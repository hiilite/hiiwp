<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
function add_hii_rotating_carousel_shortcode( $atts ){
    $post_id = get_the_id();
	
	
	$slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
	extract( shortcode_atts( array(
		'post_type' => 'post',
		'filter_source' => 'category',
		'orderby' => '',
		'order' => 'DESC',
		'meta_key' => '',
		'max_items' => '10',
		'offset' => '0',
		'taxonomies' => '',
		'custom_query' => '',
		'data_type' => 'query',
		'filter_source' => 'category',
		'include' => '',
		'exclude' => '',
		'loop' => '',
		'autoplay' => '',
		'args'  => null,
		'height' => 400,
		'width'	=> 1000,
		'type'	=> 'carousel',
		'thumbnails'	=> false,
		'media_grid_images' => null,
		'show_btn' => true,
		'btn_text'	=> 'Read More',
		'show_title' => true,
		'show_excerpt' => true,
		'css' => '',
    ), $atts ) );
    
    /*
	VC CSS    
	*/
	$extra_class = ($type == 'slides')?'slider':'carousel';
	$extra_class .= ($thumbnails)?' has_thumbs':'';
    $css_classes = array(
		$extra_class,
		vc_shortcode_custom_css_class( $css ), 
	);
	if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='';
	}
	$wrapper_attributes = array();
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

	
///////////////	
	
	// Set include & exclude
	if ( 'ids' !== $atts['post_type'] ) {
		$settings = array(
			'posts_per_page' => $max_items,
			'offset' => $offset,
			'orderby' => $orderby,
			'order' => $order,
			'meta_key' => in_array( $orderby, array(
				'meta_value',
				'meta_value_num',
			) ) ? $meta_key : '',
			'post_type' => $post_type,
			'exclude' => $exclude,
		);
		if ( ! empty( $taxonomies ) ) {
			$vc_taxonomies_types = get_taxonomies( array( 'public' => true ) );
			$terms = get_terms( array_keys( $vc_taxonomies_types ), array(
				'hide_empty' => false,
				'include' => $atts['taxonomies'],
			) );
			$settings['tax_query'] = array();
			$tax_queries = array(); // List of taxnonimes
			foreach ( $terms as $t ) {
				if ( ! isset( $tax_queries[ $t->taxonomy ] ) ) {
					$tax_queries[ $t->taxonomy ] = array(
						'taxonomy' => $t->taxonomy,
						'field' => 'id',
						'terms' => array( $t->term_id ),
						'relation' => 'IN',
					);
				} else {
					$tax_queries[ $t->taxonomy ]['terms'][] = $t->term_id;
				}
			}
			$settings['tax_query'] = array_values( $tax_queries );
			$settings['tax_query']['relation'] = 'OR';
		}
	} else {
		if ( empty( $include ) ) {
			$include = - 1;
		} elseif ( ! empty( $exclude ) ) {
			$include = array_map( 'trim', explode( ',', $include ) );
			$exclude = array_map( 'trim', explode( ',', $exclude ) );
			$diff = array_diff( $include, $exclude );
			$include = implode( ', ', $diff );
		}
		$settings = array(
			'include' => $include,
			'posts_per_page' => $max_items,
			'offset' => $offset,
			'post_type' => 'any',
			'orderby' => 'post__in',
		);
	}

	if ( 'custom' === $post_type && ! empty( $custom_query ) ) {
		$settings = html_entity_decode( $custom_query, ENT_QUOTES, 'utf-8' );
	} else {
		return;
	}


//////////////
    $query = new WP_Query($settings);
    
    $output = '';
    $output .= '<amp-carousel height="'.$height.'" width="'.$width.'" layout="fixed-height" type="'.$type.'" '.implode( ' ', $wrapper_attributes ).'>';
    if($type == 'carousel') $output .= '<div class="carousel-wrapper" style="white-space: nowrap; position: absolute; z-index: 1; top: 0px; left: 0px; bottom: 0px;">';
    if($args['post_type'] == 'attachment'):
    	$count = 0;
		foreach ( $query->posts as $attachment) :
			$count++;
	       $image = wp_get_attachment_image_src( $attachment->ID, 'full' );
	       $hratio = ($height / $image[2]);
	       $output .= '<a class="slide">';
		   $output .= '<img src="'.$image[0].'" width="'.($image[1]*$hratio).'" height="'.($image[2]*$hratio).'" alt="'.get_the_title().'">';
		   $output .= '</a>';
	    endforeach;
	    if($thumbnails):
	    	$output .= '<div class="thumbnails">';
			$i = 0;
			$thumb_width = 100 / $count;
			foreach ( $query->posts as $attachment) :
		       $image = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
		       $hratio = ($height / $image[2]);
		       $output .= '<a class="thumbnail" data-img="'.$i.'" style="width:'.$thumb_width.'%">';
			   $output .= '<img src="'.$image[0].'" width="150" height="150" alt="'.get_the_title().'">';
			   $output .= '</a>';
			   $i++;
		    endforeach;
		    $output .= '</div>';
		endif;
	else:
		while($query->have_posts()):
			$query->the_post();
			if ( has_post_thumbnail() ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' );
				$hratio = ($height / $image[2]);
				$output .= '<div href="'.get_the_permalink().'" class="slide">';
				$output .= '<figure class="slide_img_container"><img src="'.$image[0].'" width="'.($image[1]*$hratio).'" height="'.($image[2]*$hratio).'" alt="'.get_the_title().'"></figure>';
				
				$output .= '<h4 class="slide_title">'.get_the_title().'</h4>';
				$output .= '<a href="'.get_the_permalink( ).'" class="button slide_button">'.$btn_text.'</a>';
				$output .= '</div>';
		  	}
		endwhile;
    endif;
    
    if($type == 'carousel') $output .= '</div>';
    $output .= '</amp-carousel>';
    
	return $output;
}
add_shortcode( 'hii_rotating_carousel', 'add_hii_rotating_carousel_shortcode' );
?>