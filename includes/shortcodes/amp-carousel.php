<?php
function add_amp_carousel_shortcode( $atts ){
	
	/*
		TODO:

	*/
	$post_id = get_the_id();

	$slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
	extract( shortcode_atts( array(
      'args'  => null,
      'height' => 300,
      'width'	=> 1000,
      'type'	=> 'carousel',
      'thumbnails'	=> false,
      'media_grid_images' => null,
      'css' => '',
      'id'	=> ''
    ), $atts ) );
    
    $id = ($id != '')?"id={$id}":"id='hii_rc_".rand(100,999)."'";
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
		
    $args = ($args==null)?array('post_type'=>$slug,'posts_per_page'=> -1,'nopaging'=>true,'order'=>'ASC','orderby'=>'menu_order'):$args;
    if($media_grid_images != null){
	    $args = array(
				'post_type'=>'attachment',
				'post_mime_type' =>'image',
				'post_status' => 'inherit',
				'posts_per_page' => -1,
				'post__in' => explode(',', $media_grid_images ),
				'orderby' => 'post__in',
			);
	}
    $query = new WP_Query($args);
    
    $output = '';
    $output .= '<amp-carousel style="display:block;height:'.$height.'px;width:'.$width.'px" layout="fixed-height" type="'.$type.'" '.implode( ' ', $wrapper_attributes ).' '.$id.'>';
    if($type == 'carousel') $output .= '<div class="carousel-wrapper" style="white-space: nowrap; position: absolute; z-index: 1; top: 0px; left: 0px; bottom: 0px;">';
    if($args['post_type'] == 'attachment'):
    	$count = 0;
		foreach ( $query->posts as $attachment) :
			$count++;
	       $image = wp_get_attachment_image_src( $attachment->ID, 'full' );
	       $hratio = ((int) $height / (int) $image[2]);
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
				$output .= '<a href="'.get_the_permalink().'" class="slide">';
				$output .= '<img src="'.$image[0].'" width="'.($image[1]*$hratio).'" height="'.($image[2]*$hratio).'" alt="'.get_the_title().'">';
				$output .= '</a>';
		  	}
		endwhile;
    endif;
    
    if($type == 'carousel') $output .= '</div>';
    $output .= '</amp-carousel>';
    
	return $output;
}
add_shortcode( 'amp-carousel', 'add_amp_carousel_shortcode' );	
?>