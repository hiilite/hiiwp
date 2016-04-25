<?php 



////////////////////////
//
//	REGISTER POST TYPES
//
////////////////////////
add_action( 'init', 'hii_post_type_init' );
function hii_post_type_init() {
	global $hiilite_options;
	////////////////////////
	//
	//	REGISTER PORTFOLIO
	//
	////////////////////////
	if($hiilite_options['portfolio_on']){
		$labels = array(
			'name'               => _x( 'Portfolio', 'post type general name', 'hiilite' ),
			'singular_name'      => _x( 'Piece', 'post type singular name', 'hiilite' ),
			'menu_name'          => _x( 'Portfolio', 'admin menu', 'hiilite' ),
			'name_admin_bar'     => _x( 'Portfolio Piece', 'add new on admin bar', 'hiilite' ),
			'add_new'            => _x( 'Add New', 'book', 'hiilite' ),
			'add_new_item'       => __( 'Add New Portfolio Piece', 'hiilite' ),
			'new_item'           => __( 'New Piece', 'hiilite' ),
			'edit_item'          => __( 'Edit Piece', 'hiilite' ),
			'view_item'          => __( 'View Piece', 'hiilite' ),
			'all_items'          => __( 'All Portfolio Pieces', 'hiilite' ),
			'search_items'       => __( 'Search Portfolio', 'hiilite' ),
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
			'rewrite'            => array( 'slug' => 'portfolio' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'menu_icon'			 => 'dashicons-format-image',
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);
	
		register_post_type( 'portfolio', $args );
		
		
		// Add new taxonomy, make it hierarchical (like categories)
	    $labels = array(
	        'name'              => _x( 'Mediums', 'taxonomy general name', 'textdomain' ),
	        'singular_name'     => _x( 'Medium', 'taxonomy singular name', 'textdomain' ),
	        'search_items'      => __( 'Search Mediums', 'textdomain' ),
	        'all_items'         => __( 'All Mediums', 'textdomain' ),
	        'parent_item'       => __( 'Parent Medium', 'textdomain' ),
	        'parent_item_colon' => __( 'Parent Medium:', 'textdomain' ),
	        'edit_item'         => __( 'Edit Medium', 'textdomain' ),
	        'update_item'       => __( 'Update Medium', 'textdomain' ),
	        'add_new_item'      => __( 'Add New Medium', 'textdomain' ),
	        'new_item_name'     => __( 'New Medium Name', 'textdomain' ),
	        'menu_name'         => __( 'Mediums', 'textdomain' ),
	    );
	 
	    $args = array(
	        'hierarchical'      => true,
	        'labels'            => $labels,
	        'show_ui'           => true,
	        'show_admin_column' => true,
	        'query_var'         => true,
	        'rewrite'           => array( 'slug' => 'medium' ),
	    );
	 
	    register_taxonomy( 'medium', array( 'portfolio' ), $args );

	}

	////////////////////////
	//
	//	REGISTER TEAM
	//
	////////////////////////
	if($hiilite_options['teams_on']){
		$labels = array(
			'name'               => _x( 'Team', 'post type general name', 'hiilite' ),
			'singular_name'      => _x( 'Team Member', 'post type singular name', 'hiilite' ),
			'menu_name'          => _x( 'Team', 'admin menu', 'hiilite' ),
			'name_admin_bar'     => _x( 'Team Member', 'add new on admin bar', 'hiilite' ),
			'add_new'            => _x( 'Add Team Member', 'book', 'hiilite' ),
			'add_new_item'       => __( 'Add New Team Member', 'hiilite' ),
			'new_item'           => __( 'New Team Member', 'hiilite' ),
			'edit_item'          => __( 'Edit Team Member', 'hiilite' ),
			'view_item'          => __( 'View Team Member', 'hiilite' ),
			'all_items'          => __( 'All Team Members', 'hiilite' ),
			'search_items'       => __( 'Search Team Members', 'hiilite' ),
			'parent_item_colon'  => __( 'Parent Team Member:', 'hiilite' ),
			'not_found'          => __( 'No Team Members found.', 'hiilite' ),
			'not_found_in_trash' => __( 'No Team Members found in Trash.', 'hiilite' )
		);
	
		$args = array(
			'labels'             => $labels,
	                'description'        => __( 'Description.', 'hiilite' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'team' ),
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
	        'name'              => _x( 'Positions', 'taxonomy general name', 'textdomain' ),
	        'singular_name'     => _x( 'Position', 'taxonomy singular name', 'textdomain' ),
	        'search_items'      => __( 'Search Positions', 'textdomain' ),
	        'all_items'         => __( 'All Positions', 'textdomain' ),
	        'parent_item'       => __( 'Parent Position', 'textdomain' ),
	        'parent_item_colon' => __( 'Parent Position:', 'textdomain' ),
	        'edit_item'         => __( 'Edit Position', 'textdomain' ),
	        'update_item'       => __( 'Update Position', 'textdomain' ),
	        'add_new_item'      => __( 'Add New Position', 'textdomain' ),
	        'new_item_name'     => __( 'New Position Name', 'textdomain' ),
	        'menu_name'         => __( 'Positions', 'textdomain' ),
	    );
	 
	    $args = array(
	        'hierarchical'      => true,
	        'labels'            => $labels,
	        'show_ui'           => true,
	        'show_admin_column' => true,
	        'query_var'         => true,
	        'rewrite'           => array( 'slug' => 'position' ),
	    );
	 
	    register_taxonomy( 'position', array( 'team' ), $args );
	}
	
	
	
	
	////////////////////////
	//
	//	REGISTER MENUS
	//
	////////////////////////
	if($hiilite_options['menus_on']) {
		$labels = array(
			'name'               => _x( 'Menu', 'restaurant menu', 'hiilite' ),
			'singular_name'      => _x( 'Food Item', 'post type singular name', 'hiilite' ),
			'menu_name'          => _x( 'Menus', 'admin menu', 'hiilite' ),
			'name_admin_bar'     => _x( 'Menu', 'add new on admin bar', 'hiilite' ),
			'add_new'            => _x( 'Add Menu Item', 'book', 'hiilite' ),
			'add_new_item'       => __( 'Add New Menu Item', 'hiilite' ),
			'new_item'           => __( 'New Menu Item', 'hiilite' ),
			'edit_item'          => __( 'Edit Menu Item', 'hiilite' ),
			'view_item'          => __( 'View Menu Item', 'hiilite' ),
			'all_items'          => __( 'All Menu Items', 'hiilite' ),
			'search_items'       => __( 'Search Menu', 'hiilite' ),
			'parent_item_colon'  => __( 'Parent Menu Item:', 'hiilite' ),
			'not_found'          => __( 'No menu items found.', 'hiilite' ),
			'not_found_in_trash' => __( 'No menu items found in Trash.', 'hiilite' )
		);
	
		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Description.', 'hiilite' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'menu' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 7,
			'menu_icon'			 => 'dashicons-carrot',
			'supports'           => array( 'title','thumbnail','editor'),
		);
	
		register_post_type( 'menu', $args );
		
		
		// Add new taxonomy, make it hierarchical (like categories)
	    $labels = array(
	        'name'              => _x( 'Menu Section', 'taxonomy general name', 'textdomain' ),
	        'singular_name'     => _x( 'Section', 'taxonomy singular name', 'textdomain' ),
	        'search_items'      => __( 'Search Sections', 'textdomain' ),
	        'all_items'         => __( 'All Menu Sections', 'textdomain' ),
	        'parent_item'       => __( 'Parent Menu Section', 'textdomain' ),
	        'parent_item_colon' => __( 'Parent Section:', 'textdomain' ),
	        'edit_item'         => __( 'Edit Menu Section', 'textdomain' ),
	        'update_item'       => __( 'Update Menu Section', 'textdomain' ),
	        'add_new_item'      => __( 'Add New Menu Section', 'textdomain' ),
	        'new_item_name'     => __( 'New Section Name', 'textdomain' ),
	        'menu_name'         => __( 'Menu Section', 'textdomain' ),
	    );
	 
	    $args = array(
	        'hierarchical'      => true,
	        'labels'            => $labels,
	        'show_ui'           => true,
	        'show_admin_column' => true,
	        'query_var'         => true,
	        'rewrite'           => array( 'slug' => 'menu-section' ),
	    );
	 
	    register_taxonomy( 'menu-section', array( 'menu' ), $args );
	    add_action( 'after_switch_theme', 'menu_add_default_sections' );
	    
	    $sections = get_terms('menu-section');
		foreach($sections as $section){
			$hiilite_options['menu_sections'][$section->name] = $section->slug;
		}
		require_once( dirname( __FILE__ ) . '/shortcodes/menu.php');
		if(isset($hiilite_options['menu_sections'])){
			vc_map( array(
				"name" => "Menu",
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
	
	
}

function menu_add_default_sections(){
	 
	    $parent_term = term_exists( 'menu', 'menu-section' ); // array is returned if taxonomy is given
		wp_insert_term(
			'Breakfast', // the term 
			'section', // the taxonomy
			array(
				'description'=> 'Breakfast from 9am till 11am',
				'slug' => 'breakfeast',
			)
		);
		wp_insert_term(
			'Lunch', // the term 
			'section', // the taxonomy
			array(
				'description'=> 'Lunch from 11am till 5pm',
				'slug' => 'lunch',
			)
		);
		wp_insert_term(
			'Staters', // the term 
			'section', // the taxonomy
			array(
				'description'=> 'Start your meal off with something light',
				'slug' => 'starters',
			)
		);
		wp_insert_term(
			'Dinner', // the term 
			'section', // the taxonomy
			array(
				'description'=> 'Dinner from 5am till 10pm',
				'slug' => 'dinner',
			)
		);
		wp_insert_term(
			'Drinks', // the term 
			'section', // the taxonomy
			array(
				'description'=> 'Our drink menu',
				'slug' => 'drinks',
			)
		);
}

add_action( 'add_meta_boxes', 'menu_options_meta_box' );
//
// Adds the meta box to the page screen
//
function menu_options_meta_box()
{
    add_meta_box(
        'menu_item_options', // id, used as the html id att
        __( 'Menu Item Details' ), // meta box title, like "Page Attributes"
        'menu_options_meta_box_cb', // callback function, spits out the content
        array('menu'), // post type or page. We'll add this to pages only
        'advanced', // context (where on the screen
        'high' // priority, where should this go in the context?
    );
}

//
//  Callback function for our meta box.  Echos out the content
//
function menu_options_meta_box_cb( $post )
{
	// $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
  
    $ingredients = isset( $values['ingredients'][0] ) ? esc_attr( $values['ingredients'][0] ) : '';
    $price = isset( $values['price'][0] ) ? esc_attr( $values['price'][0] ) : '';
    $hashtag = isset( $values['hashtag'][0] ) ? esc_attr( $values['hashtag'][0] ) : '';
    $notes = isset( $values['notes'][0] ) ? esc_attr( $values['notes'][0] ) : '';
    $addons = isset( $values['addons'][0] ) ? esc_attr( $values['addons'][0] ) : '';
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'menu__meta_box_nonce', 'meta_box_nonce' );

    ?>
     
    <p>
	    <label for="ingredients">Ingredients</label><br>
        <textarea id="ingredients" name="ingredients" cols="50" rows="3"><?=$ingredients?></textarea>
    </p>
    <p>
	    <label for="price">Price</label><br>
        <input type="text" id="price" name="price" size="10" value="<?=$price?>" placeholder="0.00" /><br>
        <small>(ex: $9.99/per, $ 9.99 each, 9.99)</small>
    </p>
    <p>
	    <label for="notes">Notes</label><br>
        <input type="text" id="notes" name="notes" size="50" value="<?=$notes?>" /><br>
        <small>(ex: *Below served with your choice of daily soup, salad, or fries)</small>
    </p>
    <p>
	    <label for="addons">Add Ons</label><br>
        <textarea id="addons" name="addons" cols="50" rows="4"><?=$addons?></textarea>
    </p>
    <p>
	    <label for="hashtag">Instagram hashtag</label><br>
        <input type="text" id="hashtag" name="hashtag" size="50" value="<?=$hashtag?>" placeholder="#beefburger" /><br>
        <small>Show tagged to your Instagram account with this hash tag</small>
    </p>
    <?php    
	 
}

add_action( 'save_post', 'menu_meta_box_save' );
function menu_meta_box_save( $post_id )
{
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'menu__meta_box_nonce' ) ) return;

    $ingredients = isset( $_POST['ingredients'] )? $_POST['ingredients'] : '';
    $price = isset( $_POST['price'] )? $_POST['price'] : '';
    $hashtag = isset( $_POST['hashtag'] )? $_POST['hashtag'] : '';
    $notes = isset( $_POST['notes'] )? $_POST['notes'] : '';
    $addons = isset( $_POST['addons'] )? $_POST['addons'] : '';
    
    update_post_meta( $post_id, 'ingredients', $ingredients );
    update_post_meta( $post_id, 'price', $price );
    update_post_meta( $post_id, 'hashtag', $hashtag );
    update_post_meta( $post_id, 'notes', $notes );
    update_post_meta( $post_id, 'addons', $addons );
}



function my_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );





?>