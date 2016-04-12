<?php 
/*
Template Name: Full Width
*/ 
?>

<?php get_header();


if(have_posts()):
	while(have_posts()):
		the_post();
		
			get_template_part( 'templates/title' );
			get_template_part('templates/full_width', 'loop');		
	endwhile;
endif;

	 
get_footer(); ?>