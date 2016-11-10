<?php
function add_menu_shortcode( $atts ){
	global $menu_tax_slug, $menu_slug;
	$hiilite_options['amp'] = get_theme_mod('amp');
	if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';
	$menu_slug = get_theme_mod('menu_slug', 'menu');
	$menu_tax_slug = get_theme_mod('menu_tax_slug', 'menu-section');
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
			    
			    //Overlay
			    $output .= '<td class="menu-image">';
			    $tn_id = get_post_thumbnail_id( $post_id );
			    $img = wp_get_attachment_image_src( $tn_id, 'thumbnail' );
			    if($img) $output .= '<a href="'.get_the_permalink($post_id).'" class="menu-image-link"><div class="menu-popup"><'.$_amp.'img src='.$img[0].' layout="responsive" width="150" height="150">'.(($_amp!='')?'</amp-img>':'').'</div></a>';
			    $output .= '</td>';
			    
			    $output .= '<td class="menu-title col-3"><a href="'.get_the_permalink($post_id).'" class="menu-title-link">'.get_the_title().'</a>';
			     
			    
			    $output .= '</td>';
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