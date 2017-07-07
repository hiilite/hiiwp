<?php
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

- DDF Realty Addon

- Plugin Modifiers
-- Gravity Forms
-- WooCommerce

========================
Folder Structure: 
- post_types
-- portfolio
-- listings
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
include_once(HIILITE_DIR . '/includes/HiiWP.php');
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
		add_theme_support( 'woocommerce' );
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




/*
Include Support Add-ons	
*/
if(class_exists('Vc_Manager')){
	/*
	Include VC Extend file
	*/
	add_action('init', 'requireVcExtend', 10);
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

// REMOVE WP EMOJIS
function disable_wp_emojicons() {
	
	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	
	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
        
}
add_action( 'init', 'disable_wp_emojicons' );



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
on ADMIN_HEAD actions
*/
if(!function_exists('hiilite_admin_styles')){
	function hiilite_admin_styles() {
	    wp_register_style( 'hiilite_admin_stylesheet', get_template_directory_uri(). '/css/admin-style.css' );
	    wp_enqueue_style( 'hiilite_admin_stylesheet' );
	    
	    wp_enqueue_media();
	 
	    // Registers and enqueues the required javascript.
	    wp_register_script( 'meta_uploader', get_template_directory_uri() . '/js/meta_uploader.js', array( 'jquery' ) );
	    wp_localize_script( 'meta_uploader', 'meta_image',
	        array(
	            'title' => __( 'Choose or Upload an Image', 'prfx-textdomain' ),
	            'button' => __( 'Use this image', 'prfx-textdomain' ),
	        )
	    );
	    wp_enqueue_script( 'meta_uploader' );
	}
	add_action( 'admin_enqueue_scripts', 'hiilite_admin_styles' );
	
	
	// THIS GIVES US SOME OPTIONS FOR STYLING THE ADMIN AREA
	function custom_colors() {
		
		require(HIILITE_DIR . '/includes/site_variables.php');
		echo '<style>';
			require_once(HIILITE_DIR . '/editor-style.php');
		echo '</style>';
		add_editor_style( 'editor-style.css' ); 
	}
	add_action('admin_head', 'custom_colors');
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


// MODIFIY IMAGE TAGS
function amp_image_tags($content)
{
    try {
        $html = new DOMDocument();
        @$html->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
        
        // IMAGE replace
        foreach ($html->getElementsByTagName('img') as $img) {
			 
			$amp = $html->createElement("amp-img");

		    if ($img->hasAttributes()) {
			  foreach ($img->attributes as $attr) {
			    $amp->setAttribute($attr->nodeName, $attr->nodeValue);
			    
			  }
			}
		    
		    $img->parentNode->replaceChild($amp, $img);
        }
        
        // VIDEO Replace
        foreach ($html->getElementsByTagName('video') as $vid) {
			$amp = $html->createElement("amp-video");
		    if ($vid->hasAttributes()) {
			  foreach ($vid->attributes as $attr) {
			    $amp->setAttribute($attr->nodeName, $attr->nodeValue);
			  }
			}
		    $vid->parentNode->replaceChild($amp, $vid);
        }
        
        // EMBED Replace
        foreach ($html->getElementsByTagName('embed') as $emb) {
			$amp = $html->createElement("amp-embed");
		    if ($emb->hasAttributes()) {
			  foreach ($emb->attributes as $attr) {
			    $amp->setAttribute($attr->nodeName, $attr->nodeValue);
			  }
			}
		    $emb->parentNode->replaceChild($amp, $emb);
        }
        //return $html->saveXML();
        
        $find 		= array('/^<!DOCTYPE.+?>/', '/style="([^"]*)"/');
        $replace 	= '';
        
        return $html = preg_replace($find, $replace, str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $html->saveHTML()));
        
        
    } catch (Exception $e) {
        return $content;
    }
}


// ADD DEFER TO SCRIPT TAGS
function add_defer_attribute($tag, $handle) {
	if(is_admin()) return $tag;
	return str_replace( ' src', ' defer=defer src', $tag );
}



function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}




	
function minqueue_scripts() {
	global $wp_scripts, $hiilite_options;
	global $post;
	if(is_admin() || get_post_meta($post->ID, 'amp', true) == 'nonamp' || get_theme_mod('amp') == false){
		return;
	} 
	
	if(class_exists( 'WooCommerce' )){
		$hiilite_options['is_woocommerce'] = (is_woocommerce())?true:false;
	} else {
		$hiilite_options['is_woocommerce'] = false;
	}
	
	if($wp_scripts){
		$queue = $wp_scripts->queue;
		foreach( $queue as $key => $handle) {
			
			if ((isset($_REQUEST['vc_editable']) && $_REQUEST['vc_editable'] == true) || (isset($_REQUEST['wp_customize']) && $_REQUEST['wp_customize'] == 'on')){
				
			} elseif(!$hiilite_options['is_woocommerce'])  {
				//wp_deregister_script($handle); 
			}
		}
    }
}

