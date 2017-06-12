<?php
function add_button_shortcode( $atts ){
	global $qode_options_proya;
	$is_vc = (class_exists('Vc_Manager'))?true:false;
	$el_class = $width = $css = $offset = $output = $style = '';
	$args = array(
      'button_type'	=> '',
      'target' => '_self',
      'text'   => 'Learn More',
      'link'	=> '',
      'classes'	=> '',
      'text_align' => '',
      'css'	=> '',
      'button_id'	=> '',
      'button_align'	=> '',
      'color'			=> '',
      'use_google_font' => false
   );
   //print_r($atts);
   extract( shortcode_atts( $args, $atts ) );
   
   $vc_css = ($is_vc)?vc_shortcode_custom_css_class( $css ):null;
   $css_classes = array(
		'button',
		$button_type,
		$classes,
		$text_align,
		$vc_css, 
	); 
	if(isset($use_google_font) && $use_google_font != false){
		$google_fonts = explode('|',$atts['google_fonts']);
	    $font_family = explode('%3A', $google_fonts[0]);
	    $font_family = str_replace('font_family','font-family', $font_family[0]);
	    $font_family = str_replace('%20',' ',$font_family).';';
	    
	    $font_style = explode('%3A', $google_fonts[1]);
	    $font_style = str_replace('$font_style','font-style', $font_style[0]);
	    $font_style = str_replace('%20',' ',$font_style).';';
   
	    if($color != ";" || isset($font_family))
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
						$f_style = str_replace('regular','normal',$font_style[2]);    
					}
					else
					{
						$f_style = str_replace('regular','normal',$font_style[1]).';';
					}
					$fs = 'font-weight:'. str_replace('font_style:','',$font_style[0]).'; font-style:'.$f_style;    
			}
			
		    $style = "style='".$c." ".$ff." ".$fs."'";
		}
	}
  
	if ($is_vc && vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
		$css_classes[]='';
	}
	$wrapper_attributes = array();

	$css_class = ($is_vc)?preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), '.vc_custom_', $atts ) ):implode( ' ', array_filter( $css_classes ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
	
	if(isset($link)){
		$link = vc_build_link( $link );
		$link = $link['url'];
	} 
	
	$align_start = ($button_align != '')?'<div class="'.$button_align.'">':'';
	$align_end = ($button_align != '')?'</div>':'';
	return $align_start."<a ".implode( ' ', $wrapper_attributes )." id='{$button_id}' href='{$link}' target={$target} {$style}>{$text}</a>".$align_end;
}
add_shortcode( 'button', 'add_button_shortcode' );
	
	?>