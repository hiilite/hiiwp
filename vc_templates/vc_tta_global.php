<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Accordion|WPBakeryShortCode_VC_Tta_Tabs|WPBakeryShortCode_VC_Tta_Tour|WPBakeryShortCode_VC_Tta_Pageable
 */
  $post_id = get_the_id();
if(get_post_meta($post_id, 'amp', true) == 'nonamp'){
	$hiilite_options['amp'] = false;
} else {
	$hiilite_options['amp'] = (!isset($hiilite_options['amp']))?get_theme_mod('amp'):false;
}
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';
$el_class = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
extract( $atts );

$this->setGlobalTtaInfo();

$this->enqueueTtaScript();

// It is required to be before tabs-list-top/left/bottom/right for tabs/tours
$prepareContent = $this->getTemplateVariable( 'content' );

$class_to_filter = $this->getTtaGeneralClasses();
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
if($_amp){
	$output = '<amp-carousel class="slider"
					  layout="responsive"
					  width="'.$atts['slider_width'].'"
					  height="'.$atts['slider_height'].'"
					  type="slides"';
	$output .= ($atts['autoplay'] != 'none')?' autoplay delay="'.$atts['autoplay'].'000">':'>';
	$output .= $prepareContent;
	$output .= '</amp-carousel>';
} else {
	$output = '<amp-carousel class="slider"
					  layout="responsive"
					  width="'.$atts['slider_width'].'"
					  height="'.$atts['slider_height'].'"
					  type="slides"';
	$output .= ($atts['autoplay'] != 'none')?' autoplay delay="'.$atts['autoplay'].'000">':'>';
	$output .= $prepareContent;
	$output .= '</amp-carousel>';
}

echo $output;
