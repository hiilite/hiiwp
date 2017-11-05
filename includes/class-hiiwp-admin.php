<?php
/**
 * The HiiWP Admin class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.1
 */
if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * HiiWP_Admin class.
 *
 * @since 0.4.1
 */
class HiiWP_Admin {
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		foreach (glob(HIILITE_DIR."/includes/admin/class-hiiwp-*.php") as $filename) {
		    include_once( $filename );
		} 
		
		$this->dashboard	= new HiiWP_Dashboard();
		
		add_action( 'cmb2_admin_init', array( $this, 'hii_seo_options_page' ) );
		add_action( 'add_meta_boxes', array( $this, 'page_options_meta_box' ));
		add_action( 'save_post', array( $this, 'page_seo_options_meta_box_save' ), 999 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ));
		add_action( 'admin_head', array( $this, 'custom_colors' ));
		add_filter( 'get_user_option_edit_post_per_page', array($this, 'edit_per_page'), 10, 3 );
		add_filter( 'get_user_option_edit_page_per_page', array($this, 'edit_per_page'), 10, 3 );
		add_action( 'cmb2_render_google_authorization', array( $this, 'cmb2_render_callback_for_google_authorization'), 10, 5 );
	}
	
	
	/**
	 * edit_per_page function.
	 * 
	 * @access public
	 * @param mixed $result
	 * @param mixed $option
	 * @param mixed $user
	 * @return void
	 */
	public function edit_per_page( $result, $option, $user ) {
		$status = filter_input( INPUT_GET, 'post_status', FILTER_SANITIZE_STRING );
		return 50;
	}
	 
	

	/**
	 * hiilite_admin_styles function.
	 * 
	 * @access public
	 * @return void
	 */
	public function admin_styles() {
	    wp_register_style( 'hiilite_admin_stylesheet', get_template_directory_uri(). '/css/admin-style.css' );
	    wp_enqueue_style( 'hiilite_admin_stylesheet' );
	    
	    wp_enqueue_media();
	 
	    // Registers and enqueues the required javascript.
	    wp_register_script( 'meta_uploader', get_template_directory_uri() . '/js/meta_uploader.js', array( 'jquery' ) );
	    wp_localize_script( 'meta_uploader', 'meta_image',
	        array(
	            'title' => __( 'Choose or Upload an Image', 'prfx-textdomain' ),
	            'button' => __( 'Use this image', 'prfx-textdomain' ),
	        )
	    );
	    wp_enqueue_script( 'meta_uploader' );
	}
	
	
	/**
	 * custom_colors function.
	 * 
	 * @access public
	 * @return void
	 */
	public function custom_colors() {
		
		include_once(HIILITE_DIR . '/includes/site_variables.php');
		echo '<style>';
			include_once(HIILITE_DIR . '/css/editor-style.php');
		echo '</style>';
		add_editor_style( HIILITE_DIR.'/css/editor-style.css' ); 
	}
	

	
	/**
	 * page_options_meta_box function.
	 * 
	 * @access public
	 * @return void
	 */
	public function page_options_meta_box()
	{
	    add_meta_box(
	        'page_seo_options', // id, used as the html id att
	        __( 'HiiWP SEO Options' ), // meta box title, like "Page Attributes"
	        array($this, 'page_seo_options_meta_box_cb'), // callback function, spits out the content
	        array('page','post','portfolio','team','menu'), // post type or page. We'll add this to pages only
	        'normal', // context (where on the screen
	        'high' // priority, where should this go in the context?
	    );
	}
	
	/**
	 * page_seo_options_meta_box_cb function.
	 * 
	 * @access public
	 * @param mixed $post
	 * @return void
	 */
	public function page_seo_options_meta_box_cb( $post )
	{
		// $post is already set, and contains an object: the WordPress post
	    global $post;
	    $values = get_post_custom( $post->ID );
	    $page_seo_title = isset( $values['page_seo_title'][0] ) ? esc_attr( $values['page_seo_title'][0] ) : '';
	    if(isset($values['_yoast_wpseo_title'][0]) && $page_seo_title == '')$page_seo_title = $values['_yoast_wpseo_title'][0];
	    
	    $page_seo_description = isset( $values['page_seo_description'][0] ) ? esc_attr( $values['page_seo_description'][0] ) : '';
	    if(isset($values['_yoast_wpseo_title'][0]) && $page_seo_title == '')$page_seo_title = $values['_yoast_wpseo_title'][0];
	    if(isset($values['_yoast_wpseo_metadesc'][0]) && $page_seo_description == '')$page_seo_description = $values['_yoast_wpseo_metadesc'][0];
	    // We'll use this nonce field later on when saving.
	    wp_nonce_field( 'page_seo_options__meta_box_nonce', 'meta_box_nonce' );
		if(! defined('WPSEO_VERSION')):
	    ?>
	    <p>
		<label for="page_seo_title">SEO Title</label><br>
	        <input id="page_seo_title" name="page_seo_title" maxlength="65" type="text" size="70" placeholder="%%title%% %%sep%% %%sitename%%" value="<?=$page_seo_title?>" />
	    </p>
	    
	    <p>
	        <label for="page_seo_description">Meta Description</label><br>
	        <textarea id="page_seo_description" name="page_seo_description" cols="70" rows="4" maxlength="165"><?=$page_seo_description?></textarea>
	    </p>
	    <?php    
	    else :
	    ?>
	    <p>HiiWP SEO is deactivate while Yoast is installed</p>
	    <?php
	    endif;
	}
	
	/**
	 * page_seo_options_meta_box_save function.
	 * 
	 * @access public
	 * @param mixed $post_id
	 * @return void
	 */
	public function page_seo_options_meta_box_save( $post_id )
	{
	    // Bail if we're doing an auto save
	    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	     
	    // if our nonce isn't there, or we can't verify it, bail
	    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'page_seo_options__meta_box_nonce' ) ) return;
	    
	    $page_seo_title = isset( $_POST['page_seo_title'] )? $_POST['page_seo_title'] : '';
	    $page_seo_description = isset( $_POST['page_seo_description'] )? $_POST['page_seo_description'] : '';
	    update_post_meta( $post_id, 'page_seo_title', $page_seo_title );
	    update_post_meta( $post_id, 'page_seo_description', $page_seo_description );
	}
	
	
	public function cmb2_render_callback_for_google_authorization( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
	    $gadwp = new GADWP_Settings();
	    $gadwp->general_settings();
	}
	
	
	
	public function hii_seo_options_page() {
	
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
	        'show_on'   => $show_on 
	    ));
	    
	    if(class_exists('GADWP_Manager')):
		    /*$cmb->add_field( array(
		        'name'       => __( 'Google Analytics Connect', 'cmb2' ),
		        'desc'       => __( 'Connect directly with Google Analytics to display all your information right in your dashboard and input all the correct tracking code within your site.', 'cmb2' ),
		        'id'         => 'google_authorization',
		        'type'       => 'google_authorization',
		    ));*/
	    else:
	    	$cmb->add_field( array(
		        'name'       => __( 'Google Analytics Code', 'cmb2' ),
		        'desc'       => __( 'Add your Google Analytics UA code', 'cmb2' ),
		        'id'         => 'google_analytics_ua_code',
		        'type'       => 'text',
		    ));
	    endif;
	    
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
	    $cmb_ = new_cmb2_box( array(
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
		        'group_title'   => __( 'Phone Numbers', 'cmb2' ),
		        'add_button'    => __( 'Add Another Number', 'cmb2' ),
		        'remove_button' => __( 'Remove Number', 'cmb2' ),
		        'sortable'      => true
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
new HiiWP_Admin();
?>