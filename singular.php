<?php get_header();


if(have_posts()):
	while(have_posts()):
		the_post();
		
		if(!is_front_page() && !is_woocommerce()) {
			get_template_part( 'templates/title' );
			get_template_part('templates/singular', 'loop');
		} else {
			get_template_part('templates/singular', 'loop');
		}
		
		
		
	endwhile;
endif;

	 
get_footer(); ?>