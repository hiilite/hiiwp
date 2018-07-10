<?php
/**
 * The HiiWP Ajax class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.1
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HiiWP_Ajax {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( __CLASS__, 'add_endpoint') );
		add_action( 'template_redirect', array( __CLASS__, 'do_ajax'), 0 );
	}
	
	/**
	 * Add our endpoint for frontend ajax requests
	 */
	public static function add_endpoint() {
		add_rewrite_tag( '%hiiwp-ajax%', '([^/]*)' );
		add_rewrite_rule( 'hiiwp-ajax/([^/]*)/?', 'index.php?hiiwp-ajax=$matches[1]', 'top' );
		add_rewrite_rule( 'index.php/hiiwp-ajax/([^/]*)/?', 'index.php?hiiwp-ajax=$matches[1]', 'top' );
	}
	
	/**
	 * Get HiiWP Ajax Endpoint
	 * @param  string $request Optional
	 * @param  string $ssl     Optional
	 * @return string
	 */
	public static function get_endpoint( $request = '%%endpoint%%', $ssl = null ) {
		if ( strstr( get_option( 'permalink_structure' ), '/index.php/' ) ) {
			$endpoint = trailingslashit( home_url( '/index.php/hiiwp-ajax/' . $request . '/', 'relative' ) );
		} elseif ( get_option( 'permalink_structure' ) ) {
			$endpoint = trailingslashit( home_url( '/hiiwp-ajax/' . $request . '/', 'relative' ) );
		} else {
			$endpoint = add_query_arg( 'hiiwp-ajax', $request, trailingslashit( home_url( '', 'relative' ) ) );
		}
		return esc_url_raw( $endpoint );
	}
	
	/**
	 * Check for WC Ajax request and fire action
	 */
	public static function do_ajax() {
		global $wp_query;

		if ( ! empty( $_GET['hiiwp-ajax'] ) ) {
			 $wp_query->set( 'hiiwp-ajax', sanitize_text_field( $_GET['hiiwp-ajax'] ) );
		}

   		if ( $action = $wp_query->get( 'hiiwp-ajax' ) ) {
   			if ( ! defined( 'DOING_AJAX' ) ) {
				define( 'DOING_AJAX', true );
			}

			// Not home - this is an ajax endpoint
			$wp_query->is_home = false;

   			do_action( 'hiiwp_ajax_' . sanitize_text_field( $action ) );
   			die();
   		}
	}
	
	

}

new HiiWP_Ajax();