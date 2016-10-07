<?php
	
//////////////////////
//
// Real Estate
//
//////////////////////

add_action( 'init', 'hiilite_listing_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function hiilite_listing_init() {
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
			'label' => __( 'Site Status' ),
			'rewrite' => array( 'slug' => 'status' ),
			'hierarchical' => true,
		)
	);
	
}





/*
 * Add each meta box in call order
 */
 add_action('cmb2_admin_init', 'cmb2_listing_photos_metaboxes');
 add_action('cmb2_admin_init', 'cmb2_listing_general_metaboxes');
 add_action('cmb2_admin_init', 'cmb2_listing_property_metaboxes');
 add_action('cmb2_admin_init', 'cmb2_listing_address_metaboxes');
 add_action('cmb2_admin_init', 'cmb2_listing_mls_metaboxes');
 add_action('cmb2_admin_init', 'cmb2_listing_tax_metaboxes');
 
 add_action('cmb2_admin_init', 'cmb2_listing_office_metaboxes');
 add_action('cmb2_admin_init', 'cmb2_listing_agent_metaboxes');
 
 // Closed
 add_action('cmb2_admin_init', 'cmb2_listing_coAgent_metaboxes');
 add_action('cmb2_admin_init', 'cmb2_listing_geo_metaboxes');
 add_action('cmb2_admin_init', 'cmb2_listing_association_metaboxes');
 add_action('cmb2_admin_init', 'cmb2_listing_extras_metaboxes');


function cmb2_listing_photos_metaboxes(){
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


function cmb2_listing_general_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
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
	    'name' => 'mlsId',
	    'id'   => 'mlsId',
	    'type' => 'text_small',
	    'default' => '',
	    'desc' => 'Not public' 
	) );
	$cmb->add_field( array(
	    'name' => 'listingId',
	    'id'   => 'listingId',
	    'type' => 'text_small',
	    'default' => '',
	    'desc' => 'Visible on listing',
	) );
	$cmb->add_field( array(
	    'name' => 'List Price',
	    'id'   => 'listPrice',
	    'type' => 'text_small',
	    'default' => '',
	) );
	
	
	$cmb->add_field( array(
	    'name' => 'virtualTourUrl',
	    'id'   => 'virtualTourUrl',
	    'type' => 'text_url',
	    'default' => '',
	) );
	
	
	$cmb->add_field( array(
	    'name' => 'Date Listed',
	    'id'   => 'listDate',
	    'type' => 'text_date',
	    'default' => '',
	) );
	$cmb->add_field( array(
	    'name' => 'Date Last Modified',
	    'id'   => 'modified',
	    'type' => 'text_date',
	    'default' => '',
	) );
	
	$cmb->add_field( array(
	    'name' => 'Size',
	    'id'   => 'property-area',
	    'type' => 'text_small',
	    'desc' => 'Interior Sqft',
	) );
	
	$cmb->add_field( array(
	    'name' => 'Bedrooms',
	    'id'   => 'property-bedrooms',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'Bathrooms',
	    'id'   => 'property-bathrooms',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'Type',
	    'id'   => 'property-subType',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'remarks',
	    'id'   => 'remarks',
	    'type' => 'textarea',
	    'default' => '',
	    'desc' => 'Post content will take precedence over remarks'
	) );
	
	
	
}

