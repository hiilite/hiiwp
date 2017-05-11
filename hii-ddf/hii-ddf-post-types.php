<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

add_filter('single_template', array('HiiDdfPostTypes', 'ddfLoadPostTemplate'));

class HiiDdfPostTypes {
	
	/**
	 * ddfActivate function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function ddfActivate(){
		HiiDdfPostTypes::ddfRegisterPostType();
		
		
		
		/*
		 * Add each meta box in call order
		 */
		add_action('cmb2_admin_init', array('HiiDdfPostTypes','cmb2_listing_photos_metaboxes'));
		add_action('cmb2_admin_init', array('HiiDdfPostTypes','cmb2_listing_general_metaboxes'));
		add_action('cmb2_admin_init', array('HiiDdfPostTypes','cmb2_listing_address_metaboxes'));
		add_action('cmb2_admin_init', array('HiiDdfPostTypes','cmb2_listing_openhouse_metaboxes'));
		add_action('cmb2_admin_init', array('HiiDdfPostTypes','cmb2_listing_utilities_metaboxes'));
		add_action('cmb2_admin_init', array('HiiDdfPostTypes','cmb2_listing_parking_metaboxes'));
		add_action('cmb2_admin_init', array('HiiDdfPostTypes','cmb2_listing_agents_metaboxes'));
		add_action('cmb2_admin_init', array('HiiDdfPostTypes','cmb2_listing_building_metaboxes'));
		add_action('cmb2_admin_init', array('HiiDdfPostTypes','cmb2_listing_land_metaboxes'));
		
