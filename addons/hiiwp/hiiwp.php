<?php
/**
 * Plugin Name: Hiilite SEO
 * Plugin URI: https://hiilite.com
 * Description: Hiilites Official Wordpress SEO plugin
 * Version: 0.3.1
 * Text Domain: hiiwp
 * Author: Peter Singh-Vigilante
 * Author URI: https://hiilite.com
 * License: GPL2
 */
// don't load directly
if(!defined('ABSPATH')){die('-1');}





//add_action( 'activated_plugin', array('HiiWP','activation_redirect' ));



include_once( dirname( __FILE__ ) . '/addons/cmb2-functions.php' );
include_once( dirname( __FILE__ ) . '/addons/cmb2-metatabs-options/cmb2_metatabs_options.php' );
include_once( dirname( __FILE__ ) . '/addons/cmb2-conditionals/cmb2-conditionals.php' );
include_once( dirname( __FILE__ ) . '/addons/cmb-field-select2/cmb-field-select2.php' );
include_once( dirname( __FILE__ ) . '/addons/custom-field-types/address-field-type.php' );
include_once( dirname( __FILE__ ) . '/includes/business_profile.php' );
include_once( dirname( __FILE__ ) . '/addons/google-sitemap-generator/sitemap.php');
require_once( dirname( __FILE__ ) . '/includes/wp_login_screen.php');
//require_once( dirname( __FILE__ ) . '/includes/wp_admin_dashboard.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/social-profiles.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/social-share.php');
require_once( dirname( __FILE__ ) . '/addons/google-analytics-dashboard-for-wp/gadwp.php');



add_action( 'tgmpa_register', array('HiiWP','hiilite_register_required_plugins' ));


/*
on WP_HEAD	
*/
add_action( 'wp_head', 'canonical_for_comments' );
function canonical_for_comments() {
  global $cpage, $post;
  if ( $cpage > 1 ) :
    echo "n";
      echo "<link rel='canonical' href='";
      echo get_permalink( $post->ID );
      echo "' />";
   endif;
}




/*
on WP_FOOTER
*/
add_action('wp_footer', 'add_footer_tracking', 100);
function add_footer_tracking(){
	$gadwp = GADWP();
	$post_id = get_the_id();
	$post_object = get_post( $post_id );
	$options = get_option('hii_seo_settings');
		
	$profile_info = GADWP_Tools::get_selected_profile($gadwp->config->options['ga_dash_profile_list'], $gadwp->config->options['ga_dash_tableid_jail']);
	
	//var_dump($profile_info);
	
	$tracking_id = (isset($profile_info[2]))?$profile_info[2]:get_theme_mod('analytics_id');
	
	?>
	<script type="text/javascript">
		
	document.onreadystatechange = function() {
	
		function trackingLink($this, type){
			var href = $this.innerHTML;
			return "ga('send', 'event', 'Contact Links', '"+type+"','"+href+"')";
		}
		
		var maillink = document.querySelectorAll('[href*=mail]'),
			phonelink = document.querySelectorAll('[href*=tel]');
		for (var i=0; i < maillink.length; i++) {
			maillink[i].onclick = function(){
				return trackingLink(this, "user-emailed");
			};
		}
		for (var i=0; i < phonelink.length; i++) {
			phonelink[i].onclick = function(){
				return trackingLink(this, "user-phoned");
			};
		}
			
	};

	</script>
	<?php
	
}

/*
on ADMIN_MENU	
*/
add_action('admin_menu', 'hiiwp_adminmenu', 10);
function hiiwp_adminmenu() {
	add_submenu_page('hii_seo_settings', __('HiiWP Settings', 'hiiwp'), __('Settings', 'hiiwp'), 'manage_options', 'hii_seo_settings');
	
	add_submenu_page('hii_seo_settings', __('Customize', 'hiiwp'), __('Customize', 'hiiwp'), 'manage_options', 'customize.php');
	
	add_submenu_page('hii_seo_settings', __('Install Plugins', 'hiiwp'), __('Install Plugins', 'hiiwp'), 'manage_options', 'themes.php?page=tgmpa-install-plugins');
	
    add_menu_page( __('About HiiWP SEO', 'hiiwp'), __('About', 'hiiwp'), 'manage_options', 'admin.php?page=about_hii_seo','hii_about_page');
    remove_menu_page( 'admin.php?page=about_hii_seo' );
    
    add_submenu_page( 'hii_seo_settings', __('About HiiWP', 'hiiwp'), __('About', 'hiiwp'), 'manage_options', 'admin.php?page=about_hii_seo','hii_about_page');
}
function hii_about_page(){
	require_once dirname( __FILE__ ) . '/about.php';
}



//////////////////////////////
//
//	PAGE SEO OPTIONS META
//
/////////////////////////////
add_action( 'add_meta_boxes', 'page_options_meta_box' );
function page_options_meta_box()
{
    add_meta_box(
        'page_seo_options', // id, used as the html id att
        __( 'HiiWP SEO Options' ), // meta box title, like "Page Attributes"
        'page_seo_options_meta_box_cb', // callback function, spits out the content
        array('page','post','portfolio','team','menu'), // post type or page. We'll add this to pages only
        'normal', // context (where on the screen
        'high' // priority, where should this go in the context?
    );
}
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

/*
Title Tag Re-writes	
*/
add_theme_support( 'title-tag' );
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
		?><title><?php wp_title( '|', true, 'right' ); ?></title><?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}


add_filter( 'document_title_parts', 'custom_titles', 10);
function custom_titles( $title ) {
    // Page Title
	$brand_title = (get_theme_mod('brand_seo_title')!='')?get_theme_mod('brand_seo_title'):get_bloginfo('title');
	if(get_post_meta(get_the_id(), 'page_seo_title', true) != ''){
		$title['title'] = get_post_meta(get_the_id(), 'page_seo_title', true);
		$title['site'] = '';
		$title['tagline'] = '';
	} elseif(get_theme_mod('site_seo_title') != '' && is_front_page()) {
		$title['title'] = get_theme_mod('site_seo_title');
		$title['site'] = '';
		$title['tagline'] = '';
	} 
    return $title;
}




?>