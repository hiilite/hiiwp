<?php
global $hiilite_options;
$hiilite_options['amp'] = get_theme_mod('amp');
$hiilite_options['portfolio_on'] = get_theme_mod('portfolio_on');
$hiilite_options['teams_on'] = get_theme_mod('teams_on');
$hiilite_options['menus_on'] = get_theme_mod('menus_on');
/*
* Convert all images to amp-img	
*	
*kir
*/
define( 'HIILITE_DIR', dirname( __FILE__ ) );
add_filter( 'auto_update_theme', '__return_true' );


add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );

if(!class_exists('Vc_Manager')){
	require_once( dirname( __FILE__ ) . '/addons/js_composer/js_composer.php');
}

if(!class_exists('ICWP_Cloudflare_Flexible_SSL')){
	require_once( dirname( __FILE__ ) . '/addons/cloudflare-flexible-ssl/plugin.php');
}
// Initialising Shortcodes
function requireVcExtend(){
	require_once locate_template('/extendvc/extend-vc.php');
}
add_action('init', 'requireVcExtend', 10);


include_once( dirname( __FILE__ ) . '/includes/kirki-settings.php' );
include_once( dirname( __FILE__ ) . '/addons/cmb2-functions.php' );


include_once( dirname( __FILE__ ) . '/includes/register_sidebars.php' );


include_once( dirname( __FILE__ ) . '/includes/business_profile.php' );

require_once( dirname( __FILE__ ) . '/includes/shortcodes/button.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/title.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/social-share.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/social-profiles.php');

require_once( dirname( __FILE__ ) . '/includes/wp_login_screen.php');
require_once( dirname( __FILE__ ) . '/includes/wp_admin_dashboard.php');

require_once( dirname( __FILE__ ) . '/addons/tinymce_edits/tinymce_edits.php');
require_once( dirname( __FILE__ ) . '/addons/github-updater/github-updater.php');

require_once( dirname( __FILE__ ) . '/addons/post-types-order/post-types-order.php');
require_once( dirname( __FILE__ ) . '/addons/taxonomy-images/taxonomy-images.php');
require_once( dirname( __FILE__ ) . '/addons/taxonomy-terms-order/taxonomy-terms-order.php');
require_once( dirname( __FILE__ ) . '/addons/force-gzip/force-gzip.php');

function hiiwp_init(){
	global $hiilite_options;
		
	require_once(dirname( __FILE__ ) . '/includes/site_variables.php');
}
add_action( 'wp_head', 'hiiwp_init' );

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



// AMP FIXES
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


// MAKE NEXT AND PREV LINKS BUTTONS
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
function posts_link_attributes() {
    return 'class="button"';
}

// REMOVE COMMENT CSS FROM HEADER
add_action( 'widgets_init', 'my_remove_recent_comments_style' );
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'  ) );
}

// REGISTER MEU AREAS
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




// REPLACE rel_canonical to load on all pages
function rel_canonical_with_custom_tag_override()
{
    global $wp_the_query;
    if( !$id = $wp_the_query->get_queried_object_id() )
        $link = get_permalink( $id );
    else {
	    $link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
    	
    
    echo "<link rel='canonical' href='" . esc_url( $link ) . "' />\n";
}

// remove the default WordPress canonical URL function
if( function_exists( 'rel_canonical' ) )
{
    remove_action( 'wp_head', 'rel_canonical' );
}
// replace the default WordPress canonical URL function with your own
add_action( 'wp_head', 'rel_canonical_with_custom_tag_override' );



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
	
	if($wp_scripts){
		$queue = $wp_scripts->queue;
		foreach( $queue as $key => $handle) {

			if ((isset($_REQUEST['vc_editable']) && $_REQUEST['vc_editable'] == true) || (isset($_REQUEST['wp_customize']) && $_REQUEST['wp_customize'] == 'on')){
			
			} else {
				wp_deregister_script($handle); 
			}
		}
    }
}

