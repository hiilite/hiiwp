<?php
function add_button_shortcode( $atts ){
	extract( shortcode_atts( array(
      'target' => '_self',
      'text'   => 'Learn More',
      'link'	=> '',
      'style'	=> '',
      'text_align' => ''
   ), $atts ) );
   
   $css_classes = array(
		'button',
		$style,
		$text_align,
		vc_shortcode_custom_css_class( $css ), 
	);
  
	if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='';
	}
	$wrapper_attributes = array();

	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) );
	
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
		
	return "<a ".implode( ' ', $wrapper_attributes )." href='{$link}' target={$target}>{$text}</a>";
}
add_shortcode( 'button', 'add_button_shortcode' );
	
	?>