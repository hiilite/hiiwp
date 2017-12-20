<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HiiWP_Install
 */
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