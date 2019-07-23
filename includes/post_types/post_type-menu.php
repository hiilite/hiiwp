<?php 
	
if($hiilite_options['menus_on']):
	
	////////////////////////
	//
	//	REGISTER MENUS POST TYPE
	//
	////////////////////////

	$title = get_theme_mod( 'menu_title', 'Menu' );
	$menu_slug = get_theme_mod( 'menu_slug', 'menu' );
	$tax_title = get_theme_mod( 'menu_tax_title', 'Menu Section' );
	$menu_tax_slug = get_theme_mod( 'menu_tax_slug', 'menu-section' );


	$labels = apply_filters( 'menu_post_type_labels', array(
		'name'               => sprintf(_x('%s', 'restaurant menu', 'hiiwp'), $title),
		'singular_name'      => sprintf(_x('%s Item', 'post type singular name', 'hiiwp'), $title ),
		'menu_name'          => sprintf(_x('%s', 'admin food menu', 'hiiwp'), $title ),
		'name_admin_bar'     => sprintf(_x('%s', 'add new on admin bar', 'hiiwp'), $title ),
		'add_new'            => sprintf(_x('Add %s Item', 'food', 'hiiwp'), $title ),
		'add_new_item'       => sprintf(__( "Add New %s Item", 'hiiwp' ), $title ),
		'new_item'           => sprintf(__( "New %s Item", 'hiiwp' ), $title ),
		'edit_item'          => sprintf(__( "Edit %s Item", 'hiiwp' ), $title ),
		'view_item'          => sprintf(__( "View %s Item", 'hiiwp' ), $title ),
		'all_items'          => sprintf(__( "All %s Items", 'hiiwp' ), $title ),
		'search_items'       => sprintf(__( "Search %s", 'hiiwp' ), $title ),
		'parent_item_colon'  => sprintf(__( "Parent %s Item:", 'hiiwp' ), $title ),
		'not_found'          => sprintf(__( "No %s items found.", 'hiiwp' ), $title ),
		'not_found_in_trash' => sprintf(__( "No %s items found in Trash.", 'hiiwp' ), $title )
	));

	$args = apply_filters( 'mwnu_post_type_args', array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'hiiwp' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $menu_slug, 'with_front' => false ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 7,
		'menu_icon'			 => 'dashicons-carrot',
		'supports'           => array( 'title','thumbnail','editor'),
	));

	register_post_type( $menu_slug, $args );
	
	
	// Register Taxonomy
    $labels = apply_filters( 'menu_tax_labels', array(
        'name'              => sprintf(_x( '%s', 'taxonomy general name', 'hiiwp' ), $tax_title ),
        'singular_name'     => sprintf(_x( '%s', 'taxonomy singular name', 'hiiwp' ), $tax_title ),
        'search_items'      => sprintf(__( 'Search %s', 'hiiwp' ), $tax_title ),
        'all_items'         => sprintf(__( 'All %s', 'hiiwp' ), $tax_title ),
        'parent_item'       => sprintf(__( 'Parent %s', 'hiiwp' ), $tax_title ),
        'parent_item_colon' => sprintf(__( 'Parent %s:', 'hiiwp' ), $tax_title ),
        'edit_item'         => sprintf(__( 'Edit %s', 'hiiwp' ), $tax_title ),
        'update_item'       => sprintf(__( 'Update %s', 'hiiwp' ), $tax_title ),
        'add_new_item'      => sprintf(__( 'Add New %s', 'hiiwp' ), $tax_title ),
        'new_item_name'     => sprintf(__( 'New %s Name', 'hiiwp' ), $tax_title ),
        'menu_name'         => sprintf(__( '%s', 'hiiwp' ), $tax_title ),
    ));
 
    $args = apply_filters( 'menu_tax_args', array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => $menu_tax_slug, 'with_front' => false ),
    ));
 
    register_taxonomy( $menu_tax_slug, array( $menu_slug ), $args );
    
    $sections = get_terms($menu_tax_slug);
	foreach($sections as $section){
		$hiilite_options['menu_sections'][$section->name] = $section->slug;
	}
		

endif;




?>