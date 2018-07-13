<?php
/**
 * HiiWP functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

/**
 * HiiWP only works in WordPress 4.4 or later.
 */
class Hii {
	/*--------------------------------------------*
     * Attributes 
     *--------------------------------------------*/
     
	/** Refers to a single instance of this class. */
	private static $_instance = null;
	
	public static $hiiwp = null;

	private $rest_api = null;
	
	public static $options = array();
	
	/**
	 * HTML Element Helper Object
	 *
	 * @var object
	 * @since 0.4.9
	 */
	 public static $html;

	/**
	 * Main HiiWP Instance.
	 *
	 * Ensures only one instance of HiiWP is loaded or can be loaded.
	 *
	 * @since  1.0.0
	 * @static
	 * @see HIIWP()
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	
	/**
	 * define_constants function.
	 * 
	 * @access private
	 * @return void
	 */
	private function define_constants(){
	    if ( ! defined( 'HIIWP_VERSION' ) ) {                
			 define( 'HIIWP_VERSION', '1.0' );
		}
		if ( ! defined( 'HIIWP_SLUG' ) ) {                
		    define( 'HIIWP_SLUG', 'hiiwp' );           
		}                
		if(!defined('HIILITE_DIR')) define( 'HIILITE_DIR', get_template_directory() );
		if(!defined('HIIWP_DIR')) define( 'HIIWP_DIR', get_template_directory() );
		    
		if ( ! defined( 'HIIWP_URL' ) ) {
		    $file = get_template_directory(); 
			$link = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $file );
		    define( 'HIIWP_URL', $link );
		}
	}
	
	/**
     * Initializes the theme by setting localization, filters, and administration functions.
     */
	public function __construct() {
		$this->define_constants();
		$this->add_dependencies();
		$this->add_service_extensions();
		
				
		include_once(HIILITE_DIR . '/HiiWP.php');
		
		// For backwards compatibility
		if(null == self::$hiiwp) {
			self::$hiiwp = $this;
		}
		
		$hiilite_options = self::get_options();
		
		
		foreach (glob(HIILITE_DIR."/includes/class-hiiwp-*.php") as $filename) {
		    include_once( $filename );
		} 
		
		
		$this->hooks		= new HiiWP_Hooks();
		$this->post_types	= new HiiWP_Post_Types();
		$this->sidebars		= new HiiWP_Sidebars();
		$this->theme_options= new HiiWP_Theme_Options();
		$this->menus		= new HiiWP_Menus();
		self::$html 		= new HiiWP_HTML_Elements();
				
		
		
		
		add_action( 'after_setup_theme', array($this, 'setup'));
		add_action( 'after_switch_theme', array( $this, 'activate') );
		
		add_action( 'after_switch_theme', array( 'HiiWP_Ajax', 'add_endpoint'), 10);
		add_action( 'after_switch_theme', 'flush_rewrite_rules', 15);
		
		add_action('wp_enqueue_scripts', array( $this, 'add_scripts' ));
		
		
	}
	
	public function add_scripts() {
		
	}
	
	private function add_dependencies(){
		include_once( HIILITE_DIR . '/addons/cmb2-functions.php' ); 
		if(!class_exists('Cmb2_Metatabs_Options'))	include_once( HIILITE_DIR . '/addons/cmb2-metatabs-options/cmb2_metatabs_options.php' );
		if(!class_exists('CMB2_Conditionals'))		include_once( HIILITE_DIR . '/addons/cmb2-conditionals/cmb2-conditionals.php' );
		if(!class_exists('PW_CMB2_Field_Select2'))	include_once( HIILITE_DIR . '/addons/cmb-field-select2/cmb-field-select2.php' );
		if(!class_exists('WDS_CMB2_Attached_Posts_Field_127'))	include_once( HIILITE_DIR . '/addons/cmb2-attached-posts/cmb2-attached-posts-field.php' );
		if(!class_exists('CMB2_Taxonomy'))			include_once( HIILITE_DIR . '/addons/cmb2-taxonomy/init.php' );
		include_once( HIILITE_DIR . '/addons/custom-field-types/address-field-type/address-field-type.php' );
	}
	
	private function add_service_extensions(){
		if(class_exists('WooCommerce')){
			get_template_part( 'includes/service_extensions/woocommerce' );
		}
		
		if(class_exists('Sensei_Main')){
			get_template_part( 'includes/service_extensions/sensei' );
		}
		
		if(class_exists('WP_User_Manager')):
			get_template_part( 'includes/shortcodes/wpum');
		endif;
		
		if(class_exists('Sportspress')):
			get_template_part( 'includes/service_extensions/sportspress');
		endif;
		
		if(class_exists('bbPress')):
			get_template_part( 'includes/service_extensions/bbpress');
		endif;
		
		if(function_exists('espresso_version')):
			/* Add usport for custom event list template */
			add_filter( 'FHEE__EED_Event_Archive__template_include__allow_custom_selected_template', '__return_true' );
		endif;
		
		if(class_exists('GFForms')):
			add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
		endif;
		
		/*
		Include Support Add-ons	
		*/
		if(class_exists('Vc_Manager')){
			/*
			Include VC Extend file
			*/
			add_action( 'init', array( $this, 'requireVcExtend' ), 10);
			add_action( 'vc_after_init', array( $this, 'add_vc_grid_dependancies' ) ); 		
		}
	}
	
	/**
	 * requireVcExtend function.
	 * 
	 * @access public
	 * @return void
	 */
	public function requireVcExtend(){
		require_once locate_template('/extendvc/extend-vc.php');
	}
	
	public function add_vc_grid_dependancies() {
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
	
	/**
	 * activate function.
	 * 
	 * @access public
	 * @return void
	 */
	public function activate() {
		HiiWP_Ajax::add_endpoint();
		HiiWP_Install::install();
		flush_rewrite_rules();
	}
	
	
	/**
	 * setup function.
	 * 
	 * @access public
	 * @return void
	 */
	public function setup(){
		
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'hiiwp' );
		
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		add_theme_support( 'post-thumbnails' );
		
		$GLOBALS['content_width'] = 1600;
		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		) );
		
		// Add theme support for Custom Logo.
		add_theme_support( 'custom-logo', array(
			'width'       => 250,
			'height'      => 250,
			'flex-width'  => true,
		) );
		
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
	 	 */
		add_editor_style(  HIILITE_DIR.'/css/editor-style.css' );
	}
	
	/**
	 * get_options function.
	 * 
	 * @access public
	 * @return void
	 */
	public static function get_options() {
		require(HIILITE_DIR . '/includes/site_variables.php');
		self::$options = $hiilite_options;
        return self::$options;
    }
    
    /**
	 * get_post_types function.
	 * 
	 * @access public
	 * @param array $args (default: array())
	 * @param string $output (default: 'names')
	 * @return void
	 */
	public static function get_post_types($args = array(), $output = 'names') {
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
    
}