function cmb2_listing_property_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'listing_property',
        'title'         => 'Property Details',
        'object_types'  => array( 'listing' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => false, // keep the metabox closed by default
    ) );
    
	
	$cmb->add_field( array(
	    'name' => 'style',
	    'id'   => 'property-style',
	    'type' => 'text',
	    'desc' => 'ex: 2 Storey w/Bsmt.',
	) );
	
	$cmb->add_field( array(
	    'name' => 'Bathrooms Full',
	    'id'   => 'property-bathsFull',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'Bathrooms Half',
	    'id'   => 'property-bathsHalf',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'Stories',
	    'id'   => 'property-stories',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'Fireplaces',
	    'id'   => 'property-fireplaces',
	    'type' => 'text_small',
	) );
	
	
	$cmb->add_field( array(
	    'name' => 'Interior Features',
	    'id'   => 'property-interiorFeatures',
	    'type' => 'text_small',
	) );
	
	
	$cmb->add_field( array(
	    'name' => 'Lot Size',
	    'id'   => 'property-lotSizeArea',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'Maintenance Fees',
	    'id'   => 'property-maintenanceExpense',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'View',
	    'id'   => 'property-view',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'Year Built',
	    'id'   => 'property-yearBuilt',
	    'type' => 'text_small',
	) );
}






function cmb2_listing_address_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'listing_address',
        'title'         => 'Listing Address',
        'object_types'  => array( 'listing' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => false, // keep the metabox closed by default
    ) );
    
    $cmb->add_field( array(
	    'name' => 'Unit Number',
	    'id'   => 'address-unit',
	    'type' => 'text_small',
	) );
    $cmb->add_field( array(
	    'name' => 'Street Number',
	    'id'   => 'address-streetNumber',
	    'type' => 'text_small',
	) );
    
	
	$cmb->add_field( array(
	    'name' => 'Street Name',
	    'id'   => 'address-streetName',
	    'type' => 'text_small',
	) );
	
	
	$cmb->add_field( array(
	    'name' => 'City',
	    'id'   => 'address-city',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'Sub Area',
	    'id'   => 'property-subdivision',
	    'type' => 'text_small',
	    'desc' => 'ex: Downtown VW'
	) );
	
	$cmb->add_field( array(
	    'name' => 'Province',
	    'id'   => 'address-state',
	    'type' => 'text_small',
	    'default' => 'BC',
	) );
	$cmb->add_field( array(
	    'name' => 'Country',
	    'id'   => 'address-country',
	    'type' => 'text_small',
	    'default' => 'Canada',
	) );
	
	
	
}


function cmb2_listing_tax_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'listing_tax',
        'title'         => 'Listing Tax',
        'object_types'  => array( 'listing' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => false, // keep the metabox closed by default
    ) );
    
    $cmb->add_field( array(
	    'name' => 'taxYear',
	    'id'   => 'tax-taxYear',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'taxAnnualAmount',
	    'id'   => 'tax-taxAnnualAmount',
	    'type' => 'text_small',
	) );
	
}


function cmb2_listing_office_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'listing_office',
        'title'         => 'Listing Office',
        'object_types'  => array( 'listing' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => false, // keep the metabox closed by default
    ) );
    
    $cmb->add_field( array(
	    'name' => 'name',
	    'id'   => 'office-name',
	    'type' => 'text',
	) );
	$cmb->add_field( array(
	    'name' => 'servingName',
	    'id'   => 'office-servingName',
	    'type' => 'text',
	) );
	$cmb->add_field( array(
	    'name' => 'brokerid',
	    'id'   => 'office-brokerid',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'email',
	    'id'   => 'office-contact-email',
	    'type' => 'text_email',
	) );
	$cmb->add_field( array(
	    'name' => 'office phone',
	    'id'   => 'office-contact-office',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'cell',
	    'id'   => 'office-contact-cell',
	    'type' => 'text_small',
	) );
	
}


function cmb2_listing_agent_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'listing_agent',
        'title'         => 'Listing Agent',
        'object_types'  => array( 'listing' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => false, // keep the metabox closed by default
    ) );
    
    $cmb->add_field( array(
	    'name' => 'id',
	    'id'   => 'agent-id',
	    'type' => 'text_small',
	) );
    $cmb->add_field( array(
	    'name' => 'firstName',
	    'id'   => 'agent-crossStreet',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'lastName',
	    'id'   => 'agent-lastName',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'email',
	    'id'   => 'agent-contact-email',
	    'type' => 'text_email',
	) );
	$cmb->add_field( array(
	    'name' => 'office phone',
	    'id'   => 'agent-contact-office',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'cell',
	    'id'   => 'agent-contact-cell',
	    'type' => 'text_small',
	) );
	
}

