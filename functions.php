<?php
/**
 * HiiWP functions.
 * Handles locating and loading other class-files.
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.3
 */



/**
 * Hii class.
 */
class Hii {
	/*--------------------------------------------*
     * Attributes 
     *--------------------------------------------*/
     
	/** Refers to a single instance of this class. */
	private static $_instance = null;
	
	public static $hiiwp = null;

	private $rest_api = null;
	
	public static $options = array();

	/**
	 * Main HiiWP Instance.
	 *
	 * Ensures only one instance of HiiWP is loaded or can be loaded.
	 *
	 * @since  1.0.0
	 * @static
	 * @see HIIWP()
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	/**
	* Define plugin constants
	*/
	private function define_constants(){
	    if ( ! defined( 'HIIWP_VERSION' ) ) {                
			 define( 'HIIWP_VERSION', '0.4.3' );
		}
		if ( ! defined( 'HIIWP_SLUG' ) ) {                
		    define( 'HIIWP_SLUG', 'hiiwp' );           
		}                
		if(!defined('HIILITE_DIR')) define( 'HIILITE_DIR', get_template_directory() );
		if(!defined('HIIWP_DIR')) define( 'HIIWP_DIR', get_template_directory() );
		    
		if ( ! defined( 'HIIWP_URL' ) ) {
		    $file = get_template_directory(); 
			$link = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $file );
		    define( 'HIIWP_URL', $link );
		}
	}
	
	/**
     * Initializes the theme by setting localization, filters, and administration functions.
     */
	public function __construct() {
		$this->define_constants();
		$this->add_dependencies();
		$this->add_service_extensions();
		
				
		include_once(HIILITE_DIR . '/HiiWP.php');
		
		// For backwards compatibility
		if(null == self::$hiiwp) {
			self::$hiiwp = new HiiWP();
		}
		
		$hiilite_options = self::get_options();
		
		
		foreach (glob(HIILITE_DIR."/includes/class-hiiwp-*.php") as $filename) {
		    include_once( $filename );
		} 
		
		if ( ! class_exists( 'AM_License_Menu' ) ) {
			require_once( HIILITE_DIR . '/includes/service_extensions/am-license-menu.php' );
			AM_License_Menu::instance( __FILE__, 'HiiWP', HIIWP_VERSION, 'theme', 'https://dev.hiilite.com/' );
		    
		}
		
		$this->hooks		= new HiiWP_Hooks();
		$this->post_types	= new HiiWP_Post_Types();
		$this->sidebars		= new HiiWP_Sidebars();
		$this->theme_options= new HiiWP_Theme_Options();
		
		
		
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		
		add_action( 'after_switch_theme', array( $this, 'activate') );
		
		add_action( 'after_switch_theme', array( 'HiiWP_Ajax', 'add_endpoint'), 10);
		add_action( 'after_switch_theme', array( $this->post_types, 'register_post_types'), 11);
		add_action( 'after_switch_theme', 'flush_rewrite_rules', 15);
		
		
		
		
	}
	
	
	private function add_dependencies(){
		include_once( HIILITE_DIR . '/addons/cmb2-functions.php' );
		if(!class_exists('Cmb2_Metatabs_Options'))	include_once( HIILITE_DIR . '/addons/cmb2-metatabs-options/cmb2_metatabs_options.php' );
		if(!class_exists('CMB2_Conditionals'))		include_once( HIILITE_DIR . '/addons/cmb2-conditionals/cmb2-conditionals.php' );
		if(!class_exists('PW_CMB2_Field_Select2'))	include_once( HIILITE_DIR . '/addons/cmb-field-select2/cmb-field-select2.php' );
		if(!class_exists('CMB2_Taxonomy'))			include_once( HIILITE_DIR . '/addons/cmb2-taxonomy/init.php' );
		include_once( HIILITE_DIR . '/addons/custom-field-types/address-field-type.php' );
	}
	
	private function add_service_extensions(){
		if(class_exists('WooCommerce')){
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}
		
		if(class_exists('WP_User_Manager')):
			require_once( HIILITE_DIR . '/includes/shortcodes/wpum.php');
		endif;
		
		
	}
	
	public function activate() {
		HiiWP_Ajax::add_endpoint();
		$this->post_types->register_post_types();
		HiiWP_Install::install();
		flush_rewrite_rules();
	}
	
	/**
	 * get_options function.
	 * 
	 * @access public
	 * @return void
	 */
	public static function get_options() {
		require(HIILITE_DIR . '/includes/site_variables.php');
		self::$options = $hiilite_options;
        return self::$options;
    }
    
    /**
	 * get_post_types function.
	 * 
	 * @access public
	 * @param array $args (default: array())
	 * @param string $output (default: 'names')
	 * @return void
	 */
	public function get_post_types($args = array(), $output = 'names') {
		$post_types = get_post_types( array(), $output ); 
		$types = array();
		if($output == 'objects'):
			foreach ($post_types as $post_type) {
				if( $post_type->name != 'revision' &&
					$post_type->name != 'nav_menu_item' &&
					$post_type->name != 'custom_css' &&
					$post_type->name != 'customize_changeset')
					$types[$post_type->name] = $post_type->name;
			}
		else:
			$types = $post_types;
		endif;
		return $types;
	}
    
}
function HIIWP() {
	return Hii::instance();
}

$GLOBALS['hiiwp'] = new Hii();


/**
 * hii_get_the_title function.
 * 
 * @access public
 * @return void
 */
function hii_get_the_title(){
	if( is_archive(  )){ 
		$page_title = get_the_archive_title();
	} elseif(is_home()) {
		$page_title = get_the_title( get_option('page_for_posts', true) );
	} else {
		$page_title = get_the_title( get_the_id( ));
	} 
	
	return $page_title;
}

function hii_the_title() {
	echo hii_get_the_title();
}

if(class_exists('WooCommerce')){
	include_once( HIILITE_DIR . '/includes/service_extensions/woocommerce.php' );
}
/*
Include Support Add-ons	
*/
if(class_exists('Vc_Manager')){
	/*
	Include VC Extend file
	*/
	add_action('init', 'requireVcExtend', 10);
	add_action( 'vc_after_init', 'add_vc_grid_dependancies' ); /* Note: here we are using vc_after_init because WPBMap::GetParam and mutateParame are available only when default content elements are "mapped" into the system */
	function add_vc_grid_dependancies() {
	  //Get current values stored in the color param in "Call to Action" element
	  $param = WPBMap::getParam( 'vc_basic_grid', 'item' );
	  //Append new value to the 'value' array
	  $param['dependency'] = array (
					"element" => "use_blog_layouts",
					"value" => "false",
				);
	  //Finally "mutate" param with new values
	  vc_update_shortcode_param( 'vc_basic_grid', $param );
	}
}
function requireVcExtend(){
	require_once locate_template('/extendvc/extend-vc.php');
}


/*	
GRAVITY FORMS	
*/
if(class_exists('GFForms')):
	//require_once( dirname( __FILE__ ) . '/addons/gravityformsrangeslider/rangeslider.php');
	add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
endif;



/* Add with options in Custumizer */
if(get_theme_mod( 'blog_author_bio' ) == true){
	require_once( HIILITE_DIR . '/includes/shortcodes/author-info.php');
}


/*
Speed up the WP Admin by removing or slowing down heartbeat	
*/
function optimize_heartbeat_settings( $settings ) {
    $settings['autostart'] = false;
    $settings['interval'] = 60;
    return $settings;
}
add_filter( 'heartbeat_settings', 'optimize_heartbeat_settings' );







