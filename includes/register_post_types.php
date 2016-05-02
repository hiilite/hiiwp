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
	        'name'              => _x( 'Work:', 'taxonomy general name', 'textdomain' ),
	        'singular_name'     => _x( 'Work', 'taxonomy singular name', 'textdomain' ),
	        'search_items'      => __( 'Search Work Type', 'textdomain' ),
	        'all_items'         => __( 'All Work Types', 'textdomain' ),
	        'parent_item'       => __( 'Parent Work Type', 'textdomain' ),
	        'parent_item_colon' => __( 'Parent Work Type:', 'textdomain' ),
	        'edit_item'         => __( 'Edit Work Type', 'textdomain' ),
	        'update_item'       => __( 'Update Work Type', 'textdomain' ),
	        'add_new_item'      => __( 'Add New Work Type', 'textdomain' ),
	        'new_item_name'     => __( 'New Type Name', 'textdomain' ),
	        'menu_name'         => __( 'Work Types', 'textdomain' ),
	    );
	 
	    $args = array(
	        'hierarchical'      => true,
	        'labels'            => $labels,
	        'show_ui'           => true,
	        'show_admin_column' => true,
	        'query_var'         => true,
	        'rewrite'           => array( 'slug' => 'work' ),
	    );
	 
	    register_taxonomy( 'work', array( 'portfolio' ), $args );

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



