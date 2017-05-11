<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$plugin = get_template_directory(  ).'/hii-ddf/';
$link = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $plugin );
define('RETSPATH',    $plugin.'/');
define('RETSURL',     $link.'/');


//
require_once( RETSPATH . 'hii-ddf-helper.php' );
require_once( RETSPATH . 'hii-ddf-post-types.php' );
require_once( RETSPATH . 'hii-ddf-shortcode.php' );
require_once( RETSPATH . 'hii-ddf-widgets.php' );


$RETS_Options = get_option('hii_rets_settings');
if(isset($RETS_Options['rets_username']) && isset($RETS_Options['rets_password'])){
	require("PHRets_CREA.php");
	$RETS = new PHRets();
	$TimeBackPull = "-2 days";
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
}

if ( is_admin() ) {
    require_once( RETSPATH . 'hii-ddf-admin.php' );
    add_action( 'admin_init', array( 'HiiDdfAdminSettings', 'register_admin_settings' ) );
    add_action( 'admin_menu', array( 'HiiDdfAdminSettings', 'add_to_admin_menu' ) );
}

add_action( 'init', array('HiiDdfPostTypes', 'ddfActivate' ) );
add_action( 'init', array('HiiDdf', 'enqueueScripts' ), 10, 1 );
add_action( 'custom_css', array('HiiDdf', 'addDdfCss' ) );
add_action( 'hii_before_header', array('HiiDdf', 'addToHeader' ), 100, 10 );

add_action( 'wp_footer', array('HiiDdf', 'enqueueInlineScripts' ), 100, 10 );
add_action( 'wp_footer', array('HiiDdf', 'addToFooter' ), 100, 10 );

add_filter( 'query_vars', array( 'HiiDdfPostTypes', 'ddfQueryVarsInit' ) );
add_filter( 'pre_get_posts', array( 'HiiDdfHelper', 'custom_search_query') );
add_action( 'wp_ajax_get_listing_map_info', array('HiiDdfHelper', 'get_listing_map_info') );
add_action( 'wp_ajax_nopriv_get_listing_map_info', array('HiiDdfHelper', 'get_listing_map_info') );

// ONLY MOVIE CUSTOM TYPE POSTS
add_filter('manage_listing_posts_columns', 'ddf_columns_head_only_listing', 10);
add_action('manage_listing_posts_custom_column', 'ddf_columns_content_only_listing', 10, 2);
 
// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
function ddf_columns_head_only_listing($defaults) {
    $defaults['status'] = 'Status';
    return $defaults;
}
function ddf_columns_content_only_listing($column_name, $post_id) {
    if ($column_name == 'status') {
        // show content of 'directors_name' column
        $terms = get_the_term_list( $post_id, 'status', '', ',', '' );
		if ( is_string( $terms ) ) {
			echo $terms;
		} 
    }
}

/**
 * HiiDDF class.
 */
class HiiDdf {
	
	public static $markers = array();
	
	
	public static $BuildingKeys = array(
		'BathroomTotal',
		'BedroomsTotal',
		'Appliances',
		'ArchitecturalStyle',
		'BasementDevelopment',
		'BasementFeatures',
		'BasementType',
		'ConstructedDate',
		'CoolingType',
		'ExteriorFinish',
		'FireplaceFuel',
		'FireplacePresent',
		'FireplaceType',
		'FireProtection',
		'FlooringType',
		'FoundationType',
		'HalfBathTotal',
		'HeatingFuel',
		'HeatingType',
		'RoofMaterial',
		'RoofStyle',
		'SizeInterior',
		'StoriesTotal',
		'Type',
		'UtilityWater',
	);
	public static $LandKeys = array(
		'SizeTotal',
		'Acreage',
		'Sewer',
		'SizeIrregular',
		'AccessType',
		'Amenities',
		'LandscapeFeatures',
	);
	
	public static $PropertyTypes = array(
		'All'			=> '',
		'Single Family' => 'Single Family',
		'Industrial'    => 'Industrial',
		'Agriculture'   => 'Agriculture',
		'Office'     	=> 'Office',
		'Business'     	=> 'Business',
		'Vacant Land'   => 'Vacant Land',
		'Office'     	=> 'Office',
	);
	