//add_action('wp_print_scripts','add_load_css',7);
add_action('wp_head','add_load_css',7);
function add_load_css(){ 
    ?>
    <script>/*! 
		loadCSS: load a CSS file asynchronously. 
		[c]2014 @scottjehl, Filament Group, Inc. 
		Licensed MIT 
		*/
		
		function loadCSS( href, before, media ){ 
			"use strict"; 
			var ss = window.document.createElement( "link" ); 
			var ref = before || window.document.getElementsByTagName( "script" )[ 0 ]; 
			ss.rel = "stylesheet"; 
			ss.href = href; 
			ss.media = "only x"; 
			ref.parentNode.insertBefore( ss, ref ); 
			setTimeout( function(){ 
				ss.media = media || "all"; 
			} ); 
			return ss; 
		}
	</script><?php
}

add_filter('style_loader_tag', 'link_to_loadCSS_script',9999,3);
function link_to_loadCSS_script($html, $handle, $href ) {
	if(!is_admin()){
		$dom = new DOMDocument();
	    $dom->loadHTML($html);
	    $a = $dom->getElementById($handle.'-css');
	    if($a)
	    	return "<script>loadCSS('" . $a->getAttribute('href') . "',0,'" . $a->getAttribute('media') . "');</script>\n";	
	    else
	    	return $html;
	} else {
		return $html;
	}
}


/*
Flush rewrites on customizer save and theme update
*/
function my_rewrite_flush() { flush_rewrite_rules(); }
add_action( 'after_switch_theme', 'my_rewrite_flush' );
add_action( 'customize_save', 'my_rewrite_flush' );


/*
on INIT	
*/
function disable_heartbeat_unless_post_edit_screen() {
    global $pagenow;
    
    if ( $pagenow != 'post.php' && $pagenow != 'post-new.php' )
        wp_deregister_script('heartbeat');
}
add_action( 'init', 'disable_heartbeat_unless_post_edit_screen', 1 );

