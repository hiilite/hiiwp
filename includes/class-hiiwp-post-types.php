<?php
/**
 * The HiiWP Post Types class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.3
 */
if ( ! defined( 'ABSPATH' ) )	exit;
/**
 * HiiWP_Admin class.
 *
 * @since 0.4.3
 */
class HiiWP_Post_Types {
	
	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since  1.0.0
	 */
	private static $_instance = null;
	
	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since  1.0.0
	 * @static
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_types'), 0 );
		add_action('cmb2_init', array( $this, 'add_post_options' ) );
		//add_action( 'init', array( $this, 'register_taxonomies'), 0 );
	}
	
	/**
	 * register_post_types function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register_post_types() {
		$hiilite_options = Hii::get_options();
		foreach (glob(HIILITE_DIR."/includes/post_types/post_type-*.php") as $filename) {
		    include_once( $filename );
		}
		
		flush_rewrite_rules();
	}
	
	public function add_post_options() {
		foreach (glob(HIILITE_DIR."/includes/post_options/post_options-*.php") as $filename) {
		    include_once( $filename );
		}

	}
	
}