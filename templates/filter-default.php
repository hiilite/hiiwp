<?php
/**
 * HiiWP Template: filter-default
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.3
 */
$hiilite_options = HiiWP::get_options();
do_action( 'before_filter' );
 

 
$current_post_type = (!isset($current_post_type))?get_post_type( ): $current_post_type;

switch($current_post_type):
	case 'portfolio':
		$taxonomy = $hiilite_options['portfolio_tax_slug'];
	break;
	case 'post':
		$taxonomy = 'category';
	break;
	default:
		$taxonomy = false;
	break;
endswitch;

if ( $taxonomy ) :
	$terms = get_terms(array(
		'taxonomy'		=> $taxonomy,
		'hide_empty'	=> 1,
		'parent'		=> 0
	));
	
	$html = '<nav class="navbar row layout-switcher"><div class="collapse navbar-collapse">';
	if( !is_wp_error( $terms ) && count($terms) > 0 ):
		$li_classes = array('nav-item');
		
		$html .= '<ul class="navbar-nav mr-auto">';
		
		$html .= "<li class='" . implode(' ', $li_classes) . "'>";
		$html .= '<a href="'.get_post_type_archive_link($current_post_type).'" class="nav-link">All</a>';
		$html .= '</li>';
		
		foreach($terms as $term){
			
			if( isset(get_queried_object()->term_id) && get_queried_object()->term_id == $term->term_id ) $li_classes[] =  'active';
			
			
			$child_terms = get_terms(array(
				'taxonomy'		=> $taxonomy,
			    'hide_empty' 	=> 1,
			    'parent'		=> $term->term_id,
			));
			$dropdown_html = '';
			if(count($child_terms) > 0):
				$li_classes[] = 'dropdown';
				$dropdown_li_classes = array('downdown-item');
				
				$dropdown_html .= '<ul class="dropdown-menu">';
				
				foreach($child_terms as $child_term){
					
					if( isset(get_queried_object()->term_id) && get_queried_object()->term_id == $child_term->term_id ) $dropdown_li_classes[] = 'active';
					$dropdown_html .= "<li class='" . implode(' ', $dropdown_li_classes) . "'>";
					$dropdown_html .= '<a href="'.esc_attr( get_term_link( $child_term->term_id ) ).'">'.$child_term->name.'</a>';
					$dropdown_html .= '</li>';
				}
				$dropdown_html .= '</ul>';
			endif;
			
			$html .= "<li class='" . implode(' ', $li_classes) . "'>";
			$html .= '<a href="'.esc_attr( get_term_link( $term->term_id ) ).'" class="nav-link">'.$term->name.'</a>';
			
			$html .= $dropdown_html;
			
			$html .= '</li>';
		}
		$html .= '</ul>';
		
	endif;
	
	// Layout Switchers
	$html .= '<div class="btn-group" role="group" aria-label="Switch Layout">';
	$html .= '<button type="button" class="btn btn-secondary" data-layout="full-width" data-container="portfolio_layout"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" class="fill-width-icon fa" style="width: 14px;height: 14px;"><defs></defs><g transform="translate(-1433 -361)"><rect class="a" width="14" height="6" transform="translate(1433 361)"/><rect class="a" width="14" height="6" transform="translate(1433 369)"/></g></svg></button>';
	$html .= '<button type="button" class="btn btn-secondary" data-layout="boxed" data-container="portfolio_layout"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" style="width:14px;height:14px;"><g transform="translate(-1465 -361)"><rect class="a" width="6" height="6" transform="translate(1465 361)"/><rect class="a" width="6" height="6" transform="translate(1465 369)"/><rect class="a" width="6" height="6" transform="translate(1473 361)"/><rect class="a" width="6" height="6" transform="translate(1473 369)"/></g></svg></button>';
	$html .= '<button type="button" class="btn btn-secondary" data-layout="masonry" data-container="portfolio_layout"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.008 14.113" style="width:14px;height:14px;"><g transform="translate(-1486 -361)"><rect width="4.016" height="6.113" transform="translate(1486 361)"/><rect width="4.016" height="7.113" transform="translate(1486 368)"/><rect width="4.016" height="9.113" transform="translate(1495.992 361)"/><rect width="4.016" height="4.113" transform="translate(1495.992 371)"/><rect width="4.016" height="4.113" transform="translate(1490.984 361)"/><rect width="4.016" height="3.113" transform="translate(1490.984 366)"/><rect width="4.016" height="5.113" transform="translate(1490.984 370)"/></g></svg></button>';
	$html .= '</div>';
	
	$html .= '</div></nav>';
	
	echo $html;
endif;
do_action( 'after_filter' );