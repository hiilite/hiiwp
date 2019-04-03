<?php
/**
 * The HiiWP Install class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2019, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0.4
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class HiiWP_Install {
	
	function __construct() {
		add_action('admin_notices', array($this,'theme_activation_admin_notice'));
		add_action('wp_ajax_template_hide_admin_notice', array($this, 'template_hide_admin_notice_hook'));
        add_action('wp_ajax_nopriv_template_hide_admin_notice', array($this, 'template_hide_admin_notice_hook'));
	}
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
	
	
	public function theme_activation_admin_notice(){
        if( get_option('hiiwp_admin_notice')!==false && get_option('hiiwp_admin_notice')=="0" )
            return;

        echo '<div class="updated" id="theme-admin-notice">
                <h3>Welcome to '.wp_get_theme()->template.' theme.</h3>
                <p>
                    <a href="'.esc_url(admin_url()).'themes.php?page=admin.php%3Fpage%3Dhiiwp-welcome" class="button-primary" style="text-decoration:none;"><span class="dashicons dashicons-welcome-learn-more"></span> Learn To Use '.wp_get_theme()->template.'</a>
                    <a href="'.esc_url(admin_url()).'customize.php" class="button-primary" style="text-decoration:none;"><span class="dashicons dashicons-admin-customizer"></span> Live Customizer</a>
                    <a href="javascript: tt_template_hide_admin_notice();" class="button" style="text-decoration:none;"><span class="dashicons dashicons-no"></span> Hide Notice</a>
                </p>
            </div>';
    }


    
    public function template_hide_admin_notice_hook(){
        update_option('hiiwp_admin_notice', 0);
        exit;
    }

	
}

new HiiWP_Install();