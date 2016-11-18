<?php
global $hiilite_options;
$hiilite_options['amp'] = get_theme_mod('amp');
$hiilite_options['portfolio_on'] = get_theme_mod('portfolio_on');
$hiilite_options['teams_on'] = get_theme_mod('teams_on');
$hiilite_options['menus_on'] = get_theme_mod('menus_on');
$hiilite_options['testimonials_on'] = get_theme_mod('testimonials_on');
$hiilite_options['rets_listings_on'] = get_theme_mod('rets_listings_on');


if(class_exists( 'WooCommerce' )){
	$hiilite_options['is_woocommerce'] = (is_woocommerce())?true:false;
} else {
	$hiilite_options['is_woocommerce'] = false;
}
define( 'HIILITE_DIR', dirname( __FILE__ ) );
add_filter( 'auto_update_theme', '__return_true' );


/*
Add Theme Supports	
*/
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
add_theme_support( 'woocommerce' );

add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );


/*
Include Support Add-ons	
*/
if(!class_exists('ICWP_Cloudflare_Flexible_SSL')){
	require_once( dirname( __FILE__ ) . '/addons/cloudflare-flexible-ssl.php');
}
if(!class_exists('Vc_Manager')){
	require_once( dirname( __FILE__ ) . '/addons/js_composer/js_composer.php');
}




require_once( dirname( __FILE__ ) . '/includes/kirki-settings.php' );

if(!class_exists('HiiWP')){ 
	require_once( dirname( __FILE__ ) . '/addons/hiiwp/hiiwp.php');
}
if(!class_exists('SrUtils') && $hiilite_options['rets_listings_on']){
	//Simply Rets Plugin
	require_once( dirname( __FILE__ ) . '/addons/simply-rets/simply-rets.php' );
	
	// Admin listing port type
	require_once( dirname( __FILE__ ) . '/includes/rets-listings.php' );
	
	// Templete override functions
	require_once( dirname( __FILE__ ) . '/addons/simply-rets.php' );
}

require_once( dirname( __FILE__ ) . '/addons/tinymce_edits/tinymce_edits.php');
require_once( dirname( __FILE__ ) . '/addons/post-types-order/post-types-order.php');
require_once( dirname( __FILE__ ) . '/addons/taxonomy-images/taxonomy-images.php');
require_once( dirname( __FILE__ ) . '/addons/taxonomy-terms-order/taxonomy-terms-order.php');
require_once( dirname( __FILE__ ) . '/includes/register_sidebars.php' );
require_once( dirname( __FILE__ ) . '/includes/register_post_types.php');
require_once( dirname( __FILE__ ) . '/includes/classes.php' );
require_once( dirname( __FILE__ ) . '/includes/shortcodes/button.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/title.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/media-gallery.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/vc_empty_space.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/amp-carousel.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/screen-showcase.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/calculation-table.php');

/* Add with options in Custumizer */
if(get_theme_mod( 'blog_author_bio' ) == true){
require_once( dirname( __FILE__ ) . '/includes/shortcodes/author-info.php');
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




/*
Include VC Extend file
*/
function requireVcExtend(){
	require_once locate_template('/extendvc/extend-vc.php');
}
add_action('init', 'requireVcExtend', 10);

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
on	WP_HEAD
*/
function hiiwp_init(){
	global $hiilite_options, $post, $wp_scripts;
	
	require_once(dirname( __FILE__ ) . '/includes/site_variables.php');
	
	if(isset($post->ID) && get_post_meta($post->ID, 'amp', true) == 'nonamp'){
		$hiilite_options['amp'] = false;
	} else {
		$hiilite_options['amp'] = get_theme_mod('amp');
	}

	// AMP FIXES
	if($hiilite_options['amp']){
		add_filter('widget_text', 'amp_image_tags');
		add_filter( 'the_content', 'amp_image_tags', 10);
		add_filter( 'post_thumbnail_html', 'amp_image_tags',100);
		add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
		
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
		remove_action( 'wp_head', 'wlwmanifest_link');
		add_action( 'init', 'minqueue_init', 1 );
		add_filter( 'style_loader_tag', 'enqueue_less_styles', 5, 2);
	} else {
		wp_enqueue_script("jquery");
		//wp_deregister_script('wpb_composer_front_js');
	}
	
	
}
add_action( 'wp_head', 'hiiwp_init' );

// remove the default WordPress canonical URL function
if( function_exists( 'rel_canonical' ) )
{
    remove_action( 'wp_head', 'rel_canonical' );
}
// REPLACE rel_canonical to load on all pages
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
	    wp_register_style( 'hiilite_admin_stylesheet', get_stylesheet_directory_uri(). '/css/admin-style.css' );
	    wp_enqueue_style( 'hiilite_admin_stylesheet' );
	    
	    wp_enqueue_media();
	 
	    // Registers and enqueues the required javascript.
	    wp_register_script( 'meta_uploader', get_stylesheet_directory_uri() . '/js/meta_uploader.js', array( 'jquery' ) );
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
		global $hiilite_options;
		
		require_once(dirname( __FILE__ ) . '/includes/site_variables.php');
		echo '<style>';
			require_once(dirname( __FILE__ ) . '/editor-style.php');
		echo '</style>';
		add_editor_style( 'editor-style.css' ); 
	}
}
add_action('admin_head', 'custom_colors');




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
	global $hiilite_options;
	$urlParts = explode('.', $_SERVER['HTTP_HOST']);
	$hiilite_options['subdomain'] = $urlParts[0];
	if($hiilite_options['subdomain'] != 'iframe'){
		
    	if(is_admin()) return $tag;
		
		return str_replace( ' src', ' defer="defer" src', $tag );
    } else {
	    return $tag;
    }
}



