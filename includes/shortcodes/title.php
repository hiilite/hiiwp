<?php
	/* Title shortcode */

if (!function_exists('hii_title')) {
    function hii_title($atts, $content = null) {
        global $qode_options_proya;

		$el_class = $width = $css = $offset = ''; $output = '';
        $args = array(
	        "text" 		=> "",
	        "color"		=> "",
	        "size" 		=> "h1",
	        "css"  		=> "",
	        "align"		=> ""
        );

        extract(shortcode_atts($args, $atts));
        //init variables
        $html  = "";
        $button_styles  = "";

		$css_classes = array(
			'text-block',
			$align,
			vc_shortcode_custom_css_class( $css ), 
		);

		if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
			$css_classes[]='';
		}
		$wrapper_attributes = array();

		$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) );
		$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
		

        if($color != ""){
            $button_styles .= 'class="'.$color.'" ';
        }

        $html .=  '<div ' . implode( ' ', $wrapper_attributes ) . '><'.$size.' '.$button_styles.'>'.$text.'</'.$size.'></div>';

        return $html;
    }
}
add_shortcode('title', 'hii_title');
?>