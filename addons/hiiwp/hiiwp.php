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


class HiiWP {
	public function __construct() {
		register_activation_hook( __FILE__, array($this,'plugin_activated'));
		register_deactivation_hook( __FILE__, array($this, 'plugin_deactivated' ));
		
		//Define plugin constants if you haven't already. 
		//I recommend calling  a function, $this->define_constants and doing the definitions there
		$this->define_constants();
		// Load admin JavaScript. Do an is_admin() check before calling My_Custom_Plugin
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		//Used to disable tour mode
		add_action( 'wp_ajax_hiiwp_disable_tour_mode', array( $this, 'hiiwp_disable_tour_mode' ));
        
        
        
	}
	
	/**
	* Define plugin constants
	*/
	private function define_constants(){
	    if ( ! defined( 'HIIWP_VERSION' ) ) {                
			 define( 'HIIWP_VERSION', '0.3.1' );
	    }
	    if ( ! defined( 'HIIWP_SLUG' ) ) {                
	        define( 'HIIWP_SLUG', 'hiiwp' );           
	    }                
	         
	    if ( ! defined( 'HIIWP_URL' ) ) {
		    $file = dirname(__FILE__); // Current PHP file, but can be anyone
			$link = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $file );
	        define( 'HIIWP_URL', $link );
	     }
	}
	
	public function run() {
		
	}
	
	public function enqueue_admin_scripts() {
		wp_enqueue_script( HIIWP_SLUG . '-pointer-js', HIIWP_URL.'/js/hiiwp-pointer.js', array( 'jquery' ), HIIWP_VERSION );
		
		wp_register_style( HIIWP_SLUG . '-admin-css', HIIWP_URL . '/css/hiiwp-admin.css', false, HIIWP_VERSION );
        wp_enqueue_style( HIIWP_SLUG . '-admin-css' );
		
		$tour_pointer_messages['hiiwp_intro_tour'] =  $this->load_intro_tour();
		//Localization allows us to send variables to the JS script. In this case, we are sending the pointers array
		wp_localize_script( HIIWP_SLUG . '-pointer-js', 'hiiwp_admin', 
		array(  'ajax_url'              =>  admin_url( 'admin-ajax.php'),
		    'hiiwp_admin_nonce' =>  wp_create_nonce( 'hiiwp-admin-nonce' ),//Not used in this example but important
		    'hiiwp_tour_pointers'     =>  $tour_pointer_messages
			)
		);
	}

	/**
	* Give the user an introductory tour to your plugin
	* @return Array $pointers Returns an array of pointers or false
	*/
	private function load_intro_tour(){
		$screen = get_current_screen();
		$screen_id = $screen->id;
		// Don't run on WP < 3.3. Admin pointers were only introduced in WP 3.3
		if ( get_bloginfo( 'version' ) < '3.3' ){
		    return false;                
		}
		//Do a check to see whether your user wants to take the tour. You can check
		//a custom plugin setting here like this:
		if ( "no" === get_option('hiiwp_enable_tour') || !get_option('hiiwp_enable_tour') ){
		    return false;
		}//This implies that you need to use update_option('my_plugin_enable_tour') to trigger the tour
		//Generate the tour messages
		
		$pointers = $this->generate_tour_content();
		
		// No pointers? Then we stop.
		if ( ! $pointers || ! is_array( $pointers ) ){
		    return false;
		}
		
		wp_enqueue_style( 'wp-pointer' );//Needed to style the pointers.
		wp_enqueue_script( 'wp-pointer' );//Has the actual pointer logic
		 
		return $pointers;
	}
	
	 /**
	  * The tour content for the different screens
	  */
	
	private function generate_tour_content(){
		//The content is entered into the array based on when it should display since
		//it'll be displayed sequentially i.e. content at $p[0] will come first, then $p[n+1]
		$p[] = array(
			"target" => "#toplevel_page_hii_seo_settings",//Target ID or class
			"screen"  => 'toplevel_page_hii_seo_settings', //Which screen to show the pointer on. This is useful if you have multiple screens to navigate between
			"options" => array(
			    "content" => sprintf( "<span><h3> %s </h3> <p> %s </p></span>",
			    __( "Welcome to the Hiilite SEO Plugin" ,"hiiwp"),
			    __( "This plugin will handle all your sites SEO automatically by properly formatting your sites titles and description, creating XML sitemaps, and adding structured data for Google to read. We first just need to gather some information about your  website so we can tell search engines who you are.","hiiwp")
			    ),                    
			    "position" => array( 'edge' => 'left', 'align' => 'top' )//Edge and alignment gotten using 'Better Admin Pointers' plugin
			)                
		);
	    $p[] = array(
	        "target" => ".gadwp-settings-options",
	        "screen"  => 'toplevel_page_hii_seo_settings', 
	        "options" => array(
	            "content" => sprintf( "<span><h3> %s </h3> <p> %s </p><p> %s </p></span>",
	            __( "Connect Google Analytics" ,"hiiwp"),
	            __( "The first thing you need to do is connect your Google Analytics account to so we can add all the necessary tracking codes to your site.","hiiwp"),
	            __( "Click the Connect Analytics button to begin","hiiwp")
	            ),                   
	            "position" => array( 'edge' => 'bottom', 'align' => 'top' )
	        )                
	    );
	    
	    $p[] = array(
	        "target" => "#opt-tab-hiilite_info_tab",
	        "screen"  => 'toplevel_page_hii_seo_settings', 
	        "options" => array(
	            "content" => sprintf( "<span><h3> %s </h3> <p> %s </p></span>",
	            __( "Add Your Info" ,"hiiwp"),
	            __( "This is where you can tell Google all about your business. From address, opening hours, different forms of contact. All this is added as Structured Data that Google can use to get valuable infomation about your business.", "hiiwp")
	            ),                    
	            "position" => array( 'edge' => 'top', 'align' => 'left' )	       
	        )                
	    );
	    
	    $p[] = array(
	        "target" => "#opt-tab-hiilite_social_tab",
	        "screen"  => 'toplevel_page_hii_seo_settings', 
	        "options" => array(
	            "content" => sprintf( "<span><h3> %s </h3> <p> %s </p></span>",
	            __( "Set Social Profile" ,"hiiwp"),
	            __( "This will tell Google what social media accounts to relate to your site. It will also automatically add them to the [social_profiles] shortcode.", "hiiwp")
	            ),                    
	            "position" => array( 'edge' => 'top', 'align' => 'left' )	       
	        )                
	    );

	    
	    return $p;
	}
	
	
	
	/**
	* Disable tour mode
	*/
	public function hiiwp_disable_tour_mode(){
		update_option("hiiwp_enable_tour","no");
		echo json_encode( 1 );
		die();            
	}
	
	public static function plugin_activated(){
         // This will run when the plugin is activated, setup the database
         
    }
    
    public static function plugin_deactivated(){
         // This will run when the plugin is deactivated, use to delete the database
    }
    
    public static function activation_redirect(){     
	    exit( wp_redirect( admin_url( 'admin.php?page=admin.php?page=about_hii_seo' ) ) );
    }
    
}