$GLOBALS['hiiwp'] = Hii::instance();
$hiilite_options = Hii::get_options();



/**
 * hii_get_the_title function.
 * 
 * @access public
 * @return void
 */
if (! function_exists('hii_get_the_title')):
function hii_get_the_title(){
	$t_sep = ':';
	if( is_archive() )
		$page_title = get_the_archive_title();
	elseif( is_home() && ! is_front_page() ) 
		$page_title = get_the_title( get_option( 'page_for_posts', true ) );
	elseif( is_front_page() && ! is_home( ) )
		$page_title = get_the_title( get_the_id( ) );
	elseif(is_search(  )){
		$search   = get_query_var( 's' );
		$page_title = sprintf( __( 'Search Results %1$s %2$s', 'hiiwp' ), $t_sep, strip_tags( $search ) ); }
	elseif(is_404())
		$page_title = __( 'Page not found', 'hiiwp' );
	else
		$page_title = get_the_title( get_the_id( ));
		
	$page_title = strip_tags($page_title);
	
	return $page_title;
}
endif;

/*
	TEMPORARY until Kirki fixes font-awesome loader.
*/
add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
function enqueue_load_fa() {
    wp_enqueue_style( 'load-fa', get_template_directory_uri(  ).'/css/font-awesome/css/font-awesome.min.css' );
}

/**
 * hii_the_title function.
 * 
 * @access public
 * @return void
 */
if (! function_exists('hii_the_title')):
function hii_the_title() {
	echo hii_get_the_title();
}
endif;

