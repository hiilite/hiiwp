<?php 
	
if($hiilite_options['teams_on']):
	

	$title = get_theme_mod( 'team_title', 'Team' );
	$slug = get_theme_mod( 'team_slug', 'team' );
	$tax_title = get_theme_mod( 'team_tax_title', 'Position' );
	$tax_slug = get_theme_mod( 'team_tax_slug', 'position' );
	
	$labels = apply_filters( 'team_post_type_labels', array(
		'name'               => sprintf(_x( '%s', 'post type general name', 'hiiwp' ), $title ),
		'singular_name'      => sprintf(_x( '%s Member', 'post type singular name', 'hiiwp' ), $title ),
		'menu_name'          => sprintf(_x( '%s', 'admin menu', 'hiiwp' ), $title), 
		'name_admin_bar'     => sprintf(_x( '%s Member', 'add new on admin bar', 'hiiwp' ), $title ),
		'add_new'            => sprintf(_x( 'Add %s Member', 'book', 'hiiwp' ), $title ),
		'add_new_item'       => sprintf(__( 'Add New %s Member', 'hiiwp' ), $title ),
		'new_item'           => sprintf(__( 'New %s Member', 'hiiwp' ), $title ),
		'edit_item'          => sprintf(__( 'Edit %s Member', 'hiiwp' ), $title ),
		'view_item'          => sprintf(__( 'View %s Member', 'hiiwp' ), $title ),
		'all_items'          => sprintf(__( 'All %s Members', 'hiiwp' ), $title ),
		'search_items'       => sprintf(__( 'Search %s Members', 'hiiwp' ), $title ),
		'parent_item_colon'  => sprintf(__( 'Parent %s Member:', 'hiiwp' ), $title ),
		'not_found'          => sprintf(__( 'No %s Members found.', 'hiiwp' ), $title ),
		'not_found_in_trash' => sprintf(__( 'No %s Members found in Trash.', 'hiiwp' ), $title )
	));

	$args = apply_filters( 'team_post_type_args', array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'hiiwp' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $slug , 'with_front' => false),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 7,
		'menu_icon'			 => 'dashicons-groups',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	));

	register_post_type( 'team', $args );
	
	
	// Add new taxonomy, make it hierarchical (like categories)
    $labels = apply_filters( 'team_tax_labels', array(
        'name'              => sprintf(_x( '%s', 'taxonomy general name', 'hiiwp' ), $tax_title ),
        'singular_name'     => sprintf(_x( '%s', 'taxonomy singular name', 'hiiwp' ), $tax_title ),
        'search_items'      => sprintf(__( 'Search %s', 'hiiwp' ), $tax_title ),
        'all_items'         => sprintf(__( 'All %s', 'hiiwp' ), $tax_title ),
        'parent_item'       => sprintf( __( 'Parent %s', 'hiiwp' ), $tax_title ),
        'parent_item_colon' => sprintf(__( 'Parent %s:', 'hiiwp' ), $tax_title ),
        'edit_item'         => sprintf(__( 'Edit %s', 'hiiwp' ), $tax_title ),
        'update_item'       => sprintf(__( 'Update %s', 'hiiwp' ), $tax_title ),
        'add_new_item'      => sprintf(__( 'Add New %s', 'hiiwp' ), $tax_title ),
        'new_item_name'     => sprintf(__( 'New %s Name', 'hiiwp' ), $tax_title ),
        'menu_name'         => sprintf(__( '%s', 'hiiwp' ), $tax_title )
    ));
 
    $args = apply_filters( 'team_tax_args', array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => $tax_slug, 'with_front' => false ),
    ));
 
    register_taxonomy( $tax_slug, array( $slug ), $args );
endif;

?>