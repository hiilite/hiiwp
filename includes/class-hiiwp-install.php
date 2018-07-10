<?php
/**
 * The HiiWP Install class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.1
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class HiiWP_Install {
	
	
	/**
	 * install function.
	 * 
	 * Adds transients and loads welcome screen
	 *
	 * @access public
	 * @static
	 * @return void
	 * @since 0.4.7
	 */
	public static function install() {
		global $wpdb;
		
		// Redirect to setup screen for new installs
		if ( ! get_option(  'hiiwp_version' ) ) {
			set_transient( '_hiiwp_activation_redirect', 1, HOUR_IN_SECONDS);
		}
		
		delete_transient( 'hiiwp_addons_html' );
		update_option( 'hiiwp_version', HIIWP_VERSION );
	}
	
}