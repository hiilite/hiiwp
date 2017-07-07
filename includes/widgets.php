<?php
/**
 * HiiWP: Widgets
 *
 * Loads widget areas
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2016, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.3.5
 */
function hii_sidebar_widget_area(){
	get_sidebar(  );
}
add_action( 'hii_sidebar', 'hii_sidebar_widget_area' );


function hii_header_top_left_widget_area(){
	global $hiilite_options;
	if($hiilite_options['header_top_left'] || get_theme_mod('header_top_area_yesno') == true){
		echo '<div id="header_top_left" class="flex-item">';
			if ( is_active_sidebar( 'header_top_left' ) ) :
				if(!dynamic_sidebar( 'header_top_left' )){}
			endif;
		echo '</div>';
	} 	
}
add_action( 'hii_header_top_left', 'hii_header_top_left_widget_area' );

function hii_header_top_center_widget_area(){
	global $hiilite_options;
	if($hiilite_options['header_top_center'] || get_theme_mod('header_top_area_yesno') == true){
		echo '<div id="header_top_center" class="flex-item">';
			if ( is_active_sidebar( 'header_top_center' ) ) :
				if(!dynamic_sidebar( 'header_top_center' )){}
			endif;
		echo '</div>';
	} 	
}
add_action( 'hii_header_top_left', 'hii_header_top_center_widget_area' );

function hii_header_top_right_widget_area(){
	global $hiilite_options;
	if($hiilite_options['header_top_right'] || get_theme_mod('header_top_area_yesno') == true){
		echo '<div id="header_top_right" class="flex-item">';
			if ( is_active_sidebar( 'header_top_right' ) ) :
				if(!dynamic_sidebar( 'header_top_right' )){}
			endif;
		echo '</div>';
	} 	
}
add_action( 'hii_header_top_right', 'hii_header_top_right_widget_area' );


function hii_blog_sidebar_widget_area(){
	if ( is_active_sidebar( 'blog_sidebar' ) && $hiilite_options['blog_sidebar_on'] ) :
	echo '<aside class="col-3 content-box  align-top">';
		if(!dynamic_sidebar( 'blog_sidebar' ))
	echo '</aside>';
	endif;
}
add_action( 'hii_blog_sidebar', 'hii_blog_sidebar_widget_area' );
?>