<?php 
global $hiilite_options;
get_header();

$colcount = ($hiilite_options['blog_layout'] =='masonry')?' col-count-'.$hiilite_options['blog_columns']:'';
if ( is_active_sidebar( 'blog_sidebar' ) ) $colcount .= ' col-9';
if(have_posts()):
get_template_part( 'templates/title' );
	echo '<section class="row" id="home_blog_loop"><div class="container_inner in_grid">';
	echo '<div class="in_grid '.$hiilite_options['blog_layout'].$colcount.'">';

	while(have_posts()):
		the_post();
		get_template_part('templates/blog', 'loop');
	endwhile;
	
		echo '<div class="pagination in_grid content-box">';
			echo '<div class="align-left flex-item col-6">';
			previous_posts_link();
			echo '</div><div class="align-right flex-item col-6">';
			next_posts_link();
		echo '</div></div>';
	
	echo '</div>'; //end in_grid
	if ( is_active_sidebar( 'blog_sidebar' ) ) :
	echo '<aside class="col-3 content-box  align-top">';
		if(!dynamic_sidebar( 'blog_sidebar' ))
	echo '</aside>';
	endif;
						
	
	echo '</div></section>';

endif;
get_footer(); ?>