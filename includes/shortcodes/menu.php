<?php
function add_menu_shortcode( $atts ){
	extract( shortcode_atts( array(
      'section'			=> '',
      'heading_tag'		=> 'h2',
      'ingredients_sep'	=> ' - ',
      'price_sep'		=> ' = ',
      'show_title'		=> true
   ), $atts ) );
  
    $query = new WP_Query(
	    array(
		    'post_type' => 'menu',
		    'tax_query' => array(
				array(
					'taxonomy' => 'menu-section',
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
	    	$section_title = get_terms('menu-section', array('slug' => $section));
			$output .= '<'.$heading_tag.' class="menu-section-title"><a class="menu-section-title-link" href="/menu-section/'.$section.'">'.$section_title[0]->name.'</a></'.$heading_tag.'>';
		}
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
			    $output .= '<span class="menu-addons-title">Add Onto Your '.get_the_title().':</span><br>';
			    $output .= '<span class="menu-addons">'.nl2br(get_post_meta($post_id, 'addons', true)) .'</span><br><br>';
		    }
		    $output .= '</span>';
	    }
	    $output .= '</p>';
    }
    
	return $output;
}
add_shortcode( 'menu', 'add_menu_shortcode' );
	
	?>