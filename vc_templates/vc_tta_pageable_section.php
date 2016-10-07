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
 $post_id = get_the_id();
if(get_post_meta($post_id, 'amp', true) == 'nonamp'){
	$hiilite_options['amp'] = false;
} else {
	$hiilite_options['amp'] = (!isset($hiilite_options['amp']))?get_theme_mod('amp'):false;
}
if($hiilite_options['amp']) $_amp = ''; else $_amp = '';

$css = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );

WPBakeryShortCode_VC_Tta_Section::$self_count ++;
WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;

$isPageEditable = vc_is_page_editable();

$css = $atts['css'];
$link = wp_get_attachment_image_src( $atts['image'], 'full' );
$src = $link[0];
$slide_width = $link[1];
$slide_height = $link[2];

$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

$wrapper_attributes = array();
$wrapper_attributes[] = 'id="' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '"';

$css_classes[] = 'slide';
$css_classes[] = esc_attr( $this->getElementClasses() );

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';


$output = '';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<'.$_amp.'img src="'.$src.'" width="'.$slide_width.'" class="slider-background" height="'.$slide_height.'"  layout="responsive">';
$output .= ($_amp!='')?'</amp-img>':'';
$output .= '<div class="slide-text-overlay">
				';
$output .= $this->getTemplateVariable( 'content' );
$output .= '</div></div>';

echo $output;
