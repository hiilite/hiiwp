<?php
/**
 * The HiiWP Menus class.
 * Handles any filters or modifications to WP_Menus
 *
 * @package     HiiWP
 * @category    Core
 * @author      Hiilite Creative Group
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.5
 */
if ( ! defined( 'ABSPATH' ) )	exit;
 
class HiiWP_Menus {
	
	private static $_instance = null;
	
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function __construct() {
		add_action( 'init', array( $this, 'register_my_menus' ) );
		
		/* If WooCommerce is active, add cart icon to menu */
		if(class_exists('WooCommerce') && Hii::$options['show_cart_menu'] == true) {
			$theme_locations = get_nav_menu_locations();
			if(isset($theme_locations['header-menu'])){
				$menu_obj = get_term( $theme_locations['header-menu'], 'nav_menu' );
		
				if($menu_obj) add_filter( "wp_nav_menu_{$menu_obj->slug}_items", array( $this, 'add_woo_menu_cart' ), 20, 2 );
			}
		}
		
		if(Hii::$options['enable_search_bar_yesno'] == true) {
			$theme_locations = get_nav_menu_locations();
			if(isset($theme_locations['header-menu'])){
				$menu_obj = get_term( $theme_locations['header-menu'], 'nav_menu' ); 
		
				if($menu_obj) add_filter( "wp_nav_menu_{$menu_obj->slug}_items", array( $this, 'add_search_button' ), 20, 2 );
			}
		}
		
		$options = get_option('hii_seo_settings');
		if(isset($options['add_social_to_menu'])):
			foreach($options['add_social_to_menu'] as $menu_obj):
				add_filter( "wp_nav_menu_{$menu_obj}_items", array( $this, 'add_social_icons' ) );
			endforeach;
		endif;
		
		
		// Change admin walker.
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'edit_nav_menu_walker' ) );

		// Add fields via hook.
		add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'add_custom_fields' ), 10, 4 );

		// Save the new fields.
		add_action( 'wp_update_nav_menu_item', array( $this, 'save_custom_fields'), 10, 2 );

		// Add menu status to menu items object.
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'setup_menu_item' ) );

		// Now exclude menu items if needed.
		if( ! is_admin() ) {
			add_filter( 'wp_get_nav_menu_items', array( $this, 'exclude_menu_items' ), 10, 3 );
		}
	}
	
	public function add_social_icons($items) {
		$output = '';
		$options = get_option('hii_seo_settings');
		if(isset($options['business_social']) && count($options['business_social']) > 0) {
			foreach($options['business_social'] as $socialprofile):	
				$social_url = (isset($socialprofile['social_url']))?$socialprofile['social_url']:'#';
				$output .= '<li class="menu-item social-menu-item"><a href="'.$social_url.'" target="_blank" rel="noopener"><i class="fa fa-'.strtolower($socialprofile['social_site']).'"></i></a></li>';
			endforeach;
		}
		
	    $items = $items . $output;
	    return $items;
	}
	
	public function add_search_button($items, $args) {	    
	    if ($args->theme_location == 'header-menu') {
	    	$searchbutton = '<li class="search_button menu-item"><i class="fa fa-search"></i></li>';
			$items = $items . $searchbutton;
	    }
	    return $items;
	}
	public function add_woo_menu_cart($items, $args) {
		if ($args->theme_location == 'header-menu') {
			$cart_url = wc_get_cart_url();
			
			$cart_icon = '<i class="fa fa-shopping-cart"></i>';
			if(Hii::$options['cart_menu_icon'] == 'shopping-bag') {
				$cart_icon = '<i class="fa fa-shopping-bag"></i>';
			}
			
			$cart_totals = '';
			if(Hii::$options['cart_menu_layout'] == 'icon-plus-items') {
				$cart_totals = ' | '.sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'hiiwp' ), WC()->cart->get_cart_contents_count() ).' - '.WC()->cart->get_cart_total();
			}
			
			$woocart = '<li class="woo_menu_cart menu-item"><a href="'.$cart_url.'">'.$cart_icon.''.$cart_totals.'</a></li>';
			
		    $items = $items . $woocart;
		}
		return $items;
	}
	
	
	// REGISTER MENU AREAS
	public function register_my_menus() {
	  register_nav_menus(
	    array(
	      'header-menu' => __( 'Header Menu', 'hiiwp' ),
	      'left-menu' => __( 'Left Menu', 'hiiwp' ),
	      'right-menu' => __( 'Right Menu', 'hiiwp' ),
	      'footer-menu' => __( 'Footer Menu', 'hiiwp' ),
	      'bottom-menu' => __( 'Header Bottom Menu', 'hiiwp' )
	    )
	  );
	  
	}
	
	/**
	 * Set the name of the class for the new Walker.
	 *
	 * @param  string $walker existing walker.
	 * @return string         new walker.
	 */
	public function edit_nav_menu_walker( $walker ) {

		return 'Walker_HiiWP_Nav_Menu_Roles_Controller';

	}

	/**
	 * Register all new fields for the menus.
	 *
	 * @param  string $item_id current item id.
	 * @return array          fields to display.
	 */
	private function get_custom_fields( $item_id ) {

		$item_status = get_post_meta( $item_id, '_hiiwp_nav_menu_role', true );

		$fields = array(

			array(
				'type'             => 'select',
				'label'            => esc_html( 'Display to:' ),
				'name'             => 'hiiwp_nav_menu_status[' . $item_id . ']',
				'desc'             => esc_html__( 'Set the visibility of this menu item.', 'hiiwp' ),
				'show_option_all'  => false,
				'show_option_none' => false,
				'selected'         => isset( $item_status[ 'status' ] ) ? $item_status[ 'status' ]: '',
				'class'            => 'hiiwp-menu-visibility-setter',
				'options'          => array(
					''    => esc_html__( 'Everyone', 'hiiwp' ),
					'in'  => esc_html__( 'Logged In Users', 'hiiwp' ),
					'out' => esc_html__( 'Logged Out Users', 'hiiwp' ),
				)
			),

			array(
				'type'             => 'select',
				'label'            => esc_html( 'Select roles:' ),
				'name'             => 'hiiwp_nav_menu_status_roles[' . $item_id . ']',
				'desc'             => esc_html__( 'Select the roles that should see this menu item. Leave blank for all roles.', 'hiiwp' ),
				'show_option_all'  => false,
				'show_option_none' => false,
				'multiple'         => true,
				'selected'         => isset( $item_status[ 'roles' ] ) ? $item_status[ 'roles' ]: '',
				'options'          => hii_get_roles( true )
			),

		);

		return $fields;

	}

	/**
	 * Render all the fields within the menu editor.
	 * Right now they're all "select" fields, refactor will probably change this.
	 *
	 * @param string $item_id item id.
	 * @param object $item    details about the item.
	 * @param string $depth   item depth.
	 * @param array $args     settings.
	 */
	public function add_custom_fields( $item_id, $item, $depth, $args ) {

		$fields = $this->get_custom_fields( $item_id );

		echo '<p class="hiiwp-menu-controller">';

		echo '<input type="hidden" class="nav-menu-id" name="hiiwp-menu-item-'. $item_id .'" value="'. esc_attr( $item_id ) .'">';

		foreach ( $fields as $field ) {

			echo Hii::$html->select( $field );

		}

		echo '</p>';

		echo wp_nonce_field( "hiiwp_nonce_menu_controller", "hiiwp_nonce_menu_controller" );

	}

	/**
	 * Save status of the menu.
	 *
	 * @param  string $menu_id         Menu ID.
	 * @param  string $menu_item_db_id ID saved into the database.
	 * @return void
	 */
	public function save_custom_fields( $menu_id, $menu_item_db_id ) {

		global $wp_roles;

		$allowed_roles = apply_filters( 'hiiwp_nav_menu_roles', $wp_roles->role_names );

		// Nonce verification.
		if ( ! isset( $_POST['hiiwp_nonce_menu_controller'] ) || ! wp_verify_nonce( $_POST['hiiwp_nonce_menu_controller'], 'hiiwp_nonce_menu_controller' ) ){
			return;
		}

		$data_to_save  = false;
		$submitted_menu_statuses = ( array ) $_POST['hiiwp_nav_menu_status'];
		$submitted_menu_roles = isset( $_POST['hiiwp_nav_menu_status_roles'] ) ? $_POST['hiiwp_nav_menu_status_roles'] : false;

		// Check if menu item has a status.
		if( array_key_exists( $menu_item_db_id , $submitted_menu_statuses ) && $submitted_menu_statuses[ $menu_item_db_id ] == 'in' || $submitted_menu_statuses[ $menu_item_db_id ] == 'out' ) {

			$menu_item_status = $submitted_menu_statuses[ $menu_item_db_id ];
			$menu_item_roles  = false;

			// Check if any role has been set.
			if( isset( $_POST['hiiwp_nav_menu_status_roles'] ) && array_key_exists( $menu_item_db_id , $_POST['hiiwp_nav_menu_status_roles'] ) ) {
				$menu_item_roles = array_slice( $_POST['hiiwp_nav_menu_status_roles'][ $menu_item_db_id ], 0, -1 );
			}

			$data_to_save = array( 'status' => $menu_item_status, 'roles' => $menu_item_roles );

		}

		if( $data_to_save ) {

			update_post_meta( $menu_item_db_id, '_hiiwp_nav_menu_role', $data_to_save );

		} else {

			delete_post_meta( $menu_item_db_id, '_hiiwp_nav_menu_role' );

		}

	}

	/**
	 * Add menu status to menu object.
	 *
	 * @param  object $menu_item Menu object.
	 * @return object            Menu object.
	 */
	public function setup_menu_item( $menu_item ) {

		$item_status = get_post_meta( $menu_item->ID, '_hiiwp_nav_menu_role', true );

		if( ! empty( $item_status ) ) {
			$menu_item->hiiwp_status = $item_status;
		}

		return $menu_item;

	}

	/**
	 * Exclude menu items from navigation.
	 *
	 * @param  array $items all menu items.
	 * @param  string $menu  menu ID.
	 * @param  array $args  args passed to the function.
	 * @return array
	 */
	public function exclude_menu_items( $items, $menu, $args ) {

		foreach ( $items as $key => $item ) {

			if( isset( $item->hiiwp_status ) ) {

				$status  = $item->hiiwp_status['status'];
				$roles   = $item->hiiwp_status['roles'];
				$visible = true;

				switch ( $status ) {
					case 'in':
						$visible = is_user_logged_in() ? true : false;

						if( is_array( $roles ) && ! empty( $roles ) ) {
							foreach ( $roles as $role ) {
								if( ! current_user_can( $role ) ) {
									$visible = false;
								}
							}
						}

						break;
					case 'out':
						$visible = ! is_user_logged_in() ? true : false;
						break;
				}

				// Now exclude item if not visible.
				if( ! $visible ) {
					unset( $items[ $key ] );
				}

			}

    	}

		return $items;
	}
}