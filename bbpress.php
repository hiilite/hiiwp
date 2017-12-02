<?php 
get_header();

echo '<!--BBPRESS-->';
echo '<div class="in_grid">';
if(have_posts()):
	while(have_posts()):
		the_post();
		
		the_content();
		
	endwhile;
endif;

echo '</div>'; 
get_footer(); ?>