<?php 
global $hiilite_options;
if($hiilite_options['portfolio_on']):
/*
Template Name: Portfolio Page
*/ 
endif;



get_header();
get_template_part( 'templates/title' );
if(have_posts()):
	while(have_posts()):
		the_post();
		the_content();
	endwhile;
endif;
echo get_theme_mod( 'portfolio_layout', 'h-masonry' ) . get_theme_mod( 'portfolio_columns');
$portfolio = get_portfolio(null, array(
		'show_post_meta'  	=> get_theme_mod( 'portfolio_show_post_meta', false ),
	    'show_post_title'  	=> get_theme_mod( 'portfolio_show_post_title', false ),
	    'in_grid'			=> get_theme_mod( 'portfolio_in_grid', false ),
	    'add_padding'		=> get_theme_mod( 'portfolio_add_padding', '0px' ),
	    'portfolio_layout'	=> get_theme_mod( 'portfolio_layout', 'h-masonry' ),
	    'portfolio_columns'	=> get_theme_mod( 'portfolio_columns', '1' ),
		'portfolio_image_pos'=> get_theme_mod( 'portfolio_image_pos', 'image-left' ),
		'portfolio_title_pos'=> get_theme_mod( 'portfolio_title_pos', 'title-below' ),
		'portfolio_heading_size'=> get_theme_mod( 'portfolio_heading_size', 'h2' ),
		'portfolio_excerpt_on'=> get_theme_mod( 'portfolio_excerpt_on', false ),
		'portfolio_more_on'=> get_theme_mod( 'portfolio_more_on', false ),
	    )
	);
echo $portfolio;

get_footer(); ?>