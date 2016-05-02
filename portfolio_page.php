<?php 
if($hiilite_options['portfolio_on']):
/*
Template Name: Portfolio Page
*/ 
endif;

$portfolio = get_portfolio();



get_header();
get_template_part( 'templates/title' );
if(have_posts()):while(have_posts()):
the_post();
the_content();
endwhile;endif;

echo $portfolio;

get_footer(); ?>