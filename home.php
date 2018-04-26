<?php 
$hiilite_options = Hii::$hiiwp->get_options();
get_header();
if(in_array('0', $hiilite_options['show_title_on'])) {
	get_template_part( 'templates/title' );
}

$colcount = ($hiilite_options['blog_layouts'] =='masonry')?' col-count-'.$hiilite_options['blog_col']:'';
if ( $hiilite_options['blog_sidebar_show'] == true ) $colcount .= ' col-9';

$grid = ($hiilite_options['blog_full_width'] == false) ? 'in_grid' : '';

echo '<div class="row content-area" id="home_blog_loop"><div class="container_inner '.$grid.'">
	<div class="site-main '.$grid.' '.$hiilite_options['blog_layouts'].$colcount.'" role="main">';
if(have_posts()):


	while(have_posts()):
		the_post();
		get_template_part('templates/blog', 'loop');
	endwhile;
	
	if($hiilite_options['blog_pag_show'] == true):
		echo '<div class="pagination '.$grid.' content-box">';
		the_posts_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . __( 'Previous page', 'hiiwp' ) . '</span><i class="fa fa-angle-left"></i>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'hiiwp' ) . '</span><i class="fa fa-angle-right"></i>',
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'hiiwp' ) . ' </span>',
		) );
		echo '</div>';
	endif;
	
	echo '</div>'; //end in_grid
	
	get_sidebar();
endif;
echo '</div>
</div>';
get_footer(); ?>