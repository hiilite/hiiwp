<?php


/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $content - shortcode content
 */


function add_hii_infinite_carousel_shortcode( $atts ){


$is_vc = (class_exists('Vc_Manager'))?true:false;
/*extract( shortcode_atts( array(
      'post_ids' => null,
      'show_title'	=> true,
      'show_excerpt'	=> true,
      'show_btn'	=> true,
      'btn_text' => __('Read More', 'hiiwp'),
      'css' => '',
    ), $atts ) );*/
    
    
WPBakeryShortCode_VC_Tta_Section::$self_count ++;
WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;
$isPageEditable = vc_is_page_editable();

/*if($atts['show_tab'] == 'yes')
{
	$show = 'show';	
}
else
{
	$show = 'hide';
}*/

$output = '';

$output .= '<div class="' . esc_attr( $this->getElementClasses() ) . '"';
$output .= ' id="' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '"';
$output .= ' data-vc-content=".vc_tta-panel-body">';
$output .= '<div class="vc_tta-panel-heading">';
$output .= $this->getTemplateVariable( 'heading' );
$output .= '</div>';
$output .= '<div class="vc_tta-panel-body ' . $show . '">';
if ( $isPageEditable ) {
	$output .= '<div data-js-panel-body>'; // fix for fe - shortcodes container, not required in b.e.
}
$output .= $this->getTemplateVariable( 'content' );
if ( $isPageEditable ) {
	$output .= '</div>';
}
$output .= '</div>';
$output .= '</div>';


echo $output;



}
add_shortcode( 'hii_infinite_carousel', 'add_hii_infinite_carousel_shortcode' );
?>