        flush_rewrite_rules();
	}

	/**
	 * ddfLoadPostTemplate function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function ddfLoadPostTemplate() {
        $query_object = get_queried_object();
        $sr_post_type = 'listing';
        $page_template = get_post_meta( $query_object->ID, 'ddf_page_template', true );

        $default_templates    = array();
        $default_templates[]  = "single-{$query_object->post_type}-{$query_object->post_name}.php";
        $default_templates[]  = "single-{$query_object->post_type}.php";
        $default_templates[]  = "page.php";

        // only apply our template to our CPT pages
        if ( $query_object->post_type == $sr_post_type ) {
            if ( !empty( $page_template ) ) {
                $default_templates = $page_template;
            }
        }
		
        $new_template = locate_template( $default_templates, false );
        return $new_template;
    }	
    
    
    
    /**
     * ddfQueryVarsInit function.
     * 
     * @access public
     * @static
     * @param mixed $vars
     * @return void
     */
    public static function ddfQueryVarsInit( $vars ) {
        global $wp_query;
        $vars[] = "listing_id";
        $vars[] = "listing_title";
        $vars[] = "listing_price";
        $vars[] = "limit";
        $vars[] = "offset";
        $vars[] = "advanced";
        $vars[] = "status";
        // sr prefixes are for the search form
        $vars[] = "minprice";
        $vars[] = "maxprice";
        $vars[] = "minbeds";
        $vars[] = "maxbeds";
        $vars[] = "minbaths";
        $vars[] = "maxbaths";
        $vars[] = "ddf_q";
        $vars[] = "keywords";
        $vars[] = "type";
        $vars[] = "ptype";
        $vars[] = "agent";
        $vars[] = "brokers";
        $vars[] = "sort";
        $vars[] = "water";
        // post type
        $vars[] = "listings";
        // advanced search form parameters
        $vars[] = "lotsize";
        $vars[] = "area";
        $vars[] = "cities";
        $vars[] = "neighborhoods";
        $vars[] = "amenities";
        $vars[] = "features";
        // multi-mls
        $vars[] = "vendor";
        // settings
        $vars[] = "map_position";
        return $vars;
    }

    
    /**
     * ddfRegisterPostType function.
     * 
     * @access public
     * @static
     * @return void
     */
    public static function ddfRegisterPostType() {
	    $labels = array(
			'name'               => _x( 'Listings', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Listing', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Listings', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Listing', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Listing', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Listing', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Listing', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Listing', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Listings', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Listings', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Listings:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No listings found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No listings found in Trash.', 'your-plugin-textdomain' )
		);
		
		$args = array(
			'labels'             => $labels,
		            'description'        => __( 'Description.', 'your-plugin-textdomain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'			 => 'dashicons-admin-multisite',
			'rewrite'            => array( 'slug' => 'listing' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt')
		);
		
		register_post_type( 'listing', $args );
		
		
		register_taxonomy(
			'status',
			'listing',
			array(
				'label' => __( 'Listing Status' ),
				'rewrite' => array( 'slug' => 'status' ),
				'hierarchical' => true,
			)
		);
    }
    
    
    
    
    
	/**
	 * cmb2_listing_photos_metaboxes function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function cmb2_listing_photos_metaboxes(){
		//////////////////////////////////
		// Generic Options Listing
		/////////////////////////////////
	    $cmb = new_cmb2_box( array(
	        'id'            => 'listing_photos',
	        'title'         => 'Listing Photos',
	        'object_types'  => array( 'listing' ), // post type
	        'context'       => 'normal', // 'normal', 'advanced' or 'side'
	        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
	        'show_names'    => true, // show field names on the left
	        'cmb_styles'    => true, // false to disable the CMB stylesheet
	        'closed'        => false, // keep the metabox closed by default
	    ) );
	    
	    $cmb->add_field( array(
		    'name' => 'photos',
		    'id'   => 'photos',
		    'type' => 'file_list',
		) );
	}
	
	
	
	/**
	 * cmb2_listing_general_metaboxes function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function cmb2_listing_general_metaboxes(){
	    $cmb = new_cmb2_box( array(
	        'id'            => 'listing_options',
	        'title'         => 'Listing General',
	        'object_types'  => array( 'listing' ), // post type
	        'context'       => 'normal', // 'normal', 'advanced' or 'side'
	        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
	        'show_names'    => true, // show field names on the left
	        'cmb_styles'    => true, // false to disable the CMB stylesheet
	        'closed'        => false, // keep the metabox closed by default
	    ) );
	    
	    $cmb->add_field( array(
		    'name' => '@attributes-ID',
		    'id'   => '@attributes-ID',
		    'type' => 'text_small',
		    'default' => '',
		    'desc' => 'Not public' 
		) );
		$cmb->add_field( array(
		    'name' => 'ListingID',
		    'id'   => 'ListingID',
		    'type' => 'text_small',
		    'default' => '',
		    'desc' => 'Visible on listing',
		) );	
		$cmb->add_field( array(
		    'name' => 'Board',
		    'id'   => 'Board',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'AmmenitiesNearBy',
		    'id'   => 'AmmenitiesNearBy',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'CommunityFeatures',
		    'id'   => 'CommunityFeatures',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'Features',
		    'id'   => 'Features',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'FarmType',
		    'id'   => 'FarmType',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'MunicipalId',
		    'id'   => 'MunicipalId',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'Price',
		    'id'   => 'Price',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'PropertyType',
		    'id'   => 'PropertyType',
		    'type' => 'select',
		    'show_option_none' => true,
		    'default' => '',
		    'options'          => array(
				'Single Family'   => __( 'Single Family', 'cmb2' ),
				'Industrial'     => __( 'Industrial', 'cmb2' ),
				'Agriculture'     => __( 'Agriculture', 'cmb2' ),
				'Office'     => __( 'Office', 'cmb2' ),
				'Business'     => __( 'Business', 'cmb2' ),
				'Vacant Land'     => __( 'Vacant Land', 'cmb2' ),
				'Office'     => __( 'Office', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'PublicRemarks',
		    'id'   => 'PublicRemarks',
		    'type' => 'textarea',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'RightType',
		    'id'   => 'RightType',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'RoadType',
		    'id'   => 'RoadType',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options' => array(
				'No thru road'  => 'No thru road',
				'Paved road' => 'Paved road',
			),
		) );
		$cmb->add_field( array(
		    'name' => 'RightType',
		    'id'   => 'RightType',
		    'type' => 'text_small',
		    'default' => 'Water Rights',
		) );
		$cmb->add_field( array(
		    'name' => 'Structure',
		    'id'   => 'Structure',
		    'type' => 'pw_multiselect', // switch back to pw_multiselect
		    'default' => '',
		    'options' => array(
				'Workshop'  => 'Workshop',
				'Wharf' => 'Wharf',
				'Clubhouse' => 'Clubhouse',
				'Patio(s)' => 'Patio(s)',
				'Deck' => 'Deck',
				'Playground' => 'Playground',
				'Tennis Court' => 'Tennis Court',
				'Shed' => 'Shed',
				'Sundeck' => 'Sundeck',
				'Greenhouse' => 'Greenhouse',
			),
		) );
		$cmb->add_field( array(
		    'name' => 'TransactionType',
		    'id'   => 'TransactionType',
		    'type' => 'text_small',
		    'default' => 'For Sale',
		) );
		$cmb->add_field( array(
		    'name' => 'ViewType',
		    'id'   => 'ViewType',
		    'type' => 'pw_multiselect',// switch back to pw_multiselect
		    'default' => '',
		    'options' => array(
				'Lake view'  => 'Lake view',
				'Mountain view' => 'Mountain view',
				'View' => 'View',
				'City view' => 'City view',
				'Valley view' => 'Valley view',
				'Ocean view' => 'Ocean view',
			),
		) );
		$cmb->add_field( array(
		    'name' => 'WaterFrontType',
		    'id'   => 'WaterFrontType',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options' => array(
			    'Waterfront' => 'Waterfront',
			    'Road Between' => 'Road Between',
				'Waterfronton river' => 'Waterfront on river',
				'Waterfront on lake'  => 'Waterfront on lake',
				'Waterfront nearby' => 'Waterfront nearby',
				'Other' => 'Other',
			),
		) );
		$cmb->add_field( array(
		    'name' => 'ZoningType',
		    'id'   => 'ZoningType',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'OwnershipType',
		    'id'   => 'OwnershipType',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'ParkingSpaceTotal',
		    'id'   => 'ParkingSpaceTotal',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'PoolFeatures',
		    'id'   => 'PoolFeatures',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'PoolType',
		    'id'   => 'PoolType',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options' => array(
			    'Pool' => 'Pool',
			    'Outdoor pool' => 'Outdoor pool',
			    'Inground pool' => 'Inground pool',
				'Above ground pool'  => 'Above ground pool',
				'Indoor pool' => 'Indoor pool',
			),
		) );
	}
	
	
	/**
	 * cmb2_listing_openhouse_metaboxes function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function cmb2_listing_openhouse_metaboxes(){
		$cmb = new_cmb2_box( array(
	        'id'            => 'listing_OpenHouse', 
	        'title'         => 'OpenHouse',
	        'object_types'  => array( 'listing' ), // post type
	        'context'       => 'normal', // 'normal', 'advanced' or 'side'
	        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
	        'show_names'    => true, // show field names on the left
	        'cmb_styles'    => true, // false to disable the CMB stylesheet
	        'closed'        => false, // keep the metabox closed by default
	    ) );
	    
	    $openhouses_group_id = $cmb->add_field( array(
			'id'          => 'OpenHouse-Event',
			'type'        => 'group',
			'description' => __( 'Each Open House associated with listing', 'cmb2' ),
			'options'     => array(
				'group_title'   => __( 'OpenHouse {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
				'add_button'    => __( 'Add Event', 'cmb2' ),
				'remove_button' => __( 'Remove Event', 'cmb2' ),
				'sortable'      => true, // beta
			),
		) );
		
		$cmb->add_group_field( $openhouses_group_id, array(
			'name' => 'StartDateTime',
			'id'   => 'StartDateTime',
			'type' => 'text_datetime_timestamp',
		) );
		$cmb->add_group_field( $openhouses_group_id, array(
			'name' => 'EndDateTime',
			'id'   => 'EndDateTime',
			'type' => 'text_datetime_timestamp',
		) );
	}
	
	
	/**
	 * cmb2_listing_utilities_metaboxes function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function cmb2_listing_utilities_metaboxes(){
		$cmb = new_cmb2_box( array(
	        'id'            => 'listing_UtilitiesAvailable',
	        'title'         => 'Utilities Available',
	        'object_types'  => array( 'listing' ), // post type
	        'context'       => 'normal', // 'normal', 'advanced' or 'side'
	        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
	        'show_names'    => true, // show field names on the left
	        'cmb_styles'    => true, // false to disable the CMB stylesheet
	        'closed'        => false, // keep the metabox closed by default
	    ) );
	    
	    $agent_group_id = $cmb->add_field( array(
			'id'          => 'UtilitiesAvailable-Utility',
			'type'        => 'group',
			'description' => __( 'Each utility associated with listing', 'cmb2' ),
			'options'     => array(
				'group_title'   => __( 'Utility {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
				'add_button'    => __( 'Add Utility', 'cmb2' ),
				'remove_button' => __( 'Remove Utility', 'cmb2' ),
				'sortable'      => true, // beta
			),
		) );
		
		$cmb->add_group_field( $agent_group_id, array(
			'name' => 'Type',
			'id'   => 'Type',
			'type' => 'select',
			'show_option_none' => true,
		    'default' => '',
		    'options'          => array(
				'Water'   => __( 'Water', 'cmb2' ),
				'Sewer'   => __( 'Sewer', 'cmb2' ),
				'Cable'     => __( 'Cable', 'cmb2' ),
				'Natural Gas'     => __( 'Natural Gas', 'cmb2' ),
				'Telephone'     => __( 'Telephone', 'cmb2' ),
				'Hydro'     => __( 'Hydro', 'cmb2' ),
				
			),
		) );
		$cmb->add_group_field( $agent_group_id, array(
			'name' => 'Description',
			'id'   => 'Description',
			'type' => 'select',
			'default' => 'Available',
		    'options'          => array(
				'Available'   => __( 'Available', 'cmb2' ),
				'At Lot Line'   => __( 'At Lot Line', 'cmb2' ),
			),
		) );
	}
	
	
	/**
	 * cmb2_listing_parking_metaboxes function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function cmb2_listing_parking_metaboxes(){
		$cmb = new_cmb2_box( array(
	        'id'            => 'ParkingSpaces',
	        'title'         => 'Parking Spaces',
	        'object_types'  => array( 'listing' ), // post type
	        'context'       => 'normal', // 'normal', 'advanced' or 'side'
	        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
	        'show_names'    => true, // show field names on the left
	        'cmb_styles'    => true, // false to disable the CMB stylesheet
	        'closed'        => false, // keep the metabox closed by default
	    ) );
	    
	    $parking_group_id = $cmb->add_field( array(
			'id'          => 'ParkingSpaces-Parking',
			'type'        => 'group',
			'description' => __( 'Each parking space associated with listing', 'cmb2' ),
			'options'     => array(
				'group_title'   => __( 'Parking Space {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
				'add_button'    => __( 'Add Parking', 'cmb2' ),
				'remove_button' => __( 'Remove Parking', 'cmb2' ),
				'sortable'      => true, // beta
			),
		) );
		
		$cmb->add_group_field( $parking_group_id, array(
			'name' => 'Name',
			'id'   => 'Name',
			'type' => 'select',
			'show_option_none' => true,
		    'default' => '',
		    'options'          => array(
				'Attached garage'   => __( 'Attached garage', 'cmb2' ),
				'Detached garage'   => __( 'Detached garage', 'cmb2' ),
				'Oversize'     => __( 'Oversize', 'cmb2' ),
				'Underground'     => __( 'Underground', 'cmb2' ),
				'Breezeway'     => __( 'Breezeway', 'cmb2' ),
				'Carport'     => __( 'Carport', 'cmb2' ),
				'Rear'     => __( 'Rear', 'cmb2' ),
				'Street'     => __( 'Street', 'cmb2' ),
				'Stall'     => __( 'Stall', 'cmb2' ),
				'Parkade'     => __( 'Parkade', 'cmb2' ),
				'RV'     => __( 'RV', 'cmb2' ),
				'See Remarks'     => __( 'See Remarks', 'cmb2' ),
			),
		) );
		$cmb->add_group_field( $parking_group_id, array(
			'name' => 'Spaces',
			'id'   => 'Spaces',
			'type' => 'text_small',
		) );
	}
	
	
	/**
	 * cmb2_listing_agents_metaboxes function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function cmb2_listing_agents_metaboxes(){
		$cmb = new_cmb2_box( array(
	        'id'            => 'listing_agents',
	        'title'         => 'Listing Agents',
	        'object_types'  => array( 'listing' ), // post type
	        'context'       => 'normal', // 'normal', 'advanced' or 'side'
	        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
	        'show_names'    => true, // show field names on the left
	        'cmb_styles'    => true, // false to disable the CMB stylesheet
	        'closed'        => false, // keep the metabox closed by default
	    ) );
	    
	    
	    $agent_group_id = $cmb->add_field( array(
			'id'          => 'AgentDetails',
			'type'        => 'group',
			'description' => __( 'Each agent associated with listing', 'cmb2' ),
			'options'     => array(
				'group_title'   => __( 'Agent {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
				'add_button'    => __( 'Add Agent', 'cmb2' ),
				'remove_button' => __( 'Remove Agent', 'cmb2' ),
				'sortable'      => true, // beta
			),
		) );
		
		$cmb->add_group_field( $agent_group_id, array(
			'name' => 'Name',
			'id'   => 'Name',
			'type' => 'text',
		) );
		$cmb->add_group_field( $agent_group_id, array(
			'name' => 'Position',
			'id'   => 'Position',
			'type' => 'text',
		) );
		
		$cmb->add_group_field( $agent_group_id, array(
			'name' => 'Phones',
			'id'   => 'Phones',
			'type' => 'text',
			'repeatable' => true,
		) );
		
		$cmb->add_group_field( $agent_group_id, array(
			'name' => 'Websites',
			'id'   => 'Websites',
			'type' => 'text',
			'repeatable' => true,
		) );
		
		
		 $office_group_id = $cmb->add_field( array(
			'id'          => 'Office',
			'type'        => 'group',
			'description' => __( 'Each agent associated with listing', 'cmb2' ),
			'repeatable'  => false,
			'options'     => array(
				'group_title'   => __( 'Office', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
			),
		) );
		$cmb->add_group_field( $office_group_id, array(
			'name' => 'Franchisor',
			'id'   => 'Franchisor',
			'type' => 'text',
		) );
		$cmb->add_group_field( $office_group_id, array(
			'name' => 'Name',
			'id'   => 'Name',
			'type' => 'text',
		) );
		$cmb->add_group_field( $office_group_id, array(
			'name' => 'Address',
			'id'   => 'Address',
			'type' => 'address',
		) );
		$cmb->add_group_field( $office_group_id, array(
			'name' => 'Phones',
			'id'   => 'Phones',
			'type' => 'text',
			'repeatable' => true,
			
		) );
		$cmb->add_group_field( $office_group_id, array(
			'name' => 'Websites',
			'id'   => 'Websites',
			'type' => 'text',
			'repeatable' => true,
		) );
		
		
		
	}
	
	
	/**
	 * cmb2_listing_building_metaboxes function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function cmb2_listing_building_metaboxes(){
	    $cmb = new_cmb2_box( array(
	        'id'            => 'Building',
	        'title'         => 'Building',
	        'object_types'  => array( 'listing' ), // post type
	        'context'       => 'normal', // 'normal', 'advanced' or 'side'
	        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
	        'show_names'    => true, // show field names on the left
	        'cmb_styles'    => true, // false to disable the CMB stylesheet
	        'closed'        => false, // keep the metabox closed by default
	    ) );
	    
	   
		$cmb->add_field( array(
		    'name' => 'BathroomTotal',
		    'id'   => 'Building-BathroomTotal',
		    'type' => 'text_small',
		    'default' => '',
		) );	
		$cmb->add_field( array(
		    'name' => 'BedroomsTotal',
		    'id'   => 'Building-BedroomsTotal',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'Appliances',
		    'id'   => 'Building-Appliances',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options'          => array(
				'Dryer - Electric'   => __( 'Dryer - Electric', 'cmb2' ),
				'Refrigerator'   => __( 'Refrigerator', 'cmb2' ),
				'Washer'   => __( 'Washer', 'cmb2' ),
				'Gas stove(s)'   => __( 'Gas stove(s)', 'cmb2' ),
				'Dishwasher'   => __( 'Dishwasher', 'cmb2' ),
				'Hot Tub'   => __( 'Hot Tub', 'cmb2' ),
				'Central Vacuum'   => __( 'Central Vacuum', 'cmb2' ),
				'Range - Electric'   => __( 'Range - Electric', 'cmb2' ),
				'Microwave'   => __( 'Microwave', 'cmb2' ),
				'Whirlpool'   => __( 'Whirlpool', 'cmb2' ),
				'Sauna'   => __( 'Landscaped', 'cmb2' ), 
			),
		) );
		$cmb->add_field( array(
		    'name' => 'ArchitecturalStyle',
		    'id'   => 'Building-ArchitecturalStyle',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'BasementDevelopment',
		    'id'   => 'Building-BasementDevelopment',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'BasementFeatures',
		    'id'   => 'Building-BasementFeatures',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'BasementType',
		    'id'   => 'Building-BasementType',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'ConstructedDate',
		    'id'   => 'Building-ConstructedDate',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'CoolingType',
		    'id'   => 'Building-CoolingType',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options'          => array(
				'Central air conditioning'   => __( 'Central air conditioning', 'cmb2' ),
				'Wall unit'   => __( 'Wall unit', 'cmb2' ),
				'Window air conditioner'   => __( 'Window air conditioner', 'cmb2' ),
				'Heat Pump'   => __( 'Heat Pump', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'ExteriorFinish',
		    'id'   => 'Building-ExteriorFinish',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options'          => array(
				'Stucco'   => __( 'Stucco', 'cmb2' ),
				'Vinyl siding'   => __( 'Vinyl siding', 'cmb2' ),
				'Stone'   => __( 'Stone', 'cmb2' ),
				'Wood siding'   => __( 'Wood siding', 'cmb2' ),
				'Brick'   => __( 'Brick', 'cmb2' ),
				'Unknown'   => __( 'Unknown', 'cmb2' ),
				'Aluminum siding'   => __( 'Aluminum siding', 'cmb2' ),
				'Cedar Siding'   => __( 'Cedar Siding', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'FireplaceFuel',
		    'id'   => 'Building-FireplaceFuel',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'FireplacePresent',
		    'id'   => 'Building-FireplacePresent',
		    'type' => 'checkbox',
		) );
		$cmb->add_field( array(
		    'name' => 'FireplaceFuel',
		    'id'   => 'Building-FireplaceFuel',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'FireplaceType',
		    'id'   => 'Building-FireplaceType',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'FireProtection',
		    'id'   => 'Building-FireProtection',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options'          => array(
				'Security system'   => __( 'Security system', 'cmb2' ),
				'Smoke Detectors'   => __( 'Smoke Detectors', 'cmb2' ),
				'Sprinkler System-Fire'   => __( 'Sprinkler System-Fire', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'FlooringType',
		    'id'   => 'Building-FlooringType',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options'          => array(
				'Hardwood'   => __( 'Hardwood', 'cmb2' ),
				'Other'   => __( 'Other', 'cmb2' ),
				'Tile'   => __( 'Tile', 'cmb2' ),
				'Ceramic Tile'   => __( 'Ceramic Tile', 'cmb2' ),
				'Carpeted'   => __( 'Carpeted', 'cmb2' ),
				'Laminate'   => __( 'Laminate', 'cmb2' ),
				'Vinyl'   => __( 'Vinyl', 'cmb2' ),
				'Linoleum'   => __( 'Linoleum', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'FoundationType',
		    'id'   => 'Building-FoundationType',
		    'type' => 'select',
		    'show_option_none' => true,
		    'default' => 'Concrete',
		    'options'          => array(
				'Concrete'   => __( 'Concrete', 'cmb2' ),
				'Stone'   => __( 'Stone', 'cmb2' ),
				'Block'   => __( 'Block', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'HalfBathTotal',
		    'id'   => 'Building-HalfBathTotal',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'HeatingFuel',
		    'id'   => 'Building-HeatingFuel',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options'          => array(
				'Natural gas'   => __( 'Natural gas', 'cmb2' ),
				'Electric'   => __( 'Electric', 'cmb2' ),
				'Wood'   => __( 'Wood', 'cmb2' ),
				'Electric'   => __( 'Electric', 'cmb2' ),
				'Propane'   => __( 'Propane', 'cmb2' ),
				'Geo Thermal'   => __( 'Geo Thermal', 'cmb2' ),
				'Combination'   => __( 'Combination', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'HeatingType',
		    'id'   => 'Building-HeatingType',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options'          => array(
				'Forced air'   => __( 'Forced air', 'cmb2' ),
				'Ground Source Heat'   => __( 'Ground Source Heat', 'cmb2' ),
				'Heat Pump'   => __( 'Heat Pump', 'cmb2' ),
				'In Floor Heating'   => __( 'In Floor Heating', 'cmb2' ),
				'Baseboard heaters'   => __( 'Baseboard heaters', 'cmb2' ),
				'Hot water radiator heat'   => __( 'Hot water radiator heat', 'cmb2' ),
				'Space heating baseboards'   => __( 'Space heating baseboards', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'RoofMaterial', 
		    'id'   => 'Building-RoofMaterial',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options'          => array(
				'Asphalt shingle'   => __( 'Asphalt shingle', 'cmb2' ),
				'Tile'   => __( 'Tile', 'cmb2' ),
				'Tar gravel'   => __( 'Tar & gravel', 'cmb2' ),
				'Wood Shingle'   => __( 'Wood Shingle', 'cmb2' ),
				'Unknown'   => __( 'Unknown', 'cmb2' ),
				'Cedar shake'   => __( 'Cedar shake', 'cmb2' ),
				'Steel'   => __( 'Steel', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'RoofStyle',
		    'id'   => 'Building-RoofStyle',
		    'type' => 'text_small',
		    'default' => 'Conventional',
		) );
		$cmb->add_field( array(
		    'name' => 'SizeInterior',
		    'id'   => 'Building-SizeInterior',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'StoriesTotal',
		    'id'   => 'Building-StoriesTotal',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'Type',
		    'id'   => 'Building-Type',
		    'type' => 'select',
		    'default' => 'House',
		    'options'          => array(
				'House'   => __( 'House', 'cmb2' ),
				'Apartment'     => __( 'Apartment', 'cmb2' ),
				'Row / Townhouse'     => __( 'Row / Townhouse', 'cmb2' ),
				'Manufacturing'     => __( 'Manufacturing', 'cmb2' ),
				'Offices'     => __( 'Offices', 'cmb2' ),
				'No Building'     => __( 'No Building', 'cmb2' ),
				'Duplex'     => __( 'Duplex', 'cmb2' ),
				'Multi-Tenant Industrial'     => __( 'Multi-Tenant Industrial', 'cmb2' ),
				'Commercial Mix'     => __( 'Commercial Mix', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'UtilityWater',
		    'id'   => 'Building-UtilityWater',
		    'type' => 'select',
		    'show_option_none' => true,
		    'default' => '',
		    'options'          => array(
				'Unknown'   => __( 'Unknown', 'cmb2' ),
				'Municipal water'     => __( 'Municipal water', 'cmb2' ),
				'Irrigation District'     => __( 'Irrigation District', 'cmb2' ),
				'Lake River Water Intake'     => __( 'Lake/River Water Intake', 'cmb2' ),
				'Private Utility'   => __( 'Private Utility', 'cmb2' ),
				'Drilled Well'   => __( 'Drilled Well', 'cmb2' ),
				'Community Water System'   => __( 'Community Water System', 'cmb2' ),
				'Government Managed'   => __( 'Government Managed', 'cmb2' ),
			),
		) );
		
		
		$rooms_group_id = $cmb->add_field( array(
			'id'          => 'Building-Rooms',
			'type'        => 'group',
			'description' => __( 'Each agent associated with listing', 'cmb2' ),
			'options'     => array(
				'group_title'   => __( 'Room {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
			),
		) );
		$cmb->add_group_field( $rooms_group_id, array(
			'name' => 'Type',
			'id'   => 'Type',
			'type' => 'text',
		) );
		$cmb->add_group_field( $rooms_group_id, array(
			'name' => 'Width',
			'id'   => 'Width',
			'type' => 'text',
		) );
		$cmb->add_group_field( $rooms_group_id, array(
			'name' => 'Length',
			'id'   => 'Length',
			'type' => 'text',
		) );
		$cmb->add_group_field( $rooms_group_id, array(
			'name' => 'Level',
			'id'   => 'Level',
			'type' => 'text',
		) );
		$cmb->add_group_field( $rooms_group_id, array(
			'name' => 'Dimension',
			'id'   => 'Dimension',
			'type' => 'text',
		) );
	}
	
	
	/**
	 * cmb2_listing_land_metaboxes function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function cmb2_listing_land_metaboxes(){
	    $cmb = new_cmb2_box( array(
	        'id'            => 'Land',
	        'title'         => 'Land',
	        'object_types'  => array( 'listing' ), // post type
	        'context'       => 'normal', // 'normal', 'advanced' or 'side'
	        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
	        'show_names'    => true, // show field names on the left
	        'cmb_styles'    => true, // false to disable the CMB stylesheet
	        'closed'        => false, // keep the metabox closed by default
	    ) );
	    
		$cmb->add_field( array(
		    'name' => 'SizeTotal',
		    'id'   => 'Land-SizeTotal',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'SizeTotalText',
		    'id'   => 'Land-SizeTotalText',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'AccessType',
		    'id'   => 'Land-AccessType',
		    'type' => 'pw_multiselect',
		    'options'          => array(
				'Easy access'   => __( 'Easy access', 'cmb2' ),
				'Highway access'   => __( 'Highway access', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'Acreage',
		    'id'   => 'Land-Acreage',
		    'type' => 'checkbox',
		    'default' => false,
		) );
		$cmb->add_field( array(
		    'name' => 'Amenities',
		    'id'   => 'Land-Amenities',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options'          => array(
				'Golf Course'   => __( 'Golf Course', 'cmb2' ),
				'Shopping'   => __( 'Shopping', 'cmb2' ),
				'Airport'     => __( 'Airport', 'cmb2' ),
				'Park'     => __( 'Park', 'cmb2' ),
				'Public Transit'     => __( 'Public Transit', 'cmb2' ),
				'Recreation'     => __( 'Recreation', 'cmb2' ),
				'Schools'     => __( 'Schools', 'cmb2' ),
				'Ski hill'     => __( 'Ski hill', 'cmb2' ),
				'Stall'     => __( 'Stall', 'cmb2' ),
				'Parkade'     => __( 'Parkade', 'cmb2' ),
				'RV'     => __( 'RV', 'cmb2' ),
				'See Remarks'     => __( 'See Remarks', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'LandscapeFeatures',
		    'id'   => 'Land-LandscapeFeatures',
		    'type' => 'pw_multiselect',
		    'default' => '',
		    'options'          => array(
				'Landscaped'   => __( 'Landscaped', 'cmb2' ),
				'Underground_sprinkler'   => __( 'Underground sprinkler', 'cmb2' ),
				'Fully landscaped'     => __( 'Fully landscaped', 'cmb2' ),
				'Garden Area'     => __( 'Garden Area', 'cmb2' ),
				'Fruit trees/shrubs'     => __( 'Fruit trees/shrubs', 'cmb2' ),
				'Recreation'     => __( 'Recreation', 'cmb2' ),
				'Schools'     => __( 'Schools', 'cmb2' ),
				'Ski hill'     => __( 'Ski hill', 'cmb2' ),
				'Stall'     => __( 'Stall', 'cmb2' ),
				'Parkade'     => __( 'Parkade', 'cmb2' ),
				'RV'     => __( 'RV', 'cmb2' ),
				'See Remarks'     => __( 'See Remarks', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'Sewer',
		    'id'   => 'Land-Sewer',
		    'type' => 'select',
		    'show_option_none' => true,
		    'default' => '',
		    'options'          => array(
				'Septic System'   => __( 'Septic System', 'cmb2' ),
				'Septic Tank and Field'     => __( 'Septic Tank and Field', 'cmb2' ),
				'Municipal sewage system'     => __( 'Municipal sewage system', 'cmb2' ),
				'Septic System No sewage system'     => __( 'Septic System, No sewage system', 'cmb2' ),
			),
		) );
		$cmb->add_field( array(
		    'name' => 'SizeIrregular',
		    'id'   => 'Land-SizeIrregular',
		    'type' => 'text_small',
		    'default' => '',
		) );
		
	}
	
	
	/**
	 * cmb2_listing_address_metaboxes function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function cmb2_listing_address_metaboxes(){
	    $cmb = new_cmb2_box( array(
	        'id'            => 'Address',
	        'title'         => 'Address',
	        'object_types'  => array( 'listing' ), // post type
	        'context'       => 'normal', // 'normal', 'advanced' or 'side'
	        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
	        'show_names'    => true, // show field names on the left
	        'cmb_styles'    => true, // false to disable the CMB stylesheet
	        'closed'        => false, // keep the metabox closed by default
	    ) );
	    
	    $cmb->add_field( array(
		    'name' => 'StreetAddress',
		    'id'   => 'Address-StreetAddress',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'AddressLine1',
		    'id'   => 'Address-AddressLine1',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'StreetNumber',
		    'id'   => 'Address-StreetNumber',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'StreetName',
		    'id'   => 'Address-StreetName',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'StreetSuffix',
		    'id'   => 'Address-StreetSuffix',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'City',
		    'id'   => 'Address-City',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'Province',
		    'id'   => 'Address-Province',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'PostalCode',
		    'id'   => 'Address-PostalCode',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'Country',
		    'id'   => 'Address-Country',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'Latitude',
		    'id'   => 'Address-Latitude',
		    'type' => 'text_small',
		    'default' => '',
		) );
		$cmb->add_field( array(
		    'name' => 'Longitude',
		    'id'   => 'Address-Longitude',
		    'type' => 'text_small',
		    'default' => '',
		) );
	    
	}

}
?>