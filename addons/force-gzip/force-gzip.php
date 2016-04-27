<?php
/*
Plugin Name: Force gzip
Plugin URI: http://justin.wordpress.com/2010/07/13/force-gzip/
Description: Implements gzip output compression to speed up load times. This plugin also does a check to see if browsers are incorrectly saying that they do not support GZIP when they actually do. This can speed up load times for a significant portion of users.
Author: Justin Shreve
Version: 1.0.1
Author URI: http://justinshreve.com
License: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html
*/

/**
* Force gzip
*
* Adds gzip output compression to WordPress.
*
* <blockquote>For requests with missing or mangled Accept-Encoding headers, inspect the User-Agent to identify browsers that should understand gzip.
* Test their ability to decompress gzip.
* If successful, send them gzipped content!</blockuote>
*
* @package Forcegzip
* @since 1.0.0
* @version 1.0.1
*
* @see http://www.stevesouders.com/blog/2010/07/12/velocity-forcing-gzip-compression/
* @see http://en.oreilly.com/velocity2010/public/schedule/detail/14334
* @see http://wpdevel.wordpress.com/2010/07/13/forcing-gzip-httpwww-stevesouders-co/
*/

/*  Copyright © 2010 Force gzip Justin Shreve (email : jshreve4@kent.edu)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
* Provides a wrapper for the Force GZIP functionality
*
* @since 1.0.0
*/
class force_gzip {
	
	/*
	* Hooks the methods of the class into WordPress
	*
	* @since 1.0.0
	*/
	function force_gzip() {
		add_action( 'init', array( &$this, 'controller' ) );
		add_filter( 'query_vars',  array( &$this, 'register_query_vars' ) );
		add_action( 'parse_query',  array( &$this, 'compressiontest' ) );
	}
	
	/*
	* Decides how to deal with gzip output buffering
	*
	* Does a few checks to see how we want to handle the request
	* There are three possibilities:
	* 1) Do nothing because gzip is NOT supported by the browser.
	* 2) Simply enable gzip buffering because we already know that the browser supports it.
	* 3) Check if headers are not mangeled and set a cookie to let us know that.
	* The function contains more comments on what is happening here.
	*
	* @since 1.0.0
	*
	* @return void
	*/
	function controller() {	
	
		// If we found previously that the browser does not support GZIP we will do nothing.
		if ( !empty( $_COOKIE['GZ'] ) && $_COOKIE['GZ'] == "Z=0" )
			return;
			
		// Don't do a check if we find Accept-Encoding: identity.
		if ( !empty( $_SERVER['HTTP_ACCEPT_ENCODING'] ) && strpos( strtolower( $_SERVER['HTTP_ACCEPT_ENCODING'] ), 'identity' ) !== false )
			return;
	
		// Check to see if the browser is reporting GZIP off (if a previous check has not been done).
		if ( empty( $_SERVER['HTTP_ACCEPT_ENCODING'] ) || strpos( strtolower( $_SERVER['HTTP_ACCEPT_ENCODING'] ), 'gzip' ) === false ) {
			if( empty( $_COOKIE['GZ'] ) ) {
				if( $this->is_modern_browser() ) // Check if this is a modern browser and if so add the iframe to the bottom of the page.
					add_action( 'wp_footer', array( &$this, 'generate_iframe' ) );
			}
			return;
		}
		
		// Check to see if we set a cookie on a previous request and if it can verify GZIP compression.
		if ( !empty( $_COOKIE['GZ'] ) && $_COOKIE['GZ'] == "Z=1" ) {
			// Add gzip to the list of accepted encodings
			if( empty( $_SERVER['HTTP_ACCEPT_ENCODING'] ) )
				$_SERVER['HTTP_ACCEPT_ENCODING'] = "gzip";
			else 
				$_SERVER['HTTP_ACCEPT_ENCODING'] .= ",gzip";
		}
		
		// We are allowed to enable GZIP output buffering...
		if (  function_exists('ob_gzhandler') && false !== strpos( strtolower( $_SERVER['HTTP_ACCEPT_ENCODING'] ), 'gzip') )
			ob_start("ob_gzhandler");
				
		return;
		
	}

