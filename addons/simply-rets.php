<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
//////////////////////
//
//	get_listing_template
//
//////////////////////

function get_listing_template($listing, $size, $type){
	global $wp_embed;
	
	$cont = "";
    
	/*
	 *	Check if the listing is pulling from RETS or a Wordpress post
	 *	If its not RETS, map all fields to match RETS counterpart
	*/
	
	$ret = ($type == 'rets')?true:false;
	if(!$ret){
		$object = new stdClass();
		foreach ($listing as $key => $value)
		{
			if(strpos($key, '-') !== false) {
				list($key1, $key2) = explode('-', $key);
				if(!isset($object->$key1)) { 
					$object->$key1 = new stdClass();
					$object->$key1->$key2 = $value[0];
				} else {
					$object->$key1->$key2 = $value[0];
				}
				
			} elseif(is_array($value)) {
			    $object->$key = $value[0];
			} else {
				$object->$key = $value;
			}
		}
		$listing = $object;
	}
	
    
    // Get Contact Form
    $contact_page = ($ret)?get_option('sr_contact_page'):'';

    
    /*
     * check for an error code in the array first, if it's
     * there, return it - no need to do anything else.
     * The error code comes from the UrlBuilder function.
    */
    if($listing == NULL
       || array_key_exists("error", $listing)
       || array_key_exists("errors", $listing)) {
        $err = SrMessages::noResultsMsg((array)$listing);
        return $err;
    }

	/*
     * 
     * Set all properties
     * 
    */
    // internal unique id
    $listing_uid = $listing->mlsId;
    $listing_price = $listing->listPrice;
    $listing_price_USD = '<span itemprop="priceCurrency" content="CAD">$</span><span itemprop="price" content="'.tofloat($listing_price).'"> '.number_format( tofloat($listing_price) ).'</span>';
    
    // type
    $subType = $listing->property->subType;
    if	($subType == 'SingleFamilyResidence')	$subType = 'House';
    elseif	($subType == 'Apartment')			$subType = 'Condo';
    
    $listing_bedrooms = $listing->property->bedrooms;
    $listing_bathsFull = $listing->property->bathsFull;
    $listing_bathsHalf = $listing->property->bathsHalf;
    $listing_bathsTotal = ($listing->property->bathrooms != '')?$listing->property->bathrooms:($listing->property->bathsFull + $listing->property->bathsHalf);
    $listing_stories = $listing->property->stories;
    $listing_fireplaces = $listing->property->fireplaces;
    $listing_longitude = $listing->geo->lng;
    $listing_lat = $listing->geo->lat;
    $listing_mlsarea = $listing->mls->area;
    $listing_taxamount = '$' . number_format( tofloat($listing->tax->taxAnnualAmount),2 );
    $listing_taxyear = $listing->tax->taxYear;
    $listing_roof = $listing->property->roof;
    $listing_style = $listing->property->style;
    $listing_mls_status     = $listing->mls->status; // mls information ex: Active
    $listing_interiorFeatures = $listing->property->interiorFeatures;
    $listing_exteriorFeatures = $listing->property->exteriorFeatures;
    $listing_yearBuilt = $listing->property->yearBuilt;
    $listing_rentalRestrictions = $listing->property->rentalRestrictions;
    $listing_mlsid = $listing->listingId; // listing id (MLS #)
    $listing_heating = $listing->property->heating;
    $listing_foundation = $listing->property->foundation;
    $listing_laundry = $listing->property->laundryFeatures;
    $listing_lot_descrip = $listing->property->lotDescription;
    $listing_rooms = $listing->property->additionalRooms;
    $listing_view = $listing->property->view;
    $listing_balconyPatio = $listing->property->balconyPatio;
    $listing_accessibility = $listing->property->accessibility;
    $listing_water = $listing->property->water;
    $listing_disclaimer  = $listing->disclaimer;
    
    $listing_list_date = $listing->listDate;
    if($listing_list_date) { $list_date_formatted = date("M j, Y", strtotime($listing_list_date)); }
    
    $listing_modified = $listing->modified; // listing date modified
    if($listing_modified) { $date_modified = date("M j, Y", strtotime($listing_modified)); }

    $listing_lotSize = $listing->property->lotSize;
    $listing_lotSizeArea = $listing->property->lotSizeArea;
    $listing_lotSizeAreaUnits = $listing->property->lotSizeAreaUnits;
    $listing_acres = $listing->property->acres;
    
    /*
	 * ADDRESS   
	 */
    $listing_unit = ($listing->address->unit != '')?$listing->address->unit.' - ':'';
    $listing_subdivision = $listing->property->subdivision; // subdivision ex: Downtown VW
    $listing_postal_code = $listing->address->postalCode;
    $listing_country = $listing->address->country;
    $listing_address = $listing->address->full;
    $listing_city = $listing->address->city;
    $listing_cross_street = $listing->address->crossStreet;
    $listing_state = $listing->address->state;

    $listing_terms = $listing->terms;
    $listing_lease_term = $listing->leaseTerm;
    $listing_lease_type = $listing->leaseType;
   
    $listingVituralTourUrl = $listing->virtualTourUrl;
    
    $listing_maintenanceExpense =  ($listing->property->maintenanceExpense)?'$' . number_format( tofloat($listing->property->maintenanceExpense), 2 ):'';

	$listing_parking_description = $listing->property->parking->description;
    
    // area
    $area = $listing->property->area == 0
          ? 'n/a'
          : number_format($listing->property->area);


    // Determine the best field to show in the primary-details section
    $primary_baths = "";
    if(is_numeric($listing_bathsTotal)) {
        $primary_baths = $listing_bathsTotal + 0; // strips extraneous decimals
    } elseif(!empty($listing_bathsFull)) {
        $primary_baths = $listing_bathsFull;
    } else {
        $primary_baths = 'n/a';
    }

    if( $listing_bedrooms == null || $listing_bedrooms == "" ) $listing_bedrooms = 0;
    if( $listing_bathsFull == null || $listing_bathsFull == "" ) $listing_bathsFull = 0;

	///////////////////
    // Room Dimensions
    ///////////////////
    $roomsMarkup = '';
	if(isset($listing->property->rooms)):
	    if(is_array($listing->property->rooms)) {
		   $rooms = $listing->property->rooms;
		} else {
			$rooms = unserialize($listing->property->rooms);
		}
	    usort($rooms, function ($a, $b) {
	        return (is_null($a->level) OR $a->level == "") ? 1 : -1;
	    });
	    $roomsMarkup .= count($rooms) < 1 ? "" : "<table class='show_listing_table' width='100%'>
	      <thead>
	        <tr>
	          <th colspan=\"2\"><h5>Room Dimensions</h5></th></tr></thead><tbody>";
	
	    foreach($rooms as $room) {
			$room = (object) $room;
	        if(!is_null($room->dimensions)) {
	            $roomSize = $room->dimensions;
	        } else {
	            $roomSize = "$room->length" .  " x " . "$room->width";
	        }
	        
	        $roomsMarkup .= "<tr class='specrow'><td class='specname'>$room->type: </td><td class='specvalue'>$room->dimensions </td></tr>";
	    }
	    $roomsMarkup .= count($rooms) < 1 ? "" : "</tbody></table>";
    endif;
    
    
    ///////////////////
    // Building Details
    ///////////////////
    
    $associationMarkup = '';
    if(isset($listing->association->name)):		
   
	    $associationMarkup .= "<table class='show_listing_table' width='100%'>
	      <thead>
	        <tr>
	          <th colspan=\"2\"><h5>Building Details</h5></th></tr></thead><tbody>";
	
	    $fees = isset($listing->association->fee)?'$'.$listing->association->fee:$listing_maintenanceExpense;
	    $amenities = isset($listing->association->amenities)?$listing->association->amenities:'';
	    $bname = isset($listing->association->name)?$listing->association->name:'';
	    $associationMarkup .= "<tr class='specrow'><td class='specname'>Building: </td><td class='specvalue'>$bname </td></tr>";
	    $associationMarkup .= ($fees!='')?"<tr class='specrow'><td class='specname'>Fees: </td><td class='specvalue'>$fees </td></tr>":'';
	    $associationMarkup .= ($amenities!='')?"<tr class='specrow'><td class='specname'>Amenities: </td><td class='specvalue'>$amenities </td></tr>":'';
	    
	    $associationMarkup .= "</tbody></table>";
    endif;
    
	
	///////////////////
    // photo gallery
    ///////////////////
    if(!$ret) {
	    $photos		= get_post_meta( get_the_id(), 'photos', 1 );
	} else {
		$photos     = $listing->photos;
	}
	$photo_gallery  = SimplyRetsApiHelper::srDetailsGallery( $photos );
    $gallery_markup = $photo_gallery['markup'];
    $more_photos    = $photo_gallery['more'];
    $dummy          = RETSURL. 'assets/img/defprop.jpg';
    !empty($photos) ? $main_photo = array_values($photos)[0] : $main_photo = $dummy;


	//////////////////
	// floor plan
	/////////////////
	$floorplan     = isset($listing->floorplan)?$listing->floorplan:false;
	
	
    // school data
    $listing_school_district = $listing->school->district;
    $listing_elementary = $listing->school->elementarySchool;
    $listing_middle_school = $listing->school->middleSchool;
    $listing_high_school = $listing->school->highSchool;

    if($listing_school_district
       || $listing_elementary
       || $listing_middle_school
       || $listing_high_school
    ) {
        $school_data = <<<HTML
          <thead>
            <tr>
              <th colspan="3"><h5>School Information</h5></th></tr></thead>
          <tbody>
          $school_district
          $school_elementary
          $school_middle
          $school_high
          </tbody>
HTML;
    } else {
        $school_data = "";
    }

    if( get_option('sr_show_listing_remarks') ) {
        $show_remarks = false;
    } else {
        $show_remarks = true;
        $remarks = (!$ret)?wpautop(get_the_content()):wpautop($listing->remarks);
        $remarks_markup = <<<HTML
        <div class="sr-remarks-details">
          $remarks
        </div>
HTML;
    }

    if( get_option('sr_show_leadcapture') ) {
        $contact_text = 'Contact us about this listing';
        $cf_listing = $listing_address . ' ( MLS #' . $listing_mlsid . ' )';
        $contact_markup = SimplyRetsApiHelper::srContactFormMarkup($cf_listing);
    } else {
        $contact_text = '';
        $contact_markup = '';
    }


    /**
     * Check for ListHub Analytics
     */
    if( get_option( 'sr_listhub_analytics' ) ) {
        $lh_analytics = SimplyRetsApiHelper::srListhubAnalytics();
        if( get_option( 'sr_listhub_analytics_id' ) ) {
            $metrics_id = get_option( 'sr_listhub_analytics_id' );
            $lh_send_details = SimplyRetsApiHelper::srListhubSendDetails(
                $metrics_id
                , true
                , $listing_mlsid
                , $postal_code
            );
            $lh_analytics .= $lh_send_details;
        }
    } else {
        $lh_analytics = '';
    }

    ///////////////////////////////////////////////////////

    $show_contact_info = SrUtils::showAgentContact();

    // agent data
    $listing_agent_id    = $listing->agent->id;
    $listing_agent_name  = $listing->agent->firstName . ' ' . $listing->agent->lastName;

    $listing_agent_email;
    if($show_contact_info) {
        $listing_agent_email = $listing->agent->contact->email;
    } else {
        $listing_agent_email = '';
    }

    // agent email is available
    $agent_email = trim($listing_agent_email);
    if(!empty($agent_email)) {
        $listing_agent_name = "<a href='mailto:$listing_agent_email'>$listing_agent_name</a>";
    }
    //agent name is not available - use their id
    $agent_name = trim($listing_agent_name);
    if(empty($agent_name)) {
        $listing_agent_name = $listing_agent_id;
    }

    $agent = SimplyRetsApiHelper::srDetailsTable($listing_agent_name, "Listing Agent");

	///////////////
    // Office
	///////////////
    $listing_office = $listing->office->name;
    
    $listing_office_phone = $listing->office->contact->office;

    $listing_office_email = $listing->office->contact->email;

    if(!$show_contact_info) {
        $officePhone = '';
        $officeEmail = '';
    }

    /////////////////////////////////////////////////////

    $galleria_theme = RETSURL.'assets/galleria/themes/classic/galleria.classic.min.js';

	//////////////////////////////////////
    // Build details link for map marker
    /////////////////////////////////////
    if($ret){
	    $link = SrUtils::buildDetailsLink(
	        $listing,
	        !empty($vendor) ? array("sr_vendor" => $vendor) : array()
	    );
    } else {
	   
	    $link = $listing->link;
    }

    $addrFull = $address . ', ' . $city . ' ' . $zip;
    
    
     /* TITLE AREA */
    $listing_mlsid_html = ($listing_mlsid != '')?$listing_mlsid_html = ' ('.$listing_mlsid.')':'';
    $title_html = ($listing_address != '' || $listing_subdivision != '' && $listing_city != '')?$listing_unit.' '.$listing_address.' '. $listing_subdivision.', '.$listing_city.$listing_mlsid_html:get_the_title();
    
    /*Status*/
    $terms = get_the_terms( get_the_id(), 'status' );
    if(!empty($terms)){
		foreach ( $terms as $term ) {
            $term_status = $term->name;
            $additional_class .= $term->slug;
        }
    }
    if(isset($term_status))$status = $term_status;
	elseif((strtotime($listing->listDate) < strtotime('1 week ago')) && (strtolower($status) != 'sold')) $status = 'Just Listed';
    elseif(isset($listing->mls->area)) $status = $listing->mls->area;
    else $status = $listing->mls->status;
    
    $status_html = ( strtolower($status) == 'sold')?'<div class="sold_tag">Sold</div>':$status;
    
    
    
    /********************************
	 *
	 * BUILD TEMPLATE 
	 *
	 ********************************/
    // full, small, tiny
    switch ($size){
	    case 'full':
		/************************************************/
		$cont .= '<article class="sr-details"  itemscope itemtype="http://schema.org/Product">
    		<input type="hidden" value="$listing_uid">';
    
		if(has_post_thumbnail(get_the_id()) && $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' ))
			$cont .= '<link itemprop="image" href="'.$img[0].'">';

		$cont .= '<h1 class="align-center col-12" itemprop="name">'.$title_html.'</h1>';
    
	    /* Price */
	    $cont .= '<h4 class="align-center col-12" itemprop="offers" itemscope itemtype="http://schema.org/Offer">'.$listing_price_USD.'<link itemprop="availability" href="http://schema.org/InStock" /></h4>';
    
    
		$cont .= '<p class="sr-details-links col-12 align-center">'.$status_html.'</p>';
    
	    /*Virtual Tour*/
	    
	    if($listingVituralTourUrl != '') 
    		$cont .= '<div class="video-container">'.$wp_embed->run_shortcode( '[embed width="1000"]'.$listingVituralTourUrl.'[/embed]' ).'</div>';
    
	    /*Gallery*/
	    $cont .= <<<HTML
	        $gallery_markup
	        <script>
	          if(document.getElementById('sr-fancy-gallery')) {
	              Galleria.loadTheme('$galleria_theme');
	              Galleria.configure({
	                  height: 750,
	                  width:  "100%",
	                  showinfo: false,
	                  dummy: "$dummy",
	                  lightbox: true,
	                  imageCrop: false,
	                  imageMargin: 0,
	                  fullscreenDoubleTap: true
	              });
	              Galleria.run('.sr-gallery');
	          }
	        </script>
HTML;

		/* Main Details Row */
		$cont .= '<div class="container_inner"><div class="sr-primary-details col-12">';
	    	
    	/* SQFT */
    	if($area != '')
    		$cont .= '<div class="sr-detail" id="sr-primary-details-size"><p>Size: '.$area .'<small class="sr-listing-area-sqft">SqFt</small></p></div>'; 
              
        /* Beds */
        if($listing_bedrooms != '')
			$cont .= '<div class="sr-detail" id="sr-primary-details-beds"><p><small>Bedrooms: </small> '.$listing_bedrooms.'</p></div>';
              
        /* Baths */
        if($primary_baths != '')
        	$cont .= '<div class="sr-detail" id="sr-primary-details-baths"><p><small>Bathrooms:</small>'.$primary_baths.'</p></div>'; 
        
        
        /* Type */
        if($subType != '')
        	$cont .= '<div class="sr-detail" id="sr-primary-details-size"><p><small>Type:</small> '.$subType.'</p></div>'; 
              
        /* Taxes */
        if($listing_taxamount != ''){
        	$cont .= '<div class="sr-detail" id="sr-primary-details-status"><p><small>Taxes: </small> '.$listing_taxamount;
           if($listing_taxyear != '') $cont .= ' ('.$listing_taxyear.')';
		   $cont .= '</p></div>'; 
		}    
		
		$cont .= '</div>';
    
	    /* Extras */
	    
	    $cont .= '<div class="container_inner"><div class="sr-primary-details col-12">';
	    $cont .= ($floorplan)?"<a href='$floorplan' target='new' class='button'><i class='fa fa-home'></i> Floor Plans</a>":'';
	    $cont .= ($listingVituralTourUrl)?"<a href='$listingVituralTourUrl' target='new' class='button'><i class='fa fa-video-camera'></i> Virtual Tour</a>":'';
	    $cont .= "<a href='#request-information' class='button'><i class='fa fa-question'></i> Request Information</a>";
	    $cont .= "<span class='button listing_social_share'>Share: ";
	    $cont .= do_shortcode('[social-share gp="true" fa="true" tw="true" pt="true" em="true"]');
	    $cont .= '</span></div><hr>';
	    
	    /* Remarks */
	    $cont .= <<<HTML
	            <hr><div class='col-6 text-block' itemprop="description">
	            	<h3>Brought to you by Leo Wilk Personal Real Estate Corporation</h3>
	            	$remarks_markup
	            	<br><br>
	            	<p class="addendum">Listing provided by $listing_office</p>
	            </div>
HTML;
 
		/* Featured */
		
	    $cont .= '<div class="col-6 container_inner align-top text-block"><h2 class="col-12">Features</h2>';
	    
	    if($listing_interiorFeatures != '')
	    	$cont .= '<div class="col-12">'.$listing_interiorFeatures.'</div>';
			
		$cont .= '<div class="col-4"><table width="100%" class="show_listing_table"><tbody>';
		
		if($subType != '')
			$cont .= '<tr class="specrow"><td class="specname">type:</td><td class="specvalue">'.$subType.'</td></tr>';
			
		if($listing_style != '')
			$cont .= '<tr class="specrow"><td class="specname">style:</td><td class="specvalue">'.$listing_style.'</td></tr>';
		
		if($listing_taxamount != '')
			$cont .= '<tr class="specrow"><td class="specname">taxes:</td><td class="specvalue">'.$listing_taxamount.'</td></tr>';
			
		if($listing_maintenanceExpense != '')
			$cont .= '<tr class="specrow"><td class="specname">maintenance:</td><td class="specvalue">'.$listing_maintenanceExpense.'</td></tr>';
		
		if($listing_bedrooms != '')
			$cont .= '<tr class="specrow"><td class="specname">bedrooms:</td><td class="specvalue">'.$listing_bedrooms.'</td></tr>';
		
		if($primary_baths != '')
			$cont .= '<tr class="specrow"><td class="specname">bathrooms:</td><td class="specvalue">'.$primary_baths.'</td></tr>';
		
		if($listing_bathsFull != '')
			$cont .= '<tr class="specrow"><td class="specname">full baths:</td><td class="specvalue">'.$listing_bathsFull.'</td></tr>';
		
		if($listing_bathsHalf != '')
			$cont .= '<tr class="specrow"><td class="specname">half baths:</td><td class="specvalue">'.$listing_bathsHalf.'</td></tr>';
		
		if($listing_yearBuilt != '')
			$cont .= '<tr class="specrow"><td class="specname">year built:</td><td class="specvalue">'.$listing_yearBuilt.'</td></tr>';
		
		if($listing_parking != '')
			$cont .= '<tr class="specrow"><td class="specname">parking:</td><td class="specvalue">'.$listing_parking.'</td></tr>';
			
		if($listing_rentalRestrictions != '')
			$cont .= '<tr class="specrow"><td class="specname">rental restrictions:</td><td class="specvalue">'.$listing_rentalRestrictions.'</td></tr>';
		
		$cont .= '</tbody></table>
			</div> <!-- end four columns -->
			<div class="col-4">
				<table width="100%" class="show_listing_table">
		        	<tbody>';
		if($listing_interiorFeatures != '')
			$cont .= '<tr class="specrow"><td class="specname">Interior Features:</td><td class="specvalue">'.$listing_interiorFeatures.' SqFt</td></tr>';
		if($listing_lotSizeArea != '')
			$cont .= '<tr class="specrow"><td class="specname">lot:</td><td class="specvalue">'.$listing_lotSizeArea.' SqFt</td></tr>';
		if($listing_stories != '')
			$cont .= '<tr class="specrow"><td class="specname">levels:</td><td class="specvalue">'.$listing_stories.'</td></tr>';
		if($$area != '')
			$cont .= '<tr class="specrow"><td class="specname">sqft:</td><td class="specvalue">'.$area.'</td></tr>';
		if($listing_view != '')
			$cont .= '<tr class="specrow"><td class="specname">view:</td><td class="specvalue">'.$listing_view.'</td></tr>';
			
		if($listing_balconyPatio != '')
			$cont .= '<tr class="specrow"><td class="specname">balcony/patio:</td><td class="specvalue">'.$listing_balconyPatio.'</td></tr>';
			
		if($listing_fireplaces != '')
			$cont .= '<tr class="specrow"><td class="specname">fireplaces:</td><td class="specvalue">'.$listing_fireplaces.'</td></tr>';
		
		$cont .= '</tbody></table>';
		
		$cont .= $associationMarkup;
		
		$cont .= $roomsMarkup;
		
		
		
		$cont .= '</div>
			</div>';

		/* Map 
		if(($listing_lat != '') && ($listing_longitude != '')){
			$cont .= <<<HTML 
				 <div class='col-12' id='bingmap' style="width:100%;"></div>
				
		        <script>$lh_analytics</script>
		        
		        <script>
		        function loadMapScenario() {
		            if('$listing_lat' != ''){
		            document.getElementById('bingmap').style.height = '500px';
		            var map = new Microsoft.Maps.Map(document.getElementById('bingmap'), {
					    credentials: 'Apx0OStf8CqqfGnh0OKPwZSV5Iudi7s6ka-fvpsbkUiqFK315pvKJY86rr9IlX-b',
					    center: new Microsoft.Maps.Location($listing_lat, $listing_longitude),
					});
					var pushpin = new Microsoft.Maps.Pushpin(map.getCenter(), null);
					map.entities.push(pushpin);
					pushpin.setOptions({ enableHoverStyle: true, enableClickedStyle: true });
					}
				 }
		        </script>
		        <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?branch=release&callback=loadMapScenario' async defer></script>
HTML;
		}
*/

	    $cont .= <<<HTML
	        	<div class='col-6 text-block'>
	        	
					<h3>WANT TO KNOW MORE?</h3>
					<p class="contact_leo">Contact Leo now to learn more about this listing, or arrange a showing.</p>
					<p class="phone_leo"><strong><a href="tel:+16047295203">604.729.5203</a></strong></p>
	        	
	        	</div><div class='col-6 text-block' id='request-information'> 
	    
HTML;
	    $cont .= SimplyRetsApiHelper::srContactFormDeliver();
	    $cont .= $contact_markup;
	    
	    $cont .= <<<HTML
	    		</div>
	    	</div>
	    </article>
HTML;

	    	break;
	    case 'small':
	    /************************************************/
	    
	    	break;
	    case 'tiny':
	    /************************************************/
			
	    
	    	$cont .= <<<HTML
					<div class="sr-listing-slider-item small_listing_container $additional_class"> 
						<div class="four columns alpha omega listing_thumb">
							<a href="$link" title="$title_html">
								<img src="$main_photo" alt="$title_html" title="$fullAddress" class="scale-with-grid ">
							</a>
							<div class="four columns alpha omega listing_info">
								<div class="listing_remarks">
									<p>$listing_price_USD</p>
								</div><p>$subType | $beds Bed | $baths Bath | $area</p>
							</div>
						</div>
						<h3><a href="$link" title="$title_html">$title_html</a></h3>
						<sup class="supersmall">$office</sup>
					</div>
HTML;
	   		break;
    }
   
    
    


	return $cont;
}

///////////////////////////
//
//	get_short_listing_template
//
//////////////////////////

function get_short_listing_template($listing){
	global $wpdb;
	$ret = true;
	if(!isset($listing->mlsId)){
		$object = new stdClass();
		foreach ($listing as $key => $value)
		{
			if(strpos($key, '-') !== false) {
				list($key1, $key2) = explode('-', $key);
				if(!isset($object->$key1)) { 
					$object->$key1 = new stdClass();
					$object->$key1->$key2 = $value[0];
				} else {
					$object->$key1->$key2 = $value[0];
				}
				
			} else {
			    $object->$key = $value[0];
			}
		}
		$listing = $object;
		$ret = false;
	}

	$additional_class   = '';
    
    $listing_uid        = $listing->mlsId;
    $listing_mlsid      = $listing->listingId;
    $listing_price      = $listing->listPrice;
    $remarks            = $listing->remarks;
    $city               = $listing->address->city;
    $county             = $listing->geo->county;
    $address            = $listing->address->full;
    $zip                = $listing->address->postalCode;
    $listing_agent_id   = $listing->agent->id;
    $listing_agent_name = $listing->agent->firstName . ' ' . $listing->agent->lastName;
    $lng                = $listing->geo->lng;
    $lat                = $listing->geo->lat;
    $mls_status         = $listing->mls->status;
    $propType           = $listing->property->type;
    $bedrooms           = $listing->property->bedrooms;
    $bathsFull          = $listing->property->bathsFull;
    $bathsHalf          = $listing->property->bathsHalf;
    $bathsTotal         = $listing->property->bathrooms;
    $area               = $listing->property->area; // might be empty
    $lotSize            = $listing->property->lotSize; // might be empty
    $subdivision        = $listing->property->subdivision;
    $style              = $listing->property->style;
    $yearBuilt          = $listing->property->yearBuilt;

    $addrFull = $address . ', ' . $city . ' ' . $zip;
    $listing_USD = '$'.number_format( tofloat($listing_price) );
    
    $subarea		= $listing->mls->area;
    $streetNumber	= $listing->address->streetNumber;
    $streetName		= $listing->address->streetName;
    $unit 			= ($listing->address->unit != '')?$listing->address->unit .' - ':'';
    $photos  		= $listing->photos;
    
    $subType = $listing->property->subType;
    if($subType == 'SingleFamilyResidence')$subType = 'House';
    elseif($subType == 'Apartment')$subType = 'Condo';
    
    
	$office = $listing->office->name;
	
	$fullAddress = $unit.$streetNumber.' '.$streetName.' '.$city.', '.$subarea;
    
    

    if( $bedrooms == null || $bedrooms == "" ) {
        $bedrooms = 0;
    }
    if( $bathsFull == null || $bathsFull == "" ) {
        $bathsFull = 0;
    }
    if( $bathsHalf == null || $bathsHalf == "" ) {
        $bathsHalf = 0;
    }
    if( !$area == 0 ) {
        $area = number_format( $area );
    }
    
    // listing link to details
    $link = SrUtils::buildDetailsLink(
        $listing,
        !empty($vendor) ? array("sr_vendor" => $vendor) : array()
    );

    if(empty($bathsFull) || $bathsFull == 0 && is_numeric($bathsTotal)) {
        $realBaths   = $bathsTotal + 0;
        $bathsMarkup = SimplyRetsApiHelper::resultDataColumnMarkup($realBaths, "Bath");
    }
    
    $photos     = $listing->photos;
    $ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%".$listing->address->full."%' AND post_type='listing' AND post_status='publish'");

	$featured = '';
	if(!empty($ids[0])){
		$a = new WP_Query(array(
			'post_type' 	  => 'listing',
			'p' => $ids[0],
		));
		while($a->have_posts() ) : $a->the_post();
			$link = get_the_permalink();
			$post_id = get_the_id();
			$featured = 'featured';
			$photos	= get_post_meta( $post_id, 'photos', 1 );
			$terms = get_the_terms( get_the_id(), 'status' );
			$photos[0] = get_the_post_thumbnail_url($post_id, 'large' );
			if(!empty($terms)){
				foreach ( $terms as $term ) {
	                $term_status = $term->name;
	                $additional_class .= $term->slug;
	            }
            }
		endwhile;
		wp_reset_query();
	}
	
    $dummy          = RETSURL. 'assets/img/defprop.jpg';
    !empty($photos) ? $main_photo = $photos[0] : $main_photo = $dummy;
    
    
    // Create Title
    $listing_mlsid_html = ($listing_mlsid != '')?$listing_mlsid_html = ' ('.$listing_mlsid.')':'';
    if($listing_address != '' || $listing_subdivision != '' && $listing_city != '')
    	$title_html = $listing_unit.' '.$listing_address.' '. $listing_subdivision.', '.$listing_city.$listing_mlsid_html;
    elseif($fullAddress != '' && $fullAddress != '  , ')
    	$title_html = $fullAddress.$listing_mlsid_html;
    else
    	$title_html = get_the_title($post_id).$listing_mlsid_html;
     
	if(isset($term_status))$status = $term_status;
	elseif(strtotime($listing->listDate) < strtotime('1 week ago')) $status = 'Just Listed';
    elseif(isset($listing->mls->area)) $status = $listing->mls->area;
    else $status = $listing->mls->status;
    
	$resultsMarkup .= <<<HTML
<article class="col-6 alpha listing_container text-block align-center $additional_class" itemscope="" itemtype="http://schema.org/Place"> 
<div class="eight columns alpha omega listing_thumb">
<a href="$link" title="$title_html">
	<img src="$main_photo" alt="$title_html" class="scale-with-grid ">
</a>
<div class="eight columns alpha omega listing_info">
	<div class="listing_remarks $featured">
		<p>$status</p>
	</div>
	<p itemprop="name">$subType | $bedrooms Bed | $bathsTotal Bath | $area | $listing_USD</p>
</div>
</div>
<h3>
<a href="$link title="$title_html" itemscope="">
	$title_html
</a>
</h3>
<sup class="supersmall">$office</sup>
</article>
HTML;
	
	
	return $resultsMarkup;
			
}	
?>