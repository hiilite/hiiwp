<?php 
global $hiilite_options;
if($hiilite_options['portfolio_on']):
/*
Template Name: Portfolio Page
*/ 
endif;

$portfolio = get_portfolio(null, array(
		'show_post_meta'  	=> get_theme_mod( 'portfolio_show_post_meta', false ),
	    'show_post_title'  	=> get_theme_mod( 'portfolio_show_post_title', false ),
	    'in_grid'			=> get_theme_mod( 'portfolio_in_grid', false ),
	    'add_padding'		=> get_theme_mod( 'portfolio_add_padding', '0px' )
	    )
	);



get_header();
get_template_part( 'templates/title' );
if(have_posts()):while(have_posts()):
the_post();
the_content();
endwhile;endif;

echo $portfolio;

get_footer(); ?>