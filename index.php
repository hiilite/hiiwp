<?php 
get_header();

echo '<!--index-->';
if(have_posts()):
	while(have_posts()):
		the_post();
		
		the_content();
		
	endwhile;
endif;

	 
get_footer(); ?>