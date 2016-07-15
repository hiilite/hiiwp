<?php
function add_menu_shortcode( $atts ){
	global $menu_tax_slug, $menu_slug;
	extract( shortcode_atts( array(
      'section'			=> '',
      'heading_tag'		=> 'h2',
      'ingredients_sep'	=> ' - ',
      'price_sep'		=> ' = ',
      'layout'			=> 'table', // table, inline
      'show_title'		=> true
   ), $atts ) );
  
    $query = new WP_Query(
	    array(
		    'post_type' => $menu_slug,
		    'posts_per_page' => '-1',
		    'tax_query' => array(
				array(
					'taxonomy' => $menu_tax_slug,
					'field'    => 'slug',
					'terms'    => $section,
					'include_children' => false
				),
			),
	    )
    );
    $output = '';
    if($query->have_posts()){
	    if($show_title == 'true'){
	    	$section_title = get_terms($menu_tax_slug, array('slug' => $section));
			$output .= '<'.$heading_tag.' class="menu-section-title align-center"><a class="menu-section-title-link" href="/menu-section/'.$section.'">'.$section_title[0]->name.'</a></'.$heading_tag.'>';
		}
		if($layout == 'table'){
			$output .= '<table class="menu-section-items col-12 fixed_columns align-left" >';
		    while($query->have_posts()){
			    $query->the_post();
			    $post_id = get_the_id();
			    $output .= '<tr class="menu-item">';
			    $output .= '<td class="menu-title col-3"><a href="'.get_the_permalink($post_id).'" class="menu-title-link">'.get_the_title().'</a></td>';
			    $output .= '<td class="menu-ingredients flex-item col-7 align-left">'.get_post_meta($post_id, 'ingredients', true);
			    if(get_post_meta($post_id, 'addons', true)){
				    $output .= '<table class="full-width"><tr>';
				    $output .= '<td class="menu-addons-title flex-item col-3">Add Ons:</td>';
				    $output .= '<td class="menu-addons"><table class="full-width">';
				    
				    $entries = get_post_meta( get_the_ID(), 'addons', true );
					foreach ( (array) $entries as $key => $entry ) {
					    $title = $desc = '';
					
					    if ( isset( $entry['addons_text'] ) )
					        $title = esc_html( $entry['addons_text'] );
					
					    if ( isset( $entry['addons_price'] ) )
					        $desc = esc_html( $entry['addons_price'] );
						
						$output .= '<tr><td>'.$title.'</td><td>'.$desc.'</td></tr>';
					   
					    // Do something with the data
					}
				    $output .= '</table></td></tr></table>';
			    }
			    $output .= '</td>';
			    $output .= '<td class="menu-price flex-item col-2">'.get_post_meta($post_id, 'price', true).'</td>';
			    
			    $output .= '</tr>';
		    }
			$output .= '</table>';
		} else {
			$output .= '<p class="menu-section-items">';
		    while($query->have_posts()){
			    $query->the_post();
			    $post_id = get_the_id();
			    $output .= '<span class="menu-item">';
			    $output .= '<span class="menu-title"><a href="'.get_the_permalink($post_id).'" class="menu-title-link">'.get_the_title().'</a></span>';
			    $output .= '<span class="menu-ingredients-sep">'.$ingredients_sep.'</span>';
			    $output .= '<span class="menu-ingredients">'.get_post_meta($post_id, 'ingredients', true).'</span>';
			    $output .= '<span class="menu-price-sep">'.$price_sep.'</span>';
			    $output .= '<span class="menu-price">'.get_post_meta($post_id, 'price', true).'</span>';
			    $output .= '<br>';
			   if(get_post_meta($post_id, 'addons', true)){
				    $output .= '<table><tr>';
				    $output .= '<td class="menu-addons-title flex-item col-2">Add Ons:</td>';
				    $output .= '<td class="menu-addons"><table class="full-width">';
				    
				    $entries = get_post_meta( get_the_ID(), 'addons', true );
					foreach ( (array) $entries as $key => $entry ) {
					    $title = $desc = '';
					
					    if ( isset( $entry['addons_text'] ) )
					        $title = esc_html( $entry['addons_text'] );
					
					    if ( isset( $entry['addons_price'] ) )
					        $desc = esc_html( $entry['addons_price'] );
						
						$output .= '<tr><td>'.$title.'</td><td>'.$desc.'</td></tr>';
					   
					    // Do something with the data
					}
				    $output .= '</table></td></tr></table>';
			    }
			    $output .= '</span>';
		    }
		    $output .= '</p>';
		}
	   
    }
    
	return $output;
}
add_shortcode( 'menu', 'add_menu_shortcode' );
	
	?>