function minqueue_styles() {
	global $wp_styles;
	$queue = $wp_styles->queue;
    foreach( $queue as $key => $handle) {
		if ((isset($_REQUEST['vc_editable']) && $_REQUEST['vc_editable'] == true) || (isset($_REQUEST['wp_customize']) && $_REQUEST['wp_customize'] == 'on')){
			
		} elseif(
			$handle != 'kirki_google_fonts' &&
			//$handle != 'js_composer_front' &&
			$handle != 'vc_inline_css' &&
			$handle != 'customize-preview'
		) {
			wp_deregister_style($handle);
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




//
// Adds the meta box to the page screen
//
add_action( 'add_meta_boxes', 'page_options_meta_box' );
function page_options_meta_box()
{
    
    add_meta_box(
        'page_seo_options', // id, used as the html id att
        __( 'SEO Options' ), // meta box title, like "Page Attributes"
        'page_seo_options_meta_box_cb', // callback function, spits out the content
        array('page','post','portfolio','team','menu'), // post type or page. We'll add this to pages only
        'advanced', // context (where on the screen
        'high' // priority, where should this go in the context?
    );
}



//////////////////////////////
//
//	PAGE SEO OPTIONS META
//
/////////////////////////////

function page_seo_options_meta_box_cb( $post )
{
	// $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $page_seo_title = isset( $values['page_seo_title'][0] ) ? esc_attr( $values['page_seo_title'][0] ) : '';
    if(isset($values['_yoast_wpseo_title'][0]) && $page_seo_title == '')$page_seo_title = $values['_yoast_wpseo_title'][0];
    
    $page_seo_description = isset( $values['page_seo_description'][0] ) ? esc_attr( $values['page_seo_description'][0] ) : '';
    if(isset($values['_yoast_wpseo_title'][0]) && $page_seo_title == '')$page_seo_title = $values['_yoast_wpseo_title'][0];
    if(isset($values['_yoast_wpseo_metadesc'][0]) && $page_seo_description == '')$page_seo_description = $values['_yoast_wpseo_metadesc'][0];
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'page_seo_options__meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
	<label for="page_seo_title">SEO Title</label><br>
        <input id="page_seo_title" name="page_seo_title" maxlength="65" type="text" size="70" placeholder="%%title%% %%sep%% %%sitename%%" value="<?=$page_seo_title?>" /><br>
        <small>The title element of a web page is meant to be an accurate and concise description of a page's content. This element is critical to both user experience and search engine optimization. It creates value in three specific areas: relevancy, browsing, and in the search engine results pages. The suggested format for SEO titles is "Primary Keyword - Secondary Keyword | Brand Name". <a href="https://moz.com/learn/seo/title-tag">More on title tags here</a></small>
    </p>
    
    <p>
        <label for="page_seo_description">Meta Description</label><br>
        <textarea id="page_seo_description" name="page_seo_description" cols="70" rows="4" maxlength="165"><?=$page_seo_description?></textarea><br>
        <small>Google announced in September of 2009 that neither meta descriptions nor meta keywords factor into Google's ranking algorithms for web search. Google uses meta descriptions to return results when searchers use advanced search operators to match meta tag content, as well as to pull preview snippets on search result pages, but it's important to note that meta descriptions do not to influence Google's ranking algorithms for normal web search. <a href="https://moz.com/learn/seo/meta-description">More info on Meta descriptions here</a></small>
    </p>
    <?php    
}
add_action( 'save_post', 'page_seo_options_meta_box_save',999 );
function page_seo_options_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'page_seo_options__meta_box_nonce' ) ) return;
    
    $page_seo_title = isset( $_POST['page_seo_title'] )? $_POST['page_seo_title'] : '';
    $page_seo_description = isset( $_POST['page_seo_description'] )? $_POST['page_seo_description'] : '';
    update_post_meta( $post_id, 'page_seo_title', $page_seo_title );
    update_post_meta( $post_id, 'page_seo_description', $page_seo_description );
}




add_action('cmb2_init', 'cmb2_post_metaboxes');
function cmb2_post_metaboxes(){
	$prefix = '_hiilite_';
	
	// create the metabox
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
    
    $cmb->add_field( array(
	    'name' => 'Page Title Options',
	    'desc' => 'alter the default page title settings',
	    'type' => 'title',
	    'id'   => 'page_title_options_title'
	) );
    // metabox title
	$cmb->add_field( array(
	    'name' => 'Hide Page Title',
	    'id'   => 'show_page_title',
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
}


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
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
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


include_once( dirname( __FILE__ ) . '/includes/register_post_types.php');

?>