function cmb2_listing_coAgent_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'listing_coAgent',
        'title'         => 'Listing Co-Agent',
        'object_types'  => array( 'listing' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => true, // keep the metabox closed by default
    ) );
    
    $cmb->add_field( array(
	    'name' => 'id',
	    'id'   => 'coAgent-id',
	    'type' => 'text_small',
	) );
    $cmb->add_field( array(
	    'name' => 'firstName',
	    'id'   => 'coAgent-crossStreet',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'lastName',
	    'id'   => 'coAgent-lastName',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'email',
	    'id'   => 'coAgent-contact-email',
	    'type' => 'text_email',
	) );
	$cmb->add_field( array(
	    'name' => 'office phone',
	    'id'   => 'coAgent-contact-office',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'cell',
	    'id'   => 'coAgent-contact-cell',
	    'type' => 'text_small',
	) );
	
}


function cmb2_listing_mls_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'listing_mls',
        'title'         => 'Listing MLS Details',
        'object_types'  => array( 'listing' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => false, // keep the metabox closed by default
    ) );
    
	$cmb->add_field( array(
	    'name' => 'area',
	    'id'   => 'mls-area',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'daysOnMarket',
	    'id'   => 'mls-daysOnMarket',
	    'type' => 'text_small',
	) );
	
}


function cmb2_listing_roomdimensions_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'listing_roomdimensions',
        'title'         => 'Room Dimensions',
        'object_types'  => array( 'listing' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => false, // keep the metabox closed by default
    ) );
    
    $group_field_id = $cmb->add_field( array(
	    'id'          => 'rooms',
	    'type'        => 'group',
	    'description' => __( 'Add each room and its dimensions', 'hiiwp' ),
	    'repeatable'  => true, // use false if you want non-repeatable group
	    'options'     => array(
	        'group_title'   => __( 'Entry {#}', 'hiiwp' ), // since version 1.1.4, {#} gets replaced by row number
	        'add_button'    => __( 'Add Another Entry', 'hiiwp' ),
	        'remove_button' => __( 'Remove Entry', 'hiiwp' ),
	        'sortable'      => true, // beta
	        // 'closed'     => true, // true to have the groups closed by default
	    ),
	) );
	
	
	$cmb->add_group_field( $group_field_id, array(
	    'name' => 'Room',
	    'id'   => 'title',
	    'type' => 'text_small',
	    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );
	
	$cmb->add_group_field( $group_field_id, array(
	    'name' => 'Room',
	    'id'   => 'dimensions',
	    'type' => 'text_small',
	    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );


}


function cmb2_listing_geo_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'listing_geo',
        'title'         => 'Listing GEO',
        'object_types'  => array( 'listing' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => true, // keep the metabox closed by default
    ) );
    
    $cmb->add_field( array(
	    'name' => 'county',
	    'id'   => 'geo-county',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'lat',
	    'id'   => 'geo-lat',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'lng',
	    'id'   => 'geo-lng',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'marketArea',
	    'id'   => 'geo-marketArea',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'directions',
	    'id'   => 'geo-directions',
	    'type' => 'text_small',
	) );

}





function cmb2_listing_association_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'listing_association',
        'title'         => 'Listing Association',
        'object_types'  => array( 'listing' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => true, // keep the metabox closed by default
    ) );
    
    $cmb->add_field( array(
	    'name' => 'fee',
	    'id'   => 'association-fee',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'name',
	    'id'   => 'association-name',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'amenities',
	    'id'   => 'association-amenities',
	    'type' => 'text_small',
	) );


}