/**
 * get_background_css function.
 * 
 * @access public
 * @param mixed $background
 * @return void
 */
 if(!function_exists('get_background_css')):
	function get_background_css($background){ 
		$background_css = '';
		foreach($background as $rule => $value){
			if($value != ''){
				switch ($rule){
					case 'background-image':case 'image':
						$background_css .= "background-image:url($value);";
						break;
					case 'background-attach':case 'attach':
						$background_css.= "background-attachment:$value;";
						break;
					case 'background-position':case 'position':
						$background_css.= 'background-position:'.str_replace('-', ' ', $value).';';
						break;
					case 'background-size':case 'size':
						$background_css.= "background-size:$value;";
						break;
					case 'background-repeat':case 'repeat':
						$background_css.= "background-repeat:$value;";
						break;
					case 'background-color':case 'color':
						$background_css.= "background-color:$value;";
						break;
					default:
						$background_css.= "$rule:$value;";
						break;
						
				}
			}
		}
		return $background_css;
	}
endif;

/**
 * sanitize_rgba function.
 * 
 * @access public
 * @param mixed $font
 * @return void
 */
if (! function_exists('sanitize_rgba')):
function sanitize_rgba( $color ) {
    // If string does not start with 'rgba', then treat as hex
    // sanitize the hex color and finally convert hex to rgba
    if ( false === strpos( $color, 'rgba' ) ) {
        return sanitize_hex_color( $color );
    }

    // By now we know the string is formatted as an rgba color so we need to further sanitize it.
    $color = str_replace( ' ', '', $color );
    sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
    return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
}
endif;

/**
 * get_font_css function.
 * 
 * @access public
 * @param mixed $font
 * @return void
 */
if (! function_exists('get_font_css')):
function get_font_css($font) {
	if(is_array($font)){
	
		$font_family = $font_weight = $text_align = $font_extras = '';
		
		foreach($font as $key => $value){
			if($value != ' ' && $value != '' && $value != 'px'){
				if($key == 'variant') { 
					$font_weight = 'font-weight:';
					switch ($value) {
						case 'regular':
							$font_weight .= '400';
						break;
						case '100italic':
							$font_weight .= '100;font-style:italic;';
						break;
						case '200italic':
							$font_weight .= '200;font-style:italic;';
						break;
						case '300italic':
							$font_weight .= '300;font-style:italic;';
						break;
						case '400italic':
							$font_weight .= '400;font-style:italic;';
						break;
						case '600italic':
							$font_weight .= '600;font-style:italic;';
						break;
						case '700italic':
							$font_weight .= '700;font-style:italic;';
						break;
						case '800italic':
							$font_weight .= '800;font-style:italic;';
						break;
						case '900italic':
							$font_weight .= '900;font-style:italic;';
						break;
						case 'italic':
							$font_weight .= '400;font-style:italic;';
						break;
						default:
							$font_weight .= $value.';';
						break;
					}
					$font_weight .= ';';
				}
				elseif ($key == 'text-align') {
					$text_align = '';
					switch ($value) {
						case 'right':
							$text_align .= 'margin-left:auto;';
						break;
						case 'center':
							$text_align .=  'margin-left:auto;';
							$text_align .=  'margin-right:auto;';
						break;
						case 'left':
							$text_align .=  'margin-right:auto;';
						break;
					}
					$text_align .=  $key.':'.$value.';';
				}
				elseif ($key == 'font-family') {
					$font_family = $key.':'.$value;
				}
				elseif ($key == 'font-backup') {
					$font_family .= ','.$value;
				}
				elseif($key != 'font-weight' && $key != 'font-style') { 
					$font_extras .= $key.':'.$value.';'; 
				}
				
			}
		}
		return $font_family.';'.$font_weight.$font_extras.$text_align;
	}
}
endif;

/**
 * get_justify_content function.
 * 
 * @access public
 * @param mixed $align
 * @return void
 */
if(!function_exists('get_justify_content')) :
function get_justify_content($align){
	if(is_array($align)){
		foreach($align as $key => $value){
			if($value != ' ' && $value != ''){
				if($key == 'text-align') { 
					echo 'justify-content:';
					switch ($value) {
						case 'left':
							return 'flex-start;';
						break;
						case 'right':
							return 'flex-end;';
						break;
						case 'center':
							return 'center;';
						break;
						case 'justify':
							return 'space-around;';
						break;
					}
					echo ';';
				}
			}
		}
	}
}
endif;

