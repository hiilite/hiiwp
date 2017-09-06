<?php 
	
add_action( 'init', 'menu_post_type_init', 1 );
function menu_post_type_init() {
	
	////////////////////////
	//
	//	REGISTER MENUS POST TYPE
	//
	////////////////////////

	$title = get_theme_mod( 'menu_title', 'Menu' );
	$menu_slug = get_theme_mod( 'menu_slug', 'menu' );
	$tax_title = get_theme_mod( 'menu_tax_title', 'Menu Section' );
	$menu_tax_slug = get_theme_mod( 'menu_tax_slug', 'menu-section' );


	$labels = array(
		'name'               => _x( $title, 'restaurant menu', 'hiilite' ),
		'singular_name'      => _x( $title.'Item', 'post type singular name', 'hiilite' ),
		'menu_name'          => _x( $title, 'admin menu', 'hiilite' ),
		'name_admin_bar'     => _x( $title, 'add new on admin bar', 'hiilite' ),
		'add_new'            => _x( 'Add '.$title.' Item', 'book', 'hiilite' ),
		'add_new_item'       => __( 'Add New '.$title.' Item', 'hiilite' ),
		'new_item'           => __( 'New '.$title.' Item', 'hiilite' ),
		'edit_item'          => __( 'Edit '.$title.' Item', 'hiilite' ),
		'view_item'          => __( 'View '.$title.' Item', 'hiilite' ),
		'all_items'          => __( 'All '.$title.' Items', 'hiilite' ),
		'search_items'       => __( 'Search '.$title, 'hiilite' ),
		'parent_item_colon'  => __( 'Parent '.$title.' Item:', 'hiilite' ),
		'not_found'          => __( 'No '.$title.' items found.', 'hiilite' ),
		'not_found_in_trash' => __( 'No '.$title.' items found in Trash.', 'hiilite' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'hiilite' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $menu_slug ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 7,
		'menu_icon'			 => 'dashicons-carrot',
		'supports'           => array( 'title','thumbnail','editor'),
	);

	register_post_type( $menu_slug, $args );
	
	
	// Register Taxonomy
    $labels = array(
        'name'              => _x( $tax_title, 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( $tax_title, 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search '.$tax_title, 'textdomain' ),
        'all_items'         => __( 'All '.$tax_title, 'textdomain' ),
        'parent_item'       => __( 'Parent '.$tax_title, 'textdomain' ),
        'parent_item_colon' => __( 'Parent '.$tax_title.':', 'textdomain' ),
        'edit_item'         => __( 'Edit '.$tax_title, 'textdomain' ),
        'update_item'       => __( 'Update '.$tax_title, 'textdomain' ),
        'add_new_item'      => __( 'Add New '.$tax_title, 'textdomain' ),
        'new_item_name'     => __( 'New '.$tax_title.' Name', 'textdomain' ),
        'menu_name'         => __( $tax_title, 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => $menu_tax_slug ),
    );
 
    register_taxonomy( $menu_tax_slug, array( $menu_slug ), $args );
    
    $sections = get_terms($menu_tax_slug);
	foreach($sections as $section){
		$hiilite_options['menu_sections'][$section->name] = $section->slug;
	}
	
	
	// Include shortcodes
	require_once( HIILITE_DIR.'/includes/shortcodes/menu.php');
	
	
	
	// Add VC Controls
	if(isset($hiilite_options['menu_sections'])){
		vc_map( array(
			"name" => $title,
			"base" => "menu",
			"category" => 'by Hiilite',
			"description" => "Show sections of your restaurants menu",
			"icon" => "icon-wpb-layerslider",
			"allowed_container_element" => 'vc_row',
			"params" => array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Section",
					"param_name" => "section",
					"value" => $hiilite_options['menu_sections']
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Heading tag",
					"param_name" => "heading_tag",
					"description" => "Includes class=menu-section-title for additional styling",
					"value" => array(
						'h1' => 'h1',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',
						'h5' => 'h5',
						'h6' => 'h6',
						'strong' => 'strong',
					)
				),
				array(
		            'type' => 'css_editor',
		            'heading' => __( 'Css', 'my-text-domain' ),
		            'param_name' => 'css',
		            'group' => __( 'Design options', 'my-text-domain' ),
		        ),
				
			)
		) );
	}
}



/////////////////////
//
//	Add Meta Boxes
//
/////////////////////
add_action('cmb2_init', 'cmb2_menu_metaboxes');
function cmb2_menu_metaboxes(){
	//////////////////////////////////
	// Menu for all posts
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'menu_options',
        'title'         => 'Menu Item Details',
        'object_types'  => array( 'menu' ), // post type
        'context'       => 'advanced', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => false, // keep the metabox closed by default
    ) );
    $cmb->add_field( array(
	    'name' => 'Ingredients',
	    'id' => 'ingredients',
	    'type' => 'textarea_small'
	) );
	$cmb->add_field( array(
	    'name'    => 'Price',
	    'desc'    => '(ex: $9.99/per, $ 9.99 each, 9.99)',
	    'id'      => 'price',
	    'type'    => 'text_small'
	) );
	$cmb->add_field( array(
	    'name'    => 'Notes',
	    'desc'    => '(ex: *Below served with your choice of daily soup, salad, or fries)',
	    'id'      => 'notes',
	    'type'    => 'text'
	) );
	
	
	
	$group_field_id = $cmb->add_field( array(
	    'id'          => 'addons',
	    'type'        => 'group',
	    // 'repeatable'  => false, // use false if you want non-repeatable group
	    'options'     => array(
	        'group_title'   => __( 'Addon {#}', 'hiilite' ), // since version 1.1.4, {#} gets replaced by row number
	        'add_button'    => __( 'Add Another', 'hiilite' ),
	        'remove_button' => __( 'Remove', 'hiilite' ),
	        'sortable'      => true, // beta
	        // 'closed'     => true, // true to have the groups closed by default
	    ),
	) );
	// Id's for group's fields only need to be unique for the group. Prefix is not needed.
	$cmb->add_group_field( $group_field_id, array(
	    'name' => 'Text',
	    'id'   => 'addons_text',
	    'type' => 'text_medium',
	    //'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'name' => '$',
	    'id'   => 'addons_price',
	    'type' => 'text_small',
	) );
	
	$cmb->add_field( array(
	    'name' => 'Show Add Ons Prefix',
	    'id' => 'show_addons_prefix',
		'desc' => 'Show the word "Add on" before the addons',
	    'type' => 'checkbox',
	    'default' => true
	) );
}




?>