// REGISTER MENU AREAS
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'left-menu' => __( 'Left Menu' ),
      'right-menu' => __( 'Right Menu' ),
      'footer-menu' => __( 'Footer Menu' ),
      'bottom-menu' => __( 'Header Bottom Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


/*
//	note: customize_preview_init
*/
function hiiwp_customize_preview_js() {
    wp_enqueue_script( 'hiiwp_customizer_preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'hiiwp_customize_preview_js' );
 
/*
//	note: customize_controls_enqueue_scripts
*/
function hiiwp_customize_control_js() {
    wp_enqueue_script( 'hiiwp_customizer_control', get_template_directory_uri() . '/js/customizer-control.js', array( 'customize-controls', 'jquery' ), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'hiiwp_customize_control_js' );



// remove the default WordPress canonical URL function
if( function_exists( 'rel_canonical' ) )
{
    remove_action( 'wp_head', 'rel_canonical' );
}










/*
on WIDGET_INIT	
*/
// REMOVE COMMENT CSS FROM HEADER
add_action( 'widgets_init', 'my_remove_recent_comments_style' );
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'  ) );
}


// MAKE NEXT AND PREV LINKS BUTTONS
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
function posts_link_attributes() {
    return 'class="button"';
}


function bbp_enable_visual_editor( $args = array() ) {
    $args['tinymce'] = true;
    return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'bbp_enable_visual_editor' );



add_action('cmb2_admin_init', 'cmb2_post_metaboxes');
function cmb2_post_metaboxes(){
	//////////////////////////////////
	// Generic Options for all posts
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'page_options',
        'title'         => 'Page Options',
        'object_types'  => array( 'page', 'post', 'team', 'menu', 'portfolio' ), // post type
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


//
// Adds the meta box to the page screen
//



add_action('cmb2_admin_init', 'cmb2_blog_metaboxes');
function cmb2_blog_metaboxes(){
	//////////////////////////////////
	// Generic Options for all posts
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'blog_options',
        'title'         => 'Blog Post Options',
        'object_types'  => array( 'post' ), // post type
        'context'       => 'side', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => false, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => false, // keep the metabox closed by default
    ) );
    $cmb->add_field( array(
	    'name'    => 'Source Site',
	    'desc'    => 'Source Site',
	    'default' => '',
	    'id'      => 'source_site_title',
	    'type'    => 'text_medium'
	) );
	$cmb->add_field( array(
	    'name'    => 'Source Site URL',
	    'desc'    => 'Source Site URL',
	    'default' => '',
	    'id'      => 'source_article_link',
	    'type'    => 'text_url'
	) );
	$cmb->add_field( array(
	    'name'    => 'Canonical URL',
	    'desc'    => 'Canonical URL',
	    'default' => '',
	    'id'      => 'article_canonical_link',
	    'type'    => 'text_url'
	) );
}





add_action('cmb2_init', 'cmb2_portfolio_metaboxes');
function cmb2_portfolio_metaboxes(){
	//$prefix = '_hiilite_';
	//////////////////////////////////
	// Portfolio for all posts
	/////////////////////////////////
	$hiilite_options = Hii::$hiiwp->get_options();
	
    $cmb = new_cmb2_box( array(
        'id'            => 'portfolio_options',
        'title'         => 'Portfolio Options',
        'object_types'  => array( 'portfolio' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => false, // keep the metabox closed by default
    ) );
    if($hiilite_options['portfolio_template'] == 'split') {
	    $cmb->add_field( array(
			'name'       => __( 'Client Name', 'hiilite' ),
			'id'         => 'portfolio_client',
			'type'       => 'text'
		) );
		$cmb->add_field( array(
			'name'    => __( 'Project Description', 'hiilite' ),
			'desc'    => __( 'Add a project description (optional)', 'hiilite' ),
			'id'      => 'portfolio_description',
			'type'    => 'wysiwyg',
			'options' => array(
				'textarea_rows' => 10,
			),
		) );
		
		$cmb->add_field( array(
			'name'    => __( 'Social Share', 'hiilite' ),
			'desc'    => __( 'Add social share icons', 'hiilite' ),
			'id'      => 'project_share',
			'type'    => 'multicheck',
			'options' => array(
				'fb' => 'Facebook',
				'tw' => 'Twitter',
				'gp' => 'Google+',
				'pn' => 'Pinterest',
				'ln' => 'LinkedIn',
			),
		) );
		
		$contributors = $cmb->add_field( array(
			'id'          => 'contributers_group',
			'type'        => 'group',
			'description' => __( 'Generates reusable entries for contributors', 'hiilite' ),
			// 'repeatable'  => false, // use false if you want non-repeatable group
			'options'     => array(
				'group_title'   => __( 'Contributor {#}', 'hiilite' ), // since version 1.1.4, {#} gets replaced by row number
				'add_button'    => __( 'Add Another Contributor', 'hiilite' ),
				'remove_button' => __( 'Remove Contributor', 'hiilite' ),
				'sortable'      => true, // beta
				// 'closed'     => true, // true to have the groups closed by default
			),
		) );
		
		// Id's for group's fields only need to be unique for the group. Prefix is not needed.
		$cmb->add_group_field( $contributors, array(
			'name' => __( 'Contributor Role', 'hiilite' ),
			'id'   => 'role',
			'type' => 'text',
			//'repeatable' => true,
		) );	
		
		$users_args = array(
		    'role_in' => array('administrator','editor','author','contributor'),
		 );
		$users = get_users();
		$user_names = array();
		foreach($users as $user) {
					$user_names[$user->display_name] = $user->display_name;
		}
		$cmb->add_group_field( $contributors, array(
			'name'             => __( 'Contributor Name', 'hiilite' ),
			'id'               => 'name',
			'type'             => 'select',
			'show_option_none' => true,
			'default'          => 'custom',
			'options'          => $user_names,
		) );	
	}
	$cmb->add_field( array(
		'name' => 'Upload Images',
		'desc' => __( 'Add your project images', 'hiilite' ),
		'id'   => 'project_iamges',
		'type' => 'file_list',
		// 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
		// 'query_args' => array( 'type' => 'image' ), // Only images attachment
		// Optional, override default text strings
		'text' => array(
			'add_upload_files_text' => __( 'Add or Upload Files', 'hiilite' ), // default: "Add or Upload Files"
			'remove_image_text' => __( 'Remove Image', 'hiilite' ), // default: "Remove Image"
			'file_text' => __( 'File:', 'hiilite' ), // default: "File:"
			'file_download_text' => __( 'Download', 'hiilite' ), // default: "Download"
			'remove_text' => __( 'Remove', 'hiilite' ), // default: "Remove"
		),
	) );
	
	if($hiilite_options['portfolio_template'] == 'default') {
		$cmb->add_field( array(
			'name' => 'In Grid',
			'desc' => __( 'Keep images in grid', 'hiilite' ),
			'id'   => 'imgs_in_grid',
			'type' => 'checkbox',
		) );
	}
    /*$cmb->add_field( array(
	    'name' => 'Isolated Image',
	    'id'   => 'isolated',
	    'type' => 'checkbox',
	    'default' => false
	) );
	$cmb->add_field( array(
	    'name'    => 'Anchor Isolated Image',
	    'id'      => 'anchor_to',
	    'type'    => 'radio_inline',
	    'default' => 'center',
	    'options' => array(
	        'top-left' 	=> __( 'Top Left', 'hiilite' ),
	        'top' 		=> __( 'Top', 'hiilite' ),
	        'top-right' => __( 'Top Right', 'hiilite' ),
	        'left' 		=> __( 'Left', 'hiilite' ),
			'center' 	=> __( 'Center', 'hiilite' ),
			'right' 	=> __( 'Right', 'hiilite' ),
			'bottom-left'=> __( 'Bottom Left', 'hiilite' ),
			'bottom' 	=> __( 'Bottom', 'hiilite' ),
			'bottom-right'=> __( 'Bottom Right', 'hiilite' ),
	    ),
	) );
	$cmb->add_field( array(
	    'name'    => 'Background',
	    'id'      => 'background_color',
	    'type'    => 'colorpicker',
	    'default' => '#ffffff',
	) );
	$cmb->add_field( array(
	    'name'    => 'Minimum Padding',
	    'id'      => 'min_padding',
	    'type'    => 'text',
	    'default' => '',
	) );*/
}


function cmb2_output_portfolio_imgs( $portfolio_images ) {
	if(!empty($portfolio_images)):
		foreach($portfolio_images as $port_img) {
			echo '<div class="col-12 port-img">';
			echo '<img src="'.$port_img.'">';
			echo '</div>';	
		}
	endif;
}


//////////////////////////////////
// Taxonomy for all Portfolio
/////////////////////////////////
add_action('cmb2-taxonomy_meta_boxes', 'cmb2_portfolio_taxonomy_metaboxes');
function cmb2_portfolio_taxonomy_metaboxes( array $meta_boxes ) {
	$hiilite_options = Hii::$hiiwp->get_options();
	
	$meta_boxes['test_metabox'] = array(
		'id'            => 'portfolio_work_metabox',
		'title'         => __( 'Portfolio Category Indentity', 'hiilite' ),
		'object_types'  => array( $hiilite_options['portfolio_tax_slug'] ), // Taxonomy
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		'fields'        => array(
			array(
				'name'    => __( 'Category Color Picker', 'cmb2' ),
				'desc'    => __( 'field description (optional)', 'hiilite' ),
				'id'      => 'portfolio_work_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
			array(
				'name' => __( 'Category Icon', 'cmb2' ),
				'desc' => __( 'Upload an image or enter a URL.', 'hiilite' ),
				'id'   => 'portfolio_work_image',
				'type' => 'file',
			),
		),
	);
	return $meta_boxes;
}





function portfolio_primary_category_selection() {
	
	$hiilite_options = Hii::$hiiwp->get_options();

    $prefix = 'portfolio_';

    $cmb_demo = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => esc_html__( 'Primary Category', 'hiilite' ),
        'object_types'  => array( $hiilite_options['portfolio_slug'] ),
            'context'       => 'side',
        'priority'      => 'low',
        'show_names'    => false, 
    ) );

    $cmb_demo->add_field( array(
        'name'           => esc_html__( 'Choose Primary Category', 'hiilite' ),
        'desc'           => esc_html__( 'Choose primary category for display in post_meta', 'hiilite' ),
        'id'             => $prefix . 'category_list',
        'taxonomy'       => $hiilite_options['portfolio_tax_slug'],
        'type'           => 'taxonomy_select',
    ) );    

}
add_action( 'cmb2_admin_init', 'portfolio_primary_category_selection' );


/**
 *
 * Add Primary to [post_categories] shortcode replacing the genesis shortcode of the same name
 *
 */
function portfolio_post_primary_category_shortcode( $atts ) {

    //* get our CMB2 field and category stuff
    $prefix        = 'portfolio_';
    $primary_cat   = get_post_meta( get_the_ID(), $prefix . 'category_list', true );
    $category_id   = get_cat_ID( $primary_cat );
    $category_link = get_category_link( $category_id );
    $category_name = get_cat_name( $category_id );

    $defaults = array(
        'sep'    => ', ',
        'before' => __( 'Filed Under: ', 'hiilite' ),
        'after'  => '',
    );

    $atts = shortcode_atts( $defaults, $atts, 'post_categories' );

    //* fallback to the standard array if the choice in the primary metabox is not set
    if( empty( $primary_cat ) ) {
        $cats = get_the_category_list( trim( $atts['sep'] ) . ' ' );
    } else {
        $cats = '<a href="' . $category_link . '">' . $category_name . '</a>';
    }

    //* Do nothing if no cats
    if ( ! $cats ) {
        return '';
    }

    if ( genesis_html5() )
        $output = sprintf( '<span %s>', genesis_attr( 'entry-categories' ) ) . $atts['before'] . $cats . $atts['after'] . '</span>';
    else
        $output = '<span class="categories">' . $atts['before'] . $cats . $atts['after'] . '</span>';

    return apply_filters( 'genesis_post_categories_shortcode', $output, $atts );

}
add_shortcode( 'post_categories', 'portfolio_post_primary_category_shortcode' );



/**
 * cc_mime_types function.
 * 
 * @access public
 * @param mixed $mimes
 * @return void
 */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');



/**
 * excerpt function.
 * 
 * @access public
 * @param mixed $limit
 * @return void
 */
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 

/**
 * content function.
 * 
 * @access public
 * @param mixed $limit
 * @return void
 */
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}


/**
 * content_excerpt function.
 * 
 * @access public
 * @param int $length (default: 55)
 * @return void
 */
function content_excerpt( $length = 55 ) { 
	global $post;
	$exc = get_the_excerpt();
	if($exc != NULL && strlen($exc) > 0)
	{   
	    $excerpt = $exc;
	    
	}
	else
	{
	    if( $post->post_excerpt ) {
		    
	        $excerpt = strip_shortcodes(excerpt($length));
	    } else {
		    $content = get_the_content('');
	        $content = preg_replace("/\[[^\]]+\]/", '', $content);
	        $excerpt = wp_trim_words( $content , $length );
	    }
	}
    return $excerpt;
}


/**
 * get_wp_title function.
 * 
 * @access public
 * @param string $separator (default: ' ')
 * @param string $seplocation (default: 'left')
 * @return void
 */
function get_wp_title( $separator = ' ', $seplocation = 'left' ) {	
	$separator = apply_filters('timber_wp_title_seperator', $separator);	
	return trim(wp_title($separator, false, $seplocation));	
}	


/**
 * isset_return function.
 * 
 * @access public
 * @param mixed &$is_true (default: null)
 * @param string $prepend (default: '')
 * @param string $append (default: '')
 * @return void
 */
function isset_return(&$is_true = null, $prepend = '', $append = ''){
	return isset($is_true) && !is_array($is_true) ? $prepend.$is_true.$append : null; 
}


/**
 * empty_return function.
 * 
 * @access public
 * @param mixed &$is_true (default: null)
 * @return void
 */
function empty_return(&$is_true = null){
	return !empty($is_true) ? $is_true : null; 
}



/**
 * numeric_posts_nav function.
 * Add Numbered Pagination 
 * @access public
 * @return void
 */
function numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';
		
		printf( '<li%s><a href="%s" class="button-dis">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		if($paged == $link):
			echo '<li class="active"><span class="button button-dis">'.$paged.'</span></li>';
		else:
			printf( '<li%s><a href="%s" class="button">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		endif;
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s" class="button">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}

/* Add usport for custom event list template */
add_filter( 'FHEE__EED_Event_Archive__template_include__allow_custom_selected_template', '__return_true' );

function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );
    $replace = array('>','<','\\1');
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
} 


/**
* Hii Shortcodes
*/
add_filter('the_posts', 'conditionally_add_scripts_and_styles'); // the_posts gets triggered before wp_head
function conditionally_add_scripts_and_styles($posts){
	if (empty($posts)) return $posts;
 
	$shortcode_found = false; // use this flag to see if styles and scripts need to be enqueued
	foreach ($posts as $post) {
		if (stripos($post->post_content, 'hiicss') !== false) {
			// enqueue here
			add_filter('custom_css', function() use ($post){ 
				preg_match_all("/(hiicss)=[\"']?((?:.(?![\"']?\s+(?:\S+)=|[>\"']))+.)[\"']?/", $post->post_content, $output_array);
				
				foreach($output_array[2] as $set){
					print_r( $set );
				}
			}, 1);
			
		}
		
		if(stripos($post->post_content, 'screen-showcase') !== false) {
			add_filter('custom_css', function() use ($post){ 
				preg_match_all("/screen-showcase\s(imac_image=[\"']?((?:.(?![\"']))+.)[\"']\s?)?(macbook_image=[\"']?((?:.(?![\"']))+.)[\"']\s?)?(ipad_image=[\"']?((?:.(?![\"']))+.)[\"']\s)?(iphone_image=[\"']?((?:.(?![\"']))+.)[\"'])?/", $post->post_content, $output_array);
				
				
				$imac 		= 	wp_get_attachment_image_src($output_array[2][0], 'large');
				$macbook 	=	wp_get_attachment_image_src($output_array[4][0], 'large');
				$ipad 		= 	wp_get_attachment_image_src($output_array[6][0], 'large');
				$iphone 	= 	wp_get_attachment_image_src($output_array[8][0], 'large');
				
				
				if(!$imac && !$ipad && !$iphone && $macbook) { 		// macbook
					$sizes = array(0,80,0,0);
					$margins = array('','auto','','');
				} elseif(!$imac && !$ipad && $macbook && $iphone) { // macbook + iphone
					$sizes = array(0,60,0,9);
					$margins = array('','auto 0 0 auto','','auto auto 0 0');
				} elseif(!$imac && $macbook && $ipad && $iphone) {  // macbook + ipad + iphone
					$sizes = array(0,60,24,9);
					$margins = array('','auto 0 0 auto','auto auto 0 3%','auto auto 0 0');
				} elseif(!$imac && !$macbook && !$ipad && $iphone) { // iphone
					$sizes = array(0,0,0,80);
					$margins = array('','','','auto');
				} elseif(!$imac && !$macbook && $ipad && !$iphone) { // ipad
					$sizes = array(0,0,80,0);
					$margins = array('','','auto','');
				} elseif($imac && !$macbook && !$ipad && !$iphone) { // imac
					$sizes = array(80,0,0,0);
					$margins = array('auto','','','');
				} else {
					$sizes = array(60,46,19,6);
					$margins = array('auto auto auto 16%','auto 0 0 auto','auto auto 0 3%','auto auto 0 0');
				}
				
				 
				$html = '.hii_scrolling_screens {position: relative;margin:auto;display: flex;align-items: baseline;}.hii_scrolling_screens img {max-width: 100%;}.hii_scrolling_screens .screen:first-child{position:relative;}';
				
				$html .= '.imac_scrolling_screen {position: absolute;width:'.$sizes[0].'%;margin:'.$margins[0].';bottom: 0;}';
				$html .= '.macbook_scrolling_screen {position: absolute;width:'.$sizes[1].'%;margin:'.$margins[1].';right: 0;bottom: 0;}';
				$html .= '.ipad_scrolling_screen {position: absolute;width:'.$sizes[2].'%;margin:'.$margins[2].';bottom: 0;left: 0;}';
				$html .= '.iphone_scrolling_screen {position: absolute;width:'.$sizes[3].'%;margin:'.$margins[3].';bottom: 0;left: 0;}';
				
				$html .= ($imac[0])?'.imac_scrolling_screen .screen_area {background: url('.$imac[0].') no-repeat;background-size: 100%;width: 92%;height: 67%;position: absolute;bottom: 28%;left: 4%;animation: imac 10s ease-in-out 1s infinite;}':'';
				$html .= ($ipad[0])?'.ipad_scrolling_screen .screen_area {background: url('.$ipad[0].') no-repeat;background-size: 100%;width: 87%;height: 80%;position: absolute;bottom: 12%;left: 7%;animation: imac 10s ease-in-out 1s infinite;}':'';
				$html .= ($iphone[0])?'.iphone_scrolling_screen .screen_area {background: url('.$iphone[0].') no-repeat;background-size: 100%;width: 87%;height: 80%;position: absolute;bottom: 12%;left: 7%;animation: imac 10s ease-in-out 1s infinite;}':'';
				$html .= ($macbook[0])?'.macbook_scrolling_screen .screen_area {background: url('.$macbook[0].') no-repeat;background-size: 100%;width: 76%;height: 80%;position: absolute;bottom: 14%;left: 12%;animation: imac 10s ease-in-out 1s infinite;}':'';
				
				$html .= '@keyframes imac {0% {background-position-y: 0%;}15% {background-position-y: 0%;}30% {background-position-y: 25%;}50% {background-position-y: 50%;}70% {background-position-y: 75%;}90% {background-position-y: 100%;}100% {background-position-y: 0%;}}';
				echo $html;
			}, 1);
		}
	}
 
	return $posts;
}



/**
 * Add Custom Avatar Field
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 * @param object $user
 */
function be_custom_avatar_field( $user ) { ?>
	<h3>Custom Avatar</h3>
	 
	<table>
	<tr>
	<th><label for="be_custom_avatar">Custom Avatar URL:</label></th>
	<td>
	<input type="text" name="be_custom_avatar" id="be_custom_avatar" value="<?php echo esc_attr( get_the_author_meta( 'be_custom_avatar', $user->ID ) ); ?>" /><br />
	<span>Type in the URL of the image you'd like to use as your avatar. This will override your default Gravatar, or show up if you don't have a Gravatar. <br /><strong>Image should be 70x70 pixels.</strong></span>
	</td>
	</tr>
	</table>
	<?php 
}
add_action( 'show_user_profile', 'be_custom_avatar_field' );
add_action( 'edit_user_profile', 'be_custom_avatar_field' );
/**
 * Save Custom Avatar Field
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 * @param int $user_id
 */
function be_save_custom_avatar_field( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
		update_usermeta( $user_id, 'be_custom_avatar', $_POST['be_custom_avatar'] );
}
add_action( 'personal_options_update', 'be_save_custom_avatar_field' );
add_action( 'edit_user_profile_update', 'be_save_custom_avatar_field' );


/**
 * Use Custom Avatar if Provided
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 */
function be_gravatar_filter($avatar, $id_or_email, $size, $default, $alt) {
	
	// If provided an email and it doesn't exist as WP user, return avatar since there can't be a custom avatar
	$email = is_object( $id_or_email ) ? $id_or_email->comment_author_email : $id_or_email;
	if( is_email( $email ) && ! email_exists( $email ) )
		return $avatar;
	
	$custom_avatar = get_the_author_meta('be_custom_avatar');
	if ($custom_avatar) 
		$return = '<img src="'.$custom_avatar.'" width="'.$size.'" height="'.$size.'" alt="'.$alt.'" />';
	elseif ($avatar) 
		$return = $avatar;
	else 
		$return = '<img src="'.$default.'" width="'.$size.'" height="'.$size.'" alt="'.$alt.'" />';
	return $return;
}
add_filter('get_avatar', 'be_gravatar_filter', 10, 5);



/*
 * This function takes the last comma or dot (if any) to make a clean float, ignoring thousand separator, currency or any other letter : 
 */
function tofloat($num) {
    $dotPos = strrpos($num, '.');
    //$commaPos = strrpos($num, ',');
    $sep = ($dotPos) ? $dotPos : false;
   
    if (!$sep) {
        return floatval(preg_replace("/[^0-9]/", "", $num));
    } 

    return floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
        preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
    );
}




