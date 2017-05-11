<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/**
 * HiiDdfHelper class.
 */
class HiiDdfHelper {
	
	public static $q_vars = array();
	/**
	 * explode_if_key function.
	 * 
	 * @access public
	 * @param mixed $key
	 * @param mixed $value
	 * @return void
	 */
	static private function explode_if_key($key, $value){
			
		$check_keys = array(	'RoadType', 
						    	'Structure', 
						    	'ViewType', 
						    	'WaterFrontType',
						    	'PoolType',
						    	'CoolingType',
						    	'ExteriorFinish',
						    	'FireProtection',
						    	'FlooringType',
						    	'HeatingFuel',
						    	'HeatingType',
						    	'RoofMaterial',
						    	'AccessType',
						    	'Amenities',
						    	'LandscapeFeatures',
						    	'Appliances',
						    );
		
							    
	    if(in_array($key, $check_keys)){
	        $arr_value = explode(', ', $value);
	    } else {
	        $arr_value = $value;
	    }
	    return $arr_value;
	}
	
	
	/**
	 * get_listing_map_info function.
	 *
	 * Used for AJAX response to load listing
	 * 
	 * @access public
	 * @static
	 * @return $cont
	 */
	public static function get_listing_map_info(){
		global $wpdb;
		$listing_id = $_POST['post_id'];
		$cont = '<div class="map_info">';
		$results = $wpdb->get_results( 
			"SELECT Listing.ID AS id, Listing.guid AS url, Price.meta_value AS price, Street.meta_value AS street, Thumb.meta_value AS thumb
			 FROM $wpdb->posts Listing
			 LEFT JOIN $wpdb->postmeta Price
			 	ON Price.post_id = Listing.ID
			   AND Price.meta_key = 'Price'
			 LEFT JOIN $wpdb->postmeta Street
			 	ON Street.post_id = Listing.ID
			   AND Street.meta_key = 'Address-StreetAddress'
			 LEFT JOIN $wpdb->postmeta Thumb
			 	ON Thumb.post_id = Listing.ID
			   AND Thumb.meta_key = '_thumbnail_id'
			 WHERE Listing.ID = $listing_id", OBJECT );
			 
			 
		foreach($results as $result){
			$image = wp_get_attachment_image_src($result->thumb);
			$price = (is_numeric($result->price))?number_format($result->price,0):$result->price;
			$cont .= "<a target='_blank' href='$result->url'><img src='$image[0]'><h5>$ $price</h5><p>$result->street</p></a>";
		}
		
		$cont .= "</div>";
		echo $cont;
		
		die();
	}
	
	/**
	 * adds meta values on search query
	 *
	 * @param object $query
	 *
	**/
	public static function custom_search_query( $query ) {
		
		if ( !is_admin() && $query->is_search ) {
			self::$q_vars = array(
				'relation' => 'AND',
			);
			foreach($_GET as $key=>$value){
				if($value != ''){
					switch($key){
						case 'minbeds':
							self::$q_vars[] = array(
								'key' => 'Building-BedroomsTotal',
								'value' => isset($query->query_vars['minbeds'])?$query->query_vars['minbeds']:$_GET['type'],
								'compare' => 'LIKE',
							);
						break;
						case 'minbaths':
							self::$q_vars[] = array(
								'key' => 'Building-BathroomTotal',
								'value' => isset($query->query_vars['minbaths'])?$query->query_vars['minbaths']:$_GET['minbaths'],
								'compare' => 'LIKE',
							);
						break;
						case 'type':
							self::$q_vars[] = array(
								'key' => 'PropertyType',
								'value' => isset($query->query_vars['type'])?$query->query_vars['type']:$_GET['type'],
								'compare' => 'LIKE'
							);
						break;
						case 'agent':
							self::$q_vars[] = array(
								'key' => 'AgentDetails',
								'value' => isset($query->query_vars['agent'])?$query->query_vars['agent']:$_GET['agent'],
								'compare' => 'LIKE'
							);

						break;
						case 'minprice':
							self::$q_vars[] = array(
								'key' => 'Price',
								'value' => isset($query->query_vars['minprice'])?floatval($query->query_vars['minprice']):floatval($_GET['minprice']),
								'compare' => '>=',
								'type' => 'numeric'
							);
						break;
						case 'maxprice':
						self::$q_vars[] = array(
							'key' => 'Price',
							'value' => isset($query->query_vars['maxprice'])?floatval($query->query_vars['maxprice']):floatval($_GET['maxprice']),
							'compare' => '<=',
							'type' => 'numeric'
						);
						break;
					}
				}
			}
		
			
			$query->set('meta_query', self::$q_vars);
			
	        $query->set('post_type', 'listing');
		};
	}
	

	/**
	 * check_if_single function.
	 * 
	 * @access public
	 * @param mixed $arr_check
	 * @return void
	 */
	public static function check_if_single($arr_check){
	    $return_arr = array();
	    if(!array_key_exists(1, $arr_check)) {
			$return_arr[0] = $arr_check;
		} else {
			foreach($arr_check as $ph_key => $ph_val) {
				$return_arr[] = $ph_val;
			}
		}
		return $return_arr;
	}	
	
	
	/**
	 * retrieveDdfListings function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $params
	 * @param mixed $settings (default: NULL)
	 * @return void
	 */
	public static function retrieveDdfListings( $params, $settings = NULL ) {
		
		$response_markup  = HiiDdfHelper::ddfResidentialResultsGenerator( null, $settings );
		
        return $response_markup;
    }
    
    /**
	 * retrieveDdfListings function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $params
	 * @param mixed $settings (default: NULL)
	 * @return void
	 */
	public static function ddfCheckListingStatus( $listingId, $post_id ) {
		global $wpdb, $RETS;
		$DBML = "(ID=" . $listingId . ")";
		$active =  false;
		for($i = 0; $i < 1; $i++)
		{
			$startOffset = $i*10;
			$params = array("Limit" => 1, "Format" => "STANDARD-XML", "Count" => 1);
			$results = $RETS->SearchQuery("Property", "Property", $DBML, $params);	
			foreach($results["Properties"] as $listing) {
				$active = true;
			}
			
		}
		
		
		if($active)
			return 'Active';
		else {
			wp_set_object_terms( $post_id, 'sold', 'status' );
			
			return 'Sold';	
		}
			
				
    }
    
    
    /**
     * srResidentialResultsGenerator function.
     * 
     * @access public
     * @static
     * @param mixed $response
     * @param mixed $settings
     * @return void
     */
    public static function ddfResidentialResultsGenerator( $response, $settings ) {
	    global $wpdb, $RETS;
	    $cont              = "";
		
		$rets_last_import = get_option('rets_last_import') != null
			?get_option('rets_last_import')
			:update_option('rets_last_import', date('Y-m-d\TH:m:s\Z', strtotime('Now'))); 
			
		// Set for first import
		//$rets_last_import = date('Y-m-d\TH:m:s\Z', strtotime('-2 months'));
		//print_r($rets_last_import);
		// Check for filters
		$settings['keywords'] = isset($_REQUEST['keywords'])?$_REQUEST['keywords']:false;
    	$settings['offset'] = isset($_REQUEST['offset'])?$_REQUEST['offset']:0;
    	
    	
		$DBML = "(LastUpdated=" . $rets_last_import . ")";
		$limit = isset($settings['limit'])?$settings['limit']:10;
		$offset = isset($settings['offset'])?$settings['offset']:0;
		$startOffset = $offset*$limit;

		$params = array("Limit" => 1, "Format" => "STANDARD-XML", "Count" => 1, "Offset" => $startOffset);
		$results = $RETS->SearchQuery("Property", "Property", $DBML, $params);
		$totalAvailable = $results["Count"]; 
		$RETS_LimitPerQuery = 10;
		
		// NOTE: Query the most recent listings from the DDF feed
		for($i = 0; $i < $RETS_LimitPerQuery; $i++) 
		{
			$startOffset = $i*$RETS_LimitPerQuery;
			$params = array("Limit" => $RETS_LimitPerQuery, "Format" => "STANDARD-XML", "Count" => 1, "Offset" => $startOffset);
			$results = $RETS->SearchQuery("Property", "Property", $DBML, $params);		
			foreach($results["Properties"] as $listing)
			{
				$listingID = $listing["@attributes"]["ID"];
				
				$_listing_arrs = null;
			    $_listing_meta = $listing;
			    
			    
			    // NOTE: Parse return data to match with WP database structure
			    if(isset($_listing_meta)){
			        foreach($_listing_meta as $key => $value){
				        
				        
				        
				        switch($key) {
					        case 'AgentDetails':
					        	$office[0] = null;
					        	
					        	
								if (!array_key_exists(1, $value)){
									$newval[0] = $value;
									$_listing_arrs[$key][0] = $newval[0];
									$_listing_arrs['Office'][0] = $newval[0]['Office'];
									
									if(
										isset($_listing_arrs['Office'][0]['Phones']) && 
										!is_array($_listing_arrs['Office'][0]['Phones'])
									) {
										$_listing_arrs['Office'][0]['Phones'][0] = $_listing_arrs['Office'][0]['Phones']['Phone'];
									} else {
										foreach($_listing_arrs['Office'][0]['Phones']['Phone'] as $ph_key => $ph_val) {
											$_listing_arrs['Office'][0]['Phones'][] = $ph_val;
										}
									}
									unset($_listing_arrs['AgentDetails'][0]['Office'][0]);
									unset($_listing_arrs['Office'][0]['Phones']['Phone']);
									
								} elseif(isset($_listing_arrs[$key][0]['Websites']) && is_array($_listing_arrs[$key][0]['Websites'])) {
									foreach($_listing_arrs[$key][0]['Websites']['Website'] as $ws_key => $ws_val) {
										$_listing_arrs[$key][0]['Websites'][] = $ws_val;
									}
									unset($_listing_arrs[$key][0]['Websites']['Website']);
								} else {
									$_listing_arrs[$key] = $value;
								}
									
					        break;
					        case 'Photo':
					        	$_listing_arrs[$key] = $value['PropertyPhoto'];
					        	unset($_listing_arrs[$key]);
					        default:
					        	$dual_key = '';
					        	if((is_object($value) || is_array($value))){
							        foreach($value as $key1 => $value1){
								        $dual_key = $key."-".$key1;
								        $_listing_arrs[$dual_key] = HiiDdfHelper::explode_if_key($key1,$value1);
								        
								        if($dual_key == 'Building-Rooms') {
											$_listing_arrs['Building-Rooms'] = $_listing_arrs['Building-Rooms']['Room'];
											unset($_listing_arrs['Building-Rooms']['Room']);
										} elseif($dual_key == 'ParkingSpaces-Parking') {
											if(!array_key_exists(1, $_listing_arrs[$dual_key])) {
												$newval[0] = $value['Parking'];
												$_listing_arrs[$dual_key][0] = $newval[0];
												unset($_listing_arrs[$dual_key]['Name']);
												unset($_listing_arrs[$dual_key]['Spaces']);
											} else {
												foreach($_listing_arrs[$dual_key] as $ph_key => $ph_val) {
													if(isset($ph_val['Parking']))
														$_listing_arrs[$dual_key][] = $ph_val['Parking'];
												}
											}
										}
								    }
							    } else {
								    $_listing_arrs[$key] = HiiDdfHelper::explode_if_key($key,$value);
								}
								
					        break;
				        }
			        }
			    } 
			    
			    // NOTE: Generate listing title and check if it already exists before creating new entry
			    if(isset($_listing_arrs['Address-StreetAddress']) && isset($_listing_arrs['Address-City'])):
			    	
			    	
			    	
				    $post_title = 	$_listing_arrs['Address-StreetAddress'].', '.
				    				$_listing_arrs['Address-City'].', '.
				    				$_listing_arrs['Address-Province'].' '.
				    				$_listing_arrs['Address-PostalCode'];
				    $post_title = wp_strip_all_tags($post_title);
				    
				    // GEOCODE address and save lat-long
			    	
			    	$data_arr = HiiDdf::geocode($post_title);
					if($data_arr){
					    $_listing_arrs['Address-Latitude'] = $latitude = $data_arr[0];
					    $_listing_arrs['Address-Longitude'] = $longitude = $data_arr[1];
					    $formatted_address = $data_arr[2];
					    
					}
					
				    $check_query = $wpdb->prepare(
						'SELECT ID FROM '.$wpdb->posts.'
						WHERE post_title = %s
						AND post_type = \'listing\'',
						$post_title
				    );
				    $new_post_id = $wpdb->get_var($check_query);
				    
				    if($wpdb->num_rows){
					    
					    // TODO: Update post data
					    /*
					    $post_information = array(
						    'ID'		 => $new_post_id,
					        'post_title' => $post_title,
					        'post_content' => $_listing_arrs['PublicRemarks'], 
					        'post_type' => 'listing',
					        'post_status' => 'publish',
					        'meta_input' => $_listing_arrs
					    );
					    wp_update_post( $post_information );*/
				    } else {
					    $post_information = array(
					        'post_title' => $post_title,
					        'post_content' => $_listing_arrs['PublicRemarks'], 
					        'post_type' => 'listing',
					        'post_status' => 'publish',
					        'meta_input' => $_listing_arrs
					    ); 
					    if($new_post_id = wp_insert_post( $post_information )) {
							HiiDdfHelper::downloadPhotos($listingID, $new_post_id);
						}
						
				    }
				    
				endif;
			}
			
		}
		update_option('rets_last_import', date('Y-m-d\TH:m:s\Z', strtotime('Now')));
		
		self::$q_vars = array(
			'relation' => 'AND',
		);
		foreach($settings as $key=>$value){
			if($value != ''){
				switch($key){
					case 'type':
						self::$q_vars[] = array(
							'key' => 'PropertyType',
							'value' => $settings['type'],
							'compare' => 'LIKE'
						);
					break;
					case 'agent':
						self::$q_vars[] = array(
							'key' => 'AgentDetails',
							'value' => $settings['agent'],
							'compare' => 'LIKE'
						);

					break;
					
				}
			}
		}
		
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$listing_args = array(
			'post_type' => 'listing',
			'posts_per_page'	=> $limit,
			'paged'			=> $paged,
			'meta_query'	=> self::$q_vars,
		);
		$listing_query = new WP_Query($listing_args);
		
		if($listing_query->have_posts()):
			while($listing_query->have_posts()):
				$listing_query->the_post();
				$cont .= '<div class="flex-item col-4">';
				$cont .= get_listing_template('medium');
				$cont .= '</div>';
			endwhile;
			if($settings['pagination']):
				$offset_next = $paged + 1;
				$offset_prev = $paged - 1;
				$next_link = "<a href='/listing/page/$offset_next' class='button'>Next</a>";
				$prev_link = ($offset_prev > 0)?"<a href='/listing/page/$offset_prev' class='button'>Prev</a>":'';
				
				$cont .= "<hr><p class='sr-pagination'>$prev_link $next_link</p>";
			endif;
		endif;
		//wp_reset_postdata();
			
        return $cont;

    }
    
	/**
	 * downloadPhotos function.
	 * 
	 * @access public
	 * @static
	 * @param mixed $listingID
	 * @param mixed $post_id
	 * @return void
	 */
	public static function downloadPhotos($listingID, $post_id)
	{
		global $RETS, $RETS_PhotoSize, $debugMode, $RETS_PhotoFolder;
	
		// TODO Check for downloadedPhotos
		$photos_list = [];
		$upload_dir = wp_upload_dir(); // Set upload folder
		
		$photos = $RETS->GetObject("Property", $RETS_PhotoSize, $listingID, '*');
		
		if(!is_array($photos))
		{
			if($debugMode) error_log("Cannot Locate Photos");
			return;
		}
		
		if(count($photos) > 0)
		{
			$count = 0;
			foreach($photos as $photo)
			{
				if(
					(!isset($photo['Content-ID']) || !isset($photo['Object-ID']))
					||
					(is_null($photo['Content-ID']) || is_null($photo['Object-ID']))
					||
					($photo['Content-ID'] == 'null' || $photo['Object-ID'] == 'null')
				) {
					continue;
				}
				
				$listing = $photo['Content-ID'];
				$number = $photo['Object-ID'];
				$filename = $listingID."_".$number.".jpg";
				$photoData = $photo['Data'];
				
				// Check folder permission and define file location
				if( wp_mkdir_p( $upload_dir['path'] ) ) {
				    $destination = $upload_dir['path'] . '/' . $filename;
				} else {
				    $destination = $upload_dir['basedir'] . '/' . $filename;
				}
				
				// Check image file type
				$wp_filetype = wp_check_filetype( $filename, null );				
				
				file_put_contents($destination, $photoData);
				
				// Check image file type
				$wp_filetype = wp_check_filetype( $filename, null );
				
				// Set attachment data
				$attachment = array(
				    'post_mime_type' => $wp_filetype['type'],
				    'post_title'     => sanitize_file_name( $filename ),
				    'post_content'   => '',
				    'post_status'    => 'inherit'
				);
				// Create the attachment
				$attach_id = wp_insert_attachment( $attachment, $destination, $post_id );
				
				// Include image.php
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				
				// Define attachment metadata
				$attach_data = wp_generate_attachment_metadata( $attach_id, $destination );
				
				// Assign metadata to attachment
				wp_update_attachment_metadata( $attach_id, $attach_data );
				
				
				$photos_list[$attach_id] = $destination;
				$new_photos[$attach_id] = $upload_dir['url'].'/'.$filename;
				
				set_post_thumbnail( $post_id, $attach_id );
				
				$count++;
			}
			
			update_post_meta( $post_id, 'photos', $photos_list);
			
			if($debugMode)
				error_log("Downloaded ".$count." Images For '".$listingID."'");
		}
		elseif($debugMode)
			error_log("No Images For '".$listingID."'");
		
		// For good measure.
		if(isset($photos)) $photos = null;
		if(isset($photo)) $photo = null;
		
		
		
		return $photos_list;
	}

}


?>