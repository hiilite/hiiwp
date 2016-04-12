<?php get_header();

if(have_posts()):
	echo '<section class="row"><div class="container_inner"><div class="in_grid">';

	while(have_posts()):
		the_post();
		
		get_template_part('templates/blog', 'loop');
		
		
	endwhile;
	echo '<div></div></section>';

endif;
get_footer(); ?>