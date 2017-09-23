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
		

endif;




?>