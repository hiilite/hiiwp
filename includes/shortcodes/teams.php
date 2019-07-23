<?php
function add_teams_shortcode( $atts ){	
	
	$teams_slug = get_theme_mod( 'teams_slug', 'team' );
	$teams_tax_slug = get_theme_mod( 'teams_slug', 'position' );

	$el_class = $width = $css = $offset = ''; $output = '';
	
	extract( shortcode_atts( array(
      'section'			=> 'all',
      'show_image'		=> false,
      'show_title'		=> false,
      'show_rating'		=> false,
      'heading_tag'		=> 'h3',
      'height' 			=> 530,
      'width'			=> 1100,
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
      'slider_min_height' => 100,
      'autoplay'     => 'none'
   ), $atts ) );
	

	$id = ($id != '')?"id={$id}":"id='hii_rc_".rand(100,999)."'";
	/*
	VC CSS    
	*/
	$css_classes = array(
		'team-slider',
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
		'slider_min_height' 	=> $slider_min_height
	);
	
	foreach($data_attributes as $key=>$value) {
		$data_attributes_str .= "data-$key='$value' ";
	}
	$wrapper_attributes[] = $data_attributes_str;

	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

	$cur_page = get_page_template();
	
	// Build Query
	if($section != 'all'){
		$query = new WP_Query(
		    array(
			    'post_type' => $teams_slug,
			    'tax_query' => array(
					array(
						'taxonomy' => $teams_tax_slug,
						'field'    => 'slug',
						'terms'    => $section,
					),
				),
		    )
		);
	}  
	else {
		$query = new WP_Query(array('post_type' => $teams_slug));
		
	}
	
    if($query->have_posts()){
	    
	    $templates	= new HiiWP_Template_Loader();
	     
	    $attributes = implode( ' ', $wrapper_attributes );
	   
	    // if slider
	    if($is_slider):
	    	$output .= '<amp-carousel width="'.$width.'px" layout="responsive" type="carousel" '.implode( ' ', $wrapper_attributes ).' '.$id.'';
	    	$output .= ( isset($atts['autoplay']) && $atts['autoplay'] != 'none')?' autoplay delay="'.$atts['autoplay'].'000">':'><div class="carousel-wrapper">';
	    else:
	    	$output .= '<div class="container_inner">';
	    endif;
	   
	    ob_start();
	    while($query->have_posts()){
		    $query->the_post();
		    $post_id = get_the_ID();
		    include( $templates->locate_template('team-loop.php') ); 
	    }
	    $output .= ob_get_clean();
	    
	    if($is_slider):
	    	$output .= '</div></amp-carousel>';
	    else:
	    	$output .= '</div>';
	    endif;
	}
    
	return $output;
}
add_shortcode( 'teams', 'add_teams_shortcode' );