if(!function_exists('get_portfolio')):
function get_portfolio($args = null, $options = null){
	$hiilite_options = Hii::$hiiwp->get_options();
	$hiilite_options['portfolio_show_filter'] = get_theme_mod( 'portfolio_show_filter', true );
	$slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
	$html = $css = '';
	
	
	
	extract( shortcode_atts( array(
	    'show_post_meta'  			=> get_theme_mod( 'portfolio_show_post_meta', false ),
	    'show_post_title'  			=> get_theme_mod( 'portfolio_show_post_title', false ),
	    'portfolio_show_author_date'=> get_theme_mod( 'portfolio_show_author_date', false ),
	    'in_grid'					=> get_theme_mod( 'portfolio_in_grid', false ),
	    'add_padding'				=> get_theme_mod( 'portfolio_add_padding', '0px' ),
	    'portfolio_layout'			=> get_theme_mod( 'portfolio_layout', false ),
	    'portfolio_columns'			=> get_theme_mod( 'portfolio_columns', '1' ),
		'portfolio_image_pos'		=> get_theme_mod( 'portfolio_image_pos', 'image-left' ),
		'portfolio_title_pos'		=> get_theme_mod( 'portfolio_title_pos', 'title-below' ),
		'portfolio_heading_size'	=> get_theme_mod( 'portfolio_heading_size', 'h2' ),
		'portfolio_excerpt_on'		=> get_theme_mod( 'portfolio_excerpt_on', false ),
		'portfolio_excerpt_length'	=> get_theme_mod( 'portfolio_excerpt_length', '55' ),
		'portfolio_more_on'			=> get_theme_mod( 'portfolio_more_on', false ),
		'portfolio_more_text'		=> get_theme_mod( 'portfolio_more_text', 'Read On' ),
		'portfolio_show_filter'		=> get_theme_mod( 'portfolio_show_filter', true ),
		'css_class'					=> '',

    ), $options ) );
	$args = ($args==null)?array('post_type'=>$slug,'posts_per_page'=> -1,'nopaging'=>true,'order'=>'ASC','orderby'=>'menu_order'):$args;
	
	$query = new WP_Query($args);
	
	if($query->have_posts()):
		if($portfolio_show_filter == true):
			
			$html .= '<div class="row portfolio_filter"><div class="in_grid">';
				$work_terms = get_terms(array(
					'taxonomy'		=> $hiilite_options['portfolio_tax_slug'],
				    'hide_empty' 	=> 1,
				));
				if(count($work_terms) > 1):
				$html .= '<ul class="portfolio_terms">';
					foreach($work_terms as $term){
						$li_classes = '';
						if( isset(get_queried_object()->term_id) && get_queried_object()->term_id == $term->term_id ) $li_classes .= 'current-term';
						$html .= "<li class='$li_classes'>";
						$html .= '<a href="'.esc_attr( get_term_link( $term->term_id ) ).'">'.$term->name.'</a>';
						$html .= '</li>';
					}
				$html .= '</ul>';
				endif;
				
			
			$html .= '</div></div>';
			
		endif;
    	$html .= '<div class="row '.esc_attr( $css_class ).'">';
		if ($in_grid) $html .= '<div class="in_grid">';
		
		if($args['post_type'] == $slug):
			
			if($hiilite_options['portfolio_show_filter'] == true){
				$taxonomy_objects = get_terms($slug);
				$html .= '<div class="flex-item align-center col-12 text-block labels">';
				foreach($taxonomy_objects as $cat){
					if(!isset($cat)) {
						$html .= '<a href="/'.$slug.'/'.$cat->slug.'">'.$cat->name.'</a> ';
					} 
				}
				$html .= '</div>';
			}
		endif;
		
		$imgs = $col2 = $col3 = $col4 = $col6 = $col8 = $col9 = $col12 = array();
		$i = 0;
		
	    //////////////////////////
	    //
	    //	if attachment
	    //
	    //////////////////////////
	    
	    if($args['post_type'] == 'attachment'):
		    if($portfolio_layout == 'masonry') $html .= '<div class="row masonry col-count-'.$portfolio_columns.'">';
		    if($portfolio_layout == 'full-width') $html .= '<div class="row masonry col-count-12">';
		    $css .= '.masonry article{padding:'.$add_padding.';}';
		    foreach ( $query->posts as $attachment) :
	        	$image = wp_get_attachment_image_src( $attachment->ID, 'large' );
				
				$imgs[$i]['src'] 	= $image[0];
			    $imgs[$i]['width'] 	= $image[1];
			    $imgs[$i]['height'] = $image[2];
			    $imgs[$i]['ratio'] 	= $ratio = round($image[1] / $image[2],4);
			    $imgs[$i]['id'] 	= $attachment->ID;
			    $imgs[$i]['href'] 	= $image[0];
	        	
		        if($portfolio_layout == 'masonry-h'):
		        	$css .= '#pfi'.($attachment->ID).'{flex:'.$ratio.';}';
				
					if($ratio < 0.4) {
					    $imgs[$i]['col'] = 'col-2';
					    $col2[] = $imgs[$i];
				    }
				    elseif($ratio >= 0.4 && $ratio <=0.5){
					   $imgs[$i]['col'] = 'col-3';
					    $col3[] = $imgs[$i];
				    }
				    elseif($ratio > 0.5 && $ratio <= 0.8){
					    $imgs[$i]['col'] = 'col-4';
					    $col4[] = $imgs[$i];
				    }
				    elseif($ratio > 0.8 && $ratio <=1.1){
					    $imgs[$i]['col'] = 'col-6';
					    $col6[] = $imgs[$i];
				    }
				    elseif($ratio > 1.1 && $ratio <= 1.4){
					    $imgs[$i]['col'] = 'col-8';
					    $col8[] = $imgs[$i];
				    }
				    elseif($ratio > 1.4 && $ratio <= 1.7){
					    $imgs[$i]['col'] = 'col-9';
					    $col9[] = $imgs[$i];
				    }
				    elseif($ratio > 1.7){
					    $imgs[$i]['col'] = 'col-12';
					    $col12[] = $imgs[$i];
					};
					
				elseif($portfolio_layout == 'masonry'):
					
					$cols = '';					
					//get_template_part('templates/portfolio', 'loop');
					$html .= '<article class="row row-o-content-top flex-item" id="post-'.$imgs[$i]['id'].'" >';
					
					
										
					$html .='<figure class="flex-item">
						<img src="'.$imgs[$i]['src'].'" layout="responsive" on="tap:lightbox1" width='.$imgs[$i]['width'].' height='.$imgs[$i]['height'].'>';
					$html .= '</figure>';
					
					$html .= '</article>';
				elseif($portfolio_layout == 'boxed'):
					
					$cols = '';
					switch ($portfolio_columns) {
						case '1': 
							$cols = ' col-12'; 
						break;
						case '2': 
							$cols = ' col-6'; 
						break;
						case '3': 
							$cols = ' col-4'; 
						break;
						case '4': 
							$cols = ' col-3'; 
						break;		
					}			
					//get_template_part('templates/portfolio', 'loop');
					$html .= '<article class="row row-o-content-top flex-item '.$cols.'" id="post-'.$imgs[$i]['id'].'" >';
					
										
					$html .='<figure class="flex-item">
						<a href="'.$imgs[$i]['src'].'"><img src="'.$imgs[$i]['src'].'" layout="responsive" width='.$imgs[$i]['width'].' height='.$imgs[$i]['height'].'>';
					
					$html .= '</a></figure>';
					
					$html .= '</article>';
				endif;	
				$i++;	
				   
	    	endforeach;
			if($portfolio_layout == 'masonry'){ $html .= '</div>';};
		//////////////////////////
	    //
	    //	if regular post with feature image
	    //
	    //////////////////////////	
	    
		else:
			
			
	    	if($portfolio_layout == 'masonry') { 
		    	$html .= '<div class="row masonry col-count-'.$portfolio_columns.'">';
		    	$css .= '.masonry article {padding:'.$add_padding.';}';
		    }
			while($query->have_posts()):
				$query->the_post();
				
				if($portfolio_layout == 'masonry-h'):
				
					if ( has_post_thumbnail() ) :
						
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' );
					    
					    $imgs[$i]['src'] 	= $image[0];
					    $imgs[$i]['width'] 	= $image[1];
					    $imgs[$i]['height'] = $image[2];
					    $imgs[$i]['ratio'] 	= $ratio = ($image[1])?round($image[1] / $image[2],4):1;
					    $imgs[$i]['id'] 	= get_the_id();
					    $imgs[$i]['href'] 	= get_the_permalink();
					    $imgs[$i]['background_color'] 	= get_post_meta( get_the_ID(), 'background_color', true );
					    $imgs[$i]['isolate']= (get_post_meta(get_the_ID(),'isolated',true) == 'on')?'align-'.get_post_meta(get_the_ID(),'anchor_to', true ):'';
					    $imgs[$i]['post_title'] = get_the_title();
					    
					    if($show_post_meta):
							$imgs[$i]['post_meta'] = '<small><address class="post_author">';
							$imgs[$i]['post_meta'] .= '<a itemprop="author" itemscope itemtype="https://schema.org/Person" class="post_author_link" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><span itemprop="name">';
							$imgs[$i]['post_meta'] .= get_the_author_meta('display_name'); 
							$imgs[$i]['post_meta'] .= '</span></a></address> | <time class="time op-published" datetime="';
							$imgs[$i]['post_meta'] .= get_the_time('c');
							$imgs[$i]['post_meta'] .= '">';
							$imgs[$i]['post_meta'] .= '<span class="date">';
							$imgs[$i]['post_meta'] .= get_the_time('F j, Y');
							$imgs[$i]['post_meta'] .= ' </span>'.get_the_time('h:i a').'</time></small>';
						endif;
					    
					    $imgs[$i]['min_padding'] = $minpad = get_post_meta( get_the_ID(), 'min_padding', true );
					    $padding ='';
					    if($minpad != ''):
						    $padding = 'padding:';
						    if($imgs[$i]['isolate'] == 'align-top-left') 	$padding .= '0 '.$minpad.' 0 '.$minpad;
						    elseif($imgs[$i]['isolate'] == 'align-top') 	$padding .= '0 '.$minpad.' '.$minpad.' '.$minpad;
						    elseif($imgs[$i]['isolate'] == 'align-top-right') 	$padding .= '0 0 '.$minpad.' '.$minpad;
						    elseif($imgs[$i]['isolate'] == 'align-left') 	$padding .= $minpad.' '.$minpad.' '.$minpad.' 0';
						    elseif($imgs[$i]['isolate'] == 'align-center') 	$padding .= $minpad;
						    elseif($imgs[$i]['isolate'] == 'align-right') 	$padding .= $minpad.' 0 '.$minpad.' '.$minpad;
						    elseif($imgs[$i]['isolate'] == 'align-bottom-left') $padding .= $minpad.' '.$minpad.' 0 0';
						    elseif($imgs[$i]['isolate'] == 'align-bottom') 	$padding .= $minpad.' '.$minpad.' 0 '.$minpad;
						    elseif($imgs[$i]['isolate'] == 'align-bottom-right')$padding .= $minpad.' 0 0 '.$minpad;
						    $padding .= ';';
					    endif;
					     
					    $background_color = ($imgs[$i]['background_color'] != '')?'background:'.$imgs[$i]['background_color'].';':'';
					    
					    $css .= '#pfi'.get_the_id().'{flex:'.$ratio.';'.$background_color.$padding.'}';
					    
					    if($ratio < 0.4) {
						    $imgs[$i]['col'] = 'col-2';
						    $col2[] = $imgs[$i];
					    }
					    elseif($ratio >= 0.4 && $ratio <=0.5){
						    $imgs[$i]['col'] = 'col-3';
						    $col3[] = $imgs[$i];
					    }
					    elseif($ratio > 0.5 && $ratio <= 0.8){
						    $imgs[$i]['col'] = 'col-4';
						    $col4[] = $imgs[$i];
					    }
					    elseif($ratio > 0.8 && $ratio <=1.1){
						    $imgs[$i]['col'] = 'col-6';
						    $col6[] = $imgs[$i];
					    }
					    elseif($ratio > 1.1 && $ratio <= 1.4){
						    $imgs[$i]['col'] = 'col-8';
						    $col8[] = $imgs[$i];
					    }
					    elseif($ratio > 1.4 && $ratio <= 1.7){
						    $imgs[$i]['col'] = 'col-9';
						    $col9[] = $imgs[$i];
					    }
					    elseif($ratio > 1.7){
						    $imgs[$i]['col'] = 'col-12';
						    $col12[] = $imgs[$i];
					    }
					endif; // end if has thumbnails
				
					$i++;
				elseif($portfolio_layout == 'masonry'):
					// Create Title
					$article_title = '';
										
					if($show_post_title) {
						$article_title .= '<'.$portfolio_heading_size.'><a href="'.get_the_permalink().'">'.get_the_title().'</a></'.$portfolio_heading_size.'>';
					} 
					if($portfolio_show_author_date) {
						$article_title .= '<span itemprop="author" itemscope itemtype="https://schema.org/Person">';
						if($show_post_meta):
							$article_title .= '<small><address class="post_author">';
							$article_title .= '<a itemprop="author" itemscope itemtype="https://schema.org/Person" class="post_author_link" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><span itemprop="name">';
							$article_title .= get_the_author_meta('display_name'); 
							$article_title .= '</span></a></address> | <time class="time op-published" datetime="';
							$article_title .= get_the_time('c');
							$article_title .= '">';
							$article_title .= '<span class="date">';
							$article_title .= get_the_time('F j, Y');
							$article_title .= ' </span>'.get_the_time('h:i a').'</time></small>';
						else:
							$article_title .= '<meta itemprop="name" content="'.get_the_author_meta('display_name').'">';
						endif;
						$article_title .= '</span>';
					}
					
					$cols = '';
					
					switch ($portfolio_columns) {
						case '1': 
							$cols = ' col-12'; 
						break;
						case '2': 
							$cols = ' col-6'; 
						break;
						case '3': 
							$cols = ' col-4'; 
						break;
						case '4': 
							$cols = ' col-3'; 
						break;		
					}
					
					//get_template_part('templates/portfolio', 'loop');
					$html .= '<article class="row row-o-content-top flex-item" id="post-'.get_the_id().'" >
					<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="'.get_bloginfo('url').'"/>';
					
					if($portfolio_title_pos == 'title-above') { 
						$html .= '<div class="content-box">'.$article_title.'</div>';
					}
					
					if(has_post_thumbnail(get_the_id())): 
							
						$tn_id = get_post_thumbnail_id( get_the_id() );
				
						$img = wp_get_attachment_image_src( $tn_id, 'large' );
						$width = $img[1];
						$height = $img[2];
					
						$html .='<figure class="flex-item">
							<a href="'.get_the_permalink().'"><img src="'.$img[0].'" layout="responsive" width='.$width.' height='.$height.'>';
			
						$html .= '</a></figure>';
					endif;
					
						$html .= '<div class="flex-item';
						$html .= ($portfolio_image_pos=='image-left')?' col-6':' col-12';
						$html .= '">';
						$html .= '<meta itemprop="datePublished" content="'.get_the_time('Y-m-d').'">
						<meta itemprop="dateModified" content="'.get_the_modified_date('Y-m-d').'">';
					
					if($portfolio_title_pos == 'title-below') { 
						$html .= $article_title;
					}
					if($portfolio_excerpt_on)$html .= '<p>'.content_excerpt($portfolio_excerpt_length).'</p>';
					if($portfolio_more_on)$html .='<a class="button" href="'.get_the_permalink().'">'.$portfolio_more_text.'</a>';
					$html .= '<div></article>';
				else: // else if not masonry-h
				
					
					// Create Title
					$article_title = '';
										
					if($show_post_title) {
						$article_title .= '<'.$portfolio_heading_size.'><a href="'.get_the_permalink().'">'.get_the_title().'</a></'.$portfolio_heading_size.'>';
					} 
					if($portfolio_show_author_date) {
						$article_title .= '<span itemprop="author" itemscope itemtype="https://schema.org/Person">';
						if($show_post_meta):
							$article_title .= '<small><address class="post_author">';
							$article_title .= '<a itemprop="author" itemscope itemtype="https://schema.org/Person" class="post_author_link" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><span itemprop="name">';
							$article_title .= get_the_author_meta('display_name'); 
							$article_title .= '</span></a></address> | <time class="time op-published" datetime="';
							$article_title .= get_the_time('c');
							$article_title .= '">';
							$article_title .= '<span class="date">';
							$article_title .= get_the_time('F j, Y');
							$article_title .= ' </span>'.get_the_time('h:i a').'</time></small>';
						else:
							$article_title .= '<meta itemprop="name" content="'.get_the_author_meta('display_name').'">';
						endif;
						$article_title .= '</span>';
					}
					
					$cols = '';
					
					switch ($portfolio_columns) {
						case '1': 
							$cols = ' col-12'; 
						break;
						case '2': 
							$cols = ' col-6'; 
						break;
						case '3': 
							$cols = ' col-4'; 
						break;
						case '4': 
							$cols = ' col-3'; 
						break;		
					}
					
					//get_template_part('templates/portfolio', 'loop');
					$html .= '<article class="row row-o-content-top blog-article flex-item '.$cols.'" id="post-'.get_the_id().'" >
					<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="'.get_bloginfo('url').'"/>';
					
					if($portfolio_title_pos == 'title-above') { 
						$html .= '<div class="content-box">'.$article_title.'</div>';
					}
					
					if(has_post_thumbnail(get_the_id())): 
							
						$tn_id = get_post_thumbnail_id( get_the_id() );
				
						$img = wp_get_attachment_image_src( $tn_id, 'large' );
						$width = $img[1];
						$height = $img[2];
					
						$html .='<figure class="flex-item col-6">
							<a href="'.get_the_permalink().'"><img src="'.$img[0].'" layout="responsive" width='.$width.' height='.$height.'>';
					
						$html .= '</a></figure>';
					endif;
	
					$html .= '<div class="flex-item content-box';
					$html .= ($portfolio_image_pos=='image-left')?' col-6':' col-12';
					$html .= '">';
					$html .= '<meta itemprop="datePublished" content="'.get_the_time('Y-m-d').'">
						<meta itemprop="dateModified" content="'.get_the_modified_date('Y-m-d').'">';
					
					if($portfolio_title_pos == 'title-below') { 
						$html .= $article_title;
					}
					if($portfolio_excerpt_on)$html .= '<p>'.content_excerpt($portfolio_excerpt_length).'</p>';
					if($portfolio_more_on)$html .='<a class="button" href="'.get_the_permalink().'">'.$portfolio_more_text.'</a>';
					$html .= '<div></article>';
				endif; // end if not masonry-h
				
			endwhile;
			
			if($portfolio_layout != 'masonry-h'){
		    	$html .= '</div>';
	    	} 
		endif; //end if attachment else
		
		if($portfolio_layout == 'masonry-h'):
			$prev2 = $prev = 12; 
			$next = array(12,9,8,6,4,3);
			$rowstart = true;
			$rowend = true;
			$rowdirection = false;
			//$html .= $ratio;
			for($k=0;$k<$i;$k++){
				$current = null;
				
				$prev2 = $prev;
				$debug = null;
				// if there are 12cols and 12 col is next
				if(!empty($col12) && in_array(12,$next) && $rowend){
					$rowstart = $rowend = true;
					$current = array_shift($col12); 
					$next = array(9,8,6,4,3);
					$prev = 12;
					$debug = '12';
				} 
				// start col 9, next col 3
				elseif(!empty($col9) && in_array(9, $next) && !empty($col3)){
					$current = array_shift($col9);
					$rowstart = true;
					$rowend = false;
					$prev = 9;
					
					$next = array(3);
					
					$rowdirection = ($rowdirection)?false:true;
					
					$debug = '9->3';
				}  
				// prev col 9 end with col 3
				elseif(!empty($col3) && in_array(3, $next) && $prev == 9){
					$rowstart = false;
					$rowend = true;
					$prev = 3;
					$current = array_shift($col3);
					$next = array(3,4,6,8,12);
					$debug = '3end';
				} 
				// start col 8 end with col 4
				elseif(!empty($col8) && in_array(8, $next) && !empty($col4)){
					$rowstart = true;
					$rowend = false;
					$current = array_shift($col8);
					$prev = 8;
					
					$next = array(4);
					$rowdirection = ($rowdirection)?false:true;
					$debug = '8->4';
				} 
				// prev col 8, end with 4
				elseif(!empty($col4) && ($prev == 8) && in_array(4, $next) && $rowstart){
					$current = array_shift($col4);
					$rowstart = false;
					$rowend = true;
					$prev = 4;
					$next = array(3,4,6,8,9,12);
					$debug = '4end';
				} 
				// start col 6, end with 6
				elseif(count($col6) >= 2 && $rowend){
					$current = array_shift($col6);
					$rowstart = true;
					$rowend = false;
					$prev = 6;
					$next = array(6,3);
					$rowdirection = ($rowdirection)?false:true;
					$debug = '6->6';
				} 
				// if prev = 6, end with 6
				elseif(count($col6) && $rowstart && in_array(6, $next) && $prev == 6){
					$current = array_shift($col6);
					$rowstart = false;
					$rowend = true;
					$prev = 6;
					$next = array(3,4,6,8,9,12);
					$debug = '6end';
				} 
				// if last col9
				elseif(empty($col3) && count($col9) == 1 && !$rowstart && !$rowend) {
					$rowstart = false;
					$rowend = true;
					$prev = 9;
					$current = array_shift($col9);
					$current['col'] = 'col-4';
					$next = array(12,9,8,6,4,3);
					$debug = '9[4]end';
				}
				// start with 4 continue with 4 if more then 2 col4s
				elseif(count($col4) > 2 && !$rowstart && $rowend){
					$current = array_shift($col4);
					$rowstart = true;
					$rowend = false;
					$prev = 4;
					$next = array(4);
					$rowdirection = ($rowdirection)?false:true;
					$debug = '4r2';
				} 
				// continue with 4 if prev was 4 in same row
				elseif(in_array(4, $next) && $rowstart && !$rowend){
					$current = array_shift($col4);
					$rowstart = false;
					$rowend = false;
					$prev = 4;
					$next = array(4);
					$debug = '4p4>4';
				} 
				
				// continue with 4 if prev was 4 in same row and end with 4
				elseif(in_array(4, $next) && !$rowstart && !$rowend){
					$current = array_shift($col4);
					$rowstart = false;
					$rowend = true;
					$prev = 4;
					$next = array(4,3,6,8,9,12);
					$debug = '4end';
				} 
				
				// start with 3, cont with 3 if more then 3
				elseif(count($col3) > 2 && !$rowstart){
					$rowstart = true;
					$rowend = false;
					$prev = 3;
					$current = array_shift($col3);
					$next = array(3,6,9);
				} 
				// cont with 3 if prev was 3
				elseif(in_array(3, $next) && $rowstart && !$rowend && count($col3) > 1){
					$rowstart = false;
					$rowend = false;
					$prev = 3;
					$current = array_shift($col3);
					$next = array(3,6);
					$debug = '3p>6>8';
				} 
				
				// cont with 3 if prev was 3
				elseif(in_array(3, $next) && !$rowstart && !$rowend){
					$rowstart = false;
					$rowend = false;
					$prev = 3;
					$current = array_shift($col3);
					$next = array(3);
					$debug = '3p>6>8';
				} 
				// cont with 3 if prev was 3
				elseif(in_array(3, $next) && !in_array(6, $next) && !$rowstart && !$rowend){
					$rowstart = false;
					$rowend = true;
					$prev = 3;
					$current = array_shift($col3);
					$next = array(3,4,6,8,9,12);
					$debug = '3p>6>8';
				} 
				
				// if only 2 3s, make 6s
				elseif(count($col3) == 2 && !$rowstart){
					$rowstart = true;
					$rowend = false;
					$prev = 3;
					$current = array_shift($col3);
					$current['col'] = 'col-6';
					$next = array(3);
					$debug = '3p>6>8';
				} 
				// if only 2 3s, make 6s
				elseif(count($col3) == 1 && $rowstart){
					$rowstart = false;
					$rowend = true;
					$prev = 3;
					$current = array_shift($col3);
					$current['col'] = 'col-6';
					$next = array(4,6,8,9,12);
					$debug = '3p>6>8';
				} 
				//if still 8s but no 4s
				// cont with 3 if prev was 3
				elseif(count($col8) > 1 && empty($col4) ){
					$rowstart = true;
					$rowend = false;
					$prev = 8;
					$current = array_shift($col8);
					$current['col'] = 'col-6';
					$next = array(8);
					$debug = '8p>6>8';
				} 		
				elseif(count($col8) && empty($col4) && in_array(8, $next) && $prev == 8){
					$rowstart = false;
					$rowend = true;
					$prev = 8;
					$current = array_shift($col8);
					$current['col'] = 'col-6';
					$next = array(3,4,6,8,9,12);
					$debug = '8[6]end';
				}
				// last col8
				elseif(count($col8) == 1){
					$rowstart = true;
					$rowend = true;
					$prev = 8;
					$current = array_shift($col8);
					$current['col'] = 'col-12';
					$next = array(3,4,6,8,9,12);
					$debug = '8>12';
				} 
				// if last 3 col9
				elseif(empty($col3) && count($col9) == 3 && $rowend) {
					$rowstart = true;
					$rowend = false;
					$prev = 9;
					$current = array_shift($col9);
					$current['col'] = 'col-4';
					$next = array(9);
					$debug = '9[4]->9';
				}// if last col9
				elseif(empty($col3) && count($col9) == 2 && $rowstart && !$rowend) {
					$rowstart = false;
					$rowend = false;
					$prev = 9;
					$current = array_shift($col9);
					$current['col'] = 'col-4';
					$next = array(9);
					$debug = '4p9[4]>9';
				}
				// if col9 but no col 3s
				elseif(!empty($col9) && empty($col3) && $rowend && $rowstart) {
					$rowstart = true;
					$rowend = false;
					$prev = 6;
					$current = array_shift($col9);
					$current['col'] = 'col-6';
					$next = array(6,9);
					$debug = '9[6]';
				}
				
				// if col9 but no col 3s
				elseif(!empty($col9) && empty($col3) && !$rowstart) {
					$rowstart = true;
					$rowend = false;
					$prev = 6;
					$current = array_shift($col9);
					$current['col'] = 'col-6';
					$next = array(6,9);
					$debug = '9[6]';
				}
				// if col9 but no col 3s
				elseif(!empty($col9) && empty($col3) && $rowstart) {
					$rowstart = false;
					$rowend = true;
					$prev = 6;
					$current = array_shift($col9);
					$current['col'] = 'col-6';
					$next = array(3,4,6,8,9,12);
					$debug = '9[6]end';
				}
				
				// if last col 6
				elseif(count($col6) == 1 && $rowend) {
					$rowstart = true;
					$rowend = true;
					$prev = 6;
					$current = array_shift($col6);
					$current['col'] = 'col-12';
					$next = array(3,4,6,8,9,12);
					$debug = '6>12last';
				} else {
					$rowend = true;
				}
				
				
				if ($rowstart){ 
					$html .= '<div class="container_inner fixed_columns portfolio_row ';
					$html .= ($rowdirection)?'row_reverse">':'">';
				}
				if(!isset($current['isolate'])) $current['isolate'] ='';
				if(isset($current['id'])):
					$html .= '<div id="pfi'.$current['id'].'" class="flex-item '.$current['col'].' '.$current['isolate'].'">';
					//$html .= $debug;
					if($args['post_type'] != 'attachment') $html .= '<a href="'.$current['href'].'">';
					$html .= '<img src="'.$current['src'].'" layout="responsive" width="'.$current['width'].'" height="'.$current['height'].'"';
					if($args['post_type'] == 'attachment') $html .= ' on="tap:lightbox1" role="button" ';
					$html .= '>';
					if($args['post_type'] != 'attachment') $html .= '</a>';
					if($args['post_type'] != 'attachment') {
						if($show_post_title ||  $show_post_meta) $html .= '<div class="post_meta">';
						if($show_post_title) $html .= '<h3>'.$current['post_title'].'</h3><br>';
						if($show_post_meta) $html .= $current['post_meta'];
						if($show_post_title ||  $show_post_meta) $html .= '</div>';
					}
					$html .= '</div>';
				
					
				endif;
				if ($rowend) $html .= '</div>';
			}
		
		endif; // end masonry-h
		
		if ($in_grid) $html .= '</div>';
		$html .= '</div>';
		
		$hiilite_options['portfolio_custom_css'] = $css;
		
		$html .= '<style>'.$hiilite_options['portfolio_custom_css'].'</style>';
		if($args['post_type'] == 'attachment') { 
			$html .= '<amp-image-lightbox id="lightbox1" layout="nodisplay"><div id="closelightbox" on="tap:lightbox1.close"></div></amp-image-lightbox>';
			$hiilite_options['portfolio_custom_css'] .= '#closelightbox{position:fixed;width:100vw;height:100vh;z-index:9999;}';
		}
		
		
		
	endif;
	
	return $html;
}
endif;
?>