	public static function addToHeader() {
		echo '<div id="loading_listings" style="position:fixed;top:0;left:0;width:100%;height:100%;text-align:center;box-sizing:border-box;z-index:9999;padding-top:40vh;background:rgba(255,255,255,0.7);font-size:50px;"><i class="fa fa-spinner fa-spin"></i></div>';
	}
	public static function addToFooter(){
		echo '<script>var loading_listings = document.getElementById("loading_listings");loading_listings.parentNode.removeChild(loading_listings);</script>';
	}
	/**
	 * addDdfCss function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function addDdfCss(){
		include(RETSPATH . "css/hii-ddf-client.css");
	}
	
	
	public static function add_marker($id, $lat, $lng){
		self::$markers[] = array($id,$lat,$lng);
	}
	/**
	 * enqueueScripts function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function enqueueScripts(){
		$api_key = 'AIzaSyBe1tgp6ueJpHHXLwQYuPo9ipZ8FhkHgC0';
		wp_enqueue_script( 'markerclusterer', "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js", array('jquery'), false, true );
		
		//wp_enqueue_script( 'hii-ddf-scripts', RETSURL."js/hii-ddf-scripts.js", array('jquery'), '1.5.6', true );
		
		wp_enqueue_script( 'galleria', RETSURL."galleria/galleria-1.5.6.min.js", array('jquery'), '1.5.6', true );
		wp_enqueue_script( 'hii-ddf-galleria', RETSURL."galleria/hii-ddf-galleria.js", array('galleria'), '1.5.6', true );
		
		wp_enqueue_script( 'googleapis', "https://maps.googleapis.com/maps/api/js?key=$api_key&libraries=places&callback=initMap", array('jquery'), false, true );
		
		wp_localize_script( 'googleapis', 'hii_ddf', array('ajax_url' => admin_url('admin-ajax.php')) );
		
	}
	
	/**
	 * enqueueInlineScripts function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function enqueueInlineScripts(){
		echo '<script>';
		echo 'var locations = [';
		foreach(self::$markers as $marker) {
			echo "{id: ".$marker[0].", lat: ".$marker[1].", lng: ".$marker[2]."},";
		}
		echo '];';
		include_once RETSPATH."js/hii-ddf-scripts.js";
		echo '</script>';
	}
		
		
	// function to geocode address, it will return false if unable to geocode address
	public static function geocode($address){
	 
	    // url encode the address
	    $address = urlencode($address);
	     
	    // google map geocode api url
	    $url = "https://maps.google.com/maps/api/geocode/json?address={$address}";
	 
	    // get the json response
	    $resp_json = file_get_contents($url);
	     
	    // decode the json
	    $resp = json_decode($resp_json, true);
	 
	    // response status will be 'OK', if able to geocode given address 
	    if($resp['status']=='OK'){
	 
	        // get the important data
	        $lati = $resp['results'][0]['geometry']['location']['lat'];
	        $longi = $resp['results'][0]['geometry']['location']['lng'];
	        $formatted_address = $resp['results'][0]['formatted_address'];
	         
	        // verify if data is complete
	        if($lati && $longi && $formatted_address){
	         
	            // put the data in the array
	            $data_arr = array();            
	             
	            array_push(
	                $data_arr, 
	                    $lati, 
	                    $longi, 
	                    $formatted_address
	                );
	             
	            return $data_arr;
	             
	        }else{
	            return false;
	        }
	         
	    }else{
	        return false;
	    }
	}
	
	
}


/**
 * get_listing_template function.
 * 
 * @access public
 * @param string $size (default: 'medium')
 * @return void
 */
function get_listing_template($size = 'medium'){
	if(is_string($size)){
		ob_start();
		include(locate_template("/hii-ddf/templates/listing-$size.php"));
		$output = ob_get_clean();
	
		return $output;
	}
	return false;
}

if(class_exists('Vc_Manager')):
		
	////////////////////////////
	//
	//	SimplyRETS Listings
	//
	/////////////////////////////
	vc_map( array(
			"name" => "DDF Listings",
			"base" => "ddf_listings",
			"category" => 'Listings',
			"description" => "Show all listings from your MLS",
			"icon" => "icon-wpb-images-carousel",
			"allowed_container_element" => 'vc_row',
			"params" => array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Number of Listings",
					"param_name" => "limit"
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Property Type",
					"param_name" => "type",
					"default" => '',
					'value' => HiiDdf::$PropertyTypes,
				),
				array(
					"type" => "checkbox",
					"holder" => "div",
					"class" => "",
					"heading" => "Pagination",
					"param_name" => "pagination",
					"default"	=> 'true'
				),
			)
	) );
	
	////////////////////////////
	//
	//	SimplyRETS Listings
	//
	/////////////////////////////
	vc_map( array(
			"name" => "DDF Search Form",
			"base" => "ddf_search_form",
			"category" => 'Listings',
			"description" => "Show all listings from your MLS",
			"icon" => "icon-wpb-images-carousel",
			"allowed_container_element" => 'vc_row',
			/*"params" => array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Brokers",
					"param_name" => "brokers"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Type",
					"param_name" => "type"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Min Price",
					"param_name" => "minprice"
				),
			)*/
	) );
	
	////////////////////////////
	//
	//	SimplyRETS Listings
	//
	/////////////////////////////
	vc_map( array(
			"name" => "DDF Listings Slider",
			"base" => "ddf_listings_slider",
			"category" => 'Listings',
			"description" => "Show all listings from your MLS",
			"icon" => "icon-wpb-images-carousel",
			"allowed_container_element" => 'vc_row',
			/*"params" => array(
				array(
					"type" => "checkbox",
					"holder" => "div",
					"class" => "",
					"heading" => "Random",
					"param_name" => "random"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Min Price",
					"param_name" => "minprice"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Agent ID",
					"param_name" => "agent"
				),
			)*/
	) );
	
	vc_map( array(
			"name" => "DDF Map Search",
			"base" => "ddf_map_search",
			"category" => 'Listings',
			"description" => "Show all listings from your MLS",
			"icon" => "icon-wpb-images-carousel",
			"allowed_container_element" => 'vc_row',

	) );

endif;


