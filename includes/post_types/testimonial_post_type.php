<?php 
	
add_action( 'init', 'testimonial_post_type_init', 1 );
function testimonial_post_type_init() {
	////////////////////////
	//
	//	REGISTER TESTIMONIALS
	//
	////////////////////////
		
	$title = get_theme_mod( 'testimonials_title', 'Testimonials' );
	$testimonials_slug = get_theme_mod( 'testimonials_slug', 'testimonials' );
	$tax_title = get_theme_mod( 'testimonials_tax_title', 'Testimonials Categories' );
	$testimonials_tax_slug = get_theme_mod( 'testimonials_tax_slug', 'testimonials_category' );

 
	$labels = array( 
		'name'               => _x( $title, 'testimonials', 'hiilite' ),
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
		'rewrite'            => array( 'slug' => $testimonials_slug ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 7,
		'menu_icon'			 => 'dashicons-format-quote',
		'supports'           => array( 'title','thumbnail','editor'),
	);

	register_post_type( $testimonials_slug, $args );
	
	
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
        'rewrite'           => array( 'slug' => $testimonials_tax_slug ),
    );
 
    register_taxonomy( $testimonials_tax_slug, array( $testimonials_slug ), $args );
    
    $sections = get_terms($testimonials_tax_slug);
    $hiilite_options['testimonials_sections']['all'] = 'All';
	foreach($sections as $section){
		$hiilite_options['testimonials_sections'][$section->name] = $section->slug;
	}
	
	// Add Shortcodes
	require_once( HIILITE_DIR . '/includes/shortcodes/testimonials.php');
}


/////////////////////
//
//	Add Meta Boxes
//
/////////////////////
add_action('cmb2_init', 'cmb2_testimonial_metaboxes');
function cmb2_testimonial_metaboxes(){
	//////////////////////////////////
	// Menu for all posts
	/////////////////////////////////
    $cmb = new_cmb2_box( array(
        'id'            => 'testimonial_options',
        'title'         => 'Testimonial Details',
        'object_types'  => array( 'testimonials' ), // post type
        'context'       => 'advanced', // 'normal', 'advanced' or 'side'
        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
        'show_names'    => true, // show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        'closed'        => false, // keep the metabox closed by default
    ) );
    $cmb->add_field( array(
	    'name' => 'Author',
	    'id' => 'testimonial_author',
	    'type' => 'text'
	) );
	$cmb->add_field( array(
	    'name'    => 'Author Website',
	    'id'      => 'testimonial_website',
	    'type'    => 'text_url'
	) );
	$cmb->add_field( array(
	    'name'    => 'Rating',
	    'id'      => 'testimonial_rating',
	    'type'    => 'radio_inline',
	    'options' => array(
		    '5' => __( '5', 'cmb2' ),
		    '4' => __( '4', 'cmb2' ),
		    '3' => __( '3', 'cmb2' ),
			'2' => __( '2', 'cmb2' ),
	        '1' => __( '1', 'cmb2' ),   
	    ),
	) );
	
}


?>