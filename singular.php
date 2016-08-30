<?php
get_header();
echo '<!--Singular-->';
if(get_post_type(get_the_ID()) != 'post'){
	get_template_part( 'templates/title' );
}
if(have_posts()):
	while(have_posts()):
		the_post();
			get_template_part('templates/singular', 'loop');
	endwhile;
endif;

	 
get_footer(); ?>