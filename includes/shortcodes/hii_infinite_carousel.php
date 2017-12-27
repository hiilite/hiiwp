<?php


/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $content - shortcode content
 */


function add_hii_infinite_carousel_shortcode( $atts ){



$title = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'carousel wpb_content_element ' . $el_class . ' not-column-inherit', $this->settings['base'], $atts );


$output = '
	<div class="' . esc_attr( $css_class ) . '">
		<div class="wpb_infinite_carousel_wrapper">
			<div id="left_scroll"><img src="left.png" /></div> 
			 <div id="hii_carousel_inner">  
			 	<ul id="carousel_ul">  
			 		<li></li>
			 	</ul>
			 </div>
		
			<div id="right_scroll"><img src="right.png" /></div>  
' . wpb_js_remove_wpautop( $content ) . '
		</div>
	</div>
';









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



$slider_type = '';
$wrapper_attributes = array();
$css_classes = array(
	'slider',
	$atts['slider_type'],
);
if($atts['slider_full_height'] == true){
	$css_classes[] = 'slider_full_height';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );


if(isset($atts['shape']) && $atts['shape'] != '')
{
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . ' ' . $atts['shape'] . ' ' . $atts['c_align'] . '"';
}
else
{
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
}


$output = '<hii-infinite-carousel ' . implode( ' ', $wrapper_attributes ) . '
				  layout="responsive"
				  width="'.$atts['slider_width'].'"
				  height="'.$atts['slider_height'].'"
				  style="width:'.$atts['slider_width'].'px;
				  	height:'.$atts['slider_height'].'px;"
				  type="slides"';
$output .= ($atts['autoplay'] != 'none')?' autoplay delay="'.$atts['autoplay'].'000">':'>';
if(isset($atts['title']) && $atts['title'] != '')
{
	$output .= '<strong>'.$atts['title'].'</strong>';
}
$output .= $prepareContent;
$output .= '</hii-infinite-carousel>';








}
add_shortcode( 'hii_infinite_carousel', 'add_hii_infinite_carousel_shortcode' );
?>