<?php
// store the post type from the URL string
// check to see if there was a post type in the
// URL string and if a results template for that
// post type actually exists
if ( isset( $_GET['post_type'] ) && locate_template( 'search-' . $_GET['post_type'] . '.php' ) ) {
  // if so, load that template
  get_template_part( 'search', $_GET['post_type'] );
  
  // and then exit out
  exit;
}


global $hiilite_options;
get_header();
get_template_part( 'templates/title' );

$colcount = ($hiilite_options['blog_layouts'] =='masonry')?' col-count-'.$hiilite_options['blog_col']:'';
if ( $hiilite_options['blog_sidebar_show'] == true ) $colcount .= ' col-9';

$grid = ($hiilite_options['blog_full_width'] == false) ? 'in_grid' : '';

echo '<div class="row content-area" id="home_blog_loop"><div class="container_inner '.$grid.'">';
if(have_posts()):
echo '<div class="site-main '.$hiilite_options['blog_layouts'].$colcount.'" role="main">';

	while(have_posts()):
		the_post();
		get_template_part('templates/blog', 'loop');
	endwhile;
	
echo '</div>'; //end in_grid	
	get_sidebar();


	hiilite_numeric_posts_nav();

else:
	?>
<section class="row">
	<div class="container_inner in_grid">
		<div class="page_not_found align-center">
			<h2> No Results Found</h2>
		    <p> The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site’s homepage and see if you can find what you are looking for. </p>
			<div class="separator  transparent center  " style="margin-top:35px;"></div>
			<p><a itemprop="url" class="button button-primary" href="<?php echo esc_url( home_url() ); ?>"> Back to homepage </a></p>
		</div>
	</div>
</section>
<?php
endif;

echo '</div>
</div>';
get_footer(); ?>