<?php 
global $hiilite_options;
get_header();
get_template_part( 'templates/title' );

$colcount = ($hiilite_options['blog_layouts'] =='masonry')?' col-count-'.$hiilite_options['blog_col']:'';
if ( $hiilite_options['blog_sidebar_show'] == true ) $colcount .= ' col-9';

$grid = ($hiilite_options['blog_full_width'] == false) ? 'in_grid' : 'x';


if(have_posts()):
	echo '<section class="row" id="home_blog_loop"><div class="container_inner '.$grid.'">';
	echo '<div class="'.$grid.' '.$hiilite_options['blog_layouts'].$colcount.'">';

	while(have_posts()):
		the_post();
		get_template_part('templates/blog', 'loop');
	endwhile;
	
	if($hiilite_options['blog_pag_show']):
		if($hiilite_options['blog_pag_style'] == 'option-2'):
			echo '<div class="pagination '.$grid.' content-box">';
				echo '<div class="align-center flex-item col-6">';
				numeric_posts_nav();
			echo '</div></div>';
		else:
			echo '<div class="pagination '.$grid.' content-box">';
				echo '<div class="align-left flex-item col-6">';
				previous_posts_link();
				echo '</div><div class="align-right flex-item col-6">';
				next_posts_link();
			echo '</div></div>';
		endif;
	endif;

	
	echo '</div>'; //end in_grid
	?>
	<div id="blog-sidebar" class="col-3">
		<?php
		if ( $hiilite_options['blog_sidebar_show'] == true ) :
			dynamic_sidebar( 'blog_sidebar' );
		endif;
		?>
	</div>
	<?php
	
	/*do_action( 'hii_blog_sidebar' );*/			
	
	echo '</div></section>';

endif;
get_footer(); ?>