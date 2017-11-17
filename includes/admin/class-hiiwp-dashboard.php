<?php
/**
 * The HiiWP Dashboard class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.3
 */

/**
 * HiiWP_Widgets class.
 * Handels the creation of widgets to be used in sidebars. Initial creation is done in HiiWP_Shortcodes.
 *
 * @since 0.4.3
 */
if ( ! defined( 'ABSPATH' ) )	exit;
 
class HiiWP_Dashboard {
	
	private static $_instance = null;
	
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function __construct() {
		
		add_action( 'admin_bar_menu', 		array( $this, 'modify_admin_bar' ), 999 );
		add_action( 'wp_dashboard_setup', 	array( $this, 'hiilite_move_dashboard_widget' ));
		add_action( 'wp_dashboard_setup', 	array( $this, 'hiilite_remove_dashboard_widgets' ));
		add_action( 'wp_dashboard_setup', 	array( $this, 'hiilite_add_dashboard_widgets' ));
		add_action( 'login_enqueue_scripts',array( $this, 'hiilite_login_logo' ));
	}
	
	
	public function hiilite_add_dashboard_widgets() {
	    wp_add_dashboard_widget( 'hiilite_dashboard_welcome', 'Welcome', array($this, 'hiilite_add_welcome_widget' ));
	}
	
	public function hiilite_add_welcome_widget(){ ?>
	 
		<h3>This Site is Managed by Hiilite Creative Group</h3>
	<p>Hiilite works with a mix of local, regional, provincial and international clients. We are equally happy working face-to-face and working remotely. We serve BC, Western Canada and beyond from a little corner of paradise - Kelowna, BC.<br><br>
	
	115-1690 Water Street<br>
	Kelowna, BC, V1Y 8T8, Canada<br>
	<a href="tel:+18883033444">1.888.303.3444</a><br>
	</p><div id="social-icons">
	<a href="https://www.facebook.com/hiilite" target="_blank"><img src="https://hiilite.com/wp-content/uploads/2014/11/Facebook-32.png" width="32" height="32" alt="Facebook" scale="0"></a><a href="https://twitter.com/hiilite" target="_blank"><img src="https://hiilite.com/wp-content/uploads/2014/11/Twitter-Bird-32.png" width="32" height="32" alt="Twitter" scale="0"></a><a href="https://plus.google.com/u/0/b/107657092449987968512/107657092449987968512" target="_blank"><img src="https://hiilite.com/wp-content/uploads/2014/11/Google-Plus-32.png" width="32" height="32" alt="Google" scale="0"></a>
	</div><?php 
	}
	
	
	// remove unwanted dashboard widgets for relevant users
	public function hiilite_remove_dashboard_widgets() {
	    $user = wp_get_current_user();
	    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	}
	
	
	// Move the 'Right Now' dashboard widget to the right hand side
	public function hiilite_move_dashboard_widget() {
	    $user = wp_get_current_user();
	        global $wp_meta_boxes;
	        $widget = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'];
	        unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
	        $wp_meta_boxes['dashboard']['side']['core']['dashboard_right_now'] = $widget;
		
			$widget2 = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'];
	        unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
	        $wp_meta_boxes['dashboard']['side']['core']['dashboard_activity'] = $widget2;
	
	}
		
	

	
	public function modify_admin_bar( $wp_admin_bar ){
		$wp_admin_bar->remove_node( 'wporg' );
		$wp_admin_bar->remove_node( 'about' );
		$wp_admin_bar->remove_node( 'documentation' );
		$wp_admin_bar->remove_node( 'support-forums' );
		$wp_admin_bar->remove_node( 'feedback' );
		
		$wplogo = $wp_admin_bar->get_node( 'wp-logo' );
		$wplogo_id = ( ! is_null( $wplogo ))?$wplogo->id:'wp-logo';
		$args = array(
			'id'    => 'hiilite_com',
			'title' => 'Hiilite.com',
			'href'  => 'https://hiilite.com',
			'meta'  => array( 'class' => 'hiilite_com' ),
			'parent' => $wplogo_id
		);
		$wp_admin_bar->add_node( $args );
		
		$args = array(
			'id'    => 'hiilite_marketing',
			'title' => 'Marketing',
			'href'  => 'https://hiilite.com/marketing-strategy/',
			'meta'  => array( 'class' => 'hiilite_marketing' ),
			'parent' => $wplogo_id
		);
		$wp_admin_bar->add_node( $args );
		
		$args = array(
			'id'    => 'hiilite_webdesign',
			'title' => 'Web Design',
			'href'  => 'https://hiilite.com/website-design/',
			'meta'  => array( 'class' => 'hiilite_webdesign' ),
			'parent' => $wplogo_id
		);
		$wp_admin_bar->add_node( $args );
		
		$args = array(
			'id'    => 'hiilite_seo',
			'title' => 'SEO',
			'href'  => 'https://hiilite.com/seo-social-media/',
			'meta'  => array( 'class' => 'hiilite_seo' ),
			'parent' => $wplogo_id
		);
		$wp_admin_bar->add_node( $args );
	}

	public function hiilite_login_logo() { 
		$hiilite_options['main_logo'] = get_theme_mod('main_logo', get_template_directory_uri().'/images/logoNormal@2x.png');
		$image_id = attachment_url_to_postid( $hiilite_options['main_logo'] );
		if( isset( $image_id ) ) {
		  $image_url  = wp_get_attachment_metadata($image_id); 
		}
		?>
	    <style type="text/css">
		    body.login.login-action-login.wp-core-ui.locale-en-us {
			    background: white;
			}
			
			form#loginform {
			    box-shadow: none;
			    padding: 0;
			}
	        .login #login h1 a {
	            background-image: url( <?php echo  $hiilite_options['main_logo']; ?> );
				background-size: contain;
				  width: auto;
				  background-repeat: no-repeat;
	        }
	        .button, .wp-core-ui .button-primary.button  {
		            box-shadow: none;
		            text-shadow:none;
				<?php echo preg_replace('/[{}]/','',get_theme_mod('typography_button_custom_css')); ?>
			}
			
			<?php
			echo get_theme_mod('admin_custom_css');
			?>
	    </style>
	    <script>
		window.onload = function(){
			var hilogo = document.querySelector('#login');
			var hilink = document.querySelector('#login h1 a'); 
	
			document.querySelector('#login h1 a').setAttribute('href', '<?php echo home_url();?>');
		};
			
		</script><?php 
	}

	
}



