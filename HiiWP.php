<?php
/**
 * The HiiWP main class.
 * Handles locating and loading other class-files.
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2019, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0.4
 */
if ( ! defined( 'ABSPATH' ) )	exit;
/**
 * HiiWP class.
 *
 */
class HiiWP extends Hii {
	
	private static $_instance = null;
	
	public static $options = array(); 
	public static $hiilite_options = null;

	public static function instance(){
		if( is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	 
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$hiilite_options = self::$hiilite_options = self::$options = self::get_options();
		
		
		add_action( 'init', array( $this, 'hiiwp_init') );
		add_action( 'wp_enqueue_scripts', array($this, 'hiiwp_enqueue_scripts') );
		add_action( 'wp_head', array($this, 'hiiwp_head') );
		add_action( 'wp_head', array($this, 'add_favicons'));
		add_action( 'wp_head', array($this, 'add_tracking_codes'));
		add_action( 'wp_head', array($this, 'canonical_for_comments') );
		add_filter('upload_mimes', array( $this, 'cc_mime_types' ) );
		
		add_action( 'wp_footer', array( $this, 'print_inline_script'), 100 );
		
		add_action( 'admin_menu', array( $this, 'hiiwp_adminmenu'), 10);
		
		add_action( 'after_setup_theme', array( $this, 'default_content_setup' ) );
		add_action( 'after_setup_theme', array( $this, 'woocommerce_support') );
		add_action( 'after_setup_theme', array( $this, 'sportspress_support') );
		add_action( 'after_setup_theme', array( $this, 'sensei_support') );
		
		add_action( 'after_switch_theme', array( $this, 'set_permalink_structure') ); // Load admin JavaScript. Do an is_admin() check before calling My_Custom_Plugin
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ), 100 );
		add_action( 'wp_ajax_hiiwp_disable_tour_mode', array( $this, 'hiiwp_disable_tour_mode' )); //Used to disable tour mode
        add_filter( 'auto_update_theme', '__return_true' );
        add_filter( 'widget_text','do_shortcode');
        add_action( 'tgmpa_register', array($this, 'hiilite_register_required_plugins' ));
        add_filter( 'get_the_archive_title', array($this, 'modify_archive_title' ));
        
        add_filter( 'navigation_markup_template', array($this, 'modify_navigation_markup_template'), 10, 2 );
        /*
	     // TODO: More testing and adding option to remove before turning on again  
	    */
        //add_action('wp_print_scripts','add_load_css',7);
		add_action('wp_head', array($this, 'add_load_css' ),7);
		if(self::$hiilite_options['show_page_loader']) {
			add_action('hii_body_start', array($this, 'add_loading_svg'));
		}
		
	    if(self::$hiilite_options['async_all_css'] && $GLOBALS['pagenow'] !== 'wp-login.php') {
			add_filter('style_loader_tag', array($this, 'link_to_loadCSS_script' ), 9999,3);
		}
		
        
		