	/*
	* Does a check to see if the current browser is considered a "modern browser".
	*
	* Modern is defined as (IE 6+, Firefox 1.5+, Safari 2+, Opera 7+, Chrome)
	* As defined by http://assets.en.oreilly.com/1/event/44/Forcing%20Gzip%20Compression%20Presentation.zip
	* Based on code Copyright (C) 2008-2009 Chris Schuld  (chris@chrisschuld.com) - Changed 7/13/2010
	*
	* @see http://blog.mavrick.id.au/programming/2008/the-all-new-php-browser-detection/
	* @see http://chrisschuld.com/
	* @see http://assets.en.oreilly.com/1/event/44/Forcing%20Gzip%20Compression%20Presentation.zip
	*
	* @since 1.0.0
	*
	* @return true if the current browser is a modern browser, false if not
	*/
	function is_modern_browser() {
		global $is_chrome, $is_safari, $is_gecko, $is_winIE, $is_macIE, $is_opera; // WordPress has already done some simple browser detection for us (wp-includes/vars.php)
		
		// All chrome versions are "modern"
		if ( $is_chrome == true )
			return true;
			
		// Check to see if we are using a Safari version greater than 2.0
		if ( $is_safari == true ) {
			$versions = explode( '/', stristr( $_SERVER['HTTP_USER_AGENT'], 'Version' ) );
			
			if ( !empty( $versions[1] ) ) {
				$version = explode(' ', $versions[1] );
				
				if( $version[0] >= 2 )
					return true;
			}
		}
		
		// Check to see if we are using a Firefox version greater than 1.5
		if ( $is_gecko == true ) {
			$versions  = explode( '/', stristr( $_SERVER['HTTP_USER_AGENT'], 'Firefox' ) );
			$version = explode( ' ', $versions[1] );
			
			if ( $version[0] >= 1.5 )
				return true;
		}
		
		// Check to see if we are using a Internet Explorer version greater than 6
		if ( $is_winIE == true || $is_macIE == true ) {
			if ( preg_match( '/msie/i', $_SERVER['HTTP_USER_AGENT'] ) && ! preg_match( '/opera/i', $_SERVER['HTTP_USER_AGENT'] ) ) {
					$versions = explode( ' ', stristr( str_replace( ';', '; ', $_SERVER['HTTP_USER_AGENT'] ), 'msie') );
					$version = str_replace( array( '(', ')', ';' ), '', $versions[1] );
					
					if ( $version >= 6 )
						return true;
			}
		}
		
		// Check to see if we are using an Opera version greater than 7
		if ( $is_opera == true ) {
				if ( preg_match( '/Version\/(10.*)$/', stristr( $_SERVER['HTTP_USER_AGENT'], 'opera' ), $matches ) ) {
					if ( $matches[1] >= 7 )
						return true;
				} elseif ( preg_match( '/\//', stristr( $_SERVER['HTTP_USER_AGENT'], 'opera' ) ) ) {
					$versions = explode('/', stristr( $_SERVER['HTTP_USER_AGENT'], 'opera' ) );
					$version = explode( ' ', $versions[1] );
						
					if ( $version[0] >= 7 )
						return true;
				} else {
					$version = explode( ' ', stristr( $_SERVER['HTTP_USER_AGENT'], 'opera' ) );
						
					if ( $version[0] >= 7 )
						return true;
				}
		}
		
		return false; // This means we couldn't detect it with this definition of a modern browser.
	}


	/*
	* Adds a new query var to be monitored by WPQuery
	*
	* @since 1.0.0
	*
	* @return array The appended array of supported query vars
	*/
	function register_query_vars( $vars ) {	
		$vars[] = "compressiontest";
		return $vars;
	}

	/*
	* Returns a GZ compressed version of the HTML page that sets a cookie if loaded.
	*
	* This function is loaded with the query string compressiontest is set to gzip.html 
	* (?compressiontest=gzip.html)
	* This must end in .html for Internet Explorer.
	*
	* @since 1.0.0
	*
	* @return void
	*/
	function compressiontest( $query ) {	
		$compressiontest = ( !empty( $query->query_vars['compressiontest']) ) ? $query->query_vars['compressiontest'] : '';
		if( $compressiontest == 'gzip.html' ) {	
		
			// Recommended headings for GZIP output.
			// We do NOT want to cache this
			header( 'Content-Type: text/html; charset=UTF-8' );
			header( 'Vary: Accept-Encoding' );
			header( 'Pragma: no-cache' );
			header( 'Expires: Fri, 01 Jan 1990 00:00:00 GMT' );
			header( 'Cache-Control: no-cache, must-revalidate' );
			header( 'Content-Encoding: gzip' );
			
			// Load the compressed file
			$file = dirname(__FILE__) . '/compressiontest.html.gz';
			
			if ( function_exists('realpath') )
				$file= realpath( $file );
	
			if ( is_file( $file ) )
				echo file_get_contents( $file );
			
			die;
			
		}
	}


	/*
	* Generates the JavaScript that creates an iframe to load the compression test.
	*
	* @since 1.0.0
	*
	* @return void
	*/
	function generate_iframe() { ?>
		<script>
			if ( ! document.cookie.match( /GZ=Z=[0,1]/ ) ) {
				document.cookie = 'GZ=Z=0;path=/';
				var force_gzip_iframe = document.createElement( 'iframe' );
				force_gzip_iframe.src = '<?php echo home_url( "?compressiontest=gzip.html" ); ?>';
				document.body.appendChild( force_gzip_iframe );
			}
		</script> <?php
	}
	
}

new force_gzip;
?>