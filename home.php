<?php 
global $hiilite_options;
get_header();
get_template_part( 'templates/title' );

$colcount = ($hiilite_options['blog_layout'] =='masonry')?' col-count-'.$hiilite_options['blog_columns']:'';
if ( is_active_sidebar( 'blog_sidebar' ) ) $colcount .= ' col-9';



if(have_posts()):
	echo '<section class="row" id="home_blog_loop"><div class="container_inner in_grid">';
	echo '<div class="in_grid '.$hiilite_options['blog_layout'].$colcount.'">';
echo '<pre>'.print_r(get_theme_mod( 'icon_settings' ),true).'</pre>';
	while(have_posts()):
		the_post();
		get_template_part('templates/blog', 'loop');
	endwhile;
	
	if($hiilite_options['blog_pag_on']):
		if($hiilite_options['blog_pag_type'] == 'option-2'):
			echo '<div class="pagination in_grid content-box">';
				echo '<div class="align-center flex-item col-6">';
				numeric_posts_nav();
			echo '</div></div>';
		else:
			echo '<div class="pagination in_grid content-box">';
				echo '<div class="align-left flex-item col-6">';
				previous_posts_link();
				echo '</div><div class="align-right flex-item col-6">';
				next_posts_link();
			echo '</div></div>';
		endif;
	endif;

	
	echo '</div>'; //end in_grid
	
	do_action( 'hii_blog_sidebar' );					
	
	echo '</div></section>';

endif;
get_footer(); ?>