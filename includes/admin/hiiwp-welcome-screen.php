<?php
/**
 * Welcome Screen Init
 * Actions for initializing the Welcome Screen
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2019, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0.4
 */

 
if ( ! defined( 'ABSPATH' ) ) exit; 
 
class HiiWP_Welcome_Screen {
	
	public function __construct(){
		HiiWP::register_theme_activation_hook( 'hiiwp', array( $this, 'welcome_activate' ) );
		HiiWP::register_theme_deactivation_hook( 'hiiwp', array( $this, 'welcome_deactivate') );
		
		add_action( 'admin_init', array( $this, 'safe_welcome_redirect' ) );
		add_action( 'admin_menu', array( $this, 'welcome_page' ), 10 );
		
	}
	
	/**
	 * Activates the welcome page.
	 *
	 * Adds transient to manage the welcome page.
	 *
	 * @since 0.4.7
	 */
	public function welcome_activate() {
	 
	    // Transient max age is 60 seconds.
	    set_transient( '_welcome_redirect_hiiwp', true, 60 );
	 
	}
	
	public function welcome_deactivate() {
 
	  delete_transient( '_welcome_redirect_hiiwp' );
	 
	}
	
	/**
	 * Welcome page redirect.
	 *
	 * Only happens once and if the site is not a network or multisite.
	 *
	 * @since 0.4.7
	 */
	public function safe_welcome_redirect() {
	 
	    // Bail if no activation redirect transient is present.
	    if ( ! get_transient( '_welcome_redirect_wpw' ) ) {
	 
	        return;
	 
	    }
	 
	  // Delete the redirect transient.
	  delete_transient( '_welcome_redirect_hiiwp' );
	 
	  // Bail if activating from network or bulk sites.
	  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
	 
	    return;
	 
	  }
	 
	  // Redirect to Welcome Page.
	  // Redirects to `your-domain.com/wp-admin/admin.php?page=hiiwp-welcome`.
	  wp_safe_redirect( add_query_arg( array( 'page' => 'hiiwp-welcome' ), admin_url( 'admin.php' ) ) );
	 
	}
	
	/**
	 * Adds welcome page sub menu.
	 *
	 * @since 1.0
	 */
	public function welcome_page() {
	  global $hiiwp_sub_menu;
	 
	  $hiiwp_sub_menu = add_theme_page(  
	  	__('About HiiWP', 'hiiwp'), 
	  	__('About HiiWP', 'hiiwp'), 
	  	'manage_options', 
	  	'admin.php?page=hiiwp-welcome',
	  	array( $this, 'welcome_page_content' ) );
	}
	
	/**
	 * Welcome page content.
	 *
	 * @since 0.4.7
	 */
	public function welcome_page_content() {
	 
	    if ( file_exists( HIILITE_DIR . '/includes/admin/welcome/welcome-view.php') ) {
	 
	       require_once( HIILITE_DIR . '/includes/admin/welcome/welcome-view.php' );
	 
	    }
	}
	
	
	 
}