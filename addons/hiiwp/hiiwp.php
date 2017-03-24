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
    
    public static function activation_redirect($plugin){    
	    if( $plugin == plugin_basename( __FILE__ ) ) {     
	    	exit( wp_redirect( admin_url( 'admin.php?page=admin.php?page=about_hii_seo' ) ) );
	    }
    }
    
    
    /**
	 * Register the required plugins for this theme.
	 *
	 * The variable passed to tgmpa_register_plugins() should be an array of plugin
	 * arrays.
	 *
	 * This function is hooked into tgmpa_init, which is fired within the
	 * TGM_Plugin_Activation class constructor.
	 */
	public static function hiilite_register_required_plugins() {
	
	    /**
	     * Array of plugin arrays. Required keys are name and slug.
	     * If the source is NOT from the .org repo, then source is also required.
	     */
	    $plugins = array(
	
	        // This is an example of how to include a plugin pre-packaged with a theme.
	        array(
	            'name'               => 'Backup Buddy', // The plugin name.
	            'slug'               => 'backupbuddy', // The plugin slug (typically the folder name).
	            'source'             => dirname(__FILE__) . '/Plugin-Activation/plugins/backupbuddy-6.5.0.3.zip', // The plugin source.
	            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
	            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
	            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	        ),
			array(
	            'name'               => 'WPBakery Visual Composer', // The plugin name.
	            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
	            'source'             => dirname(__FILE__) . '/Plugin-Activation/plugins/js_composer.zip', // The plugin source.
	            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
	            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
	            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
	        ),
			array(
	            'name'               => 'Gravity Forms',
	            'slug'               => 'gravityforms', 
	            'source'             => dirname(__FILE__) . '/Plugin-Activation/plugins/gravityforms.zip',
	            'required'           => false, 
	            'force_activation'   => false, 
	            'force_deactivation' => false, 
	        ),
	        array(
	            'name'      => 'Imsanity',
	            'slug'      => 'imsanity',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Duplicate Post',
	            'slug'      => 'duplicate-post',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Post Types Order',
	            'slug'      => 'post-types-order',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Category Order and Taxonomy Terms Order',
	            'slug'      => 'taxonomy-terms-order',
	            'required'  => false,
	        ),
			array(
	            'name'      => 'Facebook Conversion Pixel',
	            'slug'      => 'facebook-conversion-pixel',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'WP Fastest Cache',
	            'slug'      => 'wp-fastest-cache',
	            'required'  => false,
	        ),
			array(
	            'name'      => 'Gravity Forms Google Analytics Event Tracking',
	            'slug'      => 'gravity-forms-google-analytics-event-tracking',
	            'required'  => false,
	        ),
			array(
	            'name'      => 'Sucuri Security - Auditing, Malware Scanner and Security Hardening',
	            'slug'      => 'sucuri-scanner',
	            'required'  => false,
	        ),
			array(
	            'name'      => 'Loginizer',
	            'slug'      => 'loginizer',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Cloudflare',
	            'slug'      => 'cloudflare',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'SSL Insecure Content Fixer',
	            'slug'      => 'ssl-insecure-content-fixer',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Loginizer',
	            'slug'      => 'loginizer',
	            'required'  => false,
	        ),
	    );
	
	    /**
	     * Array of configuration settings. Amend each line as needed.
	     * If you want the default strings to be available under your own theme domain,
	     * leave the strings uncommented.
	     * Some of the strings are added into a sprintf, so see the comments at the
	     * end of each line for what each argument will be.
	     */
	    $config = array(
	        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
	        'menu'         => 'tgmpa-install-plugins', // Menu slug.
	        'has_notices'  => true,                    // Show admin notices or not.
	        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
	        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
	        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
	        'message'      => '',                      // Message to output right before the plugins table.
	        'strings'      => array(
	            'page_title'                      => __( 'Install HiiWP Recommended Plugins', 'tgmpa' ),
	            'menu_title'                      => __( 'Install HiiWP Plugins', 'tgmpa' ),
	            'installing'                      => __( 'Installing HiiWP Plugin: %s', 'tgmpa' ), // %s = plugin name.
	            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
	            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
	            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
	            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
	            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
	            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
	            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
	            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
	            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
	            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
	            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
	            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
	            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
	            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
	            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
	        )
	    ); 
	
	    tgmpa( $plugins, $config );
	
	}
	
	

    
}


