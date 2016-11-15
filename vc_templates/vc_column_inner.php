<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$el_class = $width = $css = $offset = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

/*if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_col-has-fill';
}*/

if ( ! empty( $align_item )) {
	$flex_row = true;
	$css_classes[] = ' item-align-' . $align_item;
	$test = '1';
}

if ( ! empty( $content_direction ) ) {
	$flex_row = true;
	$css_classes[] = ' row-o-direction-' . $content_direction;
}

if ( ! empty( $content_wrap ) ) {
	$flex_row = true;
	$css_classes[] = ' row-o-wrap-' . $content_wrap;
}

if ( ! empty( $justify_content ) ) {
	$flex_row = true;
	$css_classes[] = ' row-o-content-justify-' . $justify_content;
}

if ( ! empty( $v_align_w_content ) ) {
	$flex_row = true;
	$css_classes[] = ' row-o-content-align-w-' . $v_align_w_content;
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = ' row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = ' row-flex';
}
if ( ! empty( $bg_img_pos )) {
	$flex_row = true;
	$css_classes[] = ' bg-img-pos-' . $bg_img_pos;
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '">';
$output .= '<div class="wpb_wrapper';
if($is_flex){ $output .=' flex-container'; }
$output .='">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;
