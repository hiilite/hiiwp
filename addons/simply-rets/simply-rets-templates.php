<?php
/*
*	Handles the display of listings and the parsing of data to be using in listing templates
*
*	FUNCTIONS:
*	@get_listing_template
*	@get_short_listing_template
*	@parse_rets_data
*	@downloadPhotos
*
*
// DONE: Setup switch for SimplyRETS and DDF	
// DONE: Create parser for SR & DDF
*/


// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$debugMode = true; 
$RETS_Options = get_option('hii_rets_settings');
$RETS_feedType = $RETS_Options['rets_feed'];
/*
*
*	IF DDF
*
*/
if($RETS_feedType == 'ddf'):
	
	// Initially, you should set this to something like "-2 years". 
	// Once you have all day, change this to "-48 hours" or so to pull incremental data
	$TimeBackPull = "-2 days";
	
	/* RETS Variables */
	// DONE: Get credentials from site options
	require("PHRets_CREA.php");
	$RETS = new PHRets();
	$RETSURL = $RETS_Options['rets_url'];
	$RETSUsername = $RETS_Options['rets_username'];
	$RETSPassword = $RETS_Options['rets_password'];
	$RETS->Connect($RETSURL, $RETSUsername, $RETSPassword);
	$RETS->AddHeader("RETS-Version", "RETS/1.7.2");
	$RETS->AddHeader('Accept', '/');
	$RETS->SetParam('compression_enabled', true);
	$RETS_PhotoSize = "LargePhoto";
	$RETS_PhotoFolder = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/RETSPhotos/';
	$RETS_LimitPerQuery = 2;
	
/*
*
*	IF SimplyRETS
*
*/
elseif($RETS_feedType == 'simplyrets'):


/*
*
*	IF NONE
*
*/	
else:
	
endif;






