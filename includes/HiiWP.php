<?php
class HiiWP {
	
	public static $options = array();
	
	
	
	
	public function __construct() {
		
		add_action( 'init', array( $this, 'hiiwp_init') );
		add_action( 'wp_head', array( $this, 'hiiwp_head') );
		add_action( 'wp_head', array($this, 'add_tracking_codes'));
		
		add_action( 'wp_footer', array( $this, 'print_inline_script'), 100 );
		
		add_action( 'after_setup_theme', array( $this, 'set_permalink_structure') );
		// Load admin JavaScript. Do an is_admin() check before calling My_Custom_Plugin
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ), 100 );
		//Used to disable tour mode
		add_action( 'wp_ajax_hiiwp_disable_tour_mode', array( $this, 'hiiwp_disable_tour_mode' ));
        
        
        add_filter( 'auto_update_theme', '__return_true' );
        add_filter( 'widget_text','do_shortcode');
        add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
        
        $hiilite_options = self::get_options();
        
        
        require_once( HIILITE_DIR . '/includes/kirki-settings.php' );
		require_once( HIILITE_DIR . '/addons/hiiwp/hiiwp.php');
		
        include_once( HIILITE_DIR . '/includes/Plugin-Activation/class-tgm-plugin-activation.php');
        
		require_once( HIILITE_DIR . '/addons/tinymce_edits/tinymce_edits.php');
		
		require_once( HIILITE_DIR . '/includes/widgets.php' );
		
		require_once( HIILITE_DIR . '/includes/register_sidebars.php' );
		
		require_once( HIILITE_DIR . '/includes/register_post_types.php');
		
		/*
		 * Auto include all shortcodes
		 */
		foreach (glob(HIILITE_DIR."/includes/shortcodes/*.php") as $filename)
		{
		    include_once( $filename );
		} 
		

	}
	
	
	public function get_options() {
		require(HIILITE_DIR . '/includes/site_variables.php');
		self::$options = $hiilite_options;
        return self::$options;
    }
    
    function hiiwp_init(){  
	    
		
    }
	 
	
	/*
	//	note: wp_head
	*/
	function hiiwp_head(){
		global $post, $wp_scripts, $woocommerce;
		
		$hiilite_options = self::get_options();
		 
		wp_enqueue_script("jquery");
		wp_enqueue_script('main-scripts', get_template_directory_uri().'/js/main-scripts.js','jquery', array( 'jquery' ), '0.0.1', true);	
		wp_localize_script('main-scripts', 'mobile_menu_switch', $hiilite_options['mobile_menu_switch']);
		add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
		if($hiilite_options['is_woocommerce']){
			wp_enqueue_script( 'prettyPhoto-init', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.init' . '.js', array( 'jquery' ), $woocommerce->version, true );
		} 
		
		include_once(HIILITE_DIR . '/css/main-css.php');
	}
	
	
	function print_inline_script() {
	  if ( wp_script_is( 'jquery', 'done' ) ) { 
		  
	  ?><script type="text/javascript">
			document.onreadystatechange = function() {
			<?=get_theme_mod('custom_js');?>
			};
		</script><?php
	  }
	}
	
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
	
	public function set_permalink_structure(){
		global $wp_rewrite;
	    $wp_rewrite->set_permalink_structure( '/%postname%/' );
	}
	
	public function add_tracking_codes(){
		$post_id = get_the_id();
		$post_object = get_post( $post_id );
		
		
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
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', '<?=$tracking_id?>', 'auto');
		ga('send', 'pageview');
		
		</script>
		<script async src='https://www.google-analytics.com/analytics.js'></script>
		<script async src='<?=HIIWP_URL?>/js/vender/autotrack.js'></script>
		<?php 
		
		$options = get_option('hii_seo_settings');
		if(isset($options['business_custom_tracking_code'])) {
				echo '<script>';
				echo $options['business_custom_tracking_code'];
				echo '</script>';
		}
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
	            'source'             => dirname(__FILE__) . '/Plugin-Activation/plugins/backupbuddy.zip', // The plugin source.
	            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
	            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
	            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	        ),
			array(
	            'name'               => 'WPBakery Visual Composer', // The plugin name.
	            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
	            'source'             => dirname(__FILE__) . '/Plugin-Activation/plugins/js_composer.zip', // The plugin source.
	            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
	            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
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
	            'name'      => 'Autoptimize',
	            'slug'      => 'autoptimize',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Cache Enabler',
	            'slug'      => 'cache-enabler',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Cloudflare',
	            'slug'      => 'cloudflare',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Optimus',
	            'slug'      => 'optimus',
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
	            'name'      => 'SSL Insecure Content Fixer',
	            'slug'      => 'ssl-insecure-content-fixer',
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
?>