function cmb2_listing_extras_metaboxes(){
	//////////////////////////////////
	// Generic Options Listing
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'listing_extras',
        'title'         => 'Listing Extras',
        'object_types'  => array( 'listing' ), // post type
        'context'       => 'normal', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => true, // keep the metabox closed by default
    ) );
    
    $cmb->add_field( array(
	    'name' => 'terms',
	    'id'   => 'terms',
	    'type' => 'text_small',
	    'default' => '',
	) );
	$cmb->add_field( array(
	    'name' => 'sales',
	    'id'   => 'sales',
	    'type' => 'text_small',
	    'default' => '',
	) );
	
	$cmb->add_field( array(
	    'name' => 'leaseType',
	    'id'   => 'leaseType',
	    'type' => 'text_small',
	    'default' => '',
	) );
	$cmb->add_field( array(
	    'name' => 'leaseTerm',
	    'id'   => 'leaseTerm',
	    'type' => 'text_small',
	    'default' => '',
	) );
	$cmb->add_field( array(
	    'name' => 'school',
	    'id'   => 'school',
	    'type' => 'text_small',
	    'default' => '',
	) );
	$cmb->add_field( array(
	    'name' => 'disclaimer',
	    'id'   => 'disclaimer',
	    'type' => 'textarea',
	    'default' => 'This information is believed to be accurate, but without warranty.',
	) );
	$cmb->add_field( array(
	    'name' => 'privateRemarks',
	    'id'   => 'privateRemarks',
	    'type' => 'textarea',
	    'default' => '',
	) );
	$cmb->add_field( array(
	    'name' => 'showingInstructions',
	    'id'   => 'showingInstructions',
	    'type' => 'textarea',
	    'default' => '',
	) );
	
	$cmb->add_field( array(
	    'name' => 'roof',
	    'id'   => 'property-roof',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'cooling',
	    'id'   => 'property-cooling',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'flooring',
	    'id'   => 'property-flooring',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'heating',
	    'id'   => 'property-heating',
	    'type' => 'text_small',
	) );

	$cmb->add_field( array(
	    'name' => 'foundation',
	    'id'   => 'property-foundation',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'laundryFeatures',
	    'id'   => 'property-laundryFeatures',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'occupantName',
	    'id'   => 'property-occupantName',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'lotDescription',
	    'id'   => 'property-lotDescription',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'pool',
	    'id'   => 'property-pool',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'areaSource',
	    'id'   => 'property-areaSource',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'additionalRooms',
	    'id'   => 'property-additionalRooms',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'exteriorFeatures',
	    'id'   => 'property-exteriorFeatures',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'water',
	    'id'   => 'property-water',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'lotSize',
	    'id'   => 'property-lotSize',
	    'type' => 'text_small',
	    'desc' => 'Total lot sqft'
	) );
	$cmb->add_field( array(
	    'name' => 'crossStreet',
	    'id'   => 'address-crossStreet',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'postalCode',
	    'id'   => 'address-postalCode',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'streetNumberText',
	    'id'   => 'address-streetNumberText',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'full',
	    'id'   => 'address-full',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'construction',
	    'id'   => 'property-construction',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'lotSizeAreaUnits',
	    'id'   => 'property-lotSizeAreaUnits',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'type',
	    'id'   => 'property-type',
	    'type' => 'text_small',
	    'default' => 'RES',
	) );
	$cmb->add_field( array(
	    'name' => 'garageSpaces',
	    'id'   => 'property-garageSpaces',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'accessibility',
	    'id'   => 'property-accessibility',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'acres',
	    'id'   => 'property-acres',
	    'type' => 'text_small',
	) );
	$cmb->add_field( array(
	    'name' => 'occupantType',
	    'id'   => 'property-occupantType',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'originatingSystemName',
	    'id'   => 'mls-originatingSystemName',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'status',
	    'id'   => 'mls-status',
	    'type' => 'text_small',
	    'default' => 'Active'
	) );
	$cmb->add_field( array(
	    'name' => 'id',
	    'id'   => 'tax-id',
	    'type' => 'text_small',
	) );
}