/**
 * get_spacing function.
 * 
 * @access public
 * @param mixed $spacing
 * @return void
 */
if(!function_exists('get_spacing')) :
function get_spacing($spacing){
	$values = '';

	$values = $spacing['top'].' '.$spacing['right'].' '.$spacing['bottom'].' '.$spacing['left'];
	
	return $values;
}
endif;


/*
Get Primary Category With Yoast	
*/
if(!function_exists('prime_cat')) :
function prime_cat($tax, $id) {
	$yourTaxonomy = 'work';

	$category = get_the_terms( $id, $tax );
	$useCatLink = true;
	// If post has a category assigned.
	if ($category){
		$category_display = '';
		$category_link = '';
		if ( class_exists('WPSEO_Primary_Term') )
		{
			// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
			$wpseo_primary_term = new WPSEO_Primary_Term( 'event_cat', get_the_id() );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term = get_term( $wpseo_primary_term );
			if (is_wp_error($term)) { 
				// Default to first category (not Yoast) if an error is returned
				$category_display = $category[0]->name;
				$category_link = esc_url( home_url() ) . '/' . $category[0]->slug;
				$category_id = $category[0]->term_id;
			} else { 
				// Yoast Primary category
				$category_display = $term->name;
				$category_link = get_term_link( $term->term_id );
				$category_id = $term->term_id;
			}
		} 
		else {
			// Default, display the first category in WP's list of assigned categories
			$category_display = $category[0]->name;
			$category_link = get_term_link( $category[0]->term_id );
			$category_id = $category[0]->term_id;
		}
		// Display category
		if ( !empty($category_display) ){
		    if ( $useCatLink == true && !empty($category_link) ){
			return $category_id;
		    } else {
			return $category_id;
		    }
		}
		
	}
}
endif;

/**
 * excerpt function.
 * 
 * @access public
 * @param mixed $limit
 * @return void
 */
if(!function_exists('excerpt')) :
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
endif;

/**
 * content function.
 * 
 * @access public
 * @param mixed $limit
 * @return void
 */
if(!function_exists('content')) :
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
endif;

/**
 * content_excerpt function.
 * 
 * @access public
 * @param int $length (default: 55)
 * @return void
 */
if(!function_exists('content_excerpt')) :
function content_excerpt( $length = 55 ) { 
	global $post;
	
	$length = (int)($length);
	if( has_excerpt() ) {		    
		$excerpt = strip_shortcodes(excerpt($length));
	} else {
		$content = get_the_content('');
		$content = preg_replace("/\[[^\]]+\]/", '', $content);
		$excerpt = wp_trim_words( $content , $length );
	}
	return $excerpt;
}
endif;

/**
 * get_wp_title function.
 * 
 * @access public
 * @param string $separator (default: ' ')
 * @param string $seplocation (default: 'left')
 * @return void
 */
if(!function_exists('get_wp_title')) :
function get_wp_title( $separator = ' ', $seplocation = 'left' ) {	
	$separator = apply_filters('timber_wp_title_seperator', $separator);	
	return trim(wp_title($separator, false, $seplocation));	
}	
endif;


/**
 * isset_return function.
 * 
 * @access public
 * @param mixed &$is_true (default: null)
 * @param string $prepend (default: '')
 * @param string $append (default: '')
 * @return void
 */
if(!function_exists('isset_return')) :
function isset_return(&$is_true = null, $prepend = '', $append = ''){
	return isset($is_true) && !is_array($is_true) ? $prepend.$is_true.$append : null; 
}
endif;

/**
 * empty_return function.
 * 
 * @access public
 * @param mixed &$is_true (default: null)
 * @return void
 */
if(!function_exists('empty_return')) :
function empty_return(&$is_true = null){
	return !empty($is_true) ? $is_true : null; 
}
endif;



/**
 * numeric_posts_nav function.
 * Add Numbered Pagination 
 * @access public
 * @return void
 */
if(!function_exists('numeric_posts_nav')) :
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
endif;



