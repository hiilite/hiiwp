<?php 
if($hiilite_options['portfolio_on']):
	$title = get_theme_mod( 'portfolio_title', 'Portfolio' );
	$slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
	$tax_title = get_theme_mod( 'portfolio_tax_title', 'Work' );
	$tax_slug = get_theme_mod( 'portfolio_tax_slug', 'work' );
	
	$labels = array( 
		'name'               => _x( $title, 'post type general name', 'hiilite' ),
		'singular_name'      => _x( 'Piece', 'post type singular name', 'hiilite' ),
		'menu_name'          => _x( $title, 'admin menu', 'hiilite' ),
		'name_admin_bar'     => _x( $title.' Piece', 'add new on admin bar', 'hiilite' ),
		'add_new'            => _x( 'Add New', 'book', 'hiilite' ),
		'add_new_item'       => __( 'Add New '.$title.' Piece', 'hiilite' ),
		'new_item'           => __( 'New Piece', 'hiilite' ),
		'edit_item'          => __( 'Edit Piece', 'hiilite' ),
		'view_item'          => __( 'View Piece', 'hiilite' ),
		'all_items'          => __( 'All '.$title.' Pieces', 'hiilite' ),
		'search_items'       => __( 'Search '.$title, 'hiilite' ),
		'parent_item_colon'  => __( 'Parent Piece:', 'hiilite' ),
		'not_found'          => __( 'No Pieces found.', 'hiilite' ),
		'not_found_in_trash' => __( 'No Pieces found in Trash.', 'hiilite' )
	);
	
	$args = array(
		'labels'             => $labels,
	    'description'        => __( 'Description.', 'hiilite' ),
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
	    'name'              => _x( $tax_title.':', 'taxonomy general name', 'textdomain' ),
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
	    'rewrite'           => array( 'slug' => $tax_slug, 'with_front' => false ),
	);
	
	register_taxonomy( 
	    'porfolio_tag', 
	    $hiilite_options['portfolio_slug'], 
	    array( 
	        'hierarchical'  => false, 
	        'label'         => __( 'Tags', 'hiilite' ), 
	        'singular_name' => __( 'Tag', 'hiilite' ), 
	        'rewrite'       => array( 'slug' => 'tag', 'with_front' => false ), 
	        'query_var'     => true 
	    )  
	);
	
	register_taxonomy( $tax_slug, array( $slug ), $args );
	


endif;
?>