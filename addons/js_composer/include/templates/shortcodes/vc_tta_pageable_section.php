<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Section
 */
//add_action('custom_css', 'add_custom_css');
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
WPBakeryShortCode_VC_Tta_Section::$self_count ++;
WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;
$isPageEditable = vc_is_page_editable();

$link = wp_get_attachment_image_src( $atts['image'], 'full' );
$src = $link[0];
$slide_width = $link[1];
$slide_height = $link[2];





$output = '';

$output .= '<div class="slide ' . esc_attr( $this->getElementClasses() ) . '"';
$output .= ' id="' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '">';
$output .= '<amp-img src="'.$src.'" width="'.$slide_width.'" height="'.$slide_height.'"></amp-img>';
$output .= '<div class="slide-text-overlay">
				';
$output .= $this->getTemplateVariable( 'content' );
$output .= '</div></div>';

echo $output;
