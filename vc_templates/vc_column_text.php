<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css_animation
 * @var $css
 * @var $el_id
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$white = $el_class = $css = $css_animation = $white_text = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if($white_text == 'yes') {
	$white = ' white';	
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$class_to_filter = 'text-block ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$class_to_filter .= $white;
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
	
$output = '
	<div '. implode( ' ', $wrapper_attributes ) .'>
			' . wpb_js_remove_wpautop( $content, true ) . '
	</div>
';

echo $output;
