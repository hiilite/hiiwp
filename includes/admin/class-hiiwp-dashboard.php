<?php
/**
 * The HiiWP Dashboard class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2019, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0.4
 */

/**
 * HiiWP_Widgets class.
 * Handels the creation of widgets to be used in sidebars. Initial creation is done in HiiWP_Shortcodes.
 *
 * @since 1.0.4
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
		
		
		add_action( 'wp_dashboard_setup', 	array( $this, 'hiilite_move_dashboard_widget' ));
		add_action( 'wp_dashboard_setup', 	array( $this, 'hiilite_remove_dashboard_widgets' ));
		add_action( 'wp_dashboard_setup', 	array( $this, 'hiilite_add_dashboard_widgets' ));
		add_action( 'login_enqueue_scripts',array( $this, 'hiilite_login_logo' ));
		
	}
	
	
	public function hiilite_add_dashboard_widgets() {
	    wp_add_dashboard_widget( 'hiilite_dashboard_welcome', 'Your Running The HiiWP Framework', array($this, 'hiilite_add_welcome_widget' ));
	}
	
	public function hiilite_add_welcome_widget(){ ?>
	 	<div class="wp-badge welcome__logo" style="padding-top: 80px;height: 20px;width: 90px;font-size: 10px;float: right;"><?php printf( __( 'Version %s', 'hiiwp' ), HIIWP_VERSION ); ?></div>
		<h3><strong><?php _e( 'What would you like to do?','hiiwp');?></strong></h3>
		<ul>
			<li><a href="<?php echo admin_url( 'customize.php' ); ?>"><span class="dashicons dashicons-admin-customizer"></span> <?php _e( 'Customize Design','hiiwp');?></a></li>
			<li><a href="<?php echo admin_url( 'themes.php?page=tgmpa-install-plugins' ); ?>"><span class="dashicons dashicons-admin-plugins"></span> <?php _e( 'Install Recommended Plugins','hiiwp');?></a></li>
			
		</ul>
		<hr>
		
		<h3><strong><?php _e( 'Adding a Design?', 'hiiwp' ); ?></strong></h3>
        <?php
        if(class_exists('OCDI_Plugin')):?>
			<p><?php _e( 'Upload and install the design you purchased from ', 'hiiwp' ); ?><a href="https://hiilite.com/shop/themes/" target="_blank">Hiilite.com</a></p>
			
			<a class="button button-primary" href="<?php echo admin_url('themes.php?page=pt-one-click-demo-import'); ?>"><span class="dashicons dashicons-schedule"></span> <?php _e( 'Install Design','hiiwp');?></a>
        <?php
	    else: ?>
	   		<p><?php _e( 'Get a head start on your website and install content from one of our many','hiiwp');?>
		   		<a href="https://hiilite.com/shop/themes/" target="_blank"><?php _e('prebuilt designs.','hiiwp');?></a>
		   		<?php _e('prebuilt designs. First, download and activate the One Click Demo Import plugin, then head over to Appearance > Import Demo Data to get started.', 'hiiwp' ); ?>
		   	</p>
	    		
	    		<?php 
		    	if( is_multisite() ) { ?>
	    			<a href="/wp-admin/network/plugin-install.php?tab=plugin-information&amp;plugin=one-click-demo-import&amp;TB_iframe=true&amp;width=772&amp;height=677" class="thickbox open-plugin-details-modal button" aria-label="More information about One Click Demo Import" data-title="One Click Demo Import"><span class="dashicons dashicons-download"></span> <?php _e( 'Download One Click Demo Import','hiiwp');?></a><?php
		    	} else {
			    	?>
				<a href="/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=one-click-demo-import&amp;TB_iframe=true&amp;width=772&amp;height=677" class="thickbox open-plugin-details-modal button" aria-label="More information about One Click Demo Import" data-title="One Click Demo Import"><span class="dashicons dashicons-download"></span> <?php _e( 'Download One Click Demo Import','hiiwp');?></a>
	    		<?php
			} 
        endif;
        ?>
        

		<hr>
		<h3><strong><?php _e( 'Need Help','hiiwp');?></strong></h3>
		<p>
			<a class="button" href="https://hiilite.ticksy.com/articles/100012838" target="_blank" rel="noopener"><?php _e( 'Read Knowledge Base','hiiwp');?></a> <a href="https://hiilite.ticksy.com/submit/#100012838" target="_blank" rel="noopener" class="button"><?php _e( 'Submit a Support Ticket','hiiwp');?></a>
		</p>
	<?php 
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
		
	

	
	/*public function modify_admin_bar( $wp_admin_bar ){
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
			'id'    => 'hiilite_support_ticket',
			'title' => 'Submit Support Ticket',
			'href'  => 'https://hiilite.com/support/request-product-support/',
			'meta'  => array( 'class' => 'hiilite_support_ticket' ),
			'parent' => $wplogo_id
		);
		$wp_admin_bar->add_node( $args );
		
		$args = array(
			'id'    => 'hiilite_knowledgebase',
			'title' => 'Knowledge Base',
			'href'  => 'https://hiilite.com/knowledgebase/',
			'meta'  => array( 'class' => 'hiilite_knowledgebase' ),
			'parent' => $wplogo_id
		);
		$wp_admin_bar->add_node( $args );
		
	}*/

	
	/**
	 * hiilite_login_logo function.
	 * 
	 * @access public
	 * @return void
	 */
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
				
			}
			<?php echo preg_replace('/[{}]/','',get_theme_mod('typography_button_custom_css')); 
				
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