//add_action( 'activated_plugin', array('HiiWP','activation_redirect' ));



include_once( dirname( __FILE__ ) . '/addons/cmb2-functions.php' );
include_once( dirname( __FILE__ ) . '/addons/cmb2-metatabs-options/cmb2_metatabs_options.php' );
include_once( dirname( __FILE__ ) . '/addons/cmb2-conditionals/cmb2-conditionals.php' );
include_once( dirname( __FILE__ ) . '/addons/cmb-field-select2/cmb-field-select2.php' );
include_once( dirname( __FILE__ ) . '/addons/custom-field-types/address-field-type.php' );
include_once( dirname( __FILE__ ) . '/includes/business_profile.php' );
include_once( dirname( __FILE__ ) . '/addons/google-sitemap-generator/sitemap.php');
require_once( dirname( __FILE__ ) . '/includes/wp_login_screen.php');
require_once( dirname( __FILE__ ) . '/includes/wp_admin_dashboard.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/social-profiles.php');
require_once( dirname( __FILE__ ) . '/includes/shortcodes/social-share.php');
require_once( dirname( __FILE__ ) . '/addons/google-analytics-dashboard-for-wp/gadwp.php');




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

add_action('wp_head', 'add_tracking_codes');
function add_tracking_codes(){
	$post_id = get_the_id();
	$post_object = get_post( $post_id );
	if(get_post_meta($post_id, 'amp', true) == 'nonamp'){
		$hiilite_options['amp'] = false;
	} else {
		$hiilite_options['amp'] = (!isset($hiilite_options['amp']))?get_theme_mod('amp'):false;
	}
	
	
	
	$file = dirname(__FILE__); // Current PHP file, but can be anyone
	$link = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $file );
	if((get_theme_mod('analytics_id') != '')) { 
		$gadwp = GADWP();
		$profile_info = GADWP_Tools::get_selected_profile($gadwp->config->options['ga_dash_profile_list'], $gadwp->config->options['ga_dash_tableid_jail']);
		$tracking_id = (isset($profile_info[2]))?$profile_info[2]:get_theme_mod('analytics_id');
		
		
	?>
		<script>
		window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
		ga('create', '<?=$tracking_id?>', 'auto');
		
		ga('require', 'cleanUrlTracker');
		ga('require', 'eventTracker');
		ga('require', 'impressionTracker');
		ga('require', 'mediaQueryTracker');
		ga('require', 'outboundFormTracker');
		ga('require', 'outboundLinkTracker');
		ga('require', 'pageVisibilityTracker');
		ga('require', 'urlChangeTracker');
		
		ga('send', 'pageview');
		
		</script>
<?php 
	}
	$options = get_option('hii_seo_settings');
	if($options['business_custom_tracking_code'] != '') {
		echo '<script>';
		echo $options['business_custom_tracking_code'];
		echo '</script>';
	}
	?>
	<script async src='https://www.google-analytics.com/analytics.js'></script>
	<script async src='<?=$link?>/js/vender/autotrack.js'></script>
	<?php
}



/*
on ADMIN_MENU	
*/
add_action('admin_menu', 'hiiwp_adminmenu', 10);
function hiiwp_adminmenu() {
	add_submenu_page('hii_seo_settings', __('Hiilite SEO', 'hiiwp'), __('Hiilite SEO', 'hiiwp'), 'manage_options', 'hii_seo_settings');
	
    add_menu_page( __('About Hiilite SEO', 'sitemap'), __('About', 'hiiwp'), 'manage_options', 'admin.php?page=about_hii_seo','hii_about_page');
    remove_menu_page( 'admin.php?page=about_hii_seo' );
    
    add_submenu_page( 'hii_seo_settings', __('About Hiilite SEO', 'sitemap'), __('About', 'hiiwp'), 'manage_options', 'admin.php?page=about_hii_seo','hii_about_page');
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
        __( 'Hiilite SEO Options' ), // meta box title, like "Page Attributes"
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




$HiiWP = new HiiWP();
$HiiWP->run();




?>