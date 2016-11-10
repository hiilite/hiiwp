<?php 
get_header();
echo '<!--Archive-->';
get_template_part( 'templates/title' );
if(have_posts()):
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';

	while(have_posts()):
		the_post();
		$post_type = get_post_type(get_the_ID());
		if ($post_type == get_theme_mod( 'testimonials_slug', 'testimonials' )){
				get_template_part('templates/testimonial', 'loop');
		} else {
				get_template_part('templates/blog', 'loop');
		}
		
		
		
		
	endwhile;
	echo '</div></div></div>';

endif;
get_footer(); ?>