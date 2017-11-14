<?php
function add_hii_post_carousel_shortcode( $atts ){
    $is_vc = (class_exists('Vc_Manager'))?true:false;
    extract( shortcode_atts( array(
      'post_ids' => null,
      'show_title'	=> true,
      'show_excerpt'	=> true,
      'show_btn'	=> true,
      'btn_text' => __('Read More', 'hiiwp'),
      'css' => '',
    ), $atts ) );
    
    $vc_css = ($is_vc)?vc_shortcode_custom_css_class( $css ):null;
	$css_classes = array(
		'hii_post_carousel',
		$classes,
		$vc_css, 
	); 
	
	if ($is_vc && vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='';
	}
	$wrapper_attributes = array();

	$css_class = ($is_vc)?preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) ):implode( ' ', array_filter( $css_classes ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
    
    
    
    $html .= '<div '.implode( ' ', $wrapper_attributes ).'>';
    //$html .= '<div class="hii_post_carousel">';
    
    $html .= '<div class="col-1" id="hii_pc_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>';
    
    $html .= '<div class="col-10 hii_post_carousel_wrap">';
    
    if(isset($post_ids)){
	    $posts = explode(",", $post_ids);
	    $i = 0;
	    foreach($posts as $key => $post){
		    $i++;
		    $img = the_post_thumbnail($post);
		    
			$html .= '<div id="hii_post-'.$i.'">';
			//$html .= '<img src="'.get_the_post_thumbnail_url($post, 'medium').'">';
			$html .= '<a href="'.get_permalink($post).'">'.get_the_post_thumbnail($post, 'medium').'</a>';
			
			if($show_title == 'yes'){
				$html .= '<a href="'.get_permalink($post).'"><h3>'.get_the_title($post).'</h3></a>';
			}
			if($show_excerpt == 'yes'){
				$html .= '<p class="hii_post_exc">'.get_the_excerpt($post).'</p>';
			}
			if($show_btn == 'yes'){
				$html .= '<a href="'.get_permalink($post).'" class="button">'.$btn_text.'</a>';
			}
			
			$html .= '</div>';
		}
	}
	$html .= '</div>';
	
	$html .= '<div class="col-1" id="hii_pc_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>';
    	
    //$html .= '</div>';
    $html .= '</div>';
    
    return $html;
}
add_shortcode( 'hii_post_carousel', 'add_hii_post_carousel_shortcode' );
?>