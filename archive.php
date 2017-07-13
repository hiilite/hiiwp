<?php 
$hiilite_options = Hii::$hiiwp->get_options();
get_header();
echo '<!--Archive-->';
get_template_part( 'templates/title' );

$colcount = ($hiilite_options['blog_layouts'] =='masonry')?' col-count-'.$hiilite_options['blog_col']:'';
if ( $hiilite_options['blog_sidebar_show'] == true ) $colcount .= ' col-9';

$grid = ($hiilite_options['blog_full_width'] == false) ? 'in_grid' : 'x';
if(have_posts()):
	echo '<section class="row"><div class="container_inner '.$grid.'">';
	echo '<div class="'.$grid.' '.$hiilite_options['blog_layouts'].$colcount.'">';
	while(have_posts()):
		the_post();
		$post_type = get_post_type(get_the_ID());
		switch (get_post_type($post)) {
			case get_theme_mod( 'portfolio_slug', 'portfolio' ):
				get_template_part('templates/blog', 'loop');
				break;
			case 'team':
				get_template_part('templates/team_member', 'loop');
				break;
			case 'menu':
				get_template_part('templates/menu_item', 'loop');
				break;
			case 'post':
				get_template_part('templates/blog', 'loop');
				break;
			case 'sr-listings':
				get_template_part('templates/listing', 'loop');
				break;
			case 'listing':
				get_template_part('templates/listing', 'loop');
				break;
			default:
				get_template_part('templates/default', 'loop');
		}
		
		
		
		
	endwhile;
	echo '</div>'; //end in_grid
	?>
	<div id="blog_sidebar" class="col-3">
		<?php
		if ( $hiilite_options['blog_sidebar_show'] == true ) :
			dynamic_sidebar( 'blog_sidebar' );
		endif;
		?>
	</div>
	<?php
	echo '</div></section>';

endif;

get_footer(); ?>