//////////////////////
//
//	get_listing_template
//
//////////////////////
function get_listing_template($listingId, $size = 'full', $type = 'rets'){
	/*
	// TODO: Review all data
	// TODO: Pull from WordPress listings only, once importer is working
	*/
	global $wp_embed, $RETS_PhotoFolder, $RETS_feedType, $RETS, $RETS_Options, $RETS_PhotoSize;
	
	$cont = $additional_class  = $featured = $dummy = '';
	
	if($RETS_feedType == 'ddf'){
		$DBML = "(ID=" . $listingId . ")";
		for($i = 0; $i < 1; $i++)
		{
			$startOffset = $i*10;
			$params = array("Limit" => 10, "Format" => "STANDARD-XML", "Count" => 1);
			$results = $RETS->SearchQuery("Property", "Property", $DBML, $params);	
			foreach($results["Properties"] as $listing) {
				$orig_listing_data = $listing;
				$listing = parse_rets_data($listing);
			}
			
		}
		
	} else {
		$listing = parse_rets_data($listingId);
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
	
	!empty($listing->main_photo) ? $main_photo = $listing->main_photo : $main_photo = $dummy;
	/*
     * 
     * Set all properties
     * 
    */
    // internal unique id
    $listing_uid = $listing->mlsId; 
    $listing_price = $listing->price;
    $listing_price_USD = '<span itemprop="priceCurrency" content="CAD">$</span><span itemprop="price" content="'.tofloat($listing_price).'"> '.number_format( tofloat($listing_price) ).'</span>';
    
    // type
    $subType = $listing->property->propType;
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
    
    ////////////////////////
    //	Building Features //
    ////////////////////////
	$buildingMarkup = '';
	$buildingMarkup .= "<table class='show_listing_table' width='100%'>
	      <thead>
	        <tr>
	          <th colspan=\"2\"><h5>Building</h5></th></tr></thead><tbody>";
	foreach($orig_listing_data['Building'] as $k=>$v) {
		if(!is_array($v)){
			$parsed_k = preg_replace('/([A-Z]+)/', " $1", $k);
			$buildingMarkup .= "<tr class='specrow'><td class='specname'>$parsed_k: </td><td class='specvalue'>$v </td></tr>";
		}
	}
	$buildingMarkup .= "</tbody></table>";
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
	        if(!is_null($room->Dimension)) {
	            $roomSize = $room->Dimension;
	        } else {
	            $roomSize = "$room->length" .  " x " . "$room->width";
	        }
	        
	        $roomsMarkup .= "<tr class='specrow'><td class='specname'>$room->Type: </td><td class='specvalue'>$room->Dimension </td></tr>";
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
    if($RETS_feedType == 'simplyrets') {
	    $photos     = $listing->photos;
	} elseif($RETS_feedType == 'ddf') {
		$photos_obj = $RETS->GetObject("Property", $RETS_PhotoSize, $listing->mlsId, '*');
		foreach($photos_obj as $photo)
		{
			if(
				(!isset($photo['Content-ID']) || !isset($photo['Object-ID']))
				||
				(is_null($photo['Content-ID']) || is_null($photo['Object-ID']))
				||
				($photo['Content-ID'] == 'null' || $photo['Object-ID'] == 'null')
			)
			{
				continue;
			}
			
			$contentID = $photo['Content-ID'];
			$number = $photo['Object-ID'];
			$destination = '/wp-content/uploads/RETSPhotos/'.$listing->mlsId."_".$number.".jpg";
			$photos[] = $destination;
		}
	} else {
		$photos		= get_post_meta( get_the_id(), 'photos', 1 );
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
	
	
        
    $remarks = wpautop($listing->remarks);
    $remarks_markup = <<<HTML
    <div class="sr-remarks-details">
      $remarks
    </div>
HTML;
  

    if( get_option('sr_show_leadcapture') ) {
        $contact_text = 'Contact us about this listing';
        $cf_listing = $listing_address . ' ( MLS #' . $listing_mlsid . ' )';
        $contact_markup = SimplyRetsApiHelper::srContactFormMarkup($cf_listing);
    } else {
        $contact_text = '';
        $contact_markup = '';
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
    		<input type="hidden" value="'.$listing->listingId.'">';
    
		if(has_post_thumbnail(get_the_id()) && $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' ))
			$cont .= '<link itemprop="image" href="'.$main_photo.'">';

		$cont .= '<h1 class="align-center col-12" itemprop="name">'.$title_html.'</h1>';
    
	    /* Price */
	    $cont .= '<h3 class="align-center col-12" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><strong>'.$listing_price_USD.'</strong><link itemprop="availability" href="http://schema.org/InStock" /></h3>';
		$cont .= '<h5><p class="sr-details-links col-12 align-center">'.$status_html.'</p></h5>';
    
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
	                  fullscreenDoubleTap: true,
	                  transition: 'fade',
	                  autoplay: 5000
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
        if($listing_taxamount != '' && $listing_taxamount != '$0.00'){
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
	    $cont .= '</span></div>';
	    
	    /* Remarks */
	    $cont .= "
	            <div class='col-6 text-block' itemprop='description'>
	            	
	            	$remarks_markup
	            	<br><br>";
	    $cont .= ($listing_office != '')?"<p class='addendum'>Listing provided by $listing_office</p>":'';
	    $cont .= "</div>";
 
		/* Featured */
		
	    $cont .= '<div class="col-6 container_inner align-top text-block"><h2 class="col-12">Features</h2>';
	    
	    $cont .= $buildingMarkup;
	    
	    
	    if($listing_interiorFeatures != '')
	    	$cont .= '<div class="col-12">'.$listing_interiorFeatures.'</div>';
			/*
		$cont .= '<div class="col-4"><table width="100%" class="show_listing_table"><tbody>';
		
		if($subType != '')
			$cont .= '<tr class="specrow"><td class="specname">type:</td><td class="specvalue">'.$subType.'</td></tr>';
			
		if($listing_style != '')
			$cont .= '<tr class="specrow"><td class="specname">style:</td><td class="specvalue">'.$listing_style.'</td></tr>';
		
		if($listing_taxamount != '' && $listing_taxamount != '$0.00')
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
		*/
		$cont .= $associationMarkup;
		
		$cont .= $roomsMarkup;
		
		
		
		$cont .= '</div>
			</div>';

	    $cont .= <<<HTML
	        	<div class='col-6 text-block'>
	        	
					<h3>WANT TO KNOW MORE?</h3>
					<p class="contact_leo">Contact Sean now to learn more about this listing, or arrange a showing.</p>
					<p class="phone_leo"><strong><a href="tel:+12508013654">250-801-3654</a></strong></p>
	        	
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
function get_short_listing_template($listing, $type = 'rets'){
	global $wpdb, $RETS_PhotoFolder, $RETS_feedType;
	
	$additional_class = $resultsMarkup  = '';
	$featured = '';
	//	TODO: Set dummy photo
	$dummy = '';
	
	$listing = parse_rets_data($listing);
			
   /*
	*
	*	CHECK FROM LISTINGS IN WORDPRESS
	*
	*/
    $ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts 
    						WHERE postmeta.meta_key = 'mlsId' 
    						  AND postmeta.meta_value = '".$listing->listingId."'
    						  AND post_type = 'listing' 
    						  AND post_status = 'publish'");
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
	 
    
    !empty($listing->main_photo) ? $main_photo = $listing->main_photo : $main_photo = $dummy;
    
    // listing link to details
    $link = SrUtils::buildDetailsLink(
        $listing,
        !empty($vendor) ? array("sr_vendor" => $vendor) : array()
    );
    /*
	*
	*	BUILD LISTING DISPLAY
	*
	*/
    // Create Title
    //	TODO: Change all values for new parsed array
    $listing_mlsid_html = ($listing->listingId != '')?$listing_mlsid_html = ' ('.$listing->listingId.')':'';
    if($listing->address->address != '' || $listing->property->subdivision != '' && $listing->address->city != '')
    	$title_html = $listing->address->address;
    elseif($fullAddress != '' && $fullAddress != '  , ')
    	$title_html = $fullAddress.$listing_mlsid_html;
    else
    	$title_html = get_the_title($post_id).$listing_mlsid_html;
     
	if(isset($term_status))$status = $term_status;
	elseif(strtotime(isset_return($listDate)) < strtotime('1 week ago')) $status = 'Just Listed';
    elseif(isset($listing->mls->area)) $status = $listing->mls->area;
    else $status = $listing->mls->status;
    
	$resultsMarkup .= '
<article class="col-4 listing_container text-block '.$additional_class.'" itemscope="" itemtype="http://schema.org/Place"> 
	<figure class="single-image align-center listing_thumb">
		<a href="'.$link.'" title="'.$title_html.'">
			<img src="'.$main_photo.'" alt="'.$title_html.'" class="scale-with-grid ">
		</a>
		
	</figure>
	<div class="listing_info" style="border:1px solid #eee; ">
		<div class="class="">
			<h5 style="border-bottom:1px solid #eee; padding:0.5em 1em;">
				<a href="'.$link.'" title="'.$title_html.'" itemscope="">
					'.$title_html.'
				</a>
			</h5>
			
			<div class="text-block">
				<h5><strong>'.$listing->priceUSD.'</strong></h5>
				<p><span style="text-transform:uppercase">'.$listing->property->propType.'</span><br>
				'.$listing->address->city.'<br>
				bed: '.$listing->property->bedrooms.' / bath: '.$listing->property->bathsTotal.' / area: '.$listing->property->area.'</p>
				<sup class="supersmall">'.$listing->office->name.'</sup>
		<a class="button button-primary" id="" href="'.$link.'" target="_self">See Listing</a>
			</div>
		</div>
		
	</div>
	
</article>';
	
	return $resultsMarkup;
			
}	


//////////////////////
//
//	parse_rets_data
//	TODO: Parse SimplyRETS
//	TODO: Check if exists in Wordpress, and if 
//
//////////////////////
function parse_rets_data($listingData){
	global $RETS_feedType,$RETS_PhotoFolder;
	
	if($RETS_feedType == 'ddf' && is_array($listingData)):
		//
		//	DDF CONVERSION (more to function)
		//
		//echo '<pre>';
		//print_r($listingData);
		//echo '</pre>';
		$listing = (object)[
			'mlsId'			=> isset_return($listingData['@attributes']['ID']),
			'listingId'		=> isset_return($listingData['ListingID']),
			'price'			=> isset_return($listingData['Price']),
			'listDate'		=> isset_return($listingData['ListingContractDate']),
			'remarks'		=> isset_return($listingData['PublicRemarks']),
			'address'		=> (object)[
				'unit'			=> null,
				'address'		=> isset_return($listingData['Address']['StreetAddress']),
				'city'			=> isset_return($listingData['Address']['City']),
				'county'		=> isset_return($listingData['Address']['Country']),
				'state'			=> isset_return($listingData['Address']['Province']),
				'postalCode'	=> isset_return($listingData['Address']['PostalCode']),
				
			],
			'agent'			=> (object)[
				'id'			=> isset_return($listingData['AgentDetails']['@attributes']['ID']),
				'name'			=> isset_return($listingData['AgentDetails']['Name']),
				'phone'			=> isset_return($listingData['AgentDetails']['Phones']['Phone'])
			],
			'office'		=> (object)[
				'name'			=> isset_return($listingData['AgentDetails']['Office']['Name']),
				'address'		=> isset_return($listingData['AgentDetails']['Office']['Address']['StreetAddress'],'',' ,').
								   isset_return($listingData['AgentDetails']['Office']['Address']['City'],'',' ,').
								   isset_return($listingData['AgentDetails']['Office']['Address']['Province'],'',' ,').
								   isset_return($listingData['AgentDetails']['Office']['Address']['PostalCode']),
				'phone'			=> isset_return($listingData['AgentDetails']['Office']['Phones']['Phone'][0])
			],
			'geo'			=> (object)[
				'lat'			=> null,
				'lng'			=> null,
			],
			'property'		=> (object)[
				'bedrooms'		=> isset_return($listingData['Building']['BedroomsTotal']),
				'bathsFull'		=> isset_return($listingData['Building']['BathroomTotal']),
				'bathsHalf'		=> isset_return($listingData['Building']['HalfBathTotal']),
				'bathsTotal'	=> isset_return($listingData['Building']['BathroomTotal']),
				'area'			=> isset_return($listingData['Building']['SizeInterior']),
				'lotSize'		=> isset_return($listingData['Building']['SizeExterior']),
				'subdivision'	=> isset_return($listingData['Address']['CommunityName']),
				'propType'		=> isset_return($listingData['PropertyType']),
				'yearBuilt'		=> null,
				'style'			=> null,
				'appliances'	=> isset_return($listingData['Building']['Appliances']), 
				'rooms'			=> isset_return($listingData['Building']['Rooms']['Room']),
				
			],
			'mls'			=> (object)[
				'status'		=> isset_return($listingData['TransactionType']),
			],
		];
	
	    $listing->address->full = $listing->address->address;
	    $listing->priceUSD = '$'.number_format( tofloat($listing->price) );
	    
	    if($listing->property->propType == 'SingleFamilyResidence')
	    	$listing->property->propType = 'House';
	    elseif($listing->property->propType == 'Apartment')
	    	$listing->property->propType = 'Condo';
		
		// GET First photo, else, download all photos, then set first photo
		$listing->photos = downloadPhotos($listing->mlsId);

		
		$listing->main_photo = $listing->photos[1];

		
	elseif($RETS_feedType == 'simplyrets'):
	
	
	
		$listing['link'] = SrUtils::buildDetailsLink(
	        $listingData,
	        !empty($vendor) ? array("sr_vendor" => $vendor) : array()
	    );
	    $dummy          = RETSURL. 'assets/img/defprop.jpg';
	
	else:
	// Feed is from WordPress Listing post type
		$object = new stdClass();
		foreach ($listingData as $key => $value)
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
	endif;
	
	if(empty($listing->property->bathsFull) || $listing->property->bathsFull == 0 && is_numeric($listing->property->bathsTotal)) {
        $realBaths   = $listing->property->bathsTotal + 0;
    }
    
    if( $listing->property->bedrooms == null || $listing->property->bedrooms == "" ) {
        $listing->property->bedrooms = '0';
    }
    if( $listing->property->bathsFull == null || $listing->property->bathsFull == "" ) {
        $listing->property->bathsFull = '0';
    }
    if( $listing->property->bathsHalf == null || $listing->property->bathsHalf == "" ) {
        $listing->property->bathsHalf = '0';
    }
    if( !$listing->property->area == 0 && is_numeric($listing->property->area)) {
        $listing->property->area = number_format( $listing->property->area );
    }


		
	return $listing;
}



?>