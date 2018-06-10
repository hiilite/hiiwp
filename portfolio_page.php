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
 * @since       1.0
 */
$hiilite_options = HiiWP::get_options();
if($hiilite_options['portfolio_on']):

endif;



get_header();
get_template_part( 'templates/title' );
echo '<!--PORTFOLIO_PAGE-->';
if(have_posts()):
	while(have_posts()):
		the_post();
		the_content();
	endwhile;
endif; 

$args = array(
	'posts_per_page' => -1,
	'post_type' => $hiilite_options['portfolio_slug']
);
$portfolio_query = new WP_Query($args);
do_action( 'before_portfolio' );

if($portfolio_query->have_posts()):
	echo '<div class="row"><div class="container_inner">';
	if($hiilite_options['portfolio_in_grid'] == true) echo '<div class="in_grid">';
	while($portfolio_query->have_posts()):
		$portfolio_query->the_post();
		
		get_template_part('templates/portfolio', 'loop');
		
		
	endwhile;
	if($hiilite_options['portfolio_in_grid'] == true) echo '</div>';
	echo '</div></div>';
	
endif;

do_action( 'after_portfolio' );

get_footer(); ?>