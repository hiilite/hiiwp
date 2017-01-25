<?php
/////////////////////////
//
//	Add COMPANY PROFILE to Menu
//
/////////////////////////
$business_args = array(	
	/*	
	*	COMPANY MAIN	
	*/
	array(
		'id'		=>'business_type',
		'title'		=>'Business Type',
		'callback'	=>'company_setting_schema',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_name',
		'title'		=>'Business Name',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_telephone',
		'title'		=>'Phone Number',
		'callback'	=>'company_setting_phone',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_contactType',
		'title'		=>'Contact Type',
		'callback'	=>'company_setting_contactType',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_faxNumber',
		'title'		=>'Fax Number',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_email',
		'title'		=>'Email',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_logo',
		'title'		=>'Logo',
		'callback'	=>'company_setting_logo',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_url',
		'title'		=>'Website',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_main' ),
	array(
		'id'		=>'business_description',
		'title'		=>'Description',
		'callback'	=>'company_setting_textarea',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_main' ),
		
	/*	
	*	COMPANY STORE SETTINGS	
	*/
	
	array(
		'id'		=>'business_openingHoursSpecification',
		'title'		=>'Open Hours',
		'callback'	=>'company_setting_hours',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_store' ),
	array(
		'id'		=>'business_acceptsReservations',
		'title'		=>'Accepts Reservations',
		'callback'	=>'company_setting_trueFalse',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_store' ),
	
	array(
		'id'		=>'business_menu',
		'title'		=>'Menu URL',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_store' ),
		
	/*	
	*	COMPANY SOCIAL	
	*/
	array(
		'id'		=>'business_facebook',
		'title'		=>'Facebook',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_social_settings',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_twitter',
		'title'		=>'Twitter',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_social_settings',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_googleplus',
		'title'		=>'GooglePlus',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_social_settings',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_instagram',
		'title'		=>'Instagram',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_social_settings',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_linkedin',
		'title'		=>'LinkedIn',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_social_settings',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_pinterest',
		'title'		=>'Pinterest',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_social_settings',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_houzz',
		'title'		=>'Houzz',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_social_settings',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_tripadvisor',
		'title'		=>'TripAdvisor',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_social_settings',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_yelp',
		'title'		=>'Yelp',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_social_settings',
		'section'	=> 'company_social' ),
	array(
		'id'		=>'business_youtube',
		'title'		=>'YouTube',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_social_settings',
		'section'	=> 'company_social' ),	
	
	/*	
	*	COMPANY ADDRESS	
	*/
	array(
		'id'		=>'business_streetAddress',
		'title'		=>'Street Address',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_address' ),
	array(
		'id'		=>'business_addressLocality',
		'title'		=>'City',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_address' ),
	array(
		'id'		=>'business_addressRegion',
		'title'		=>'Province',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_address' ),
	array(
		'id'		=>'business_addressCountry',
		'title'		=>'Country',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_address' ),
	array(
		'id'		=>'business_postalCode',
		'title'		=>'Postal Code',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_address' ),
		
	/*	
	*	COMPANY GEO	
	*/
	array(
		'id'		=>'business_geo_latitude',
		'title'		=>'Latitude',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_geo' ),
	array(
		'id'		=>'business_geo_longitude',
		'title'		=>'Longitude',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_geo' ),
	
	/*	
	*	COMPANY POTENTIAL ACTION	
	*/
	array(
		'id'		=>'business_potentialAction',
		'title'		=>'Activate',
		'callback'	=>'company_setting_trueFalse',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_action' ),
	array(
		'id'		=>'business_potentialAction_urlTemplate',
		'title'		=>'Action URL',
		'callback'	=>'company_setting_url',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_action' ),
	array(
		'id'		=>'business_potentialAction_resultType',
		'title'		=>'Action Type',
		'callback'	=>'company_setting_potentialAction_resultType',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_action' ),
	array(
		'id'		=>'business_potentialAction_name',
		'title'		=>'Action Name',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_info_settings',
		'section'	=> 'company_action' ),
	/*
	*	PAGE VALIDATION
	*/
	array(
		'id'		=>'business_google_site_verification',
		'title'		=>'Google Site Verification',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_main_settings',
		'section'	=> 'page_validation' ),
	array(
		'id'		=>'business_fb_article_claim',
		'title'		=>'Facebook Instant Articles ID',
		'callback'	=>'company_setting_string',
		'page'		=> 'hii_main_settings',
		'section'	=> 'page_validation' ),
		
		
);

/*
*
*	Loop through all business fields and add_shortcode for each
*/
foreach($business_args as $business){
	add_shortcode( $business['id'], 'generate_shortcodes');
}
function generate_shortcodes($atts, $content = '', $shortcode = ''){
 	$options = get_option('hii_seo_settings');	
    return $options[$shortcode];
}

	
/////////////////////////
//
//	CMB2 
//
//////////////////////////

/*
* Get the Google Analytics WordPress Dashboard and render as a field in CMB2	
*/
function cmb2_render_callback_for_google_authorization( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    $gadwp = new GADWP_Settings();
    $gadwp->general_settings();
}
add_action( 'cmb2_render_google_authorization', 'cmb2_render_callback_for_google_authorization', 10, 5 );



/*
*
*	func: hii_seo_options_page
*	
* 	Initiate the Hiilite SEO Options Page	
*
*/
add_action( 'cmb2_admin_init', 'hii_seo_options_page' );
function hii_seo_options_page() {

	/*
	*
	*	MAIN HIILITE SEO SETTING PAGE
	*	
	* 	Hiilite SEO Options Page	
	*
	*/
	// the options key fields will be saved under
	$opt_key = 'hii_seo_settings';
	
	// the show_on parameter for configuring the CMB2 box, this is critical!
    $show_on = array( 'key' => 'options-page', 'value' => array( $opt_key ) );
    
    // an array to hold our boxes
    $boxes = array();

    // an array to hold some tabs
    $tabs = array();
    
    
    $cmb = new_cmb2_box( array(
        'id'        => 'site_analytics',
        'title'     => __( 'Analytics', 'cmb2' ),
        'show_on'   => $show_on,
    ));
    
     $cmb->add_field( array(
        'name'       => __( 'Google Analytics Connect', 'cmb2' ),
        'desc'       => __( 'Connect directly with Google Analytics to display all your information right in your dashboard and input all the correct tracking code within your site.', 'cmb2' ),
        'id'         => 'google_authorization',
        'type'       => 'google_authorization',
    ));
    $cmb->add_field( array(
        'name'       => __( 'Manually enter Tracking Code', 'cmb2' ),
        'desc'       => __( 'If you want to use a custom tracking code enter it here, without script tag.', 'cmb2' ),
        'id'         => 'business_custom_tracking_code',
        'type'       => 'textarea_code',
    ));
    $cmb->object_type( 'options-page' );
    $boxes[] = $cmb;
    
    // add first box: this is just normal CMB2 box creation, with the exception
    // of the show_on parameter and call to object_type method, both essential
    $cmb = new_cmb2_box( array(
        'id'        => 'site_validation',
        'title'     => __( 'Site Validation', 'cmb2' ),
        'desc'		=> __('Note that <strong>verifying your site with these services is not necessary</strong> in order for your site to be indexed by search engines. To use these advanced search engine tools and verify your site with a service, paste the HTML Tag code below. Read the <a target=_blank href=https://en.support.wordpress.com/webmaster-tools/>full instructions</a> if you are having trouble. Supported verification services: <a target=_blank href=http://g.co/SearchConsole>Google Search Console</a>, <a target=_blank href=http://www.bing.com/webmaster>Bing Webmaster Center</a>, <a target=_blank href=http://pinterest.com/>Pinterest</a>'),
        'show_on'   => $show_on,
    ));
    
   
    $cmb->add_field( array(
        'name'       => __( 'Google Webmaster Tools', 'cmb2' ),
        'desc'       => __( 'Enter your Google Search Console meta value to verify your site', 'cmb2' ),
        'id'         => 'business_google_site_verification',
        'type'       => 'textarea_code',
        'attributes'	=> array(
	    	'rows'	=> '2'  
        ),
    ));
    $cmb->add_field( array(
        'name'       => __( 'Bing Webmaster Tools', 'cmb2' ),
        'desc'       => __( 'Enter your Bing Search Console meta value to verify your site', 'cmb2' ),
        'id'         => 'business_bing_site_verification',
        'type'       => 'textarea_code',
        'attributes'	=> array(
	    	'rows'	=> '2'  
        ),
    ));
    $cmb->add_field( array(
        'name'       => __( 'Pinterest Site Verification', 'cmb2' ),
        'desc'       => __( 'Enter your Pinterest meta value to verify your site', 'cmb2' ),
        'id'         => 'business_pinterest_site_verification',
        'type'       => 'textarea_code',
        'attributes'	=> array(
	    	'rows'	=> '2'  
        ),
    ));
    $cmb->add_field( array(
        'name'       => __( 'Facebook Instant Articles ID', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_fb_article_claim',
        'type'       => 'textarea_code',
        'attributes'	=> array(
	    	'rows'	=> '1'
        ),
    ));
   
    $cmb->object_type( 'options-page' );
    $boxes[] = $cmb;
    
    
    //
    //	COMPANY INFO
    //
    $cmb = new_cmb2_box( array(
        'id'        => 'main_company_info',
        'title'     => __( 'Main Company Info', 'cmb2' ),
        'show_on'   => $show_on,
    ));
    
    $cmb->add_field( array(
        'name'       => __( 'Business Type', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_type',
        'type'       => 'pw_select',
        'options'	=>	array(
	        'Organization'	=> 'Organization',
	        'Corporation'	=> 'Corporation',
	        'EducationalOrganization' => 'EducationalOrganization',
	        'GovernmentOrganization' => 'GovernmentOrganization',
	        'LocalBusiness' => 'LocalBusiness',
	        'FinancialService' => 'FinancialService',
	        'AccountingService' => 'AccountingService',
	        'FoodEstablishment' => 'FoodEstablishment',
	        'Bakery' => 'Bakery',
	        'BarOrPub' => 'BarOrPub',
			'Brewery' => 'Brewery',
			'CafeOrCoffeeShop' => 'CafeOrCoffeeShop',
			'FastFoodRestaurant' => 'FastFoodRestaurant',
			'IceCreamShop' => 'IceCreamShop',
	        'Restaurant'	=> 'Restaurant',
	        'Winery'	=> 'Winery',
	        'GovernmentOffice'	=> 'GovernmentOffice',
	        'HealthAndBeautyBusiness'	=> 'HealthAndBeautyBusiness',
	        'BeautySalon'	=> 'BeautySalon',
	        'HairSalon'	=> 'HairSalon',
	        'HealthClub'	=> 'HealthClub',
	        'DaySpa'		=> 'DaySpa',
	        'NailSalon'	=> 'NailSalon',
	        'TattooParlor'	=> 'TattooParlor',
	        'HomeAndConstructionBusiness'	=> 'HomeAndConstructionBusiness',
	        'Electrician'	=> 'Electrician',
	        'GeneralContractor'	=> 'GeneralContractor',
	        'HVACBusiness'	=> 'HVACBusiness',
	        'HousePainter'	=> 'HousePainter',
	        'Locksmith'	=> 'Locksmith',
			'MovingCompany'	=> 'MovingCompany',
			'Plumber'	=> 'Plumber',
			'RoofingContractor'	=> 'RoofingContractor',
			'LegalService'	=> 'LegalService',
			'Attorney'	=> 'Attorney',
			'Notary'	=> 'Notary',
			'MedicalOrganization'	=> 'MedicalOrganization',
			'Dentist'	=> 'Dentist',
			'DiagnosticLab'	=> 'DiagnosticLab',
			'Hospital'	=> 'Hospital',
			'MedicalClinic'	=> 'MedicalClinic',
			'Optician'	=> 'Optician',
			'Pharmacy'	=> 'Pharmacy',
			'Physician'	=> 'Physician',
			'VeterinaryCare'	=> 'VeterinaryCare',
			'ProfessionalService'	=> 'ProfessionalService',
			'RealEstateAgent'	=> 'RealEstateAgent',
			'Store'	=> 'Store',
			'ClothingStore'	=> 'ClothingStore',
			'ElectronicsStore'	=> 'ElectronicsStore',
			'Florist'	=> 'Florist',
			'FurnitureStore'	=> 'FurnitureStore',
			'GardenStore'	=> 'GardenStore',
			'HobbyShop'	=> 'HobbyShop',
			'JewelryStore'	=> 'JewelryStore',
			'LiquorStore'	=> 'LiquorStore',
			'MensClothingStore'	=> 'MensClothingStore',
			'MobilePhoneStore'	=> 'MobilePhoneStore',
			'OutletStore'	=> 'OutletStore',
			'WholesaleStore'	=> 'WholesaleStore',
        ),
    ));
    $cmb->add_field( array(
        'name'       => __( 'Business Name', 'cmb2' ),
        'desc'       => __( 'Use structured data markup on your official website to indicate the preferred name you want Google Search to display in Search results. <a target=_blank href=https://developers.google.com/search/docs/data-types/sitename>Read More...</a>', 'cmb2' ),
        'id'         => 'business_name',
        'type'       => 'text',
    ));
    
    
    
    $business_telephone_group = $cmb->add_field( array(
	    'id'          => 'business_telephone_numbers',
	    'type'        => 'group',
	    'description' => __( 'Use corporate contact markup on your official website to add your company\'s contact information to the Google Knowledge panel in some searches, for example when a user enters your company’s name into the Search bar. <a target=_blank href=https://developers.google.com/search/docs/data-types/corporate-contacts>Read More...</a>', 'cmb2' ),
	    'options'     => array(
	        'group_title'   => __( 'Phone Numbers', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
	        'add_button'    => __( 'Add Another Number', 'cmb2' ),
	        'remove_button' => __( 'Remove Number', 'cmb2' ),
	        'sortable'      => true, // beta
	        // 'closed'     => true, // true to have the groups closed by default
	    ),
	) );
	$cmb->add_group_field($business_telephone_group, array(
        'name'       => __( 'Contact Type', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_contactType',
        'type'       => 'select',
        'options'	=> array(
	        'customer support'	=> 'customer support',
	        'technical support'	=> 'technical support',
	        'billing support'	=> 'billing support',
	        'bill payment'		=> 'bill payment',
	        'sales'				=> 'sales',
	        'reservations'		=> 'reservations',
	        'credit card support' => 'credit card support',
	        'emergency'			=> 'emergency',
	        'baggage tracking'	=> 'baggage tracking',
	        'roadside assistance' => 'roadside assistance',
	        'package tracking'	=> 'package tracking'
        ),
        'show_names' => false,
        
    ));
    $cmb->add_group_field($business_telephone_group, array(
        'name'       => __( 'Phone Number', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_telephone',
        'type'       => 'text',
        'show_names' => false,
        'attributes'	=> array(
	        'placeholder'	=> 'ex: +15552224444',
        ),
    ));
    
    $cmb->add_field(array(
        'name'       => __( 'Fax Number', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_faxNumber',
        'type'       => 'text',
    ));
    
    $cmb->add_field(array(
        'name'       => __( 'Email', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_email',
        'type'       => 'text_email',
    ));
    
    $cmb->add_field(array(
        'name'       => __( 'Email', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_email',
        'type'       => 'text_email',
    ));
    
    $cmb->add_field(array(
        'name'       => __( 'Logo', 'cmb2' ),
        'desc'       => __( 'Specify the image Google Search uses for your organization\'s logo in Search results and in the Knowledge Graph. <a target=_blank href=https://developers.google.com/search/docs/data-types/logo>Read More...</a>', 'cmb2' ),
        'id'         => 'business_logo',
        'type'       => 'file',
    ));
    
    $cmb->add_field(array(
        'name'       => __( 'Description', 'cmb2' ),
        'desc'       => __( 'Maximum 250 characters', 'cmb2' ),
        'id'         => 'business_description',
        'type'       => 'textarea',
        'attributes'	=> array(
        	'maxlength' => '250',
        	'rows'		=> '4',
        )
    ));
    $cmb->object_type( 'options-page' );
    $boxes[] = $cmb;
    
    
    //
    //	ADDRESS
    //
    $cmb = new_cmb2_box( array(
        'id'        => 'company_address_info',
        'title'     => __( 'Address', 'cmb2' ),
        'show_on'   => $show_on,
    ));
    $cmb->add_field(array(
        'name'       => __( 'Address', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_address',
        'type'       => 'address',
    ));
    $cmb->object_type( 'options-page' );
    $boxes[] = $cmb;
    
    
    //
    //	GEO
    //
    $cmb = new_cmb2_box( array(
        'id'        => 'company_geo_info',
        'title'     => __( 'GEO', 'cmb2' ),
        'show_on'   => $show_on,
    ));
    $cmb->add_field(array(
        'name'       => __( 'Latitude', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_geo_latitude',
        'type'       => 'text',
    ));
    $cmb->add_field(array(
        'name'       => __( 'Longitude', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_geo_longitude',
        'type'       => 'text',
    ));
    $cmb->object_type( 'options-page' );
    $boxes[] = $cmb;
    
    //
    //	Hours
    //
    $cmb = new_cmb2_box( array(
        'id'        => 'company_hours_info',
        'title'     => __( 'Store Info', 'cmb2' ),
        'show_on'   => $show_on,
    ));
    $business_hours_group = $cmb->add_field( array(
	    'id'          => 'business_openingHoursSpecification',
	    'type'        => 'group',
	    'description' => __( '', 'cmb2' ),
	    'options'     => array(
	        'group_title'   => __( 'Open Hours', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
	        'add_button'    => __( 'Add Another Hours Set', 'cmb2' ),
	        'remove_button' => __( 'Remove Hours', 'cmb2' ),
	        'sortable'      => true, // beta
	    ),
	) );
	$cmb->add_group_field($business_hours_group, array(
        'name'       => __( 'Days', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'dayOfWeek',
        'type'       => 'multicheck',
        'options'	=> array(
	        'Sunday' => 'Sunday',
	        'Monday' => 'Monday',
	        'Tuesday' => 'Tuesday',
	        'Wednesday' => 'Wednesday',
	        'Thursday' => 'Thursday',
	        'Friday' => 'Friday',
	        'Saturday' => 'Saturday',
        ),
        
    ));
    $cmb->add_group_field($business_hours_group, array(
        'name'       => __( 'Opens', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'opens',
        'type'       => 'select',
        'attributes' => array(
	        'style' => 'width:75px'
        ),
        'options'	=> array(
	        '01:00' => '01:00',
	        '01:30' => '01:30',
	        '02:00' => '02:00',
	        '02:30' => '02:30',
	        '03:00' => '03:00',
	        '03:30' => '03:30',
	        '04:00' => '04:00',
	        '04:30' => '04:30',
	        '05:00' => '05:00',
	        '05:30' => '05:30',
	        '06:00' => '06:00',
	        '06:30' => '06:30',
	        '07:00' => '07:00',
	        '07:30' => '07:30',
	        '08:00' => '08:00',
	        '08:30' => '08:30',
	        '09:00' => '09:00',
	        '09:30' => '09:30',
	        '10:00' => '10:00',
	        '10:30' => '10:30',
	        '11:00' => '11:00',
	        '11:30' => '11:30',
	        '12:00' => '12:00',
	        '12:30' => '12:30',
	        '13:00' => '13:00',
	        '13:30' => '13:30',
	        '14:00' => '14:00',
	        '14:30' => '14:30',
	        '15:00' => '15:00',
	        '15:30' => '15:30',
	        '16:00' => '16:00',
	        '16:30' => '16:30',
	        '17:00' => '17:00',
	        '17:30' => '17:30',
	        '18:00' => '18:00',
	        '18:30' => '18:30',
	        '19:00' => '19:00',
	        '19:30' => '19:30',
	        '20:00' => '20:00',
	        '20:30' => '20:30',
	        '21:00' => '21:00',
	        '21:30' => '21:30',
	        '22:00' => '22:00',
	        '22:30' => '22:30',
	        '23:00' => '23:00',
	        '23:30' => '23:30',
	        '24:00' => '24:00',
	        '24:30' => '24:30',
        )
    ));
    $cmb->add_group_field($business_hours_group, array(
        'name'       => __( 'Closes', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'closes',
        'type'       => 'select',
        'attributes' => array(
	        'style' => 'width:75px'
        ),
        'options'	=> array(
	        '01:00' => '01:00',
	        '01:30' => '01:30',
	        '02:00' => '02:00',
	        '02:30' => '02:30',
	        '03:00' => '03:00',
	        '03:30' => '03:30',
	        '04:00' => '04:00',
	        '04:30' => '04:30',
	        '05:00' => '05:00',
	        '05:30' => '05:30',
	        '06:00' => '06:00',
	        '06:30' => '06:30',
	        '07:00' => '07:00',
	        '07:30' => '07:30',
	        '08:00' => '08:00',
	        '08:30' => '08:30',
	        '09:00' => '09:00',
	        '09:30' => '09:30',
	        '10:00' => '10:00',
	        '10:30' => '10:30',
	        '11:00' => '11:00',
	        '11:30' => '11:30',
	        '12:00' => '12:00',
	        '12:30' => '12:30',
	        '13:00' => '13:00',
	        '13:30' => '13:30',
	        '14:00' => '14:00',
	        '14:30' => '14:30',
	        '15:00' => '15:00',
	        '15:30' => '15:30',
	        '16:00' => '16:00',
	        '16:30' => '16:30',
	        '17:00' => '17:00',
	        '17:30' => '17:30',
	        '18:00' => '18:00',
	        '18:30' => '18:30',
	        '19:00' => '19:00',
	        '19:30' => '19:30',
	        '20:00' => '20:00',
	        '20:30' => '20:30',
	        '21:00' => '21:00',
	        '21:30' => '21:30',
	        '22:00' => '22:00',
	        '22:30' => '22:30',
	        '23:00' => '23:00',
	        '23:30' => '23:30',
	        '24:00' => '24:00',
	        '24:30' => '24:30',
        )
    ));

	$cmb->add_field(array(
        'name'       => __( 'Accepts Reservations', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_acceptsReservations',
        'type'       => 'checkbox',
        'attributes' => array(
			'data-conditional-id'    => 'business_type',
			'data-conditional-value' => 'Restaurant',
		),
    ));
    $cmb->add_field(array(
        'name'       => __( 'Menu URL', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'business_menu',
        'type'       => 'text_url',
        'attributes' => array(
			'data-conditional-id'    => 'business_type',
			'data-conditional-value' => 'Restaurant',
		),
    ));
    
    $cmb->object_type( 'options-page' );
    $boxes[] = $cmb;
    
    
    
    //
    //	SOCIAL INFO
    //
    $cmb = new_cmb2_box( array(
        'id'        => 'company_social_info',
        'title'     => __( 'Social Info', 'cmb2' ),
        'show_on'   => $show_on,
    ));
    
    $social_profiles_group = $cmb->add_field( array(
	    'id'          => 'business_social',
	    'type'        => 'group',
	    'description' => __( 'Use markup on your official website to add your social profile information to a Google Knowledge panel. Knowledge panels prominently display your social profile information in some Google Search results. <a target=_blank href=https://developers.google.com/search/docs/data-types/social-profile-links>Read More...</a>', 'cmb2' ),
	    'options'     => array(
	        'group_title'   => __( 'Social Profiles', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
	        'add_button'    => __( 'Add Social Profile', 'cmb2' ),
	        'remove_button' => __( 'Remove Profile', 'cmb2' ),
	        'sortable'      => true, // beta
	    ),
	) );
	$cmb->add_group_field($social_profiles_group, array(
        'name'       => __( 'Site', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'social_site',
        'type'       => 'select',
        'show_names' => false,
        'options'	=> array(
	        'Facebook' => 'Facebook',
	        'Twitter' => 'Twitter',
	        'Google-plus' => 'Google Plus',
	        'Instagram' => 'Instagram',
	        'YouTube' => 'YouTube',
	        'LinkedIn' => 'LinkedIn',
	        'Myspace' => 'Myspace',
	        'Pinterest' => 'Pinterest',
	        'Houzz' => 'Houzz',
	        'SoundCloud' => 'SoundCloud',
	        'Tumblr' => 'Tumblr',
        ),
    ));
    
    $cmb->add_group_field($social_profiles_group, array(
        'name'       => __( 'URL', 'cmb2' ),
        'desc'       => __( '', 'cmb2' ),
        'id'         => 'social_url',
        'type'       => 'text_url',
        'show_names' => false,
        'attributes'	=> array(
	        'placeholder'	=> 'URL',
        ),
    ));
    
    $cmb->object_type( 'options-page' );
    $boxes[] = $cmb;
    
    // Tabs - an array of configuration arrays.
    $tabs[] = array(
         'id'    => 'hiilite_main_tab',
         'title' => 'Main',
         'desc'  => '<p>These are the main settings for connecting your site with tracking software, and other key settings.</p>',
         'boxes' => array(
	         'site_analytics',
             'site_validation'
         ),
    );
    $tabs[] = array(
        'id'    => 'hiilite_info_tab',
        'title' => 'Site Info',
        'desc'  => '<p>Your company information is used to fill in the Rich Snippet/Structured Data fields used by Google.</p>',
        'boxes' => array(
            'main_company_info',
            'company_address_info',
            'company_geo_info',
            'company_hours_info',
        ),
    );
    $tabs[] = array(
        'id'    => 'hiilite_social_tab',
        'title' => 'Social',
        'desc'  => '<p>Input links to all your social networks, or connect them to your social networks for automatic posting.</p>',
        'boxes' => array(
            'company_social_info'
        ),
    );


	// Arguments array. See the arguments page for more detail
    $args = array(
        'key'        => $opt_key,
        'title'      => 'Hiilite SEO',
        //'topmenu'    => 'options-general.php',
        'menuargs' => array(
        	'icon_url'	=>	'dashicons-id-alt',
        	'position'	=> 2,
        ),
        
        'boxes'      => $boxes,
        'tabs'       => $tabs,
        'cols'       => 1,
        'savetxt'    => 'Save',
    );
    new Cmb2_Metatabs_Options( $args );
    
    
    
   /* $opt_key = 'hii_xml_settings';
    // Arguments array. See the arguments page for more detail
    $args = array(
        'key'        => $opt_key,
        'title'      => 'XML Site Map',
        'topmenu'    => 'hii_seo_settings',
        'menuargs' => array(
        	'icon_url'	=>	'dashicons-id-alt',
        	'position'	=> 2,
        ),
        //'desc' => GoogleSitemapGeneratorLoader::CallHtmlShowOptionsPage(),
        
        ///'boxes'      => $boxes,
        //'tabs'       => $tabs,
        //'cols'       => 1,
        //'savetxt'    => 'Save',
    );
    
   // add_submenu_page( 'hii_seo_settings', 'My Custom Page', 'My Custom Page', 'manage_options', 'hii_xml_settings');
    */
   
    
   // new Cmb2_Metatabs_Options( $args );
}


/*
*
*	func: output_structured_data
*
*	Add all Structured data to the <head> tag
*
*/
function output_structured_data(){
	$post_id = get_the_id();
	$post_object = get_post( $post_id );
	$options = get_option('hii_seo_settings');
	
	// Page Title
	$brand_title = (get_theme_mod('brand_seo_title')!='')?get_theme_mod('brand_seo_title'):get_bloginfo('title');
	if(get_post_meta(get_the_id(), 'page_seo_title', true) != ''){
		$page_title = get_post_meta(get_the_id(), 'page_seo_title', true);
	}
	elseif(get_theme_mod('site_seo_title') != '' && is_front_page()) {
		$page_title = get_theme_mod('site_seo_title');
	} else {
		$page_title = wp_title('|',false,'right').$brand_title;
	}
	
	// Page Description
	if(get_post_meta(get_the_id(), 'page_seo_description', true) != ''){
		$page_description = get_post_meta(get_the_id(), 'page_seo_description', true);
	}
	elseif(get_theme_mod('site_seo_description') != '' && is_front_page()) {
		$page_description = get_theme_mod('site_seo_description');
	} elseif (!is_tax() && is_singular()) {
		$the_content = $post_object->post_content;
		$the_content = substr(preg_replace('/\[.*.\]|\n+/', '', $the_content), 0, 165);
		$page_description = strip_tags($the_content);
	}
	// Page Image
	if(has_post_thumbnail($post_id)){
		$page_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
		$page_image=$page_image[0];
	} else {
		$page_image = $options['business_logo'];
	}
	 
		
	?>
	<meta property="op:markup_version" content="v1.0">
	<meta property="og:title" content="<?=$page_title?>">
	<meta property="og:url" content="<?='https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]?>">
	<meta property="og:image" content="<?=$page_image?>">
	<meta property="og:description" content="<?=$page_description?>">
	<meta property="og:site_name" content="<?=$brand_title?>">
	<?php
	if(in_array($options['business_type'], array('FoodEstablishment', 'Bakery','BarOrPub','Brewery', 'CafeOrCoffeeShop', 'FastFoodRestaurant', 'IceCreamShop', 'Restaurant', 'Winery'))){
		
		if(is_page('menu') || is_tax('menu-section')){
			echo '<meta property="fb:app_id" content="'.$options['business_fb_article_claim'].'" />';
			echo '<meta property="og:type" content="restaurant.menu">';
			echo '<meta property="restaurant:restaurant" content="'.$options['business_name'].'" />';
		} if(is_singular('menu')){
			echo '<meta property="fb:app_id" content="'.$options['business_fb_article_claim'].'" />';
			echo '<meta property="og:type" content="restaurant.menu_item">';
			$section = get_the_terms($post_id, 'menu-section');
			$meta_price = get_post_meta($post_id, 'price', true);
			echo '<meta property="restaurant:section"                  content="'.$section[0]->name.'" /> 
				  <meta property="restaurant:variation:price:amount"   content="'.$meta_price.'" /> 
				  <meta property="restaurant:variation:price:currency" content="CAD" />';
		} else {
			echo '<meta property="og:type" content="restaurant.restaurant">';
			echo '<meta property="restaurant:contact_info:street_address" content="'.$options['business_address']['address-1'].'" /> 
				  <meta property="restaurant:contact_info:locality"       content="'.$options['business_address']['city'].'" /> 
				  <meta property="restaurant:contact_info:region"         content="'.$options['business_address']['state'].'" /> 
				  <meta property="restaurant:contact_info:postal_code"    content="'.$options['business_address']['zip'].'" /> 
				  <meta property="restaurant:contact_info:country_name"   content="'.$options['business_address']['country'].'" /> 
				  <meta property="restaurant:contact_info:email"          content="'.$options['business_email'].'" /> 
				  <meta property="restaurant:contact_info:phone_number"   content="'.$options['business_telephone'].'" /> 
				  <meta property="restaurant:contact_info:website"        content="'.$options['business_url'].'" /> 
				  <meta property="place:location:latitude"                content="'.$options['business_geo_latitude'].'" /> 
				  <meta property="place:location:longitude"               content="'.$options['business_geo_longitude'].'" />';
		}
	} elseif(is_single()){
		echo '<meta property="og:type" content="article">';
	} elseif(is_front_page() || is_home() || !is_single() || !is_archive()){
		echo '<meta property="og:type" content="business.business">';
		echo '<meta property="business:contact_data:street_address" content="'.$options['business_address']['address-1'].'">';
		echo '<meta property="business:contact_data:locality" 	  content="'.$options['business_address']['city'].'">';
		echo '<meta property="business:contact_info:region"     content="'.$options['business_address']['state'].'" />';
		echo '<meta property="business:contact_data:postal_code"  content="'.$options['business_address']['zip'].'">';
		echo '<meta property="business:contact_data:country_name" content="'.$options['business_address']['country'].'">';
		echo '<meta property="place:location:latitude" content="'.$options['business_geo_latitude'].'">';
		echo '<meta property="place:location:longitude" content="'.$options['business_geo_longitude'].'">';
	} else {
		echo '<meta property="og:type" content="website">';
	}
	if($options['business_fb_article_claim'] != ''){
		echo '<meta property="fb:pages" content="'.$options['business_fb_article_claim'].'" />';
	}

}
add_action('wp_head', 'output_structured_data');


/*
*
*	func: add_graph_data()
*
*	Add all Open Graph data to the <head> tag
*
*/
function add_graph_data(){
	
	$options = get_option('hii_seo_settings');
	
	/*
	*
	*	WEBSITE
	*
	*/
	$WebSite = '<script type="application/ld+json">{
	  "@context" : "http://schema.org",
	  "@type" : "WebSite",';
 		if($options['business_name']!='')$WebSite .= ' "name" : "'.$options['business_name'].'",';
	 $WebSite .= '"url" : "'.get_bloginfo('url').'"';
	$WebSite .= '}</script>';
	echo $WebSite;
	
	/*
	*
	*	ORGANIZATION
	*
	*/
	$html = '<script type="application/ld+json">{
		"@context" : "http://schema.org",
		"@type" : "Organization",';
	$html .= '"url" : "'.get_bloginfo('url').'",';
	if($options['business_logo']!='')$html .= '"logo" : "'.$options['business_logo'].'",';
	if($options['business_email']!='')$html .= '"email" : "'.$options['business_email'].'",';
	if($options['business_faxNumber']!='')$html .= '"faxNumber" : "'.$options['business_faxNumber'].'",';
	if($options['business_description']!='')$html .= ' "description" : "'.$options['business_description'].'",';
	if($options['business_name']!='')$html .= ' "name" : "'.$options['business_name'].'",';
	if(isset($options['business_telephone_numbers'])){
		foreach($options['business_telephone_numbers'] as $number){
			if($number['business_telephone']!='')$html .= ' "contactPoint" : [{
			"@type" : "ContactPoint",
			"telephone" : "'.$number['business_telephone'].'",
			"contactType" : "'.$number['business_contactType'].'"
			}],';
		}
	}
	if(isset($options['business_social'])){
		 $html .= '"sameAs" : [';
		 $comma = '';
		foreach($options['business_social'] as $socialprofile):
			$html .= $comma.'"'.$socialprofile['social_url'].'"';
			$comma = ',';
	endforeach;
	}
	if (isset($options['business_address'])){
		$html.= ' ],
		  "address": {
			"@type": "PostalAddress",';
			if($options['business_address']['city']!='')$html .= '"addressLocality": "'.$options['business_address']['city'].'",';
			if($options['business_address']['state']!='')$html .= '"addressRegion": "'.$options['business_address']['state'].'",';
			if($options['business_address']['address-1']!='')$html .= '"streetAddress": "'.$options['business_address']['address-1'].'",';
			if($options['business_address']['country']!='')$html .= '"addressCountry": "'.$options['business_address']['country'].'",';
			if($options['business_address']['zip']!='')$html .= '"postalCode": "'.$options['business_address']['zip'].'"';
		$html.='  }';
	}
	$html .= '}</script>';
	echo $html;
	
	/*
	*
	*	SPECIFIC TYPE
	*
	*/
	$html = '<script type="application/ld+json">{
	  "@context" : "http://schema.org",
	  "@type" : "'.$options['business_type'].'",';
	$html .= '"url" : "'.get_bloginfo('url').'",';
	 
	if($options['business_logo']!='')$html .= '"logo" : "'.$options['business_logo'].'",';
	if($options['business_logo']!='')$html .= '"image" : "'.$options['business_logo'].'",';
	if($options['business_email']!='')$html .= '"email" : "'.$options['business_email'].'",';
	if(isset($options['business_telephone_numbers'])){
		foreach($options['business_telephone_numbers'] as $number){
			if($number['business_telephone']!='')$html .= ' "contactPoint" : [{
			"@type" : "ContactPoint",
			"telephone" : "'.$number['business_telephone'].'",
			"contactType" : "'.$number['business_contactType'].'"
			}],';
		}
	}
	$html .= '"priceRange" : "$$$",';
	if($options['business_faxNumber']!='')$html .= '"faxNumber" : "'.$options['business_faxNumber'].'",';
	if($options['business_description']!='')$html .= ' "description" : "'.$options['business_description'].'",';
	if($options['business_name']!='')$html .= ' "name" : "'.$options['business_name'].'",';
	  
	if(in_array($options['business_type'], array('FoodEstablishment','Bakery','BarOrPub','Brewery','CafeOrCoffeeShop','FastFoodRestaurant','IceCreamShop','Restaurant','Winery'))){
		if($options['business_acceptsReservations']!='')$html .= ' "acceptsReservations" : "'.$options['business_acceptsReservations'].'",';
		if($options['business_menu']!='')$html .= ' "menu" : "'.$options['business_menu'].'",';
	  	
	  	if(isset($options['business_potentialAction'])):
			$html .= '"potentialAction":{
			    "@type":"ReserveAction",
			    "target":{
			      "@type":"EntryPoint",
			      "urlTemplate":"'.$options['business_potentialAction_urlTemplate'].'",
			      "inLanguage":"en-CA",
			      "actionPlatform":[
			        "http://schema.org/DesktopWebPlatform",
			        "http://schema.org/IOSPlatform",
			        "http://schema.org/AndroidPlatform",
			        "http://schema.org/MobileWebPlatform"
			      ]
			    },
			    "result":{
			      "@type":"'.$options['business_potentialAction_resultType'].'",
			      "name":"'.$options['business_potentialAction_name'].'"
			    }
			},';
		endif;
	}
	if(isset($options['business_telephone_numbers'])){
		if($options['business_telephone_numbers'][0]['business_telephone']!='')$html .= '"telephone" : "'.$options['business_telephone_numbers'][0]['business_telephone'].'",';
		foreach($options['business_telephone_numbers'] as $number){
			
			if($number['business_telephone']!='')$html .= ' "contactPoint" : [{
			"@type" : "ContactPoint",
			"telephone" : "'.$number['business_telephone'].'",
			"contactType" : "'.$number['business_contactType'].'"
			}],';
		}
	}
	
	if(isset($options['business_openingHoursSpecification']) && is_array($options['business_openingHoursSpecification'])){
		$html .= '"openingHoursSpecification" : [';
		$comma = '';
		foreach($options['business_openingHoursSpecification'] as $hourset):
		 	if(!empty($hourset['dayOfWeek'])){
				$html .= $comma.'{
					    "@type": "OpeningHoursSpecification",
					    "dayOfWeek": [';
					$comma2 ='';
					foreach($hourset['dayOfWeek'] as $key=>$day){
						$html .= $comma2.'"'.$day.'"';
						$comma2 =',';
					}
					
				$html .= '],
					    "opens": "'.$hourset['opens'].'",
					    "closes": "'.$hourset['closes'].'"
					  }';
				$comma = ',';
			}
		endforeach;
		$html .= ' ],';
	}
	if(isset($options['business_social'])){
		$html .= '"sameAs" : [';
		$comma = '';
		foreach($options['business_social'] as $socialprofile):
			$html .= $comma.'"'.$socialprofile['social_url'].'"';
			$comma = ',';
		endforeach;
		$html.= ' ],';
	}
	if(isset($options['business_address'])){
		$html .= '"address": {
			"@type": "PostalAddress",';
			if($options['business_address']['city']!='')$html .= '"addressLocality": "'.$options['business_address']['city'].'",';
			if($options['business_address']['state']!='')$html .= '"addressRegion": "'.$options['business_address']['state'].'",';
			if($options['business_address']['address-1']!='')$html .= '"streetAddress": "'.$options['business_address']['address-1'].'",';
			if($options['business_address']['country']!='')$html .= '"addressCountry": "'.$options['business_address']['country'].'",';
			if($options['business_address']['zip']!='')$html .= '"postalCode": "'.$options['business_address']['zip'].'"';
		$html.='  }';
	}
	  if($options['business_geo_latitude']!='' && $options['business_geo_longitude']!=''){$html .= ', "geo": {
		"@type": "GeoCoordinates",
		"latitude": "'.$options['business_geo_latitude'].'",
		"longitude": "'.$options['business_geo_longitude'].'"
	  }';}
	$html .= '}</script>';
	
	
	
	if($options['business_google_site_verification'] != ''){
		if($match = preg_match_all("/\"([^\"]*)\"/", $options['business_google_site_verification'], $output_array)){
			if(isset($output_array[1][1]))$html .= '<meta name="google-site-verification" content="'.$output_array[1][1].'">';
			else $html .= $options['business_google_site_verification'];
		} else { $html .= '<meta name="google-site-verification" content="'.$options['business_google_site_verification'].'">'; }
	}
	if($options['business_bing_site_verification'] != ''){
		if($match = preg_match_all("/\"([^\"]*)\"/", $options['business_bing_site_verification'], $output_array)){
			if(isset($output_array[1][1]))$html .= '<meta name="msvalidate.01" content="'.$output_array[1][1].'">';
			else $html .= $options['business_bing_site_verification'];
		} else { $html .= '<meta name="msvalidate.01" content="'.$options['business_bing_site_verification'].'">'; }
	}
	
	if($options['business_pinterest_site_verification'] != ''){
		if($match = preg_match_all("/\"([^\"]*)\"/", $options['business_pinterest_site_verification'], $output_array)){
			if(isset($output_array[1][1]))$html .= '<meta name="p:domain_verify" content="'.$output_array[1][1].'">';
			else $html .= $options['business_pinterest_site_verification'];
		} else { $html .= '<meta name="p:domain_verify" content="'.$options['business_pinterest_site_verification'].'">'; }
	}
	
	echo $html;
}
add_action('wp_head','add_graph_data');




?>