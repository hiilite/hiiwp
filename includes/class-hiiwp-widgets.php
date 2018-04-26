<?php
/**
 * The HiiWP Widgets class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.3
 */

/**
 * HiiWP_Widgets class.
 * Handels the creation of widgets to be used in sidebars. Initial creation is done in HiiWP_Shortcodes.
 *
 * @since 0.4.3
 */
if ( ! defined( 'ABSPATH' ) )	exit;
 
class HiiWP_Widgets {
	
	private static $_instance = null;
	
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'remove_recent_comments_style' ) );
	}
	
	
	/*
	on WIDGET_INIT	
	*/
	// REMOVE COMMENT CSS FROM HEADER
	public function remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'  ) );
	}
}