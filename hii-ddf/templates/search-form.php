<?php
$cont = '<form id="ddf_search_form" action="'.home_url( '/' ).'">';
    	
$cont .= '<div class="ddf_form_section col-4">'.
			'<div class="ddf-search-field" id="ddf-search-keywords">'.
				'<input name="s" id="ddf_search_listings" type="search" placeholder="Enter your Keywords / Location" value="'.$s.'">'.
			'</div>';

$cont .= 	'<div class="ddf-search-field" id="ddf-search-PropertyType">
				<select name="type" id="type">'.
				'<option value="">Property Type</option>';
				foreach($property_options as $opt){
    				$selected = ($type == $opt)?'selected=selected':'';
    				$cont .= "<option value='$opt' $selected>$opt</option>";
				}
$cont .=		'</select>
			</div>
		</div>';

$cont .= '<div class="ddf_form_section">'.
			'<div class="ddf-search-field" id="ddf-search-minprice">'.
				'<input name="minprice" step="1000" min="0" type="number" placeholder="Min Price" value="'.$minprice.'">'.
			'</div>';
			
$cont .=	'<div class="ddf-search-field" id="ddf-search-maxprice">'.
				'<input name="maxprice" step="1000" min="0" type="number" placeholder="Max Price" value="'.$maxprice.'">'.
			 '</div>'.
		 '</div>';
		 
$cont .= '<div class="ddf_form_section">'.
			'<div class="ddf-search-field" id="ddf-search-minbeds">'.
				'<input name="minbeds" type="text" placeholder="Number of Beds" value="'.$minbeds.'">'.
			'</div>';
			
$cont .=	'<div class="ddf-search-field" id="ddf-search-minbaths">'.
				'<input name="minbaths" type="text" placeholder="Number of Baths" value="'.$minbaths.'">'.
			 '</div>'.
		 '</div>';
		 
$cont .= '<div class="ddf_form_section">'.
			'<div class="ddf-search-field" id="ddf-search-keywords">'.
				'<input name="submit" type="submit" value="Search">'.
				'<input type="hidden" name="post_type" value="listing">'.
			'</div>'.
		 '</div>';
		 
$cont .= '</div>';

$cont .='</form>';

echo $cont;
?>