<?php 
get_header();
echo '<!--EVENT-->';
get_template_part( 'templates/title' );
if(have_posts()):
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';

	while(have_posts()):
		the_post();
		$post_type = get_post_type(get_the_ID());

		get_template_part('templates/event', 'loop');
		
		
		
		
	endwhile;
	echo '</div></div></div>';

endif;
get_footer(); ?>