function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}










function minqueue_init () {
	global $hiilite_options;
	global $post;
	if(is_admin() || get_post_meta($post->ID, 'amp', true) == 'nonamp' || get_theme_mod('amp') == false){
		return;
	} 
	// Run the minifier
	$urlParts = explode('.', $_SERVER['HTTP_HOST']);
	$hiilite_options['subdomain'] = $urlParts[0];
	if($hiilite_options['subdomain'] != 'iframe'){
		add_action( 'wp_print_scripts', 'minqueue_scripts', 100 );
		add_action( 'wp_footer', 'minqueue_scripts', 5 );
		add_action( 'wp_print_styles', 'minqueue_styles', 100 );
	} else {
		wp_enqueue_script('jquery');
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
	    'type' => 'checkbox',
	    'default' => false
	) );
	
	$cmb->add_field( array(
	    'name' => 'Hide Feature Image',
	    'id'   => 'hide_page_feature_image',
	    'type' => 'checkbox',
	    'default' => false
	) );
	
	$cmb->add_field( array(
	    'name'             => 'Title Background Color',
	    'desc'             => 'Edit color sets in the theme customizer',
	    'id'               => 'page_title_bg',
	    'type'             => 'radio_inline',
	    'show_option_none' => true,
	    'default'          => '',
	    'options'          => array(
	        '' => 'None',
	        'bg_color_one'    => '<span style="background:'.get_theme_mod( 'color_one', '#ef5022').'">'.get_theme_mod( 'color_one', '#ef5022').'</span>',
	        'bg_color_two'    => '<span style="background:'.get_theme_mod( 'color_two', '#71be44').'">'.get_theme_mod( 'color_two', '#71be44').'</span>',
	        'bg_color_three'  => '<span style="background:'.get_theme_mod( 'color_three', '#2eb6c4').'">'.get_theme_mod( 'color_three', '#2eb6c4').'</span>',
	        'bg_color_four'   => '<span style="background:'.get_theme_mod( 'color_four', '#555555').'">'.get_theme_mod( 'color_four', '#555555').'</span>',
	        'bg_color_five'   => '<span style="background:'.get_theme_mod( 'color_five', '#8f52a0').'">'.get_theme_mod( 'color_five', '#8f52a0').'</span>',
	    ),
	) );
	
	$cmb->add_field( array(
	    'name'             => 'Title Font Color',
	    'desc'             => 'Edit color sets in the theme customizer',
	    'id'               => 'page_title_color',
	    'type'             => 'radio_inline',
	    'show_option_none' => true,
	    'default'          => '',
	    'options'          => array(
	        '' => 'None',
	        'color_one'    => '<span style="background:'.get_theme_mod( 'color_one', '#ef5022').'">'.get_theme_mod( 'color_one', '#ef5022').'</span>',
	        'color_two'    => '<span style="background:'.get_theme_mod( 'color_two', '#71be44').'">'.get_theme_mod( 'color_two', '#71be44').'</span>',
	        'color_three'  => '<span style="background:'.get_theme_mod( 'color_three', '#2eb6c4').'">'.get_theme_mod( 'color_three', '#2eb6c4').'</span>',
	        'color_four'   => '<span style="background:'.get_theme_mod( 'color_four', '#555555').'">'.get_theme_mod( 'color_four', '#555555').'</span>',
	        'color_five'   => '<span style="background:'.get_theme_mod( 'color_five', '#8f52a0').'">'.get_theme_mod( 'color_five', '#8f52a0').'</span>',
	        'white'   	   => '#ffffff',
	    ),
	) );
	
	$cmb->add_field( array(
	    'name' => 'Turn off AMP',
	    'id'   => 'amp',
	    'type' => 'select',
	    'default' => 'default',
	    
	    'options'          => array(
	        'default' => 'default',
	        'nonamp'    =>'Non-AMP',
	        'amp'	=>'AMP'
	    )
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
    if( $post->post_excerpt ) {
        $content = get_the_excerpt();
    } else {
        $content = get_the_content();
        $content = wp_trim_words( $content , $length );
    }
    return $excerpt;
}

function get_wp_title( $separator = ' ', $seplocation = 'left' ) {	
	$separator = apply_filters('timber_wp_title_seperator', $separator);	
	return trim(wp_title($separator, false, $seplocation));	
}	
?>