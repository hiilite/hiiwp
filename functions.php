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
 * @since       0.4.1
 */
/*
Theme Structure:
- Admin
-- SEO Options
-- Theme Customizer (Kirki)
-- Post Panels

- SEO 
-- Shortcodes of values
-- Meta data modification

- Compression
-- WordPress speed enhancements
-- CSS Inlining
-- JS Async Loading

- Custom Shortcodes
-- Sliders

- Plugin Modifiers
-- Gravity Forms
-- WooCommerce

========================
Folder Structure: 
- post_types
-- portfolio
-- food
-- testimonials
--- shortcodes
--- editor
--- templates


TODO: Create class that will handle the creation of Kirki customizer options, while simaltaniously creating the same options in a Theme Options Page.

TODO: Have all CSS scripts that cannot be inlined loaded asyncronously use Google suggested Javascript method [https://www.keycdn.com/blog/google-pagespeed-insights-wordpress/].

TODO: Implement Classes using the Singleton Pattern to prevent multiple instances [https://code.tutsplus.com/articles/design-patterns-in-wordpress-the-singleton-pattern--wp-31621].

**/


if ( ! defined( 'HIIWP_VERSION' ) ) {                
	 define( 'HIIWP_VERSION', '0.3.9' );
}
if ( ! defined( 'HIIWP_SLUG' ) ) {                
    define( 'HIIWP_SLUG', 'hiiwp' );           
}                
if(!defined('HIILITE_DIR')) define( 'HIILITE_DIR', get_template_directory() );
    
if ( ! defined( 'HIIWP_URL' ) ) {
    $file = get_template_directory(); // Current PHP file, but can be anyone
	$link = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $file );
    define( 'HIIWP_URL', $link );
}
include_once(HIILITE_DIR . '/HiiWP.php');
include_once(HIILITE_DIR . '/includes/class-hiiwp-admin.php');

/**
 * Hii class.
 * Based on the Simple Factory methods Plugin class, mixed with the Singleton method of checking if the class is already set.
 * load the HiiWP class
 */
class Hii {
	/*--------------------------------------------*
     * Attributes
     *--------------------------------------------*/
     
	/** Refers to a single instance of this class. */
	public static $hiiwp = null;
	public static $hiiwp_admin = null;
	
	
	
	/*--------------------------------------------*
     * Constructor
     *--------------------------------------------*/
 
    /**
     * Creates or returns an instance of this class.
     *
     * @return  Foo A single instance of this class.
     */
     public static function say_hii(){
		if(null == self::$hiiwp) {
			self::$hiiwp = new HiiWP();
		}
		return self::$hiiwp;
	}
	
	public static function say_hii_admin(){
		if(null == self::$hiiwp) {
			self::$hiiwp_admin= new HiiWP_Admin();
		}
		return self::$hiiwp_admin;
	}
	
	/**
     * Initializes the theme by setting localization, filters, and administration functions.
     */
	private function __construct() {
		//Define plugin constants if you haven't already. 
		//I recommend calling  a function, $this->define_constants and doing the definitions there
		//$this->define_constants();
		
		/*
		Add Theme Supports	
		*/
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
	}
	
	/*--------------------------------------------*
     * Functions
     *--------------------------------------------*/
     
    /**
	* Define plugin constants
	*/
	private function define_constants(){
	    if ( ! defined( 'HIIWP_VERSION' ) ) {                
			 define( 'HIIWP_VERSION', '0.3.9' );
	    }
	    if ( ! defined( 'HIIWP_SLUG' ) ) {                
	        define( 'HIIWP_SLUG', 'hiiwp' );           
	    }                
	    if(!defined('HIILITE_DIR')) define( 'HIILITE_DIR', get_template_directory() );
	        
	    if ( ! defined( 'HIIWP_URL' ) ) {
		    $file = dirname(get_template_directory()); // Current PHP file, but can be anyone
			$link = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $file );
	        define( 'HIIWP_URL', $link );
	    }
	}
}

Hii::say_hii();
Hii::say_hii_admin();




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
WP USER MANAGER	
*/
if(class_exists('WP_User_Manager')):
	require_once( HIILITE_DIR . '/includes/shortcodes/wpum.php');
endif;

/*	
GRAVITY FORMS	
*/
if(class_exists('GFForms')):
	//require_once( dirname( __FILE__ ) . '/addons/gravityformsrangeslider/rangeslider.php');
	add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
endif;

/*	
WOOCMMERCE	
*/
if(class_exists('WooCommerce')){
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

/*
bbPress	
*/
if(class_exists('bbPress')):
	//change admin links displayed

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
//	note: action: rel_canonical_with_custom_tag_override
 *
 *	Override the rel=canonical tag to always show site url
 *
 *	REPLACE rel_canonical to load on all pages	
 */
function rel_canonical_with_custom_tag_override()
{
    global $wp_the_query, $post;
    if( !$id = $wp_the_query->get_queried_object_id() ) {
        $link = get_permalink( $id );
    } elseif(get_post_meta( $post->ID, 'article_canonical_link', true) != '') {
	    $link = get_post_meta( $post->ID, 'article_canonical_link', true);
    } else {
	    $link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
    	
    
    echo "<link rel='canonical' href='" . esc_url( $link ) . "' />\n";
}
add_action( 'wp_head', 'rel_canonical_with_custom_tag_override' );









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
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
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
    $cmb->add_field( array(
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
	) );
}



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
	if($exc == NULL || strlen($exc) <= 0)
	{   
	    if( $post->post_excerpt ) {
	        $excerpt = excerpt($length);
	    } else {
	        $content = strip_shortcodes(get_the_content());
	        $excerpt = wp_trim_words( $content , $length );
	    }
	}
	else
	{
		$excerpt = strip_shortcodes(wp_trim_words(get_the_content(), $length, null));
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
?>