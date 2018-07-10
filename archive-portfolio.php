<?php 
/**
 * HiiWP Template: archive-portfolio
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
get_header();
get_template_part( 'templates/title' );
echo '<!--ARCHIVE-PORTFOLIO-->';
$hiilite_options = HiiWP::get_options();
do_action( 'before_portfolio' );

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