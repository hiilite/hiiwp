<?php
/**
 * HiiWP: Header
 *
 * WordPress header file
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2021, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.8
 */

$hiilite_options = Hii::get_options();
$bg_color = '';


echo do_action('hii_doctype');
?><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"><?php 
wp_head(); 
?></head><body <?php body_class(); ?>><?php 
do_action( 'hii_body_start' );
do_action( 'hii_before_header' );
?><div class="wrapper"><div class="wrapper_inner"><?php
if($hiilite_options['enable_search_bar_yesno'] == true)	:
	?><aside id="main_search"><?php 
		apply_filters( 'hii_search_form', get_search_form() ); 
	?></aside><?php
endif; // end enable_search_bar_yesno




if(isset($post->ID)):
	
	$header_bg = (get_post_meta ( $post->ID, 'header_bg', true))?get_post_meta ( $post->ID, 'header_bg', true):false;
	if($header_bg) :
		$bg_color = 'style="background-color:'.$header_bg.'"';		
	elseif( post_type_exists('portfolio') && ( isset($hiilite_options['portfolio_on']) && $hiilite_options['portfolio_on'] == true  )):
		if($category = get_the_terms( $post->ID, $hiilite_options['portfolio_tax_slug'] )) {  
			$portfolio_work_color = (get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_color', true))?get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_color', true):false;	
			if($portfolio_work_color) {
				$bg_color = 'style="background-color:'.$portfolio_work_color.'"';	
			} 
		}
	endif;
endif;

do_action( 'hii_before_main_header' );	


do_action( 'hii_after_main_header' );
do_action( 'hii_before_content' );