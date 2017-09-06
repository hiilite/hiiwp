<?php 
	
add_action( 'init', 'team_post_type_init', 1 );
function team_post_type_init() {
	

	$title = get_theme_mod( 'team_title', 'Team' );
	$slug = get_theme_mod( 'team_slug', 'team' );
	$tax_title = get_theme_mod( 'team_tax_title', 'Position' );
	$tax_slug = get_theme_mod( 'team_tax_slug', 'position' );
	
	$labels = array(
		'name'               => _x( $title, 'post type general name', 'hiilite' ),
		'singular_name'      => _x( $title.' Member', 'post type singular name', 'hiilite' ),
		'menu_name'          => _x( $title, 'admin menu', 'hiilite' ),
		'name_admin_bar'     => _x( $title.' Member', 'add new on admin bar', 'hiilite' ),
		'add_new'            => _x( 'Add '.$title.' Member', 'book', 'hiilite' ),
		'add_new_item'       => __( 'Add New '.$title.' Member', 'hiilite' ),
		'new_item'           => __( 'New '.$title.' Member', 'hiilite' ),
		'edit_item'          => __( 'Edit '.$title.' Member', 'hiilite' ),
		'view_item'          => __( 'View '.$title.' Member', 'hiilite' ),
		'all_items'          => __( 'All '.$title.' Members', 'hiilite' ),
		'search_items'       => __( 'Search '.$title.' Members', 'hiilite' ),
		'parent_item_colon'  => __( 'Parent '.$title.' Member:', 'hiilite' ),
		'not_found'          => __( 'No '.$title.' Members found.', 'hiilite' ),
		'not_found_in_trash' => __( 'No '.$title.' Members found in Trash.', 'hiilite' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'hiilite' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $slug ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 7,
		'menu_icon'			 => 'dashicons-groups',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	);

	register_post_type( 'team', $args );
	
	
	// Add new taxonomy, make it hierarchical (like categories)
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
        'rewrite'           => array( 'slug' => $tax_slug ),
    );
 
    register_taxonomy( $tax_slug, array( $slug ), $args );
}




?>