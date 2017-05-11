<?php
$post_id = get_the_id();
$status = HiiDdfHelper::ddfCheckListingStatus(get_post_meta( $post_id, '@attributes-ID' , true), $post_id);
$classes = $cont = '';

// Add Lat Long if does not exist (fix for legacy listings that did not start with Lat Long)

if(get_post_meta( $post_id, 'Address-Latitude', true ) == ''){
	$data_arr = HiiDdf::geocode(get_the_title());
	if($data_arr){
		update_post_meta($post_id, 'Address-Latitude', $data_arr[0]);
		update_post_meta($post_id, 'Address-Longitude', $data_arr[1]);
	}
}

/************************************************/
/*Status*/
	    $terms = get_the_terms( get_the_id(), 'status' );
	    if(!empty($terms)){
			foreach ( $terms as $term ) {
	            $term_status = $term->name;
	            $classes .= $term_status;
	        }
	    }
		
		$cont .= '<article class="sr-details listing-full '.$classes.'"  itemscope itemtype="http://schema.org/Product">';
    
		if(has_post_thumbnail(get_the_id()) && $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' ))
			$cont .= '<link itemprop="image" href="'.$img[0].'">';
			
		 $title_html = get_the_title();
		 
		$cont .= '<h1 class="align-center col-12" itemprop="name">'.get_post_meta( $post_id, 'Address-StreetAddress', true ).'</h1>';
     
	    
	    
	    
	   
	    
	    $status_html = ( strtolower($status) == 'sold')?'<span class="sold_tag">Sold</span>':$status;
		$cont .= '<h5><p class="sr-details-links col-12 align-center">'.$status_html.' ('.get_post_meta( $post_id, 'ListingID' , true).')</p></h5>';
    
	   
		//////////////////
	    // photo gallery
	    ///////////////////
	    
		if($photos		= get_post_meta( get_the_id(), 'photos', 1 )) {
		
		$cont .= '<div class="sr-gallery" id="sr-fancy-gallery">';
                foreach( $photos as $photo ) {
	                $photo = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $photo );
                    $cont .= "<img src='$photo' data-title=''>";
                }
                $cont .= "</div>";
        }
	    /*Gallery*/

		$cont .= '<div class="container_inner">';
			
			$cont .= '<div class="col-9 text-block">';
			/* Price */
			    $price = get_post_meta( $post_id, 'Price', true );
				$price = (is_numeric($price))?number_format(get_post_meta( $post_id, 'Price', true ),0):$price;
			    $cont .= '<h1 class="" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><strong>$'.$price.'</strong><link itemprop="availability" href="http://schema.org/InStock" /></h1>';
			    $cont .= '<h2><strong>'.$title_html.'</strong></h2>';
		    
		    $cont .= '</div>';
		    
		    /*Share and more info button*/
		    $cont .= '<div class="col-3 text-block sr-primary-details">';
		    
		    	$cont .= '<a class="button primary-button large" href="#requestinfo">Request Information</a><br>';
		    	$cont .= '<span class="button listing_social_share">Share:'.do_shortcode( '[social-share fb=true gp=true tw=true pt=true]' ).'</span>';
		    
		    $cont .= '</div>';
	    
	    $cont .= '</div>';
	    
		/* Main Details Row */
		$cont .= '<div class="container_inner">';
			$cont .= '<aside class="col-6">';
				$cont .= '<div class="sr-primary-details text-block container_inner">';
		
		
	    	
		    	/* SQFT */
		    	if(get_post_meta( $post_id, 'Building-SizeInterior', true ) != '')
		    		$cont .= '<div class="sr-detail col-6" id="sr-primary-details-size"><strong>Size: </strong>'.get_post_meta( $post_id, 'Building-SizeInterior', true ) .'</div>'; 
		              
		        /* Beds */
		        if(get_post_meta( $post_id, 'Building-BedroomsTotal', true ) != '')
					$cont .= '<div class="sr-detail col-6" id="sr-primary-details-beds"><strong>Bedrooms: </strong> '.get_post_meta( $post_id, 'Building-BedroomsTotal', true ).'</div>';
		              
		        /* Baths */
		        if(get_post_meta( $post_id, 'Building-BathroomTotal', true ) != '')
		        	$cont .= '<div class="sr-detail col-6" id="sr-primary-details-baths"><strong>Bathrooms:</strong>'.get_post_meta( $post_id, 'Building-BathroomTotal', true ).'</div>'; 
		        
		        
		        /* Type */
		        if($subType = get_post_meta( $post_id, 'PropertyType', true ))
		        	$cont .= '<div class="sr-detail col-6" id="sr-primary-details-size"><strong>Type:</strong> '.$subType.'</div>'; 
		    
				$cont .= '</div>';
	    
		    	/* Remarks */
		    	$cont .= "<div class='text-block' itemprop='description'>".get_the_content( )."</div>";
	 
				/* TODO: Open Houses */
				
				/* TODO: Office */
				
		    	
				/* TODO: Agents */
				
			$cont .= '</aside>';

		    $cont .= "<aside class='col-6 text-block'>";
		    	$cont .= '<h2>Property Features</h2><div class="col-count-2">';
		    	foreach(HiiDdf::$BuildingKeys as $key) {
			    	
			    	if(($buildingValue = get_post_meta( $post_id, 'Building-'.$key, true )) && $buildingValue != ''){
				    	$str_key = preg_replace('/([A-Z])/', ' $1', $key);
				    	if(!is_array($buildingValue))
				    		$cont .= '<div class="sr-detail"><strong>'.$str_key.':</strong> '.$buildingValue.'</div>'; 
				    	elseif(is_array($buildingValue)){
					    	$cont .= '<div class="sr-detail"><strong>'.$str_key.':</strong> ';
					    	$comma = '';
					    	foreach($buildingValue as $subValue){
						    	$cont .= $comma.$subValue;
						    	$comma = ', ';
					    	}
					    	$cont .= '</div>';
				    	}
				    		
			    	}
		        		
						
		    	}
		    	$cont .= "</div><br>";
		    	
		    	/* TODO: Rooms */
		    	if(is_array(get_post_meta( $post_id, 'Building-Rooms', true ))){
			    	$cont .= '<h2>Rooms</h2><div class="col-count-2">';  
			    	foreach(get_post_meta( $post_id, 'Building-Rooms', true ) as $key) {
				    	if(!is_array($key['Dimension'])) $cont .= '<strong>'.$key['Type'].':</strong> '.$key['Dimension'].'<br>';	
			    	}
			    	$cont .= "</div><br>";
		    	}
		    	
		    	/* TODO: Parking */
		    	$parkingSpaces = null;
		    	if($parkingSpaces = get_post_meta( $post_id, 'ParkingSpaces-Parking', true ) && is_array($parkingSpaces)):
			    	$cont .= '<h3>Parking</h3><div class="col-count-2">';  	
			    	foreach($parkingSpaces as $key) {
				    	$cont .= '<strong>'.$key['Name'].':</strong> '.$key['Spaces'].'<br>';	
			    	}
			    	$cont .= "</div><br>";
		    	endif;
		    	/* TODO: Land */
		    	$cont .= '<h3>Land</h3><div class="col-count-2">';
		    	foreach(HiiDdf::$LandKeys as $key) {
			    	if(($landValue = get_post_meta( $post_id, 'Land-'.$key, true )) && $landValue != ''){
				    	$str_key = preg_replace('/([A-Z])/', ' $1', $key);
				    	if(!is_array($landValue))
				    		$cont .= '<div class="sr-detail"><strong>'.$str_key.':</strong> '.$landValue.'</div>'; 
				    	elseif(is_array($landValue)){
					    	$cont .= '<div class="sr-detail"><strong>'.$str_key.':</strong> ';
					    	$comma = '';
					    	foreach($landValue as $subValue){
						    	$cont .= $comma.$subValue;
						    	$comma = ', ';
					    	}
					    	$cont .= '</div>';
				    	}	
			    	}	
		    	}
		    	$cont .= "</div><br>";
		        		        	
		    $cont .= "</aside>";
	    
		$cont .= "</div>";
		$cont .= "<div class='container_inner'>";
		if(is_array(get_post_meta( $post_id, 'AgentDetails', true ))){
			$cont .= "<aside class='col-6 text-block'>";
			/* TODO: What to know more */
				$cont .= '<h2>What To Know More?</h2><p>Contact ';
				$i = 0;
				foreach(get_post_meta( $post_id, 'AgentDetails', true ) as $key) {
					if($i > 0) $cont .= '<br> or ';
					
					if(isset($key['Websites']) && is_array($key['Websites'])) {
						if(isset($key['Websites'][0]))$cont .= '<a href="'.$key['Websites'][0].'" target="_blank">';
					} else {
						if(isset($key['Websites']['Website']))$cont .= '<a href="'.$key['Websites']['Website'].'" target="_blank">';
					}
					
					
					
			    	if(isset($key['Position'])) $cont .= '<em>'.$key['Position'].'</em> ';
			    	
			    	$cont .= '<strong>'.$key['Name'].'</strong>';
			    	
			    	if(isset($key['Websites']))$cont .= '</a>';
			    	
			    	
			    	$cont .=' now ';	
					if(isset($key['Phones']) && is_array($key['Phones']['Phone'])){
						
						$cont .= 'at <strong><a href="tel:'.$key['Phones']['Phone'][0].'">'.$key['Phones']['Phone'][0].'</a></strong>';
					}
					elseif(isset($key['Phones']))
						$cont .= 'at <strong><a href="tel:'.$key['Phones']['Phone'].'">'.$key['Phones']['Phone'].'</a></strong>';

			    	
			    	$i++;
		    	}
			$cont .= " to learn more about this listing, or arrange a showing.</p></aside>";
			
			$cont .= "<aside class='col-6 text-block' id='requestinfo'>";
			/* TODO: contact */
				$cont .= '<h2>Contact Us About This Listing</h2>';
				$cont .= do_shortcode( '[gravityform id="1" title="false"]' );
			$cont .= "</aside>";
		}
		$cont .= "</div>";
		
    $cont .= "</div>
	    </article>";
echo $cont;


?>
