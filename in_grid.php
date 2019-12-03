<?php 
/*
Template Name: In Grid
*/ 

get_header();


if(have_posts()):
	while(have_posts()):
		the_post();
		
			get_template_part( 'templates/title' );
			get_template_part('templates/in_grid', 'loop');		
	endwhile;
endif;

	 
get_footer(); ?>