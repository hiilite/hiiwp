<?php
function add_portfolio_shortcode( $atts ){
	
	$portfolio_slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
	$portfolio_tax_slug = get_theme_mod( 'portfolio_tax_slug', 'work' );

	$el_class = $width = $css = $offset = ''; $output = '';
	
	extract( shortcode_atts( array(
      'section'			=> 'all',
      'show_image'		=> false,
      'show_title'		=> false,
      'show_rating'		=> false, 
      'portfolio_heading_size'	=> 'h3',
      'height' 			=> 530,
      'width'			=> 1100,
      'portfolio_image_style'	=> 'square',
      'portfolio_show_info'		=> true,
      'portfolio_image_pos'	=> 'image-behind',
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
      'slider_min_height' => 100,
      'autoplay'     => 'none'
   ), $atts ) );
	

	$id = ($id != '')?"id={$id}":"id='hii_rc_".rand(100,999)."'";
	/*
	VC CSS    
	*/
	$css_classes = array(
		'portfolio-slider',
		'carousel',
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
			    'post_type' => $portfolio_slug,
			    'tax_query' => array(
					array(
						'taxonomy' => $portfolio_tax_slug,
						'field'    => 'slug',
						'terms'    => $section,
					),
				),
		    )
		);
	} else {
		$query = new WP_Query(array('post_type' => $portfolio_slug));
	} 

    if($query->have_posts()){
	    
	    
	    // if slider
	    if($is_slider):
	    	$output .= '<amp-carousel width="'.$width.'px" layout="responsive" type="carousel" '.implode( ' ', $wrapper_attributes ).' '.$id.'';
	    	$output .= ( isset($atts['autoplay']) && $atts['autoplay'] != 'none')?' autoplay delay="'.$atts['autoplay'].'000">':'>';
	    else:
	    	$output .= '<div class="container_inner">';
	    endif;
	    while($query->have_posts()){
		    $query->the_post();
		    $post_id = get_the_id();		
			ob_start();
		    include(locate_template('templates/portfolio-loop.php'));
		    $output .= ob_get_clean();
		    
	    }
	    if($is_slider):
	    	$output .= '</div></amp-carousel>';
	    else:
	    	$output .= '</div>';
	    endif;
	}
    
	return $output;
}
add_shortcode( 'portfolio', 'add_portfolio_shortcode' );