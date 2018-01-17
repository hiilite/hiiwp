<?php
/**
 * The HiiWP Menus class.
 * Handles any filters or modifications to WP_Menus
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
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
		if(Hii::$options['enable_search_bar_yesno'] == true) {
			$theme_locations = get_nav_menu_locations();
			if(isset($theme_locations['header-menu'])){
				$menu_obj = get_term( $theme_locations['header-menu'], 'nav_menu' );
		
				add_filter( "wp_nav_menu_{$menu_obj->slug}_items", array( $this, 'add_search_button' ), 20 );
			}
		}
		$options = get_option('hii_seo_settings');
		if(isset($options['add_social_to_menu'])):
			foreach($options['add_social_to_menu'] as $menu_obj):
				add_filter( "wp_nav_menu_{$menu_obj}_items", array( $this, 'add_social_icons' ) );
			endforeach;
		endif;
	}
	
	public function add_social_icons($items) {
		$output = '';
		$options = get_option('hii_seo_settings');
		if(isset($options['business_social']) && count($options['business_social']) > 0) {
			foreach($options['business_social'] as $socialprofile):	
				$output .= '<li class="menu-item social-menu-item"><a href="'.$socialprofile['social_url'].'" target="_blank"><i class="fa fa-'.strtolower($socialprofile['social_site']).'"></i></a></li>';
			endforeach;
		}
		
	    $items = $items . $output;
	    return $items;
	}
	
	public function add_search_button($items) {
	    $searchbutton = '<li class="search_button menu-item"><i class="fa fa-search"></i></li>';
	    $items = $items . $searchbutton;
	    return $items;
	}
	
}

		