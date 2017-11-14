<?php 
if($hiilite_options['portfolio_on']):
	$title = get_theme_mod( 'portfolio_title', 'Portfolio' );
	$slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
	$tax_title = get_theme_mod( 'portfolio_tax_title', 'Work' );
	$tax_slug = get_theme_mod( 'portfolio_tax_slug', 'work' );
	
	$labels = array( 
		'name'               => sprintf(_x( '%s', 'post type general name', 'hiiwp' ), $title ), 
		'singular_name'      => sprintf(_x( 'Piece', 'post type singular name', 'hiiwp' ), $title ),
		'menu_name'          => sprintf(_x( '%s', 'admin menu', 'hiiwp' ), $title ),
		'name_admin_bar'     => sprintf(_x( '%s Piece', 'add new on admin bar', 'hiiwp' ), $title ),
		'add_new'            => sprintf(_x( 'Add New', 'book', 'hiiwp' ), $title ),
		'add_new_item'       => sprintf(__( 'Add New %s Piece', 'hiiwp' ), $title ),
		'new_item'           => sprintf(__( 'New Piece', 'hiiwp' ), $title ),
		'edit_item'          => sprintf(__( 'Edit Piece', 'hiiwp' ), $title ),
		'view_item'          => sprintf(__( 'View Piece', 'hiiwp' ), $title ),
		'all_items'          => sprintf(__( 'All %s Pieces', 'hiiwp' ), $title ),
		'search_items'       => sprintf(__( 'Search %s', 'hiiwp' ), $title ),
		'parent_item_colon'  => sprintf(__( 'Parent Piece:', 'hiiwp' ), $title ),
		'not_found'          => sprintf(__( 'No Pieces found.', 'hiiwp' ), $title ),
		'not_found_in_trash' => sprintf(__( 'No Pieces found in Trash.', 'hiiwp' ), $title )
	);
	
	$args = array(
		'labels'             => $labels,
	    'description'        => __( 'Description.', 'hiiwp' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $slug, 'with_front' => false),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => 6,
		'menu_icon'			 => 'dashicons-format-image',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	
	register_post_type( $slug, $args );
	
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
	    'name'              => sprintf(_x( '%s:', 'taxonomy general name', 'hiiwp' ), $tax_title ),
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
	);
	
	$args = array(
	    'hierarchical'      => true,
	    'labels'            => $labels,
	    'show_ui'           => true,
	    'show_admin_column' => true,
	    'query_var'         => true,
	    'rewrite'           => array( 'slug' => $tax_slug, 'with_front' => false ),
	);
	
	register_taxonomy( 
	    'porfolio_tag', 
	    $hiilite_options['portfolio_slug'], 
	    array( 
	        'hierarchical'  => false, 
	        'label'         => __( 'Tags', 'hiiwp' ), 
	        'singular_name' => __( 'Tag', 'hiiwp' ), 
	        'rewrite'       => array( 'slug' => 'tag', 'with_front' => false ), 
	        'query_var'     => true 
	    )  
	);
	
	register_taxonomy( $tax_slug, array( $slug ), $args );
	


endif;
?>