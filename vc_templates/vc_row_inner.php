<?php
/**
 * VC Row Inner
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2019, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0.2
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
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
 * @var $row_visibility
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $grid_left = $grid_right = $row_visibility = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if( ( $row_visibility === 'in' && !is_user_logged_in() ) || ( $row_visibility === 'out' && is_user_logged_in() ) ):	
	/* Do Nothing */
else:	
	
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
	
	if ($grid_left == 'yes') {
		$css_classes[]='grid-left';
	}
	if ($grid_right == 'yes') {
		$css_classes[]='grid-right';
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
		/*if ( ! empty( $columns_placement ) ) {
			$flex_row = true;
			$css_classes[] = ' vc_row-o-columns-' . $columns_placement;
		}*/
	}
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = ' vc_row-o-columns-' . $columns_placement;
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
	}
	if ( ! empty( $bg_img_pos )) {
		$flex_row = true;
		$css_classes[] = ' bg-img-pos-' . $bg_img_pos;
	}
	
	
	
	$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
	if(!empty($atts['row_height']))$wrapper_attributes[] = 'style="min-height:' . $atts['row_height'] . '"';
	
	$para = '';
	if($parallax){
		$para = "style='background-attachment:fixed;'";
	}
	
	$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' '.$para.'>';
	
	
	$output .= '<div class="container_inner">';
	$output .= (!empty($atts['in_grid']))?'<div class="in_grid">':'';
	
	$output .= wpb_js_remove_wpautop( $content );
	
	$output .= (!empty($atts['in_grid']) )?'</div>':'';
	$output .= '</div></div>';
	$output .= $after_output;
endif;
echo __hii($output); // WPCS: XSS ok.
