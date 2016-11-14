<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$hiilite_options['amp'] = get_theme_mod('amp');
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );


$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'row',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') ) || $video_bg || $parallax) {
	$css_classes[]='vc_row-has-fill';
}

if ($parallax) {
	$css_classes[]='vc_row-parallax';
}

if (!empty($atts['gap'])) {
	$css_classes[] = 'vc_column-gap-'.$atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'row-no-padding';
	}
	$after_output .= '<div class="row-full-width"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = ' row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = ' vc_row-o-columns-' . $columns_placement;
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = ' row-o-equal-height';
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
if ( ! empty( $background_palette )) {
	$css_classes[] =  ' '.$background_palette;
}
if ( ! empty( $align_item )) {
	$flex_row = true;
	$css_classes[] = ' item-align-' . $align_item;
	$test = '1';
}

$css_classes[] = 'flex-item';

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<section ' . implode( ' ', $wrapper_attributes ) . '>';

if($parallax_image){
	$para_img = wp_get_attachment_image_src($parallax_image,'large');
	$output .= '<amp-img src="'.$para_img[0].'"  width="'.$para_img[1].'" height="'.$para_img[2].'" class="parallax-image"></amp-img>';
}

$output .= '<div class="container_inner">';
$output .= (!empty($atts['in_grid']) && ($hiilite_options['subdomain'] != 'iframe' && empty($atts['in_iframe'])))?'<div class="in_grid">':'';

if(!empty($atts['in_iframe']) && $hiilite_options['subdomain'] != 'iframe' && $hiilite_options['amp']){
	$output .= !empty($atts['in_iframe'])?'<div class="iframe-content">':'';
	$output .= '<amp-iframe src="https://iframe.'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"].'" frameborder="0" height="75vh" width="100vw" sandbox="allow-scripts allow-same-origin allow-forms allow-top-navigation allow-popups"></amp-iframe>';
	$output .= !empty($atts['in_iframe'])?'</div>':'';

} elseif($hiilite_options['subdomain'] == 'iframe' && !empty($atts['in_iframe']) ) {
	$output .= '<div class="container_inner">';
	$output .= !empty($atts['in_grid'])?'<div class="in_grid">':'';
	$output .= wpb_js_remove_wpautop( $content );
	$output .= '</div>';
	$output .= '</div>';
} elseif($hiilite_options['subdomain'] == 'iframe' && empty($atts['in_iframe'])) {
	$output .= '<div class="container_inner">';
	$output .= !empty($atts['in_grid'])?'<div class="in_grid">':'';
	$output .= wpb_js_remove_wpautop( $content );
	$output .= '</div>';
	$output .= '</div>';
} else {
	$output .= wpb_js_remove_wpautop( $content );
}
$output .= (!empty($atts['in_grid']) && ($hiilite_options['subdomain'] != 'iframe' && empty($atts['in_iframe'])))?'</div>':'';
$output .= '</div></section>';
$output .= $after_output;

echo $output;
