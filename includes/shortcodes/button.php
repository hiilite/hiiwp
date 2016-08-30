<?php
function add_button_shortcode( $atts ){
	global $qode_options_proya;

	$el_class = $width = $css = $offset = $output = $style = '';
	$args = array(
      'button_type'	=> '',
      'target' => '_self',
      'text'   => 'Learn More',
      'link'	=> '',
      'classes'	=> '',
      'text_align' => '',
      'css'	=> '',
      'button_id'	=> '',
      'button_align'	=> '',
   );
//   print_r($atts);
   extract( shortcode_atts( $args, $atts ) );
   
   $css_classes = array(
		'button',
		$button_type,
		$classes,
		$text_align,
		vc_shortcode_custom_css_class( $css ), 
	); 
  
	if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='';
	}
	$wrapper_attributes = array();

	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) );
	
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
	$align_start = ($button_align != '')?'<div class="'.$button_align.'">':'';
	$align_end = ($button_align != '')?'</div>':'';
	return $align_start."<a ".implode( ' ', $wrapper_attributes )." id='{$button_id}' href='{$link}' target={$target}>{$text} {$style}</a>".$align_end;
}
add_shortcode( 'button', 'add_button_shortcode' );
	
	?>