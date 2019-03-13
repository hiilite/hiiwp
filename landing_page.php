<?php 
/*
Template Name: Landing Page
*/ 

get_header('landing');


if(have_posts()):
	while(have_posts()):
		the_post();
		
			get_template_part( 'templates/title' );
			get_template_part('templates/full_width', 'loop');		
	endwhile;
endif;

	 
get_footer('landing'); ?>