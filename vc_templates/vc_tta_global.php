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

$el_class = $css = '';
$shortcode_type =  $this->getShortcode();
$atts = vc_map_get_attributes( $shortcode_type, $atts );
$this->resetVariables( $atts, $content );
extract( $atts );

$this->setGlobalTtaInfo();
$this->enqueueTtaStyles();
$this->enqueueTtaScript();


// It is required to be before tabs-list-top/left/bottom/right for tabs/tours
$prepareContent = $this->getTemplateVariable( 'content' );

$class_to_filter = $this->getTtaGeneralClasses();
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_classes = array(
				'slider',
				$class_to_filter
			);

switch($shortcode_type){
	case 'vc_tta_pageable':
		
		
			$slider_type = '';
			$wrapper_attributes = array();
			
			
			/* Arrow & Bullet Attributes*/
			$data_attributes_str = '';
			$data_attributes = array(
				'show_arrows'	=> $atts['show_arrows'],
				'arrow_icon' 	=> $atts['arrow_icon'],
				'hide_arrows_on_mobile'	=> $atts['hide_arrows_on_mobile'],
				'arrow_size' 	=> $atts['arrow_size'],
				'arrow_background_type' 	=> $atts['arrow_background_type'],
				'arrow_color' 	=> $atts['arrow_color'],
				'arrow_background_color' 	=> $atts['arrow_background_color'],
				'show_bullets' 	=> $atts['show_bullets'],
				'bullet_color' 	=> $atts['bullet_color'],
				'slider_min_height' => $atts['slider_min_height']
			);
			
			$atts['slider_min_height'] = (is_numeric($atts['slider_min_height']))?$atts['slider_min_height'].'px':$atts['slider_min_height'];
			
			foreach($data_attributes as $key=>$value) {
				$data_attributes_str .= "data-$key='$value' ";
			}
			$wrapper_attributes[] = $data_attributes_str;
			
			if($atts['slider_full_height'] == true){
				$css_classes[] = 'slider_full_height';
			}
			$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
			
			
			if(isset($atts['shape']) && $atts['shape'] != '') {
				$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . ' ' . $atts['shape'] . ' ' . $atts['c_align'] . '"';
			} else {
				$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
			}
			
			
			$output = '<amp-carousel ' . implode( ' ', $wrapper_attributes ) . ' layout="responsive" width="'.$atts['slider_width'].'" style="width:'.$atts['slider_width'].'px; min-height:'.$atts['slider_min_height'].';" type="slides"';
			$output .= ($atts['autoplay'] != 'none')?' autoplay delay="'.$atts['autoplay'].'000">':'>';
			if(isset($atts['title']) && $atts['title'] != '')
			{
				$output .= '<strong>'.$atts['title'].'</strong>';
			}
			$output .= $prepareContent;
			$output .= '</amp-carousel>';
		
	break;

//////////////////////////////////////////////////////
	
	default:
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

		$output = '<div ' . $this->getWrapperAttributes() . '>';
		$output .= $this->getTemplateVariable( 'title' );
		$output .= '<div class="' . esc_attr( $css_class ) . '">';
		$output .= $this->getTemplateVariable( 'tabs-list-top' );
		$output .= $this->getTemplateVariable( 'tabs-list-left' );
		$output .= '<div class="vc_tta-panels-container">';
		$output .= $this->getTemplateVariable( 'pagination-top' );
		$output .= '<div class="vc_tta-panels">';
		$output .= $prepareContent;
		$output .= '</div>';
		$output .= $this->getTemplateVariable( 'pagination-bottom' );
		$output .= '</div>';
		$output .= $this->getTemplateVariable( 'tabs-list-bottom' );
		$output .= $this->getTemplateVariable( 'tabs-list-right' );
		$output .= '</div>';
		$output .= '</div>';
	break;
}



echo __hii($output); // WPCS: XSS ok.
