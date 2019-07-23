<?php
	/* Title shortcode */

if (!function_exists('screen_showcase')) {
    function screen_showcase($atts, $content = null) {
        global $qode_options_proya;
		add_filter('custom_css', 'add_css');
		
		$el_class = $width = $css = $offset = ''; $output = '';
		
        $args = array(
	        "imac_image" 		=> "",
	        "macbook_image"		=> "",
	        "ipad_image" 		=> "",
	        "iphone_image"		=> "",
	        "css"  		=> "",
        );
        
        extract(shortcode_atts($args, $atts));
        //init variables
        $html  = "";
       
         
        // CUSTOM CSS BLOCK
		$css_classes = array(
			'hii_scrolling_screens',
			vc_shortcode_custom_css_class( $css ),
		);
		if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {$css_classes[]='';}
		$wrapper_attributes = array();
		$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) );
		$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
		// END CUSTOM CSS BLOCK
 
        $html .=  '<div ' . implode( ' ', $wrapper_attributes ) . '>';
		$html .= ($imac_image!='')?'<div class="imac_scrolling_screen screen">
			<img src="'.esc_url( get_template_directory_uri() ).'/images/icons/iMac.png">
			<div class="screen_area"></div>
		</div>':'';
		
		$html .= ($macbook_image!='')?'<div class="macbook_scrolling_screen screen">
			<img src="'.esc_url( get_template_directory_uri() ).'/images/icons/Macbook.png">
			<div class="screen_area"></div>
		</div>':'';
		
		$html .= ($ipad_image!='')?'<div class="ipad_scrolling_screen screen">
			<img src="'.esc_url( get_template_directory_uri() ).'/images/icons/iPad.png">
			<div class="screen_area"></div>
		</div>':'';
		
		$html .= ($iphone_image!='')?'<div class="iphone_scrolling_screen screen">
			<img src="'.esc_url( get_template_directory_uri() ).'/images/icons/iPhone.png">
			<div class="screen_area"></div>
		</div>':'';
	
	$html .= '</div>';

        return $html;
    }
}
add_shortcode('screen-showcase', 'screen_showcase');
?>