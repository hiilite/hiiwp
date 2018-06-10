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
$white = $el_class = $css = $css_animation = $white_text = $icon_html = $icon_html_start = $icon_html_end = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( shortcode_atts( array(
	'icon'			=> false,
	'icon_position'	=> 'top',
	'icon_size'		=> 'small',
	'icon_color'	=> '#c3c3c3',
	'icon_align'	=> 'center',
	'white_text'	=> false
   ), $atts ) );
   
if($white_text == 'yes') {
	$white = ' white';	
}

//print_r($atts);
$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}


$class_to_filter = 'text-block ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$class_to_filter .= $white;


if (!empty($icon)){
	$icon_html = "<div class='text-block-icon align-{$icon_align}'><i class='{$icon} {$icon_size}' style='color:{$icon_color};'> </i></div>";
	$class_to_filter .= " with-icon icon-{$icon_position}";
	$icon_html_start = "<div class='with-icon-text'>";
	$icon_html_end = '</div>';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
	
$output = '<div '. implode( ' ', $wrapper_attributes ) .'>';
$output .= $icon_html;
$output .= $icon_html_start.wpb_js_remove_wpautop( $content, true ).$icon_html_end;
$output .= '</div>';

echo $output; // WPCS: XSS ok.
