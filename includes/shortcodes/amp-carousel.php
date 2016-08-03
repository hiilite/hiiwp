<?php

function add_amp_carousel_shortcode( $atts ){
	
	/*
		TODO:
		- Add &via=@twittername to twitter link 
		- Switch to amp-social-share once compatibility is back
		- Pull post title and other meta from global values
	*/
	
	$post_id = get_the_id();
	if(get_post_meta($post_id, 'amp', true) == 'nonamp'){
		$hiilite_options['amp'] = false;
	} else {
		$hiilite_options['amp'] = (!isset($hiilite_options['amp']))?get_theme_mod('amp'):false;
	}
	if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';
	
	$slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
	extract( shortcode_atts( array(
      'args'  => null,
      'height' => 300,
      'media_grid_images' => null,
    ), $atts ) );
    
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
    $output .= '<'.$_amp.'carousel height="300" layout="fixed-height" type="carousel" class="carousel">';
    if($args['post_type'] == 'attachment'):
		foreach ( $query->posts as $attachment) :
	       $image = wp_get_attachment_image_src( $attachment->ID, 'large' );
	       $hratio = ($height / $image[2]);
	       $output .= '<a href="'.get_the_permalink().'">';
		   $output .= '<'.$_amp.'img src="'.$image[0].'" width="'.($image[1]*$hratio).'" height="'.($image[2]*$hratio).'" alt="'.get_the_title().'">';
		   if($hiilite_options['amp']) $output .= '</amp-img>';
		   $output .= '</a>';
	    endforeach;
	else:
		
		while($query->have_posts()):
			$query->the_post();
			if ( has_post_thumbnail() ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' );
				$hratio = ($height / $image[2]);
				$output .= '<a href="'.get_the_permalink().'">';
				$output .= '<amp-img src="'.$image[0].'" width="'.($image[1]*$hratio).'" height="'.($image[2]*$hratio).'" alt="'.get_the_title().'"></amp-img></a>';
		  	}
		endwhile;
		 
	$output .= '</'.$_amp.'carousel>';
    endif;
	return $output;
}
add_shortcode( 'amp-carousel', 'add_amp_carousel_shortcode' );	
?>