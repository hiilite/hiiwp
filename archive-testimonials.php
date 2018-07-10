<?php get_header();
get_template_part( 'templates/title' );
if(have_posts()):
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';

	while(have_posts()):
		the_post();
		
		get_template_part('templates/testimonial', 'loop');
		
		
	endwhile;
	echo '</div></div></div>';

endif;
get_footer(); ?>