<?php 
get_header();
$hiilite_options = Hii::$hiiwp->get_options();

if(in_array('0', $hiilite_options['show_title_on'])) {
	get_template_part( 'templates/title' );
}

$colcount = ($hiilite_options['blog_layouts'] =='masonry')?' col-count-'.$hiilite_options['blog_col']:'';
if ( $hiilite_options['blog_sidebar_show'] == true ) {
	$colcount .= ' col-9';
} else {
	$colcount .= ' col-12';
}

$grid = ($hiilite_options['blog_full_width'] == false) ? 'in_grid' : '';
switch($hiilite_options['blog_layouts']){
	case 'boxed':
		$blog_layouts = 'container_inner';
		break;
	default:
		$blog_layouts = $hiilite_options['blog_layouts'];
}
echo '<div class="row content-area" id="home_blog_loop"><div class="container_inner '.$grid.' ">';
if(have_posts()):
echo '<div class="site-main '.$blog_layouts.$colcount.'" role="main">';

	while(have_posts()):
		the_post();
		get_template_part('templates/blog', 'loop');
	endwhile;
	
echo '</div>'; //end in_grid
	
	// Numbered Pagination Option
	get_sidebar();
	hiilite_numeric_posts_nav();

endif;

echo '</div>
</div>';
get_footer(); 