add_action( 'activated_plugin', array('HiiWP','activation_redirect' ));



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
require_once( dirname( __FILE__ ) . '/Plugin-Activation/class-tgm-plugin-activation.php');


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

add_action('wp_head', 'add_tracking_codes');
function add_tracking_codes(){
	$post_id = get_the_id();
	$post_object = get_post( $post_id );
	if(get_post_meta($post_id, 'amp', true) == 'nonamp'){
		$hiilite_options['amp'] = false;
	} else {
		$hiilite_options['amp'] = (!isset($hiilite_options['amp']))?get_theme_mod('amp'):false;
	}
	
	
	
	

	if($hiilite_options['amp']) { ?>
		<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
		<script async custom-element="amp-lightbox" src="https://cdn.ampproject.org/v0/amp-lightbox-0.1.js"></script>
		<script async custom-element="amp-image-lightbox" src="https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js"></script>
		<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
		<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
		<script async src="https://cdn.ampproject.org/v0.js"></script>
	<?php 
	} else { 
		$gadwp = GADWP();
		$profile_info = GADWP_Tools::get_selected_profile($gadwp->config->options['ga_dash_profile_list'], $gadwp->config->options['ga_dash_tableid_jail']);
		$tracking_id = (isset($profile_info[2]))?$profile_info[2]:get_theme_mod('analytics_id');
		$file = dirname(__FILE__); // Current PHP file, but can be anyone
		$link = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $file );
	?>
		<script type="text/javascript">
		(function(a,e,c,f,g,b,d){var h={ak:"123456789",cl:"_ABcDEFg12hI34567jK"};a[c]=a[c]||function(){(a[c].q=a[c].q||[]).push(arguments)};a[f]||(a[f]=h.ak);b=e.createElement(g);b.async=1;b.src="//www.gstatic.com/wcm/loader.js";d=e.getElementsByTagName(g)[0];d.parentNode.insertBefore(b,d);a._googWcmGet=function(b,d,e){a[c](2,b,h,d,null,new Date,e)}})(window,document,"_googWcmImpl","_googWcmAk","script");
		</script>
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
		<script async src='https://www.google-analytics.com/analytics.js'></script>
		<script async src='<?=$link?>/js/vender/autotrack.js'></script>
<?php 
	}
	$options = get_option('hii_seo_settings');
	if($options['business_custom_tracking_code'] != '') {
		echo '<script>';
		echo $options['business_custom_tracking_code'];
		echo '</script>';
	}
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
	if(get_post_meta($post_id, 'amp', true) == 'nonamp'){
		$hiilite_options['amp'] = false;
	} else {
		$hiilite_options['amp'] = (!isset($hiilite_options['amp']))?get_theme_mod('amp'):false;
	}
	
	$profile_info = GADWP_Tools::get_selected_profile($gadwp->config->options['ga_dash_profile_list'], $gadwp->config->options['ga_dash_tableid_jail']);
	
	//var_dump($profile_info);
	
	$tracking_id = (isset($profile_info[2]))?$profile_info[2]:get_theme_mod('analytics_id');
	
	if($hiilite_options['amp']) { 
	?>
	<amp-analytics type="googleanalytics" id="analytics1">
			<script type="application/json">
			{
			  "vars": {
			    "account": "<?=$tracking_id?>" 
			  },
			  "triggers": {
			    "trackPageview": { 
			      "on": "visible",
			      "request": "pageview"
			    },
			    "trackClickOnPhone" : {
			      "on": "click",
			      "selector": "a[href*=tel]",
			      "request": "event",
			      "vars": {
			        "eventCategory": "Contact Links",
			        "eventAction": "user-phoned"
			      }
			    },
			    "trackClickOnEmail" : {
			      "on": "click",
			      "selector": "a[href*=mailto]",
			      "request": "event",
			      "vars": {
			        "eventCategory": "Contact Links",
			        "eventAction": "user-emailed"
			      }
			    }
			  }
			}
			</script>
		</amp-analytics>
	<?php
	} else {
		?>
		<script>
			
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