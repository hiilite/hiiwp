<?php 
/*
Template Name: Portfolio Page
*/ 
/**
 * HiiWP Template: portfolio_page
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.3
 */
$hiilite_options = HiiWP::get_options();
$templates	= new HiiWP_Plus_Template_Loader();
get_header();

get_template_part( 'templates/title' );

if(have_posts()):
	while(have_posts()):
		the_post();
		the_content();
	endwhile;
endif; 

$current_post_type = $hiilite_options['portfolio_slug'];
$args = array(
	'posts_per_page' => -1,
	'post_type' => $current_post_type
);
$wp_query = new WP_Query($args);

include( $templates->locate_template('portfolio-archive.php') ); 

wp_reset_query( );
get_footer();