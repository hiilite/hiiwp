<?php
/* HiiWP Template: portfolio-archive
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.3
 */
$hiilite_options = HiiWP::get_options();
$templates	= new HiiWP_Plus_Template_Loader();

do_action( 'before_portfolio' );

if(have_posts()):

	if($hiilite_options['portfolio_show_filter'] == true):

		include( $templates->locate_template('filter-default.php') ); 
		
	endif;
	
	$portfolio_layout 		= (isset($atts['portfolio_layout']))		?$atts['portfolio_layout']:$hiilite_options['portfolio_layout'];
	$portfolio_columns 		= (isset($atts['portfolio_columns']))		?$atts['portfolio_columns']:$hiilite_options['portfolio_columns'];
	$portfolio_image_style 	= (isset($atts['portfolio_image_style']))	?$atts['portfolio_image_style']:$hiilite_options['portfolio_image_style'];
	
	if(strpos($portfolio_columns, 'col') !== false) {
		switch($portfolio_columns){
			case 'col-4':
				$portfolio_columns = 3;
				break;
			case 'col-12':
				$portfolio_columns = 1;
				break;
			case 'col-6':
				$portfolio_columns = 2;
				break;
			case 'col-3':
				$portfolio_columns = 4;
				break;
		}
	}
	echo "<div class='row portfolio_layout {$portfolio_layout} columns-{$portfolio_columns} {$portfolio_image_style}'>";
	
	while(have_posts()):
		the_post();
		
		include( $templates->locate_template('portfolio-loop.php') ); 
		
	endwhile;	
	
	echo "</div>";
	hiilite_numeric_posts_nav();
endif;

do_action( 'after_portfolio' );