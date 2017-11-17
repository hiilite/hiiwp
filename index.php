<?php 
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage hiiwp
 * @since 1.0
 * @version 1.0
 */
get_header();
get_template_part( 'templates/title' );
if(have_posts()):
	while(have_posts()):
		the_post();
		
		get_template_part('templates/blog', 'loop');
		
	endwhile;
endif;

	 
get_footer(); ?>