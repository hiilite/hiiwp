<?php


/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $content - shortcode content
 */


function add_hii_infinite_carousel_shortcode( $atts ){



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
		'hii_infinite_carousel',
		$vc_css, 
	); 
	
	if ($is_vc && vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='';
	}
	$wrapper_attributes = array();

	$css_class = ($is_vc)?preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) ):implode( ' ', array_filter( $css_classes ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
    
    $html = '';
    
    $html .= '<div '.implode( ' ', $wrapper_attributes ).'>';
	$html .= print_r($atts,true);
    $html .= '</div>';
    
    return $html;


}
add_shortcode( 'hii_infinite_carousel', 'add_hii_infinite_carousel_shortcode' );
?>