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
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_class = $css = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'text-block ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$content = str_replace( '<img', '<amp-img layout="responsive" ', $content );
//$img['thumbnail'] = str_replace( '/>', '></amp-img> ', $img['thumbnail'] );
	
$output = '
	<div class="' . esc_attr( $css_class ) . '">
			' . wpb_js_remove_wpautop( $content, true ) . '
	</div>
';

echo $output;
