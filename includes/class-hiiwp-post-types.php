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
		$hiilite_options = Hii::get_options();
		add_action( 'init', array( $this, 'register_post_types'), 0 );
		add_action('cmb2_init', array( $this, 'add_post_options' ) );
		add_action('cmb2_admin_init', array( $this, 'cmb2_post_metaboxes' ) );
		//add_action( 'init', array( $this, 'register_taxonomies'), 0 );
		
		
		add_filter( 'posts_where', array( $this, 'password_post_filter' ) );
		
		
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
	
	
	
	/**
	 * cmb2_post_metaboxes function.
	 * 
	 * @access public
	 * @return void
	 */
	public function cmb2_post_metaboxes(){
		//////////////////////////////////
		// Generic Options for all posts
		/////////////////////////////////
	    $cmb = new_cmb2_box( array(
	        'id'            => 'page_options',
	        'title'         => 'Page Options',
	        'object_types'  => array( 'page', 'post', 'team', 'menu', 'portfolio', 'product' ), // post type
	        'context'       => 'normal', // 'normal', 'advanced' or 'side'
	        'priority'      => 'low', // 'high', 'core', 'default' or 'low'
	        'show_names'    => true, // show field names on the left
	        'cmb_styles'    => true, // false to disable the CMB stylesheet
	        'closed'        => false, // keep the metabox closed by default
	    ) );
	    
	    // metabox title
		$cmb->add_field( array(
		    'name' => 'Hide Page Title',
		    'id'   => 'show_page_title',
		    'type' => 'select',
		    'default' => 'default',
		    'options' => array(
			    'default' => 'Theme Default',
		        'hide' => 'Hide Page Title',
		        'show'    => 'Show Page Title',
		    )
		) );
		
		$cmb->add_field( array(
		    'name' => 'Hide Feature Image',
		    'id'   => 'hide_page_feature_image',
		    'type' => 'select',
		    'default' => 'default',
		    'options'  => array(
			    'default' => 'Theme Default',
		        'hide' => 'Hide Image Title',
		        'show'    => 'Show Image Title',
		    )
		) );
		
		$cmb->add_field( array(
		    'name'             => 'Title Background Color',
		    'desc'             => 'Edit color sets in the theme customizer',
		    'id'               => 'page_title_bg',
		    'type'             => 'colorpicker',
		    'default'          => '',
		) );
		
		$cmb->add_field( array(
		    'name'             => 'Title Background Image',
		    'desc'             => 'Edit background image sets in the theme customizer',
		    'id'               => 'page_title_bgimg',
		    'type'             => 'file',
		    'options' => array(
				'url' => false, // Hide the text input for the url
			),
			'text'    => array(
				'add_upload_file_text' => 'Choose Image' // Change upload button text. Default: "Add or Upload File"
			),
			
		) );
		
		$cmb->add_field( array(
		    'name'             => 'Header Background Color',
		    'desc'             => 'Edit color sets in the theme customizer',
		    'id'               => 'header_bg',
		    'type'             => 'colorpicker',
		    'default'          => '',
		) );
		
		$cmb->add_field( array(
		    'name'             => 'Page Background Color',
		    'desc'             => 'Edit color sets in the theme customizer',
		    'id'               => 'page_bg',
		    'type'             => 'colorpicker',
		    'default'          => '',
		) );
		
		$cmb->add_field( array(
		    'name'             => 'Title Font Color',
		    'desc'             => 'Edit color sets in the theme customizer',
		    'id'               => 'page_title_color',
		    'type'             => 'colorpicker',
		    'default'          => '',
		) );
		
		
	}
	
	
	/**
	 * password_post_filter function.
	 * 
	 * @access public
	 * @param string $where (default: '')
	 * @return void
	 */
	public function password_post_filter( $where = '' ) {
		$hiilite_options = Hii::get_options();
	    if (!is_single() && !is_admin() && $hiilite_options['blog_hide_password_protected_posts'] === true ) {
	        $where .= " AND post_password = ''";
	    }
	    return $where;
	}
	
}