<?php
	/* Title shortcode */

if (!function_exists('hii_title')) {
    function hii_title($atts, $content = null) {
        global $qode_options_proya;

        $args = array(
            "text"                      => "",
            "color"               		=> "",
            "size"                      => "h1"
        );

        extract(shortcode_atts($args, $atts));

        //init variables
        $html  = "";
        $button_styles  = "";


        if($color != ""){
            $button_styles .= 'class="'.$color.'" ';
        }

        $html .=  '<div class="text-block"><'.$size.' '.$button_styles.'>'.$text.'</'.$size.'></div>';

        return $html;
    }
}
add_shortcode('title', 'hii_title');
?>