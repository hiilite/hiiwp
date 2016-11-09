<?php
	/* Calculations shortcode */

if (!function_exists('hii_calculation_table')) {
    function hii_calculation_table($atts, $content = null) {
        global $qode_options_proya;

		$el_class = $width = $css = $offset = ''; $output = '';
        $args = array(
	        "css"  		=> "",
        );
        
        extract(shortcode_atts($args, $atts));
        //init variables
        $listings = vc_param_group_parse_atts( $atts['listings'] );
        $html  = "";
		
		$css_classes = array(
			'calculation_table',
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

        $html .=  '<div ' . implode( ' ', $wrapper_attributes ) . '>';
		
		$sold_avg = 0;
		foreach($listings as $listing){
			$sold_avg = $sold_avg + (int)str_replace(',','',$listing['sold']);
			$dom_avg = $dom_avg + (int)$listing['dom'];
			$sqft_avg = $sqft_avg + (int)str_replace(',','',$listing['sqft']);
			$listinghtml .= '<tr>
						<td>'.$listing['home_style'].'</td>
						<td>'.$listing['beds'].'</td>
						<td>'.$listing['baths'].'</td>
						<td>'.$listing['sqft'].'</td>
						<td>$ '.$listing['sold'].'</td>
						<td>'.$listing['dom'].'</td>
					</tr>';
			$i++;
		}
		$sold_avg = $sold_avg / $i;
		$html .='<div class="databox"><div class="label">AVERAGE SOLD PRICE</div><div class="maindata"><sup>$</sup>'.number_format($sold_avg).'</div></div>';
		$sqft_avg = $sqft_avg / $i;
		$html .='<div class="databox"><div class="label">AVERAGE APPROX. SQ. FT.</div><div class="maindata">'.number_format($sqft_avg).'</div></div>';

		$dom_avg = $dom_avg / $i;
		$html .='<div class="databox"><div class="label">AVERAGE DAYS ON MARKET</div><div class="maindata">'.round($dom_avg,2).'</div></div>';

		
		$html .= '<div class="datatable_container"><table class="datatable"><thead><tr><th>Style</th><th>Beds</th><th>Baths</th><th>Sq. Ft.</th><th>Sold $</th><th>DOM</th></tr></thead><tbody>';
		$html .= $listinghtml;
		$html .='</tbody></table></div>';
		
		$html .= '</div>';
        return $html;
    }
}
add_shortcode('calculation_table', 'hii_calculation_table');
?>