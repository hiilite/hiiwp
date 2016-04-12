<?php
global $hiilite_options;
$hiilite_options['amp'] = get_theme_mod('amp');
/*
* Convert all images to amp-img	
*	
*/
define( 'HIILITE_DIR', dirname( __FILE__ ) );
add_filter( 'auto_update_theme', '__return_true' );


add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
if(!class_exists('Vc_Manager')){
	require_once( dirname( __FILE__ ) . '/addons/js_composer/js_composer.php');
}


include_once( dirname( __FILE__ ) . '/includes/kirki-settings.php' );

include_once( dirname( __FILE__ ) . '/includes/register_sidebars.php' );

include_once( dirname( __FILE__ ) . '/includes/business_profile.php' );

require_once( dirname( __FILE__ ) . '/includes/shortcodes/button.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/social-share.php');

require_once( dirname( __FILE__ ) . '/addons/tinymce_edits/tinymce_edits.php');


function hiiwp_init(){
	global $hiilite_options;
		
	require_once(dirname( __FILE__ ) . '/includes/site_variables.php');
}
add_action( 'wp_head', 'hiiwp_init' );


if($hiilite_options['amp']){
	add_filter( 'the_content', 'amp_image_tags', 10);
	add_filter( 'post_thumbnail_html', 'amp_image_tags',100);
	add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
	add_action( 'init', 'disable_wp_emojicons' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	remove_action( 'wp_head', 'wlwmanifest_link');
	add_action( 'init', 'minqueue_init', 1 );
	add_filter( 'style_loader_tag', 'enqueue_less_styles', 5, 2);
	show_admin_bar(false);
}


// THIS GIVES US SOME OPTIONS FOR STYLING THE ADMIN AREA
function custom_colors() {
	global $hiilite_options;
	
	require_once(dirname( __FILE__ ) . '/includes/site_variables.php');
	echo '<style>';
	require_once(dirname( __FILE__ ) . '/editor-style.php');
	echo '</style>';
	add_editor_style( 'editor-style.css' ); 
}
add_action('admin_head', 'custom_colors');





function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'left-menu' => __( 'Left Menu' ),
      'right-menu' => __( 'Right Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


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
        
        //return $html = preg_replace('/style="(.*)"/', 'class="$1"', $html->saveHTML());        
        
    } catch (Exception $e) {
        return $content;
    }
}




function add_defer_attribute($tag, $handle) {
    //if ( 'my-js-handle' !== $handle )
      //  return $tag;
	global $hiilite_options;
	$urlParts = explode('.', $_SERVER['HTTP_HOST']);
	$hiilite_options['subdomain'] = $urlParts[0];
	if($hiilite_options['subdomain'] != 'iframe'){
		
    	if(is_admin()) return $tag;
		
		return str_replace( ' src', ' defer="defer" src', $tag );
		//return '';
    } else {
	    return $tag;
    }
}


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


function disable_emojicons_tinymce( $plugins ) {
	
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}





/**
 * Init
 *
 * @return null
 */
function minqueue_init () {
	global $hiilite_options;
	if(is_admin()) return ;
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
	global $wp_scripts;
	$queue = $wp_scripts->queue;

   foreach( $queue as $key => $handle) {
	   /* if( $handle != 'customize-preview' && 
	    	$handle != 'customize-preview-widgets' && 
	    	$handle != 'customize-preview-nav-menus'&&
	    	$handle != 'wp-embed' &&
	    	$handle != 'wpb_composer_front_js' &&
	    	$handle != 'wp-embed' &&
	    	$handle != 'vc_inline_iframe_js' 
	    	) {		*/
			if ((isset($_REQUEST['vc_editable']) && $_REQUEST['vc_editable'] == true) || (isset($_REQUEST['wp_customize']) && $_REQUEST['wp_customize'] == 'on')){
			
			} else {
				wp_deregister_script($handle); 
			}
		/*}*/
    }
}

function minqueue_styles() {
	global $wp_styles;
	$queue = $wp_styles->queue;
    foreach( $queue as $key => $handle) {
	    /*if($handle != 'kirki_google_fonts' &&
	   	  $handle != 'js_composer_front' &&
	   	  $handle != 'vc_inline_css' &&
	  	  $handle != 'customize-preview' ) {*/

		if ((isset($_REQUEST['vc_editable']) && $_REQUEST['vc_editable'] == true) || (isset($_REQUEST['wp_customize']) && $_REQUEST['wp_customize'] == 'on')){
			
		} elseif(
			$handle != 'kirki_google_fonts' &&
			//$handle != 'js_composer_front' &&
			$handle != 'vc_inline_css' &&
			$handle != 'customize-preview'
		) {
			wp_deregister_style($handle);
		}
		//}
    }
}

// Initialising Shortcodes
function requireVcExtend(){
	require_once locate_template('/extendvc/extend-vc.php');
}
add_action('init', 'requireVcExtend', 10);

function enqueue_less_styles($tag, $handle) {
    global $wp_styles;
      
        $handle = $wp_styles->registered[$handle]->handle;
        $media = $wp_styles->registered[$handle]->args;
        $href = $wp_styles->registered[$handle]->src;
        $rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
        $title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';

        $tag = "<link $title href='$href' rel='stylesheet' type='text/css' id='$handle'>";
    
    return $tag;
}





add_action( 'add_meta_boxes', 'page_options_meta_box' );
/**
 * Adds the meta box to the page screen
 */
function page_options_meta_box()
{
    add_meta_box(
        'show_page_title_meta_box', // id, used as the html id att
        __( 'Page Options' ), // meta box title, like "Page Attributes"
        'page_options_meta_box_cb', // callback function, spits out the content
        'page', // post type or page. We'll add this to pages only
        'side', // context (where on the screen
        'low' // priority, where should this go in the context?
    );
}

/**
 * Callback function for our meta box.  Echos out the content
 */
function page_options_meta_box_cb( $post )
{
	// $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    //$text = isset( $values['my_meta_box_text'] ) ? $values['my_meta_box_text'] : '';
    //$selected = isset( $values['my_meta_box_select'] ) ? esc_attr( $values['my_meta_box_select'] ) : '';
    $check = isset( $values['show_page_title'][0] ) ? esc_attr( $values['show_page_title'][0] ) : '';
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'show_page_title__meta_box_nonce', 'meta_box_nonce' );
    ?>
     
    <p>
        <input type="checkbox" id="show_page_title" name="show_page_title" <?php checked( $check, 'on' ); ?> value="on" />
        <label for="show_page_title">Hide Page Title</label>
    </p>
    <?php    
}
add_action( 'save_post', 'show_page_title_meta_box_save' );
function show_page_title_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'show_page_title__meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
    
    // This is purely my personal preference for saving check-boxes
    $chk = isset( $_POST['show_page_title'] )? 'on' : 'off';
    update_post_meta( $post_id, 'show_page_title', $chk );
}







?>