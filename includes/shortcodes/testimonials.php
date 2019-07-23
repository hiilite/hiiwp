<?php
function add_testimonials_shortcode( $atts ){
	
	
	$testimonials_slug = get_theme_mod( 'testimonials_slug', 'testimonials' );
	$testimonials_tax_slug = get_theme_mod( 'testimonials_tax_slug', 'testimonials_category' );

	$el_class = $width = $css = $offset = ''; $output = '';
	
	extract( shortcode_atts( array(
      'section'			=> 'all',
      'show_image'		=> false,
      'show_title'		=> false,
      'show_rating'		=> false,
      'heading_tag'		=> 'h3',
      'height' 			=> 530,
      'width'			=> 0,
      'image_style'		=> 'none',
      'image_position'	=> 'above',
      'is_slider'		=> false,
      'slider_speed'		=> 5000,
      'css'  		=> '',
      'id'	=> '',
      'show_arrows'	=> 'true',
      'hide_arrows_on_mobile' => false,
      'arrow_icon'	=> 'chevron',
      'arrow_size'	=> 'regular',
      'arrow_background_type'	=> 'none',
      'arrow_color'	=> '#333333',
      'arrow_background_color'	=> '#ffffff',
      'show_bullets'	=> 'true',
      'bullet_color'	=> '#ffffff',
      'slider_min_height' => 200,
      'autoplay'     => 'none'
   ), $atts ) );
	

	$id = ($id != '')?"id={$id}":"id='hii_rc_".rand(100,999)."'";
	/*
	VC CSS    
	*/
	$css_classes = array(
		'testimonial-slider',
		vc_shortcode_custom_css_class( $css ), 
	);
	if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='';
	}
	$wrapper_attributes = array();
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) );
	
	/* Arrow & Bullet Attributes*/
	$data_attributes_str = '';
	$data_attributes = array(
		'show_arrows'			=> $show_arrows,
		'arrow_icon' 			=> $arrow_icon,
		'hide_arrows_on_mobile'	=> $hide_arrows_on_mobile,
		'arrow_size' 			=> $arrow_size,
		'arrow_background_type' => $arrow_background_type,
		'arrow_color' 			=> $arrow_color,
		'arrow_background_color'=> $arrow_background_color,
		'show_bullets' 			=> $show_bullets,
		'bullet_color' 			=> $bullet_color,
		'slider_min_height' 	=> $slider_min_height
	);
	
	foreach($data_attributes as $key=>$value) {
		$data_attributes_str .= "data-$key='$value' ";
	}
	$wrapper_attributes[] = $data_attributes_str;
	
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
	    if($is_slider):
	    	$output .= '<amp-carousel layout="responsive" type="slides" '.implode( ' ', $wrapper_attributes ).' '.$id.'';
	    	$output .= ( isset($atts['autoplay']) && $atts['autoplay'] != 'none')?' autoplay delay="'.$atts['autoplay'].'000">':'>';
	    endif;
	    while($query->have_posts()){
		    $query->the_post();
		    $post_id = get_the_id();
		    $image_output = '';
		    // image
			if($show_image){
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'thumbnail' );
				if($image) $image_output = '<figure class="'.$image_style.' testimonial_image"><img src="'.$image[0].'" itemprop="image" width="'.($image[1]).'" height="'.($image[2]).'" alt="'.get_the_title().'"></figure>';
			}
			
			$output .= '<div itemscope itemtype="http://schema.org/Review" class="testimonial_item slide row container_inner"><div class="flex-item align-center">';
				  
			if($image_position == 'above') $output .= $image_output;
			
			
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
			if($show_title)$output .= '<'.$heading_tag.' class="testimonial_title"><span itemprop="name">'.get_the_title($post_id).'</span></'.$heading_tag.'>';
				  
			// content
			$output .= '<div itemprop="reviewBody" class="testimonial_content">'.get_the_content().'</div>';
				  
			// author
			$output .= '<div itemprop="author" itemscope itemtype="http://schema.org/Person" class="testimonial_author">
				    		<span itemprop="name">'.get_post_meta($post_id, 'testimonial_author', true).'</span>';
							  
			// publisher info
			$output .= '<div itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
							<a href="'.get_post_meta($post_id, 'testimonial_website', true).'" itemprop="name">'.get_post_meta($post_id, 'testimonial_company', true).'</a>
						</div>';
						
			
						
			$output .= '</div>';
			if($image_position == 'bottom') $output .= $image_output;
			//End item
			$output .= '</div></div>';
		    
	    }
	    if($is_slider):
	    	$output .= '</amp-carousel>';
	    endif;
	}
    
	return $output;
}
add_shortcode( 'testimonials', 'add_testimonials_shortcode' );
	
	?>