//////////////////////////
//
//	GET PORTFOLIO TEMPLATE
//
//////////////////////////
function get_portfolio($args = null){
	global $hiilite_options;
	$hiilite_options['portfolio_show_filter'] = get_theme_mod( 'portfolio_show_filter', true );
	$html = '';
	$css = '';
	
	$args = ($args==null)?array('post_type' => 'portfolio','posts_per_page' => -1,'nopaging' => true,):$args;
	$query = new WP_Query($args);
	if($query->have_posts()):
		$html .= '<div class="row">';
		if($hiilite_options['portfolio_show_filter'] == true){
			$taxonomy_objects = get_terms('work');
			$html .= '<div class="flex-item align-center col-12 text-block labels">';
			foreach($taxonomy_objects as $cat){
				$html .= '<a href="/work/'.$cat->slug.'">'.$cat->name.'</a> ';
			}
			$html .= '</div>';
		}
		$imgs = $col2 = $col3 = $col4 = $col6 = $col8 = $col9 = $col12 = array();
		$i = 0;
	while($query->have_posts()):
		$query->the_post();
		
		if ( has_post_thumbnail() ) {
		    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' );
		    $imgs[$i]['src'] 	= $image[0];
		    $imgs[$i]['width'] 	= $image[1];
		    $imgs[$i]['height'] = $image[2];
		    $imgs[$i]['ratio'] 	= $ratio = round($image[1] / $image[2],4);
		    $imgs[$i]['id'] 	= get_the_id();
		    $imgs[$i]['href'] 	= get_the_permalink();
		    $imgs[$i]['background_color'] 	= get_post_meta( get_the_ID(), 'background_color', true );
		    $imgs[$i]['isolate']= (get_post_meta( get_the_ID(), 'isolated', true ) == 'on')?'align-'.get_post_meta( get_the_ID(), 'anchor_to', true ):'';
		    $imgs[$i]['min_padding'] = $minpad = get_post_meta( get_the_ID(), 'min_padding', true );
		    $padding ='';
		    if($minpad != ''):
			    $padding = 'padding:';
			    if($imgs[$i]['isolate'] == 'align-top-left') 	$padding .= '0 '.$minpad.' 0 '.$minpad;
			    elseif($imgs[$i]['isolate'] == 'align-top') 		$padding .= '0 '.$minpad.' '.$minpad.' '.$minpad;
			    elseif($imgs[$i]['isolate'] == 'align-top-right') 	$padding .= '0 0 '.$minpad.' '.$minpad;
			    elseif($imgs[$i]['isolate'] == 'align-left') 		$padding .= $minpad.' '.$minpad.' '.$minpad.' 0';
			    elseif($imgs[$i]['isolate'] == 'align-center') 		$padding .= $minpad;
			    elseif($imgs[$i]['isolate'] == 'align-right') 		$padding .= $minpad.' 0 '.$minpad.' '.$minpad;
			    elseif($imgs[$i]['isolate'] == 'align-bottom-left') $padding .= $minpad.' '.$minpad.' 0 0';
			    elseif($imgs[$i]['isolate'] == 'align-bottom') 		$padding .= $minpad.' '.$minpad.' 0 '.$minpad;
			    elseif($imgs[$i]['isolate'] == 'align-bottom-right')$padding .= $minpad.' 0 0 '.$minpad;
			    $padding .= ';';
		    endif;
		    
		    $css .= '#pfi'.get_the_id().'{flex:'.$ratio.';background-color:'.$imgs[$i]['background_color'].';'.$padding.'}';
		    
		    if($ratio <= 0.3){
			    $imgs[$i]['col'] = 'col-2';
			    $col2[] = $imgs[$i];
		    }
		    elseif($ratio >= 0.4 && $ratio <=0.5){
			    $imgs[$i]['col'] = 'col-3';
				    $col3[] = $imgs[$i];
			    }
			    elseif($ratio >= 0.6 && $ratio <= 0.8){
				    $imgs[$i]['col'] = 'col-4';
				    $col4[] = $imgs[$i];
			    }
			    elseif($ratio >= 0.9 && $ratio <=1.1){
				    $imgs[$i]['col'] = 'col-6';
				    $col6[] = $imgs[$i];
			    }
			    elseif($ratio >= 1.2 && $ratio <= 1.4){
				    $imgs[$i]['col'] = 'col-8';
				    $col8[] = $imgs[$i];
			    }
			    elseif($ratio >= 1.5 && $ratio <= 1.7){
				    $imgs[$i]['col'] = 'col-9';
				    $col9[] = $imgs[$i];
			    }
			    elseif($ratio >= 1.7){
				    $imgs[$i]['col'] = 'col-12';
				    $col12[] = $imgs[$i];
			    }
			}
				
			$i++;
		endwhile;
		
		$prev2 = $prev = 12; 
		$next = array(12,9,8,6,4,3);
		$rowstart = true;
		$rowend = true;
		$rowdirection = false;
		for($k=0;$k<$i;$k++){
			$current = null;
			
			$prev2 = $prev;
			
			// if there are 12cols and 12 col is next
			if(!empty($col12) && in_array(12,$next)){
				$rowstart = $rowend = true;
				$current = array_shift($col12); 
				$next = array(9,8,6,4,3);
				$prev = 12;
			} 
			// start col 9, next col 3
			elseif(!empty($col9) && in_array(9, $next) && !empty($col3)){
				$current = array_shift($col9);
				$rowstart = true;
				$rowend = false;
				$prev = 9;
				
				$next = array(3);
				
				$rowdirection = ($rowdirection)?false:true;
			}  
			// prev col 9 end with col 3
			elseif(!empty($col3) && in_array(3, $next) && $prev == 9){
				$rowstart = false;
				$rowend = true;
				$prev = 3;
				$current = array_shift($col3);
				$next = array(3,4,6,8,12);
			} 
			// start col 8 end with col 4
			elseif(!empty($col8) && in_array(8, $next) && !empty($col4)){
				$rowstart = true;
				$rowend = false;
				$current = array_shift($col8);
				$prev = 8;
				
				$next = array(4);
				$rowdirection = ($rowdirection)?false:true;
			} 
			// prev col 8, end with 4
			elseif(!empty($col4) && ($prev == 8) && in_array(4, $next) && $rowstart){
				$current = array_shift($col4);
				$rowstart = false;
				$rowend = true;
				$prev = 4;
				$next = array(3,4,6,8,9,12);
			} 
			// start col 6, end with 6
			elseif(count($col6) >= 2){
				$current = array_shift($col6);
				$rowstart = true;
				$rowend = false;
				$prev = 6;
				$next = array(6,3);
				$rowdirection = ($rowdirection)?false:true;
			} 
			// if prev = 6, end with 6
			elseif(!empty($col6) && $rowstart && $prev = 6){
				$current = array_shift($col6);
				$rowstart = false;
				$rowend = true;
				$prev = 6;
				$next = array(3,4,6,8,9,12);
			} 
			
			// start with 4 continue with 4 if more then 2 col4s
			elseif(count($col4) > 2 && !$rowstart){
				$current = array_shift($col4);
			
				$rowstart = true;
				$rowend = false;
				$prev = 4;
				
				$next = array(4);
				
				$rowdirection = ($rowdirection)?false:true;
			} 
			// continue with 4 if prev was 4 in same row
			elseif(in_array(4, $next) && $rowstart && !$rowend){
				$current = array_shift($col4);
			
				$rowstart = false;
				$rowend = false;
				$prev = 4;
				
				$next = array(4);
				
				$rowdirection = ($rowdirection)?false:true;
			} 
			
			// continue with 4 if prev was 4 in same row and end with 4
			elseif(in_array(4, $next) && !$rowstart && !$rowend){
				$current = array_shift($col4);
			
				$rowstart = false;
				$rowend = true;
				$prev = 4;
				
				$next = array(4,3,6,8,9,12);
				
				$rowdirection = ($rowdirection)?false:true;
			} 
			
			// start with 3, cont with 3 if more then 3
			elseif(count($col3) > 2 && !$rowstart){
				$rowstart = true;
				$rowend = false;
				$prev = 3;
				$current = array_shift($col3);
				$next = array(3,6,9);
			} 
			// cont with 3 if prev was 3
			elseif(in_array(3, $next) && $rowstart && !$rowend && count($col3) > 1){
				$rowstart = false;
				$rowend = false;
				$prev = 3;
				$current = array_shift($col3);
				$next = array(3,6);
			} 
			
			// cont with 3 if prev was 3
			elseif(in_array(3, $next) && !$rowstart && !$rowend){
				$rowstart = false;
				$rowend = false;
				$prev = 3;
				$current = array_shift($col3);
				$next = array(3);
			} 
			// cont with 3 if prev was 3
			elseif(in_array(3, $next) && !in_array(6, $next) && !$rowstart && !$rowend){
				$rowstart = false;
				$rowend = true;
				$prev = 3;
				$current = array_shift($col3);
				$next = array(3,4,6,8,9,12);
			} 
			
			// if only 2 3s, make 6s
			elseif(count($col3) == 2 && !$rowstart){
				$rowstart = true;
				$rowend = false;
				$prev = 3;
				$current = array_shift($col3);
				$current['col'] = 'col-6';
				$next = array(3);
			} 
			// if only 2 3s, make 6s
			elseif(count($col3) == 1 && $rowstart){
				$rowstart = false;
				$rowend = true;
				$prev = 3;
				$current = array_shift($col3);
				$current['col'] = 'col-6';
				$next = array(4,6,8,9,12);
			} 
			//if still 8s but no 4s
			// cont with 3 if prev was 3
			elseif(count($col8) > 1 && empty($col4) ){
				$rowstart = true;
				$rowend = false;
				$prev = 8;
				$current = array_shift($col8);
				$current['col'] = 'col-6';
				$next = array(8);
			} 		
			elseif(count($col8) && empty($col4) && in_array(8, $next) ){
				$rowstart = false;
				$rowend = true;
				$prev = 8;
				$current = array_shift($col8);
				$current['col'] = 'col-6';
				$next = array(3,4,6,8,9,12);
			} 
			
			
			if ($rowstart){ $html .= '<div class="container_inner fixed_columns ';
				$html .= ($rowdirection)?'row_reverse">':'">';
			}
			
			$html .= '<div id="pfi'.$current['id'].'" class="flex-item '.$current['col'].' '.$current['isolate'].'">';
			$html .= '<a href="'.$current['href'].'">';
			$html .= '<amp-img src='.$current['src'].' layout="responsive" width="'.$current['width'].'" height="'.$current['height'].'"></amp-img>';
			$html .= '</a>';
			$html .= '</div>';
			if ($rowend) $html .= '</div>';
		}
		
		$html .= '</div>';
		
		$hiilite_options['portfolio_custom_css'] = $css;
	endif;
	
	return $html;
}




?>