        if ( ! function_exists( '_wp_render_title_tag' ) ) :
	    	add_action( 'wp_head', array($this, 'render_title' ));
    	else:
    		add_filter( 'document_title_parts', array($this, 'custom_titles'), 10);
	    endif;
        
		
        include_once( HIILITE_DIR . '/includes/Plugin-Activation/class-tgm-plugin-activation.php');
		require_once( HIILITE_DIR . '/addons/tinymce_edits/tinymce_edits.php');
		 
	}
	
	
	/**
	 * get_options function.
	 * 
	 * @access public
	 * @return void
	 */
	public static function get_options() {
		require(HIILITE_DIR . '/includes/site_variables.php');
		self::$options = apply_filters( 'hiiwp_settings', $hiilite_options);
        return self::$options;
    }
    
    
    /**
     * hiiwp_init function.
     * 
     * Run on WordPress Initialization
     *
     * @access public
     * @return void
     */
    public function hiiwp_init(){
	    
	    if( self::$hiilite_options['defer_all_javascript'] ) {
		    add_filter('script_loader_tag', array( $this, 'add_defer_attribute'), 10, 2);
	    }
		
    }
	
	
	/**
	 * hiiwp_enqueue_scripts function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hiiwp_enqueue_scripts () {
		$ajax_url         = HiiWP_Ajax::get_endpoint();
		$ajax_data 		  = array(
			'ajax_url'                => $ajax_url,
		);
    
		wp_enqueue_script('jquery-effects-core');
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('modernizr', HIIWP_URL.'/js/vender/modernizr-custom.js');

		wp_enqueue_script('kinetic', HIIWP_URL.'/js/vender/jquery.kinetic.min.js', array('jquery', 'jquery-ui-core'));
		wp_enqueue_script('smoothTouchScroll', HIIWP_URL.'/js/vender/jquery.smoothTouchScroll.min.js', array('jquery', 'jquery-ui-widget'));
		wp_enqueue_script('touchSwipe', HIIWP_URL.'/js/vender/jquery.touchSwipe.min.js', array('jquery', 'jquery-ui-core'));
		
		
		// TODO: Add option to turn on in theme advanced settings, or auto load when video widgets are used 
		if( self::$hiilite_options['load_viewport_units_buggyfill'] ) {
			wp_enqueue_script('viewportUnitsBuggyfill', HIIWP_URL.'/js/vender/viewport-units-buggyfill.js');
		}
		
		wp_enqueue_script('main-scripts', HIIWP_URL.'/js/main-scripts.js', array( 'jquery', 'smoothTouchScroll' ), HIIWP_VERSION, true);
		wp_localize_script('main-scripts', 'mobile_menu_switch', self::$hiilite_options['mobile_menu_switch']);
		wp_localize_script( 'main-scripts', 'hiiwp_ajax', $ajax_data );
		
		if(self::$hiilite_options['is_woocommerce']){
			wp_enqueue_script( 'prettyPhoto-init', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.init.js', array( 'jquery' ), $woocommerce->version, true );
		} 
	}
	
	
	/**
	 * add_load_css function.
	 *
	 * Script to run the page load animation
	 * 
	 * @access public
	 * @return void
	 */
	public function add_load_css(){ 
	    if(self::$hiilite_options['show_page_loader']) {
	    	?><style>html body > .wrapper{opacity:0;transition:opacity 0.25s;}html[class*="-active"] body > .wrapper{opacity: 1;}</style><noscript><style>html body > .wrapper{opacity:1;} body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}#page-loader{display:none;}</style></noscript><?php
		}
	    if(self::$hiilite_options['async_all_css']) {
	    	?><script>/*! loadCSS: load a CSS file asynchronously.[c]2014 @scottjehl, Filament Group, Inc.Licensed MIT */function loadCSS( href, before, media ){"use strict";var ss = window.document.createElement( "link" );var ref = before || window.document.getElementsByTagName( "script" )[ 0 ];ss.rel = "stylesheet";ss.href = href;ss.media = "only x";ref.parentNode.insertBefore( ss, ref );setTimeout( function(){ss.media = media || "all";} );return ss;}</script><?php
		}
		
	}
	
	
	/**
	 * add_loading_svg function.
	 * 
	 * Adds page loader SVG
	 *
	 * @access public
	 * @return void
	 */
	public function add_loading_svg(){
		?><svg id="page-loader" style="width: 150px;height: 150px;position: fixed; z-index: 99999; top: 0; bottom: 0; margin: auto;left: 0;right: 0; transition:all 0.4s; "><circle cx="75" cy="75" r="20" /><circle cx="75" cy="75" r="35" /><circle cx="75" cy="75" r="50" /><circle cx="75" cy="75" r="65" /></svg><?php
	}
	
	/**
	 * link_to_loadCSS_script function.
	 * 
	 * @access public
	 * @param mixed $html
	 * @param mixed $handle
	 * @param mixed $href
	 * @return void
	 */
	public function link_to_loadCSS_script($html, $handle, $href ) {
		if(!is_admin()){
			$dom = new DOMDocument();
		    $dom->loadHTML($html);
		    $a = $dom->getElementById($handle.'-css');
		    if($a) {
			    $html = "<script>(function(){if (typeof loadCSS == 'function') { loadCSS('" . $a->getAttribute('href') . "',0,'" . $a->getAttribute('media') . "'); }}())</script>";
			    return $html;	
		    } else {
			    return $html;
		    }
		} else {
			return $html;
		}
	}
	 
	/**
	 * hiiwp_head function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hiiwp_head(){
		global $cpage, $post, $wp_scripts, $woocommerce, $hiilite_options;
		
		echo '<meta name="theme-color" content="#30b5c4"/>';
		//echo '<link rel="manifest" href="'.get_stylesheet_directory_uri( ).'/manifest.json">';
		
		ob_start();
		include_once(HIILITE_DIR . '/css/main-css.php');
		$css = ob_get_clean();
		$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css); // Remove comments
		// backup values within single or double quotes
		preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
		for ($i=0; $i < count($hit[1]); $i++) {
			$css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
		}
		// remove traling semicolon of selector's last property
		$css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
		// remove any whitespace between semicolon and property-name
		$css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
		// remove any whitespace surrounding property-colon
		$css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
		// remove any whitespace surrounding selector-comma
		$css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
		// remove any whitespace surrounding opening parenthesis
		$css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
		// remove any whitespace between numbers and units
		$css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
		// shorten zero-values
		$css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
		// constrain multiple whitespaces
		$css = preg_replace('/\p{Zs}+/ims',' ', $css);
		// remove newlines
		$css = str_replace(array("\r\n", "\r", "\n"), '', $css);
		// Restore backupped values within single or double quotes
		for ($i=0; $i < count($hit[1]); $i++) {
			$css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
		}
		echo $css;
	}
	
	
	/**
	 * add_favicons function.
	 * 
	 * @access public
	 * @return void
	 */
	public static function add_favicons(){		
		$favicon = self::$hiilite_options['favicon'];
		echo "<link rel='shortcut icon' href='$favicon'>";
		$safari_icon = self::$hiilite_options['safari_icon'];
		$safari_icon_color = self::$hiilite_options['safari_icon_color'];
		echo "<link rel='mask-icon' href='$safari_icon' color='$safari_icon_color'>";
		?><meta name="apple-mobile-web-app-capable" content="yes"><meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"><?php
	}
	
	/**
	 * canonical_for_comments function.
	 * 
	 * @access public
	 * @return void
	 */
	public function canonical_for_comments() {
	  global $cpage, $post;
	  if ( $cpage > 1 ) :
	    echo "";
	      echo "<link rel='canonical' href='";
	      echo get_permalink( $post->ID );
	      echo "' />";
	   endif;
	}
	
	
	/**
	 * hiiwp_adminmenu function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hiiwp_adminmenu() {
		add_submenu_page('hii_seo_settings', __('HiiWP Settings', 'hiiwp'), __('Settings', 'hiiwp'), 'manage_options', 'hii_seo_settings');
		
		add_submenu_page('hii_seo_settings', __('Customize', 'hiiwp'), __('Customize', 'hiiwp'), 'manage_options', 'customize.php');
		
		add_submenu_page('hii_seo_settings', __('Install Plugins', 'hiiwp'), __('Install Plugins', 'hiiwp'), 'manage_options', 'themes.php?page=tgmpa-install-plugins');
		
		add_submenu_page('hii_seo_settings', __('About HiiWP', 'hiiwp'), __('About HiiWP', 'hiiwp'), 'manage_options', 'themes.php?page=admin.php%3Fpage%3Dhiiwp-welcome');
		
	}
	
	
	/**
	 * render_title function.
	 * For WP 4.1 and under
	 * @access public
	 * @return void
	 */
	public function render_title() {
		// Page Title
		$brand_title = (get_theme_mod('brand_seo_title')!='')?get_theme_mod('brand_seo_title'):get_bloginfo('title');
		if(get_post_meta(get_the_id(), 'page_seo_title', true) != ''){
			$page_title = get_post_meta(get_the_id(), 'page_seo_title', true);
		} elseif(get_theme_mod('site_seo_title') != '' && is_front_page()) {
			$page_title = get_theme_mod('site_seo_title');
		} else {
			$page_title = wp_title('|',false,'right').$brand_title;
		}
		return $page_title;
	}
	
	/**
	 * custom_titles function.
	 * 
	 * @access public
	 * @param mixed $title
	 * @return void
	 */
	function custom_titles( $title ) {
	
	    // Page Title
		$brand_title = (get_theme_mod('brand_seo_title')!='')?get_theme_mod('brand_seo_title'):get_bloginfo('title');
		$title['site'] = '';
		$title['tagline'] = '';
		$pageID = (is_home())?get_option('page_for_posts'):get_the_ID();
		if( get_post_meta($pageID, '_yoast_wpseo_title', true) != '' ) {
			$title['title'] = get_post_meta($pageID, '_yoast_wpseo_title', true);
		} 
		elseif( get_post_meta($pageID, 'page_seo_title', true) != '' ){
			$title['title'] = get_post_meta($pageID, 'page_seo_title', true);
		} 
		elseif( get_theme_mod('site_seo_title') != '' && is_front_page() ) {
			$title['title'] = get_theme_mod('site_seo_title');
		}
		
	    return $title;
	}
	
	/**
	 * hii_about_page function.
	 * 
	 * @access public
	 * @return void
	 */
	public function hiiwp_welcome(){
		require_once( HIILITE_DIR . '/includes/admin/hiiwp-welcome-screen.php');
	}
	
	public function default_content_setup(){
		// Add starter content.
		add_theme_support( 'starter-content', array(
			/*
			// Add Widget Content
			'widgets' => array(
				'footer-1' => array(
					'text_about',
				),
				'footer-2' => array(
					'text_business_info',
				),
				'footer-3' => array(
					'meta',
				),
			),*/
			
			
			'posts' => HiiWP::starter_content_posts(),
	
			// Add Widget Menus
			'nav_menus' => array(
				'main_menu' => array(
					'name' => __( 'Main Menu', 'hiiwp' ),
					'items' => array(
						'page_home',
						'page_about',
						'page_blog',
						'page_contact',
					),
				),
			),
	
			// Set default options
			'options' => array(
				'show_on_front' => 'page',
				'page_on_front' => '{{home}}',
				'page_for_posts' => '{{blog}}',
			),
		) );
	}
	
	private function starter_content_posts() {
		$posts = array(
			'home',
			'about',
			'contact',
			'blog',
		);

		return $posts;
	}
	
	/**
	 * woocommerce_support function.
	 * 
	 * @access public
	 * @return void
	 */
	public function woocommerce_support() {
    	add_theme_support( 'woocommerce' );
    	add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
	
	public function sensei_support() {
    	add_theme_support( 'sensei' );
	}
	
	public function sportspress_support(){
		add_theme_support( 'sportspress' );
	}
	
	
	/**
	 * add_defer_attribute function.
	 * 
	 * @access public
	 * @param mixed $tag
	 * @param mixed $handle
	 * @return void
	 */
	public function add_defer_attribute($tag, $handle) {

		// Scripts to exclude
		$exclude_scripts = array(
			//'jquery',
			'jquery-core',
			'webfont-loader',
			'sv-wc-payment-gateway-payment-form'
		);
		if(is_admin() || is_customize_preview()) return $tag;
		
		if( in_array($handle, $exclude_scripts) ) {
			return $tag;
		} else {
			return str_replace( ' src', ' defer=defer src', $tag );
		}
			
		return $tag;
	}
	
	
	/**
	 * print_inline_script function.
	 * 
	 * @access public
	 * @return void
	 */
	public function print_inline_script() {
	  if ( wp_script_is( 'jquery', 'done' ) ) { 
	  ?><script type="text/javascript">
			<?php echo get_theme_mod('custom_js');?>	
		</script>
		<script>
		    (function() {
				if (sessionStorage.fonts) {
					document.documentElement.classList.add('wf-active');
				} 
		    })();
	    </script><?php
	  }
	}
	
	/**
	 * modify_archive_title function.
	 * 
	 * @access public
	 * @param mixed $title
	 * @return void
	 */
	public function  modify_archive_title( $title ) {
	    if ( is_category() ) {
	        $title = single_cat_title( '', false );
	    } elseif ( is_tag() ) {
	        $title = single_tag_title( '', false );
	    } elseif ( is_author() ) {
	        $title = '<span class="vcard">' . get_the_author() . '</span>';
	    } elseif ( is_post_type_archive() ) {
	        $title = post_type_archive_title( '', false );
	    } elseif ( is_tax() ) {
	        $title = single_term_title( '', false );
	    }
	  
	    return $title;
	}
	
	
	public function modify_navigation_markup_template( $template, $class ) {
		global $post;
		
		$back_link = '<div class="nav-back">';
		switch (get_post_type($post)) {
			case get_theme_mod( 'portfolio_slug', 'portfolio' ):
				$back_link .= '<a href="'. get_bloginfo( 'url' ) . '/' . self::$hiilite_options['portfolio_slug'] .'">Back to Portfolio</a>';
				break;
			case 'team':
				$back_link .= '<a href="'. get_bloginfo( 'url' ) . '/' . self::$hiilite_options['team_slug'] .'">Back to Team</a>';
				break;
			case 'menu':
				$back_link .= '<a href="'. get_bloginfo( 'url' ) . '/' . self::$hiilite_options['menu_slug'] .'">Back to Menu</a>';
				break;
			case 'post':
				
				$blog_link = ( get_option( 'page_for_posts' ) != false ) ? get_permalink( get_option( 'page_for_posts' ) ) : esc_url( home_url() );
				$back_link .= '<a class="back_to_blog" href="' . $blog_link . '">Back to blog</a>';
				break;
			default:
				$back_link .= '';
				break;
		}
		$back_link .= '</div>';
		
		
		
		
		
		$template = '<nav class="navigation %1$s" role="navigation">
				        <h2 class="screen-reader-text">%2$s</h2>
				        <div class="nav-links">'.$back_link.' %3$s</div>
				    </nav>';
		return $template;
	}

	/**
	 * set_permalink_structure function.
	 * 
	 * @access public
	 * @return void
	 */
	public function set_permalink_structure(){
		global $wp_rewrite;
	    $wp_rewrite->set_permalink_structure( '/%postname%/' );
	}
	
	/**
	 * add_tracking_codes function.
	 * 
	 * @access public
	 * @return void
	 */
	public function add_tracking_codes(){
		$options = get_option('hii_seo_settings');
		
		if(!class_exists('GADWP_Manager')):
			if(isset($options['google_analytics_ua_code'])):
		
				?>
				<script type="text/javascript">
				(function(a,e,c,f,g,b,d){var h={ak:"123456789",cl:"_ABcDEFg12hI34567jK"};a[c]=a[c]||function(){(a[c].q=a[c].q||[]).push(arguments)};a[f]||(a[f]=h.ak);b=e.createElement(g);b.async=1;b.src="//www.gstatic.com/wcm/loader.js";d=e.getElementsByTagName(g)[0];d.parentNode.insertBefore(b,d);a._googWcmGet=function(b,d,e){a[c](2,b,h,d,null,new Date,e)}})(window,document,"_googWcmImpl","_googWcmAk","script");
				
				  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
				ga('create', '<?php echo esc_html($tracking_id);?>', 'auto');
				ga('send', 'pageview');
				
				</script>
				<script async src='https://www.google-analytics.com/analytics.js'></script>
				<script async src='<?php echo HIIWP_URL?>/js/vender/autotrack.js'></script>
				<?php
			endif; 
		endif;
		
		if(isset($options['business_custom_tracking_code'])) {
				echo '<script>';
				echo esc_js($options['business_custom_tracking_code']);
				echo '</script>';
		}
	}
	
	/**
	 * enqueue_admin_scripts function.
	 * 
	 * @access public
	 * @return void
	 */
	public function enqueue_admin_scripts() {
		$ajax_url         = HiiWP_Ajax::get_endpoint();
		$ajax_data 		  = array(
			'ajax_url'                => $ajax_url,
		);
		
		wp_enqueue_script( HIIWP_SLUG . '-pointer-js', HIIWP_URL.'/js/hiiwp-pointer.js', array( 'jquery' ), HIIWP_VERSION );
		
		wp_enqueue_style( HIIWP_SLUG . '-select2', HIIWP_URL . '/js/vender/select2/css/select2.css', HIIWP_VERSION );
		wp_enqueue_script( HIIWP_SLUG . '-select2', HIIWP_URL . '/js/vender/select2/js/select2.min.js', 'jQuery', HIIWP_VERSION, true );
		
		wp_enqueue_script( HIIWP_SLUG .'-admin-js', HIIWP_URL . '/js/hiiwp-admin.js', array('jquery'), HIIWP_VERSION, true );
		
		
        wp_enqueue_style( HIIWP_SLUG . '-admin-css' );
		
		$tour_pointer_messages['hiiwp_intro_tour'] =  $this->load_intro_tour();
		
		//Localization allows us to send variables to the JS script. In this case, we are sending the pointers array
		wp_localize_script( HIIWP_SLUG . '-pointer-js', 'hiiwp_admin', 
		array(  'ajax_url'              =>  admin_url( 'admin-ajax.php'),
		    'hiiwp_admin_nonce' =>  wp_create_nonce( 'hiiwp-admin-nonce' ),//Not used in this example but important
		    'hiiwp_tour_pointers'     =>  $tour_pointer_messages
			)
		);
		
		wp_localize_script( HIIWP_SLUG .'-admin-js', 'hiiwp_ajax', $ajax_data );
		
		//wp_localize_script( HIIWP_SLUG .'-admin-js', 'hiiwp_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	}

	/**
	* Give the user an introductory tour to your plugin
	* @return Array $pointers Returns an array of pointers or false
	*/
	public function load_intro_tour(){
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
	 * generate_tour_content function.
	 * 
	 * @access public
	 * @return void
	 */
	public function generate_tour_content(){
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
    
    /**
     * activation_redirect function.
     * 
     * @access public
     * @static
     * @param mixed $plugin
     * @return void
     */
    public static function activation_redirect($plugin){    
	    if( $plugin == plugin_basename( __FILE__ ) ) {     
	    	exit( wp_redirect( admin_url( 'themes.php?page=admin.php%3Fpage%3Dhiiwp-welcome' ) ) );
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
		
		$hiilite_dev_only_plugins = array(
			
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
	            'name'      => 'Optimus',
	            'slug'      => 'optimus',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Cloudflare',
	            'slug'      => 'cloudflare',
	            'required'  => false,
	        ),
	        array(
	            'name'               => 'Gravity Forms',
	            'slug'               => 'gravityforms', 
	            'source'             => 'https://hiilite.com/download/9030/',
	            'version'			 => '2.4.7',
	            'required'           => false, 
	            'force_activation'   => false, 
	            'force_deactivation' => false, 
	        ),
			array(
	            'name'      => 'Gravity Forms Google Analytics Event Tracking',
	            'slug'      => 'gravity-forms-google-analytics-event-tracking',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Facebook Tracking Pixel for Gravity Forms',
	            'slug'      => 'gf-facebook-pixel-tracking',
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
	    
	    $plugins = array(
			array(
	            'name'               => 'WPBakery Page Builder', // The plugin name.
	            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
	            'source'             => 'https://hiilite.com/download/9034/', // The plugin source.
	            'version'			 	=> '5.7',
	            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
	            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
	            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
	        ),
	        array(
	            'name'               => 'HiiWP Plus', // The plugin name.
	            'slug'               => 'hiiwp-plus', // The plugin slug (typically the folder name).
	            'source'             => 'https://github.com/hiilite/hiiwp-plus/archive/master.zip', // The plugin source.
	            'version'			 => '1.0.3',
	            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
	            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
	            'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
	        ),
			array(
	            'name'      => 'One Click Demo Import',
	            'slug'      => 'one-click-demo-import',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Yoast SEO',
	            'slug'      => 'wordpress-seo',
	            'required'  => false,
	        ),
	        array(
	            'name'      => 'Classic Editor',
	            'slug'      => 'classic-editor',
	            'required'  => false,
	        ),
	    );
		
		if( self::$hiilite_options['hiilite_developer'] ) { 
			$plugins = array_merge($plugins, $hiilite_dev_only_plugins);
		}
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
	            'page_title'                      => __( 'Install HiiWP Recommended Plugins', 'hiiwp' ),
	            'menu_title'                      => __( 'Recommended Plugins', 'hiiwp' ),
	            'installing'                      => __( 'Installing HiiWP Plugin: %s', 'hiiwp' ), // %s = plugin name.
	            'oops'                            => __( 'Something went wrong with the plugin API.', 'hiiwp' ),
	            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'hiiwp' ), // %1$s = plugin name(s).
	            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'hiiwp' ), // %1$s = plugin name(s).
	            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'hiiwp' ), // %1$s = plugin name(s).
	            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'hiiwp' ), // %1$s = plugin name(s).
	            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'hiiwp' ), // %1$s = plugin name(s).
	            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'hiiwp' ), // %1$s = plugin name(s).
	            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'hiiwp' ), // %1$s = plugin name(s).
	            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'hiiwp' ), // %1$s = plugin name(s).
	            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'hiiwp' ),
	            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'hiiwp' ),
	            'return'                          => __( 'Return to Required Plugins Installer', 'hiiwp' ),
	            'plugin_activated'                => __( 'Plugin activated successfully.', 'hiiwp' ),
	            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'hiiwp' ), // %s = dashboard link.
	            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
	        )
	    ); 
	
	    tgmpa( $plugins, $config );
	
	}
	
	/**
	 *
	 * @desc registers a theme activation hook
	 * @param string $code : Code of the theme. This can be the base folder of your theme. Eg if your theme is in folder 'mytheme' then code will be 'mytheme'
	 * @param callback $function : Function to call when theme gets activated.
	 */
	public static function register_theme_activation_hook($code, $function) {
	    $optionKey="theme_is_activated_" . $code;
	    if(!get_option($optionKey)) {
	        call_user_func($function);
	        update_option($optionKey , 1); 
	    }
	}
	
	/**
	 * @desc registers deactivation hook
	 * @param string $code : Code of the theme. This must match the value you provided in wp_register_theme_activation_hook function as $code
	 * @param callback $function : Function to call when theme gets deactivated.
	 */
	public static function register_theme_deactivation_hook($code, $function) {
	    // store function in code specific global
	    $GLOBALS["register_theme_deactivation_hook_function" . $code]=$function;
	
	    // Your theme can perceive this hook as a deactivation hook.
	    add_action("switch_theme", 'theme_deactivation');
	}
	 
	
	/**
	 * cc_mime_types function.
	 * 
	 * @access public
	 * @param mixed $mimes
	 * @return void
	 */
	public function cc_mime_types($mimes) {
	  $mimes['svg'] = 'image/svg+xml';
	  return $mimes;
	}
	
}

new HiiWP();