///////////////////////
//
//	SEARCH PAGE
//
//////////////////////

add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page');
 
function wpdocs_register_my_custom_submenu_page() {
    add_submenu_page(
        'edit.php?post_type=listing',
        'Search Listings',
        'Search Listings',
        'manage_options',
        'search-listings',
        'wpdocs_my_custom_submenu_page_callback' );
}

function wpdocs_my_custom_submenu_page_callback() {
	$postTitleError = '';
 
	if ( isset( $_POST['submitted'] ) ) {
		//echo '<pre>';
		//print_r($_POST);
	 
	    if ( trim( $_POST['postTitle'] ) === '' ) {
	        $postTitleError = 'Please enter a title.';
	        $hasError = true;
	    }
	    
	    $_listing_arrs = null;
	    $_listing_meta = $_POST["_listing"];
	   
	    if(isset($_listing_meta)){
	        foreach($_listing_meta as $key => $value){
		        if(is_object($value) && $key != 'photos'){
			        foreach($value as $key1 => $value1){
				        $_listing_arrs[$key."-".$key1] = $value1;
				    }
			    } elseif($key != 'photos') {
				    $_listing_arrs[$key] = $value;
				}
				
	        }
	    }
	    
	    if($hasError){
		    print_r('error');
	    }
	    $post_information = array(
	        'post_title' => wp_strip_all_tags( $_POST['postTitle'] ),
	        'post_content' => $_POST['postContent'],
	        'post_type' => 'listing',
	        'post_status' => 'pending',
	        'meta_input' => $_listing_arrs
	    );
	        
	    
        
        
        if($post_id = wp_insert_post( $post_information )) {
	        
	        
			$upload_dir = wp_upload_dir(); // Set upload folder
			$new_photos = array();
			
	        foreach($_listing_meta['photos'] as $key => $image_url) {
		        $image_data = file_get_contents($image_url); // Get image data
				$filename   = basename($image_url); // Create image file name
				
				// Check folder permission and define file location
				if( wp_mkdir_p( $upload_dir['path'] ) ) {
				    $file = $upload_dir['path'] . '/' . $filename;
				} else {
				    $file = $upload_dir['basedir'] . '/' . $filename;
				}
				
				// Create the image  file on the server
				file_put_contents( $file, $image_data );
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
				$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
				
				// Include image.php
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				
				// Define attachment metadata
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
				
				// Assign metadata to attachment
				wp_update_attachment_metadata( $attach_id, $attach_data );
				
				$new_photos[$attach_id] = $upload_dir['url'].'/'.$filename;
				
				if($key == 0){
					// And finally assign featured image to post
					set_post_thumbnail( $post_id, $attach_id );
				}
	        }			
			update_post_meta( $post_id, 'photos', $new_photos);
			
			
			
			
			
		}
	} 
	
	$agent = (isset($_GET['agent']) && isset($_GET['agent']) && $_GET['agent'] != '')?'&agent='.$_GET['agent']:'';
	$brokers = (isset($_GET['brokers']) && isset($_GET['brokers']) && $_GET['brokers'] != '')?'&brokers='.$_GET['brokers']:'';
	$mlsq = (isset($_GET['mlsId']) && isset($_GET['mlsId']) && $_GET['mlsId'] != '')?'&q='.$_GET['mlsId']:'';
	
	$limit = '&limit=20';
	
	$offset = (isset($_GET['offset']))?$_GET['offset']:$offset = 0;
	$offset_get = ($offset != 0)?'&offset='.$offset:'';
	
	
	$remote_url = 'https://api.simplyrets.com/properties?include=rooms'.$mlsq.$offset_get.$limit.$agent.$brokers;
	
	
    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
        echo '<h2>Search Your MLS</h2>';
        
    $username = "peter_v5313125";
	$password = "28963z4044684801";
	
	
	$opts = array(
	    'http'=>array(
	        'method'=>"GET",
	        'header' => "Authorization: Basic " . base64_encode("$username:$password")
	    )
	);
	$context = stream_context_create($opts);
	$file = json_decode(file_get_contents($remote_url, false, $context));
	?>
	<table>
		<tr>
			<td>
				<form action="">
					<input type="hidden" value="listing" name="post_type">
					<input  type="hidden" value="search-listings" name="page">
					<input type="search" name="mlsId">
					<input type="submit" value="Search" name="search" class="button button-secondary">
					
				</form>
			</td>
			<td>
				<form action="">
					<input type="hidden" value="listing" name="post_type">
					<input  type="hidden" value="search-listings" name="page">
					<input  type="submit" value="Show Agents Listings" name="search" class="button button-primary">
					<input type="hidden" name="agent" value="42460">
				</form>
			</td>
			<td>
				<form action="">
					<input type="hidden" value="listing" name="post_type">
					<input  type="hidden" value="search-listings" name="page">
					<input  type="submit" value="Show Brokers Listings" name="search" class="button button-secondary">
					<input type="hidden" name="brokers" value="2177">
				</form>
			</td>
		</tr>
	</table>
	
	
	<?php
	//if(count($file) > 1){
	foreach($file as $property):
	
		echo '<div>';
		?>
		<form action="" id="primaryPostForm" method="POST">
		 	<table>
			 	<tr>
				 	<td><?='<img src="'.$property->photos[0].'" width=100 height=100>';?></td>
				 	<td><?='<span class="">'.$property->mlsId.'</span>';?><br>
					 	<?='<span class="property_mlsId">'.$property->listingId.'</span>';?><br>
				 		<input type="text" name="postTitle" id="postTitle" value="<?=$property->address->full?>" readonly="readonly" />
				 	</td>
				 	<td>
					 	<?php if(!post_exists($property->address->full)){ ?>
					 	<button type="submit" class="button button-secondary"><?php _e('Add as own', 'framework') ?></button>
					 	<?php } ?>
				 	</td>
			 	</tr>
		 	</table>
		 	<details>
			 	<summary>See Data</summary>
		 		<pre><?php print_r($property); ?></pre>
		 	</details>
			<input type="hidden" value="<?=$property->photos[0]?>" name="featuredImage" id="featuredImage" >
			<input type="hidden" value="<?=$property->remarks?>" name="postContent" id="postContent" >
	        
	        <?php 
	        foreach($property as $key => $value){
		        if(!is_array($value) && !is_object($value)) {
			        ?><input type="hidden" value="<?=$value?>" name="<?='_listing['.$key?>]"><?php
		        } elseif((is_object($value) || is_array($value)) && $key !== 'photos') {
			        foreach($value as $ok => $ov){
				        if(!is_array($ov) && !is_object($ov)) {
				        	?><input type="hidden" value="<?=$ov;?>" name="<?='_listing['.$key.'-'.$ok;?>]"><?php
					    }
			        }
		        }elseif($key == 'photos') {
				    foreach($value as $ok => $ov){
					    ?><input type="hidden" value='<?=$ov;?>' name="_listing[photos][<?=$ok?>]"><?php
			        }
				    
			    }
	        }   
	        ?>
		    <input type="hidden" name="submitted" id="submitted" value="true" />
		 
		</form>
	
		<?php
		echo '</div><hr>';
	endforeach;
	?><a href="?post_type=listing&page=search-listings&offset=<?=($offset - 20).$mlsq.$limit.$agent.$brokers;?>">Prev</a> | <a href="?post_type=listing&page=search-listings&offset=<?=($offset += 20).$mlsq.$limit.$agent.$brokers;?>">Next</a><?php
    echo '</div>';
}