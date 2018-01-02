<?php
/**
 * The HiiWP Sidebars class.
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.3
 */

/**
 * HiiWP_Sidebars class.
 * Handels geration of initial sidebars and the display of sidebar areas
 *
 * @since 0.4.3
 */
if ( ! defined( 'ABSPATH' ) )	exit;

class HiiWP_Sidebars {
	
	private static $_instance = null;
	
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function __construct() {
		add_action( 'widgets_init', 		array( $this, 'register_sidebars' ) );
		
		add_action( 'hii_sidebar', 			array( $this, 'hii_sidebar_widget_area') );
		add_action( 'hii_blog_sidebar', 	array( $this, 'hii_blog_sidebar_widget_area' ));
		add_action( 'hii_header_top_right', array( $this, 'hii_header_top_right_widget_area' ));
		add_action( 'hii_header_top_center',array( $this, 'hii_header_top_center_widget_area' ));
		add_action( 'hii_header_top_left', 	array( $this, 'hii_header_top_left_widget_area' ));
	}
	
	public function register_sidebars() {
		register_sidebar( array(
	        'name' => __( 'Blog Sidebar', 'hiiwp' ),
	        'id' => 'blog_sidebar',
	        'description' => __( 'Shows in the right sidebar of the blog page', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    register_sidebar( array(
	        'name' => __( 'Header Top Left', 'hiiwp' ),
	        'id' => 'header_top_left',
	        'description' => __( 'Widgets in this area will be shown in the top header above the logo', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    register_sidebar( array(
	        'name' => __( 'Header Top Center', 'hiiwp' ),
	        'id' => 'header_top_center',
	        'description' => __( 'Widgets in this area will be shown in the top header above the logo', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	     
	    register_sidebar( array(
	        'name' => __( 'Header Top Right', 'hiiwp' ),
	        'id' => 'header_top_right',
	        'description' => __( 'Widgets in this area will be shown in the top header above the logo', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item align-right %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    register_sidebar( array(
	        'name' => __( 'Header Center Left', 'hiiwp' ),
	        'id' => 'header_center_left',
	        'description' => __( 'Widgets in this area will be shown in the header on the left of the logo', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item align-left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    register_sidebar( array(
	        'name' => __( 'Header Center Right', 'hiiwp' ),
	        'id' => 'header_center_right',
	        'description' => __( 'Widgets in this area will be shown in the header on the right of the logo', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item align-left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    register_sidebar( array(
	        'name' => __( 'Header Bottom Left', 'hiiwp' ),
	        'id' => 'header_bottom_left',
	        'description' => __( 'Widgets in this area will be shown to the left in the header under the menu', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item align-center %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	   
	    register_sidebar( array(
	        'name' => __( 'Header Bottom Right', 'hiiwp' ),
	        'id' => 'header_bottom_right',
	        'description' => __( 'Widgets in this area will be shown to the right in the header under the menu', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item align-center %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    
	    register_sidebar( array(
	        'name' => __( 'Footer Column 1', 'hiiwp' ),
	        'id' => 'footer_column_1',
	        'description' => __( 'Footer Column 1', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item  %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    register_sidebar( array(
	        'name' => __( 'Footer Column 2', 'hiiwp' ),
	        'id' => 'footer_column_2',
	        'description' => __( 'Footer Column 2', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item  %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    register_sidebar( array(
	        'name' => __( 'Footer Column 3', 'hiiwp' ),
	        'id' => 'footer_column_3',
	        'description' => __( 'Footer Column 3', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    register_sidebar( array(
	        'name' => __( 'Footer Column 4', 'hiiwp' ),
	        'id' => 'footer_column_4',
	        'description' => __( 'Footer Column 4', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	     register_sidebar( array(
	        'name' => __( 'Footer Bottom Center', 'hiiwp' ),
	        'id' => 'footer_bottom_center',
	        'description' => __( 'Footer Bottom Center', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    register_sidebar( array(
	        'name' => __( 'Footer Bottom Left', 'hiiwp' ),
	        'id' => 'footer_bottom_left',
	        'description' => __( 'Footer Bottom Left', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    register_sidebar( array(
	        'name' => __( 'Footer Bottom Right', 'hiiwp' ),
	        'id' => 'footer_bottom_right',
	        'description' => __( 'Footer Bottom Right', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    
	    
	    register_sidebar( array(
	        'name' => __( 'Single Post Sidebar', 'hiiwp' ),
	        'id' => 'post_sidebar',
	        'description' => __( 'Shows in the right sidebar of a post', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    register_sidebar( array(
	        'name' => __( 'Post Bottom', 'hiiwp' ),
	        'id' => 'post_bottom',
	        'description' => __( 'Shows at the bottom of a post', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    
	    register_sidebar( array(
	        'name' => __( 'Custom Sidebar', 'hiiwp' ),
	        'id' => 'custom_sidebar_1',
	        'description' => __( 'Use within visual composer using the Widgitized Sidebar element', 'hiiwp' ),
	        'before_widget' => '<div id="%1$s" class="flex-item widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
	    ) );
	    
	    if(class_exists('WooCommerce')){
		    register_sidebar( array(
		        'name' => __( 'Shop Sidebar', 'hiiwp' ),
		        'id' => 'shop_sidebar',
		        'description' => __( 'Shows on your WooCommerce Shop page', 'hiiwp' ),
		        'before_widget' => '<div id="%1$s" class="flex-item widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widgettitle">',
				'after_title'   => '</h4>',
		    ) );

		    register_sidebar( array(
		        'name' => __( 'Product Sidebar', 'hiiwp' ),
		        'id' => 'product_sidebar',
		        'description' => __( 'Shows on the single product page', 'hiiwp' ),
		        'before_widget' => '<div id="%1$s" class="flex-item widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widgettitle">',
				'after_title'   => '</h4>',
		    ) );
	    }
	    
	   
	}
	
	
	public function hii_sidebar_widget_area(){
		get_sidebar(  );
	}
	
	
	public function hii_header_top_left_widget_area(){
		global $hiilite_options;
		if($hiilite_options['header_top_left'] || get_theme_mod('header_top_area_yesno') == true){
			echo '<div id="header_top_left" class="flex-item">';
				if ( is_active_sidebar( 'header_top_left' ) ) :
					if(!dynamic_sidebar( 'header_top_left' )){}
				endif;
			echo '</div>';
		} 	
	}
	
	
	public function hii_header_top_center_widget_area(){
		global $hiilite_options;
		if($hiilite_options['header_top_center'] || get_theme_mod('header_top_area_yesno') == true){
			echo '<div id="header_top_center" class="flex-item">';
				if ( is_active_sidebar( 'header_top_center' ) ) :
					if(!dynamic_sidebar( 'header_top_center' )){}
				endif;
			echo '</div>';
		} 	
	}
	
	
	public function hii_header_top_right_widget_area(){
		global $hiilite_options;
		if($hiilite_options['header_top_right'] || get_theme_mod('header_top_area_yesno') == true){
			echo '<div id="header_top_right" class="flex-item">';
				if ( is_active_sidebar( 'header_top_right' ) ) :
					if(!dynamic_sidebar( 'header_top_right' )){}
				endif;
			echo '</div>';
		} 	
	}
	
	
	
	public function hii_blog_sidebar_widget_area(){
		if ( is_active_sidebar( 'blog_sidebar' ) && $hiilite_options['blog_sidebar_on'] ) :
		echo '<aside class="col-3 content-box  align-top">';
			if(!dynamic_sidebar( 'blog_sidebar' ))
		echo '</aside>';
		endif;
	}
	
}