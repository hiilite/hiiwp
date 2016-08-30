<?php
function add_testimonials_shortcode( $atts ){
	global $qode_options_proya;
	
	$testimonials_slug = get_theme_mod( 'testimonials_slug', 'testimonials' );
	$testimonials_tax_slug = get_theme_mod( 'testimonials_tax_slug', 'testimonials_category' );
	
	$post_id = get_the_id();
	$post_object = get_post( $post_id );
	
	if(get_post_meta($post_id, 'amp', true) == 'nonamp'){
		$hiilite_options['amp'] = false;
	} else {
		$hiilite_options['amp'] = (!isset($hiilite_options['amp']))?get_theme_mod('amp'):$hiilite_options['amp'];
	}
	
	
	$options = get_option('company_options');
	if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';

	$el_class = $width = $css = $offset = ''; $output = '';
	
	$options = get_option('company_options');
	extract( shortcode_atts( array(
      'section'			=> 'all',
      'show_image'		=> false,
      'show_title'		=> false,
      'show_rating'		=> false,
      'heading_tag'		=> 'h3',
      'height'			=> '500px',
      'image_style'		=> 'none',
      'image_position'	=> 'above',
      'is_slider'		=> false,
      'slider_speed'		=> 5000,
      "css"  		=> "",
   ), $atts ) );
	
	
	////////////////
	// Push VC CSS
	///////////////
	
	// add custom classes
	$css_classes = array(
		'content-slider',
		vc_shortcode_custom_css_class( $css ), 
	);
	if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='';
	}
	$wrapper_attributes = array();
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
		
	
	// Build Query
	if($section != 'all'){
		$query = new WP_Query(
		    array(
			    'post_type' => $testimonials_slug,
			    'tax_query' => array(
					array(
						'taxonomy' => $testimonials_tax_slug,
						'field'    => 'slug',
						'terms'    => $section,
					),
				),
		    )
		);
	} else {
		$query = new WP_Query(array('post_type' => $testimonials_slug));
	}
    
    if($query->have_posts()){
	    
	    // if slider
	    if($hiilite_options['amp'] && $is_slider) $output .= '<amp-carousel width="1000px" height="'.$height.'" layout="responsive" type="slides" '.implode( ' ', $wrapper_attributes ).' autoplay delay="'.$slider_speed.'">';
	    
	    while($query->have_posts()){
		    $query->the_post();
		    $post_id = get_the_id();
			
			$output .= '<div itemscope itemtype="http://schema.org/Review" class="testimonial_item row container_inner"><div class="flex-item  align-center">
				  <div itemprop="itemReviewed" itemscope itemtype="http://schema.org/'.$options['business_type'].'">';
				  
			// image
			if($show_image){
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'medium' );
				$output .= '<'.$_amp.'img src="'.$image[0].'" itemprop="image" class="'.$image_style.' testimonial_image" width="'.($image[1]).'" height="'.($image[2]).'" alt="'.get_the_title().'">';
				if($hiilite_options['amp'])$output .= '</amp-img>';
			}
			
			$output .=	'<meta itemprop="name" content="'.$options['business_name'].'"></div>';
			
			// rating
			$output .= '<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="testimonial_rating">
				    <meta itemprop="ratingValue" content="'.get_post_meta($post_id, 'testimonial_rating', true).'">';
			if($show_rating){
				for($i=1;$i <= get_post_meta($post_id, 'testimonial_rating', true); $i++){
					$output .= '<i class="fa fa-star"></i>';
				}
			}
			$output .= '</div>';
			
			// title
			if($show_title)$output .= '<'.$heading_tag.' class="testimonial_title"><span itemprop="name">'.get_the_title().'</span></'.$heading_tag.'>';
				  
			// content
			$output .= '<div itemprop="reviewBody" class="testimonial_content text-block">'.get_the_content().'</div>';
				  
			// author
			$output .= '<span itemprop="author" itemscope itemtype="http://schema.org/Person">
				    <span itemprop="name" class="testimonial_author">'.get_post_meta($post_id, 'testimonial_author', true).'</span>
				  </span>';
				  
			// publisher info
			$output .= '<div itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="'.$options['business_name'].'"></div>';
			
			//End item
			$output .= '</div></div>';
		    
	    }
	    if($hiilite_options['amp'] && $is_slider) $output .= '</amp-carousel>';
	}
    
	return $output;
}
add_shortcode( 'testimonials', 'add_testimonials_shortcode' );
	
	?>