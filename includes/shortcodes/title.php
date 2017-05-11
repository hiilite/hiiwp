<?php
	/* Title shortcode */

if (!function_exists('hii_title')) {
    function hii_title($atts, $content = null) {
        global $qode_options_proya;
        
		$is_vc = (class_exists('Vc_Manager'))?true:false;
		$html = $maxw = $c = $ff = $button_styles = $fs = $el_class = $width = $css = $offset = $font_container_data = $font_family = $font_style = $f_style = $output = '';
        $args = array(
	        "text" 		=> "",
	        "color"		=> "",
	        "tag" 		=> "h1",
	        "size"		=> "",
	        "css"  		=> "",
	        "align"		=> "",
	        "link"		=> "",
	        "class"		=> "",
	        "id"		=> "",
	        "font_container" => "",
	        "max_width"	=> ""
        );
        

        extract(shortcode_atts($args, $atts));
        //init variables
		
        $font_container = isset($atts['font_container'])?explode('|',$atts['font_container']):null;
        $tag = str_replace('tag:','',$font_container[0]);
        if((!isset($tag) || $tag == NULL) && isset($size))
        {
	        $tag = $size;
	    }
        $size = $tag;
        
        $color = (isset($font_container[1]))?str_replace('%23','#',$font_container[1]).';':';';
        
        if(isset($atts['google_fonts'])) {
	        $google_fonts = explode('|',$atts['google_fonts']);
	        $font_family = explode('%3A', $google_fonts[0]);
	        $font_family = str_replace('font_family','font-family', $font_family[0]);
	        $font_family = str_replace('%20',' ',$font_family).';';
	        
	        $font_style = explode('%3A', $google_fonts[1]);
	        $font_style = str_replace('$font_style','font-style', $font_style[0]);
	        $font_style = str_replace('%20',' ',$font_style).';';
        }
		$vc_css = ($is_vc)?vc_shortcode_custom_css_class( $css ):null;
		$css_classes = array(
			'text-block',
			$align,
			$vc_css, 
		);

		if ($is_vc && vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
			$css_classes[]='';
		}
		$wrapper_attributes = array();

		$css_class = ($is_vc)?preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) ):implode( ' ', array_filter( $css_classes ) );
		$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
		

        if($class != ""){
	        $css_class = $css_class.' '.$class;
        }
        
		$html .= $font_container_data;
		if(isset($atts['max_width'])){ $maxw = ' style="max-width:'.$atts['max_width'].';"';}
        $html .=  '<div ' . implode( ' ', $wrapper_attributes ) . $maxw. '>';
        
        if($link != "")
        {
	    	$html .= '<a href="'.$link.'">';    
	    }
	    
	    if($color != ";" || $font_family != ";")
	    {
		    if($color != ";")
		    {
				$c = $color;    
			}
			if($font_family != ";")
		    {
				$ff = $font_family;    
			}
			if($font_style != ";")
		    {
			    $font_style = explode(' ',$font_style);
			    if(isset($font_style[2]))
			    {
					$f_style = 'font-style:'.str_replace('regular','normal',$font_style[2]);    
				}
				elseif(isset($font_style[1]))
				{
					$f_style = 'font-style:'.str_replace('regular','normal',$font_style[1]).';';
				}
				$fs = 'font-weight:'. str_replace('font_style:','',$font_style[0]).'; '.$f_style;   
			}
			
		}
		
	    $style = " style='".$c.$ff.$fs."'";
	    
        $html .= '<'.$size.$style.'>'.$text.'</'.$size.'></div>';
		
		if($link != "")
        {
	    	$html .= '</a>';    
	    }
	    
        return $html;
    }
}
add_shortcode('title', 'hii_title');
?>