<?php
/**
 * The HiiWP SEO class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.3
 */

/**
 * HiiWP_Admin class.
 *
 * @since 0.4.3
 */
class HiiWP_SEO extends HiiWP_Admin {
	
	public function __construct(){
		add_action( 'cmb2_render_google_authorization', array( $this, 'cmb2_render_callback_for_google_authorization' ), 10, 5 );
		add_action( 'cmb2_admin_init', array( $this, 'seo_options_page' ) );
	}
	
	public function cmb2_render_callback_for_google_authorization( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
	    $gadwp = new GADWP_Settings();
	    $gadwp->general_settings();
	}
	
	public function seo_options_page() {

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
	        'title'     => __( 'Analytics', 'hiiwp' ),
	        'show_on'   => $show_on 
	    ));
	    
	    if(class_exists('GADWP_Manager')):
		    /*$cmb->add_field( array(
		        'name'       => __( 'Google Analytics Connect', 'hiiwp' ),
		        'desc'       => __( 'Connect directly with Google Analytics to display all your information right in your dashboard and input all the correct tracking code within your site.', 'hiiwp' ),
		        'id'         => 'google_authorization',
		        'type'       => 'google_authorization',
		    ));*/
	    else:
	    	$cmb->add_field( array(
		        'name'       => __( 'Google Analytics Code', 'hiiwp' ),
		        'desc'       => __( 'Add your Google Analytics UA code', 'hiiwp' ),
		        'id'         => 'google_analytics_ua_code',
		        'type'       => 'text',
		    ));
	    endif;
	    
	    $cmb->add_field( array(
	        'name'       => __( 'Manually enter Tracking Code', 'hiiwp' ),
	        'desc'       => __( 'If you want to use a custom tracking code enter it here, without script tag.', 'hiiwp' ),
	        'id'         => 'business_custom_tracking_code',
	        'type'       => 'textarea_code',
	    ));
	    $cmb->object_type( 'options-page' );
	    $boxes[] = $cmb;
	    
	    // add first box: this is just normal CMB2 box creation, with the exception
	    // of the show_on parameter and call to object_type method, both essential
	    $cmb_ = new_cmb2_box( array(
	        'id'        => 'site_validation',
	        'title'     => __( 'Site Validation', 'hiiwp' ),
	        'desc'		=> __('Note that <strong>verifying your site with these services is not necessary</strong> in order for your site to be indexed by search engines. To use these advanced search engine tools and verify your site with a service, paste the HTML Tag code below. Read the <a target=_blank href=https://en.support.wordpress.com/webmaster-tools/>full instructions</a> if you are having trouble. Supported verification services: <a target=_blank href=http://g.co/SearchConsole>Google Search Console</a>, <a target=_blank href=http://www.bing.com/webmaster>Bing Webmaster Center</a>, <a target=_blank href=http://pinterest.com/>Pinterest</a>', 'hiiwp'),
	        'show_on'   => $show_on,
	    ));
	    
	   
	    $cmb->add_field( array(
	        'name'       => __( 'Google Webmaster Tools', 'hiiwp' ),
	        'desc'       => __( 'Enter your Google Search Console meta value to verify your site', 'hiiwp' ),
	        'id'         => 'business_google_site_verification',
	        'type'       => 'textarea_code',
	        'attributes'	=> array(
		    	'rows'	=> '2'  
	        ),
	    ));
	    $cmb->add_field( array(
	        'name'       => __( 'Bing Webmaster Tools', 'hiiwp' ),
	        'desc'       => __( 'Enter your Bing Search Console meta value to verify your site', 'hiiwp' ),
	        'id'         => 'business_bing_site_verification',
	        'type'       => 'textarea_code',
	        'attributes'	=> array(
		    	'rows'	=> '2'  
	        ),
	    ));
	    $cmb->add_field( array(
	        'name'       => __( 'Pinterest Site Verification', 'hiiwp' ),
	        'desc'       => __( 'Enter your Pinterest meta value to verify your site', 'hiiwp' ),
	        'id'         => 'business_pinterest_site_verification',
	        'type'       => 'textarea_code',
	        'attributes'	=> array(
		    	'rows'	=> '2'  
	        ),
	    ));
	    $cmb->add_field( array(
	        'name'       => __( 'Facebook Instant Articles ID', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
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
	        'title'     => __( 'Main Company Info', 'hiiwp' ),
	        'show_on'   => $show_on,
	    ));
	    
	    $cmb->add_field( array(
	        'name'       => __( 'Business Type', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
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
	        'name'       => __( 'Business Name', 'hiiwp' ),
	        'desc'       => __( 'Use structured data markup on your official website to indicate the preferred name you want Google Search to display in Search results. <a target=_blank href=https://developers.google.com/search/docs/data-types/sitename>Read More...</a>', 'hiiwp' ),
	        'id'         => 'business_name',
	        'type'       => 'text',
	    ));
	    
	    
	    
	    $business_telephone_group = $cmb->add_field( array(
		    'id'          => 'business_telephone_numbers',
		    'type'        => 'group',
		    'description' => __( 'Use corporate contact markup on your official website to add your company\'s contact information to the Google Knowledge panel in some searches, for example when a user enters your company’s name into the Search bar. <a target=_blank href=https://developers.google.com/search/docs/data-types/corporate-contacts>Read More...</a>', 'hiiwp' ),
		    'options'     => array(
		        'group_title'   => __( 'Phone Numbers', 'hiiwp' ),
		        'add_button'    => __( 'Add Another Number', 'hiiwp' ),
		        'remove_button' => __( 'Remove Number', 'hiiwp' ),
		        'sortable'      => true
		    ),
		) );
		$cmb->add_group_field($business_telephone_group, array(
	        'name'       => __( 'Contact Type', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
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
	        'name'       => __( 'Phone Number', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
	        'id'         => 'business_telephone',
	        'type'       => 'text',
	        'show_names' => false,
	        'attributes'	=> array(
		        'placeholder'	=> 'ex: +15552224444',
	        ),
	    ));
	    
	    $cmb->add_field(array(
	        'name'       => __( 'Fax Number', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
	        'id'         => 'business_faxNumber',
	        'type'       => 'text',
	    ));
	    
	    $cmb->add_field(array(
	        'name'       => __( 'Email', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
	        'id'         => 'business_email',
	        'type'       => 'text_email',
	    ));
	    
	    $cmb->add_field(array(
	        'name'       => __( 'Email', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
	        'id'         => 'business_email',
	        'type'       => 'text_email',
	    ));
	    
	    $cmb->add_field(array(
	        'name'       => __( 'Logo', 'hiiwp' ),
	        'desc'       => __( 'Specify the image Google Search uses for your organization\'s logo in Search results and in the Knowledge Graph. <a target=_blank href=https://developers.google.com/search/docs/data-types/logo>Read More...</a>', 'hiiwp' ),
	        'id'         => 'business_logo',
	        'type'       => 'file',
	    ));
	    
	    $cmb->add_field(array(
	        'name'       => __( 'Description', 'hiiwp' ),
	        'desc'       => __( 'Maximum 250 characters', 'hiiwp' ),
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
	        'title'     => __( 'Address', 'hiiwp' ),
	        'show_on'   => $show_on,
	    ));
	    $cmb->add_field(array(
	        'name'       => __( 'Address', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
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
	        'title'     => __( 'GEO', 'hiiwp' ),
	        'show_on'   => $show_on,
	    ));
	    $cmb->add_field(array(
	        'name'       => __( 'Latitude', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
	        'id'         => 'business_geo_latitude',
	        'type'       => 'text',
	    ));
	    $cmb->add_field(array(
	        'name'       => __( 'Longitude', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
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
	        'title'     => __( 'Store Info', 'hiiwp' ),
	        'show_on'   => $show_on,
	    ));
	    $business_hours_group = $cmb->add_field( array(
		    'id'          => 'business_openingHoursSpecification',
		    'type'        => 'group',
		    'description' => __( '', 'hiiwp' ),
		    'options'     => array(
		        'group_title'   => __( 'Open Hours', 'hiiwp' ), // since version 1.1.4, {#} gets replaced by row number
		        'add_button'    => __( 'Add Another Hours Set', 'hiiwp' ),
		        'remove_button' => __( 'Remove Hours', 'hiiwp' ),
		        'sortable'      => true, // beta
		    ),
		) );
		$cmb->add_group_field($business_hours_group, array(
	        'name'       => __( 'Days', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
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
	        'name'       => __( 'Opens', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
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
	        'name'       => __( 'Closes', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
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
	        'name'       => __( 'Accepts Reservations', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
	        'id'         => 'business_acceptsReservations',
	        'type'       => 'checkbox',
	        'attributes' => array(
				'data-conditional-id'    => 'business_type',
				'data-conditional-value' => 'Restaurant',
			),
	    ));
	    $cmb->add_field(array(
	        'name'       => __( 'Menu URL', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
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
	        'title'     => __( 'Social Info', 'hiiwp' ),
	        'show_on'   => $show_on,
	    ));
	    
	    $social_profiles_group = $cmb->add_field( array(
		    'id'          => 'business_social',
		    'type'        => 'group',
		    'description' => __( 'Use markup on your official website to add your social profile information to a Google Knowledge panel. Knowledge panels prominently display your social profile information in some Google Search results. <a target=_blank href=https://developers.google.com/search/docs/data-types/social-profile-links>Read More...</a>', 'hiiwp' ),
		    'options'     => array(
		        'group_title'   => __( 'Social Profiles', 'hiiwp' ), // since version 1.1.4, {#} gets replaced by row number
		        'add_button'    => __( 'Add Social Profile', 'hiiwp' ),
		        'remove_button' => __( 'Remove Profile', 'hiiwp' ),
		        'sortable'      => true, // beta
		    ),
		) );
		$cmb->add_group_field($social_profiles_group, array(
	        'name'       => __( 'Site', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
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
	        'name'       => __( 'URL', 'hiiwp' ),
	        'desc'       => __( '', 'hiiwp' ),
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
	        'title' => 'Structured Data',
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
	        'title'      => 'HiiWP Settings',
	        'menuargs' => array(
	        	'icon_url'	=>	get_template_directory_uri().'/images/hii-dashicon.png',
	        	'position'	=> 2,
	        ),
	        
	        'boxes'      => $boxes,
	        'tabs'       => $tabs,
	        'cols'       => 1,
	        'savetxt'    => 'Save',
	    );
	    new Cmb2_Metatabs_Options( $args );
	}
	
}