/**
 * sanitize_output function.
 * 
 * @access public
 * @param mixed $buffer
 * @return void
 */
if(!function_exists('sanitize_output')) :
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
endif;


/**
 * tofloat function.
 * This function takes the last comma or dot (if any) to make a clean float, ignoring thousand separator, currency or any other letter : 
 * 
 * @access public
 * @param mixed $num
 * @return void
 */
if(!function_exists('tofloat')) :
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
endif;

/**
 * Retrieve a list of all user roles
 *
 * On large sites this can be expensive, so only load if on the settings page or $force is set to true
 *
 * @since 0.4.9
 * @param bool    $force Force the roles to be loaded even if not on settings
 * @return array $roles An array of the roles
 */
if(!function_exists('hii_get_roles')) :
function hii_get_roles( $force = false ) {

	$roles_options = array( 0 => '' ); // Blank option

	if ( ( ! isset( $_GET['page'] ) || 'hiiwp-settings' != $_GET['page'] ) && ! $force ) {
		return $roles_options;
	}

	global $wp_roles;

	$roles = $wp_roles->get_names();

	return apply_filters( 'hiiwp_get_roles', $roles );
}
endif;


if(!function_exists('hiilite_numeric_posts_nav')) :
function hiilite_numeric_posts_nav() {
	global  $hiilite_options;
	if($hiilite_options['blog_pag_show'] == true):
		if($hiilite_options['blog_pag_style'] == 'option-2' ) {
		
 
		    if( is_singular() )
		        return;
		    global $wp_query;
		    
		    if( $wp_query->max_num_pages <= 1 )
		        return;
		        
		    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		    $max   = intval( $wp_query->max_num_pages );
		    
		    if ( $paged >= 1 )
		        $links[] = $paged;
		 
		    if ( $paged >= 3 ) {
		        $links[] = $paged - 1;
		        $links[] = $paged - 2;
		    }
		 
		    if ( ( $paged + 2 ) <= $max ) {
		        $links[] = $paged + 2;
		        $links[] = $paged + 1;
		    }
		 
		    echo '<div class="num-pagination row"><ul>' . "\n";
		 
		    if ( get_previous_posts_link() )
		        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
		 
		    if ( ! in_array( 1, $links ) ) {
		        $class = 1 == $paged ? ' class="active"' : '';
		 
		        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		 
		        if ( ! in_array( 2, $links ) )
		            echo '<li>…</li>';
		    }
		 
		    sort( $links );
		    foreach ( (array) $links as $link ) {
		        $class = $paged == $link ? ' class="active"' : '';
		        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		    }
		 
		    if ( ! in_array( $max, $links ) ) {
		        if ( ! in_array( $max - 1, $links ) )
		            echo '<li>…</li>' . "\n";
		 
		        $class = $paged == $max ? ' class="active"' : '';
		        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		    }
		 
		    if ( get_next_posts_link() )
		        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
		 
		    echo '</ul></div>' . "\n";
		
		// END Numbered Pagination Option
		} else {
			echo '<div class="pagination row">';
			the_posts_pagination( array(
				'prev_text' => '<span class="screen-reader-text">' . __( 'Previous page', 'hiiwp' ) . '</span><i class="fa fa-angle-left"></i>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'hiiwp' ) . '</span><i class="fa fa-angle-right"></i>',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'hiiwp' ) . ' </span>',
			) );
			echo '</div>';
		}
	endif;
}
endif;

/**
 * cmb2_output_portfolio_imgs function.
 * 
 * @access public
 * @param mixed $portfolio_images
 * @return void
 */
if(!function_exists('cmb2_output_portfolio_imgs')) :
function cmb2_output_portfolio_imgs( $portfolio_images ) {
	if(!empty($portfolio_images)):
		foreach($portfolio_images as $port_img) {
			echo '<div class="col-12 port-img">';
			echo '<img src="'.$port_img.'" >';
			echo '</div>';	
		}
	endif;
}
endif;

if(!function_exists('theme_deactivation')) :
function theme_deactivation($theme) {
	call_user_func($GLOBALS["register_theme_deactivation_hook_functionhiiwp"]); 
	delete_option("theme_is_activated_hiiwp");
}
endif;

if(!function_exists('__hii')) :
function __hii($data) {
	return $data;
}
endif;