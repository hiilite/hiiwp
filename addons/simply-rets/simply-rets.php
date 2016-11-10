<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Code starts here */

$plugin = dirname(__FILE__);
$link = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $plugin );
define('RETSPATH',    $plugin.'/');
define('RETSURL',     $link.'/');
$php_version = phpversion();

require __DIR__.'/vendor/autoload.php';

require_once( RETSPATH . 'simply-rets-utils.php' );
require_once( RETSPATH . 'simply-rets-post-pages.php' );
require_once( RETSPATH . 'simply-rets-api-helper.php' );
require_once( RETSPATH . 'simply-rets-shortcode.php' );
require_once( RETSPATH . 'simply-rets-widgets.php' );
require_once( RETSPATH . 'simply-rets-maps.php' );


if ( is_admin() ) {
    require_once( RETSPATH . 'simply-rets-admin.php' );
    add_action( 'admin_init', array( 'SrAdminSettings', 'register_admin_settings' ) );
    add_action( 'admin_menu', array( 'SrAdminSettings', 'add_to_admin_menu' ) );
}

add_shortcode( 'sr_residential',     array( 'SrShortcodes', 'sr_residential_shortcode' ) );
add_shortcode( 'sr_listings',        array( 'SrShortcodes', 'sr_residential_shortcode' ) );
add_shortcode( 'sr_openhouses',      array( 'SrShortcodes', 'sr_openhouses_shortcode' ) );
add_shortcode( 'sr_search_form',     array( 'SrShortcodes', 'sr_search_form_shortcode' ) );
add_shortcode( 'sr_listings_slider', array( 'SrShortcodes', 'sr_listing_slider_shortcode' ) );
add_shortcode( 'sr_map_search',      array( 'SrShortcodes', 'sr_int_map_search' ) );

add_action( 'widgets_init', 'srRegisterWidgets' );
add_action( 'wp_enqueue_scripts', array( 'SimplyRetsApiHelper', 'simplyRetsClientCss' ) );
add_action( 'wp_enqueue_scripts', array( 'SimplyRetsApiHelper', 'simplyRetsClientJs' ) );
add_filter( 'query_vars', array( 'SimplyRetsCustomPostPages', 'srQueryVarsInit' ) );
add_filter( "plugin_action_links_{$plugin}", array( 'SimplyRetsCustomPostPages', 'srPluginSettingsLink' ) );

register_activation_hook( __FILE__,   array('SimplyRetsCustomPostPages', 'srActivate' ) );
register_deactivation_hook( __FILE__, array('SimplyRetsCustomPostPages', 'srDeactivate' ) );