function minqueue_styles() {
	global $wp_styles, $hiilite_options;
	
	if(class_exists( 'WooCommerce' )){
		$hiilite_options['is_woocommerce'] = (is_woocommerce())?true:false;
	} else {
		$hiilite_options['is_woocommerce'] = false;
	}

	$queue = $wp_styles->queue;
    foreach( $queue as $key => $handle) {
		if ((isset($_REQUEST['vc_editable']) && 
			$_REQUEST['vc_editable'] == true) || 
			(isset($_REQUEST['wp_customize']) && 
			$_REQUEST['wp_customize'] == 'on' )){
			
		} elseif(
			($handle != 'js_composer_front' && !is_admin()) &&
			$handle != 'kirki_google_fonts' &&
			//$handle != 'vc_inline_css' &&
			//$handle != 'customize-preview' && 
			$handle != 'admin-bar'
		) {
			if(!$hiilite_options['is_woocommerce']) wp_deregister_style($handle);
		}
    }
}

function enqueue_less_styles($tag, $handle) {
    global $wp_styles;
    //if(is_admin()){
        $handle = $wp_styles->registered[$handle]->handle;
        $media = $wp_styles->registered[$handle]->args;
        $href = $wp_styles->registered[$handle]->src;
        $rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
        $title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';

        $tag = "<link $title href='$href' rel='stylesheet' type='text/css' id='$handle'>";
    
    	return $tag;
	//}
}





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




//////////////////////////////
//
//	If HiiWP Plugin is not installed
//
/////////////////////////////

/**
 * -----------------------------------------------------------------------------------------
 * Based on `https://github.com/mecha-cms/mecha-cms/blob/master/system/kernel/converter.php`
 * -----------------------------------------------------------------------------------------
 */
// HTML Minifier
function minify_html($input) {
   if(trim($input) === "") return $input;
    // Remove extra white-space(s) between HTML attribute(s)
    $input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function($matches) {
        return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
    }, str_replace("\r", "", $input));
    // Minify inline CSS declaration(s)
    if(strpos($input, ' style=') !== false) {
        $input = preg_replace_callback('#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function($matches) {
            return '<' . $matches[1] . ' style=' . $matches[2] . minify_css($matches[3]) . $matches[2];
        }, $input);
    }
    return preg_replace(
        array(
            // t = text
            // o = tag open
            // c = tag close
            // Keep important white-space(s) after self-closing HTML tag(s)
            '#<(img|input)(>| .*?>)#s',
            // Remove a line break and two or more white-space(s) between tag(s)
            '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
            '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
            '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
            '#<(img|input)(>| .*?>)<\/\1>#s', // reset previous fix
            '#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
            '#(?<=\>)(&nbsp;)(?=\<)#', // --ibid
            // Remove HTML comment(s) except IE comment(s)
            '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
        ),
        array(
            '<$1$2</$1>',
            '$1$2$3',
            '$1$2$3',
            '$1$2$3$4$5',
            '$1$2$3$4$5$6$7',
            '$1$2$3',
            '<$1$2',
            '$1 ',
            '$1',
            ""
        ),
    $input);
}
// CSS Minifier => http://ideone.com/Q5USEF + improvement(s)
function minify_css($input) {
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
            '#(?<=[\s:,\-])0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
        ),
        array(
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2'
        ),
    $input);
}
// JavaScript Minifier
function minify_js($input) {
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
            // Remove white-space(s) outside the string and regex
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
            // Remove the last semicolon
            '#;+\}#',
            // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
            '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
            // --ibid. From `foo['bar']` to `foo.bar`
            '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
        ),
        array(
            '$1',
            '$1$2',
            '}',
            '$1$3',
            '$1.$3'
        ),
    $input);
}

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');



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

function content_excerpt( $length = 55 ) { 
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
		$excerpt = $exc;
	}
    return $excerpt;
}

function get_wp_title( $separator = ' ', $seplocation = 'left' ) {	
	$separator = apply_filters('timber_wp_title_seperator', $separator);	
	return trim(wp_title($separator, false, $seplocation));	
}	


function isset_return(&$is_true = null, $prepend = '', $append = ''){
	return isset($is_true) && !is_array($is_true) ? $prepend.$is_true.$append : null; 
}
function empty_return(&$is_true = null){
	return !empty($is_true) ? $is_true : null; 
}

/* Add Numbered Pagination */
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
?>