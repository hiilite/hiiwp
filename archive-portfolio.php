<?php 
get_header();
get_template_part( 'templates/title' );
echo '<!--ARCHIVE-PORTFOLIO-->';
$hiilite_options = HiiWP::get_options();
do_action( 'before_portfolio' );
/*
$port_args = array(
		'show_post_meta'  	=> get_theme_mod( 'portfolio_show_post_meta', false ),
	    'show_post_title'  	=> get_theme_mod( 'portfolio_show_post_title', false ),
	    'portfolio_show_author_date'  	=> get_theme_mod( 'portfolio_show_author_date', false ),
	    'in_grid'			=> get_theme_mod( 'portfolio_in_grid', false ),
	    'add_padding'		=> get_theme_mod( 'portfolio_add_padding', '0px' ),
	    'portfolio_layout'	=> get_theme_mod( 'portfolio_layout', 'h-masonry' ),
	    'portfolio_columns'	=> get_theme_mod( 'portfolio_columns', '1' ),
		'portfolio_image_pos'=> get_theme_mod( 'portfolio_image_pos', 'image-left' ),
		'portfolio_title_pos'=> get_theme_mod( 'portfolio_title_pos', 'title-below' ),
		'portfolio_heading_size'=> get_theme_mod( 'portfolio_heading_size', 'h2' ),
		'portfolio_excerpt_on'=> get_theme_mod( 'portfolio_excerpt_on', false ),
		'portfolio_excerpt_length'=> get_theme_mod( 'portfolio_excerpt_length', '55' ),
		'portfolio_more_on'=> get_theme_mod( 'portfolio_more_on', false ),
		'portfolio_more_text'=> get_theme_mod( 'portfolio_more_text', 'Read On' ),
		'portfolio_show_filter'=> get_theme_mod( 'portfolio_show_filter', true ),
	    );

$portfolio = get_portfolio(null, $port_args );
echo $portfolio;
*/
if(have_posts()):
	echo '<div class="row"><div class="container_inner">';
	if($hiilite_options['portfolio_in_grid'] == true) echo '<div class="in_grid">';
	while(have_posts()):
		the_post();
		
		get_template_part('templates/portfolio', 'loop');
		
		
	endwhile;
	if($hiilite_options['portfolio_in_grid'] == true) echo '</div>';
	echo '</div></div>';
	
endif;

do_action( 'after_portfolio' );
get_footer(); ?>