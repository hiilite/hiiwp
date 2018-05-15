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
	    $tax_slug, 
	    $slug, 
	    array( 
	        'hierarchical'  => false, 
	        'label'         => __( 'Tags', 'hiiwp' ), 
	        'singular_name' => __( 'Tag', 'hiiwp' ), 
	        'rewrite'       => array( 'slug' => $tax_slug, 'with_front' => false ), 
	        'query_var'     => true 
	    )  
	);
	
	register_taxonomy( $tax_slug, array( $slug ), $args );
	
	add_action('cmb2_init', 'cmb2_portfolio_metaboxes');
	function cmb2_portfolio_metaboxes(){
		//$prefix = '_hiilite_';
		//////////////////////////////////
		// Portfolio for all posts
		/////////////////////////////////
		$hiilite_options = Hii::get_options();
		
	    $cmb = new_cmb2_box( array(
	        'id'            => 'portfolio_options',
	        'title'         => 'Portfolio Options',
	        'object_types'  => array( get_theme_mod( 'portfolio_slug', 'portfolio' ) ), // post type
	        'context'       => 'normal', // 'normal', 'advanced' or 'side'
	        'priority'      => 'high', // 'high', 'core', 'default' or 'low'
	        'show_names'    => true, // show field names on the left
	        'cmb_styles'    => true, // false to disable the CMB stylesheet
	        'closed'        => false, // keep the metabox closed by default
	    ) );
	    if($hiilite_options['portfolio_template'] == 'split') {
		    $cmb->add_field( array(
				'name'       => __( 'Client Name', 'hiiwp' ),
				'id'         => 'portfolio_client',
				'type'       => 'text'
			) );
			$cmb->add_field( array(
				'name'    => __( 'Project Description', 'hiiwp' ),
				'desc'    => __( 'Add a project description (optional)', 'hiiwp' ),
				'id'      => 'portfolio_description',
				'type'    => 'wysiwyg',
				'options' => array(
					'textarea_rows' => 10,
				),
			) );
			
			$cmb->add_field( array(
				'name'    => __( 'Social Share', 'hiiwp' ),
				'desc'    => __( 'Add social share icons', 'hiiwp' ),
				'id'      => 'project_share',
				'type'    => 'multicheck',
				'options' => array(
					'fb' => 'Facebook',
					'tw' => 'Twitter',
					'gp' => 'Google+',
					'pn' => 'Pinterest',
					'ln' => 'LinkedIn',
				),
			) );
			
			$contributors = $cmb->add_field( array(
				'id'          => 'contributers_group',
				'type'        => 'group',
				'description' => __( 'Generates reusable entries for contributors', 'hiiwp' ),
				// 'repeatable'  => false, // use false if you want non-repeatable group
				'options'     => array(
					'group_title'   => __( 'Contributor {#}', 'hiiwp' ), // since version 1.1.4, {#} gets replaced by row number
					'add_button'    => __( 'Add Another Contributor', 'hiiwp' ),
					'remove_button' => __( 'Remove Contributor', 'hiiwp' ),
					'sortable'      => true, // beta
					// 'closed'     => true, // true to have the groups closed by default
				),
			) );
			
			// Id's for group's fields only need to be unique for the group. Prefix is not needed.
			$cmb->add_group_field( $contributors, array(
				'name' => __( 'Contributor Role', 'hiiwp' ),
				'id'   => 'role',
				'type' => 'text',
				//'repeatable' => true,
			) );	
			
			$users_args = array(
			    'role_in' => array('administrator','editor','author','contributor'),
			 );
			$users = get_users();
			$user_names = array();
			foreach($users as $user) {
						$user_names[$user->display_name] = $user->display_name;
			}
			$cmb->add_group_field( $contributors, array(
				'name'             => __( 'Contributor Name', 'hiiwp' ),
				'id'               => 'name',
				'type'             => 'select',
				'show_option_none' => true,
				'default'          => 'custom',
				'options'          => $user_names,
			) );	
		}
		$cmb->add_field( array(
			'name' => 'Upload Images',
			'desc' => __( 'Add your project images', 'hiiwp' ),
			'id'   => 'project_iamges',
			'type' => 'file_list',
			// 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			// 'query_args' => array( 'type' => 'image' ), // Only images attachment
			// Optional, override default text strings
			'text' => array(
				'add_upload_files_text' => __( 'Add or Upload Files', 'hiiwp' ), // default: "Add or Upload Files"
				'remove_image_text' => __( 'Remove Image', 'hiiwp' ), // default: "Remove Image"
				'file_text' => __( 'File:', 'hiiwp' ), // default: "File:"
				'file_download_text' => __( 'Download', 'hiiwp' ), // default: "Download"
				'remove_text' => __( 'Remove', 'hiiwp' ), // default: "Remove"
			),
		) );
		
		if($hiilite_options['portfolio_template'] == 'default') {
			$cmb->add_field( array(
				'name' => 'In Grid',
				'desc' => __( 'Keep images in grid', 'hiiwp' ),
				'id'   => 'imgs_in_grid',
				'type' => 'checkbox',
			) );
		}
	    /*$cmb->add_field( array(
		    'name' => 'Isolated Image',
		    'id'   => 'isolated',
		    'type' => 'checkbox',
		    'default' => false
		) );
		$cmb->add_field( array(
		    'name'    => 'Anchor Isolated Image',
		    'id'      => 'anchor_to',
		    'type'    => 'radio_inline',
		    'default' => 'center',
		    'options' => array(
		        'top-left' 	=> __( 'Top Left', 'hiiwp' ),
		        'top' 		=> __( 'Top', 'hiiwp' ),
		        'top-right' => __( 'Top Right', 'hiiwp' ),
		        'left' 		=> __( 'Left', 'hiiwp' ),
				'center' 	=> __( 'Center', 'hiiwp' ),
				'right' 	=> __( 'Right', 'hiiwp' ),
				'bottom-left'=> __( 'Bottom Left', 'hiiwp' ),
				'bottom' 	=> __( 'Bottom', 'hiiwp' ),
				'bottom-right'=> __( 'Bottom Right', 'hiiwp' ),
		    ),
		) );
		$cmb->add_field( array(
		    'name'    => 'Background',
		    'id'      => 'background_color',
		    'type'    => 'colorpicker',
		    'default' => '#ffffff',
		) );
		$cmb->add_field( array(
		    'name'    => 'Minimum Padding',
		    'id'      => 'min_padding',
		    'type'    => 'text',
		    'default' => '',
		) );*/
	}
	
	
	
	
	
	//////////////////////////////////
	// Taxonomy for all Portfolio
	/////////////////////////////////
	add_action('cmb2-taxonomy_meta_boxes', 'cmb2_portfolio_taxonomy_metaboxes');
	function cmb2_portfolio_taxonomy_metaboxes( array $meta_boxes ) {
		$hiilite_options = Hii::get_options();
		
		$meta_boxes['test_metabox'] = array(
			'id'            => 'portfolio_work_metabox',
			'title'         => __( 'Portfolio Category Indentity', 'hiiwp' ),
			'object_types'  => array( $hiilite_options['portfolio_tax_slug'] ), // Taxonomy
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			// 'cmb_styles' => false, // false to disable the CMB stylesheet
			'fields'        => array(
				array(
					'name'    => __( 'Category Color Picker', 'hiiwp' ),
					'desc'    => __( 'field description (optional)', 'hiiwp' ),
					'id'      => 'portfolio_work_color',
					'type'    => 'colorpicker',
					'default' => '#ffffff'
				),
				array(
					'name' => __( 'Category Icon', 'hiiwp' ),
					'desc' => __( 'Upload an image or enter a URL.', 'hiiwp' ),
					'id'   => 'portfolio_work_image',
					'type' => 'file',
				),
			),
		);
		return $meta_boxes;
	}
	
	
	/**
	 *
	 * Add Primary to [post_categories] shortcode replacing the genesis shortcode of the same name
	 *
	 */
	function portfolio_post_primary_category_shortcode( $atts ) {
	
	    //* get our CMB2 field and category stuff
	    $prefix        = 'portfolio_';
	    $primary_cat   = get_post_meta( get_the_ID(), $prefix . 'category_list', true );
	    $category_id   = get_cat_ID( $primary_cat );
	    $category_link = get_category_link( $category_id );
	    $category_name = get_cat_name( $category_id );
	
	    $defaults = array(
	        'sep'    => ', ',
	        'before' => __( 'Filed Under: ', 'hiiwp' ),
	        'after'  => '',
	    );
	
	    $atts = shortcode_atts( $defaults, $atts, 'post_categories' );
	
	    //* fallback to the standard array if the choice in the primary metabox is not set
	    if( empty( $primary_cat ) ) {
	        $cats = get_the_category_list( trim( $atts['sep'] ) . ' ' );
	    } else {
	        $cats = '<a href="' . $category_link . '">' . $category_name . '</a>';
	    }
	
	    //* Do nothing if no cats
	    if ( ! $cats ) {
	        return '';
	    }
	
	    if ( genesis_html5() )
	        $output = sprintf( '<span %s>', genesis_attr( 'entry-categories' ) ) . $atts['before'] . $cats . $atts['after'] . '</span>';
	    else
	        $output = '<span class="categories">' . $atts['before'] . $cats . $atts['after'] . '</span>';
	
	    return apply_filters( 'genesis_post_categories_shortcode', $output, $atts );
	
	}
	add_shortcode( 'post_categories', 'portfolio_post_primary_category_shortcode' );
	
	if(!function_exists('get_portfolio')):
		function get_portfolio($args = null, $options = null){
			$hiilite_options = Hii::get_options();
			$hiilite_options['portfolio_show_filter'] = get_theme_mod( 'portfolio_show_filter', true );
			$slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
			$html = $css = '';
			
			
			
			extract( shortcode_atts( array(
			    'show_post_meta'  			=> get_theme_mod( 'portfolio_show_post_meta', false ),
			    'show_post_title'  			=> get_theme_mod( 'portfolio_show_post_title', false ),
			    'portfolio_show_author_date'=> get_theme_mod( 'portfolio_show_author_date', false ),
			    'in_grid'					=> get_theme_mod( 'portfolio_in_grid', false ),
			    'add_padding'				=> get_theme_mod( 'portfolio_add_padding', '0px' ),
			    'portfolio_layout'			=> get_theme_mod( 'portfolio_layout', false ),
			    'portfolio_columns'			=> get_theme_mod( 'portfolio_columns', '1' ),
				'portfolio_image_pos'		=> get_theme_mod( 'portfolio_image_pos', 'image-left' ),
				'portfolio_title_pos'		=> get_theme_mod( 'portfolio_title_pos', 'title-below' ),
				'portfolio_heading_size'	=> get_theme_mod( 'portfolio_heading_size', 'h2' ),
				'portfolio_excerpt_on'		=> get_theme_mod( 'portfolio_excerpt_on', false ),
				'portfolio_excerpt_length'	=> get_theme_mod( 'portfolio_excerpt_length', '55' ),
				'portfolio_more_on'			=> get_theme_mod( 'portfolio_more_on', false ),
				'portfolio_more_text'		=> get_theme_mod( 'portfolio_more_text', 'Read On' ),
				'portfolio_show_filter'		=> get_theme_mod( 'portfolio_show_filter', true ),
				'css_class'					=> '',
		
		    ), $options ) );
			$args = ($args==null)?array('post_type'=>$slug,'posts_per_page'=> -1,'nopaging'=>true,'order'=>'ASC','orderby'=>'menu_order'):$args;
			
			$query = new WP_Query($args);
			
			if($query->have_posts()):
				if($portfolio_show_filter == true):
					
					$html .= '<div class="row portfolio_filter"><div class="in_grid">';
						$work_parent_terms = get_terms(array(
							'taxonomy'		=> $hiilite_options['portfolio_tax_slug'],
						    'hide_empty' 	=> 1,
						    'parent'		=> 0
						));
						if(count($work_parent_terms) > 1):
							$html .= '<ul class="portfolio_terms">';
							foreach($work_parent_terms as $parent_term){
								
								$li_classes = ( isset(get_queried_object()->term_id) && get_queried_object()->term_id == $parent_term->term_id )? 'current-term' : '' ;
								$html .= "<li class='$li_classes'>";
								$html .= '<a href="'.esc_attr( get_term_link( $parent_term->term_id ) ).'">'.$parent_term->name.'</a>';
									
									$work_child_terms = get_terms(array(
										'taxonomy'		=> $hiilite_options['portfolio_tax_slug'],
									    'hide_empty' 	=> 0,
									    'parent'		=> $parent_term->term_id,
									));
									
									if(count($work_child_terms) > 1):
										$html .= '<ul class="portfolio_child_terms">';
										foreach($work_child_terms as $child_term){
											$li_classes = ( isset(get_queried_object()->term_id) && get_queried_object()->term_id == $child_term->term_id )? 'current-term' : '' ;
											$html .= "<li class='$li_classes'>";
											$html .= '<a href="'.esc_attr( get_term_link( $child_term->term_id ) ).'">'.$child_term->name.'</a>';
											$html .= '</li>';
										}
										$html .= '</ul>';
									endif;
								
								
								$html .= '</li>';
							}
							$html .= '</ul>';
						endif;
						
					
					$html .= '</div></div>';
					
				endif;
		    	$html .= '<div class="row '.esc_attr( $css_class ).'">';
				if ($in_grid) $html .= '<div class="in_grid">';
				
				if($args['post_type'] == $slug):
					
					if($hiilite_options['portfolio_show_filter'] == true){
						$taxonomy_objects = get_terms($slug);
						$html .= '<div class="flex-item align-center col-12 text-block labels">';
						foreach($taxonomy_objects as $cat){
							if(!isset($cat)) {
								$html .= '<a href="/'.$slug.'/'.$cat->slug.'">'.$cat->name.'</a> ';
							} 
						}
						$html .= '</div>';
					}
				endif;
				
				$imgs = $col2 = $col3 = $col4 = $col6 = $col8 = $col9 = $col12 = array();
				$i = 0;
				
			    //////////////////////////
			    //
			    //	if attachment
			    //
			    //////////////////////////
			    
			    if($args['post_type'] == 'attachment'):
				    if($portfolio_layout == 'masonry' || $portfolio_layout == false) $html .= '<div class="row masonry col-count-'.$portfolio_columns.'">';
				    if($portfolio_layout == 'full-width') $html .= '<div class="row masonry col-count-12">';
				    $css .= '.masonry article{padding:'.$add_padding.';}';
				    foreach ( $query->posts as $attachment) :
			        	$image = wp_get_attachment_image_src( $attachment->ID, 'large' );
						
						$imgs[$i]['src'] 	= $image[0];
					    $imgs[$i]['width'] 	= $image[1];
					    $imgs[$i]['height'] = $image[2];
					    $imgs[$i]['ratio'] 	= $ratio = round($image[1] / $image[2],4);
					    $imgs[$i]['id'] 	= $attachment->ID;
					    $imgs[$i]['href'] 	= $image[0];
			        	
				        if($portfolio_layout == 'masonry-h'):
				        	$css .= '#pfi'.($attachment->ID).'{flex:'.$ratio.';}';
						
							if($ratio < 0.4) {
							    $imgs[$i]['col'] = 'col-2';
							    $col2[] = $imgs[$i];
						    }
						    elseif($ratio >= 0.4 && $ratio <=0.5){
							   $imgs[$i]['col'] = 'col-3';
							    $col3[] = $imgs[$i];
						    }
						    elseif($ratio > 0.5 && $ratio <= 0.8){
							    $imgs[$i]['col'] = 'col-4';
							    $col4[] = $imgs[$i];
						    }
						    elseif($ratio > 0.8 && $ratio <=1.1){
							    $imgs[$i]['col'] = 'col-6';
							    $col6[] = $imgs[$i];
						    }
						    elseif($ratio > 1.1 && $ratio <= 1.4){
							    $imgs[$i]['col'] = 'col-8';
							    $col8[] = $imgs[$i];
						    }
						    elseif($ratio > 1.4 && $ratio <= 1.7){
							    $imgs[$i]['col'] = 'col-9';
							    $col9[] = $imgs[$i];
						    }
						    elseif($ratio > 1.7){
							    $imgs[$i]['col'] = 'col-12';
							    $col12[] = $imgs[$i];
							};
							
						elseif($portfolio_layout == 'masonry'):
							
							$cols = '';					
							//get_template_part('templates/portfolio', 'loop');
							$html .= '<article class="row row-o-content-top flex-item" id="post-'.$imgs[$i]['id'].'" >';
							
							
												
							$html .='<figure class="flex-item">
								<img src="'.$imgs[$i]['src'].'" on="tap:lightbox1" width='.$imgs[$i]['width'].' height='.$imgs[$i]['height'].' alt="'.get_the_title().'">';
							$html .= '</figure>';
							
							$html .= '</article>';
						elseif($portfolio_layout == 'boxed'):
							
							$cols = '';
							switch ($portfolio_columns) {
								case '1': 
									$cols = ' col-12'; 
								break;
								case '2': 
									$cols = ' col-6'; 
								break;
								case '3': 
									$cols = ' col-4'; 
								break;
								case '4': 
									$cols = ' col-3'; 
								break;		
							}			
							//get_template_part('templates/portfolio', 'loop');
							$html .= '<article class="row row-o-content-top flex-item '.$cols.'" id="post-'.$imgs[$i]['id'].'" >';
							
												
							$html .='<figure class="flex-item">
								<a href="'.$imgs[$i]['src'].'"><img src="'.$imgs[$i]['src'].'" width='.$imgs[$i]['width'].' height='.$imgs[$i]['height'].' alt="'.get_the_title().'">';
							
							$html .= '</a></figure>';
							
							$html .= '</article>';
						endif;	
						$i++;	
						   
			    	endforeach;
					if($portfolio_layout == 'masonry'){ $html .= '</div>';};
				//////////////////////////
			    //
			    //	if regular post with feature image
			    //
			    //////////////////////////	
			    
				else:
					
					
			    	if($portfolio_layout == 'masonry') { 
				    	$html .= '<div class="row masonry col-count-'.$portfolio_columns.'">';
				    	$css .= '.masonry article {padding:'.$add_padding.';}';
				    }
					while($query->have_posts()):
						$query->the_post();
						
						if($portfolio_layout == 'masonry-h'):
						
							if ( has_post_thumbnail() ) :
								
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' );
							    
							    $imgs[$i]['src'] 	= $image[0];
							    $imgs[$i]['width'] 	= $image[1];
							    $imgs[$i]['height'] = $image[2];
							    $imgs[$i]['ratio'] 	= $ratio = ($image[1])?round($image[1] / $image[2],4):1;
							    $imgs[$i]['id'] 	= get_the_id();
							    $imgs[$i]['href'] 	= get_the_permalink();
							    $imgs[$i]['background_color'] 	= get_post_meta( get_the_ID(), 'background_color', true );
							    $imgs[$i]['isolate']= (get_post_meta(get_the_ID(),'isolated',true) == 'on')?'align-'.get_post_meta(get_the_ID(),'anchor_to', true ):'';
							    $imgs[$i]['post_title'] = get_the_title();
							    
							    if($show_post_meta):
									$imgs[$i]['post_meta'] = '<small><address class="post_author">';
									$imgs[$i]['post_meta'] .= '<a itemprop="author" itemscope itemtype="https://schema.org/Person" class="post_author_link" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><span itemprop="name">';
									$imgs[$i]['post_meta'] .= get_the_author_meta('display_name'); 
									$imgs[$i]['post_meta'] .= '</span></a></address> | <time class="time op-published" datetime="';
									$imgs[$i]['post_meta'] .= get_the_time('c');
									$imgs[$i]['post_meta'] .= '">';
									$imgs[$i]['post_meta'] .= '<span class="date">';
									$imgs[$i]['post_meta'] .= get_the_time('F j, Y');
									$imgs[$i]['post_meta'] .= ' </span>'.get_the_time('h:i a').'</time></small>';
								endif;
							    
							    $imgs[$i]['min_padding'] = $minpad = get_post_meta( get_the_ID(), 'min_padding', true );
							    $padding ='';
							    if($minpad != ''):
								    $padding = 'padding:';
								    if($imgs[$i]['isolate'] == 'align-top-left') 	$padding .= '0 '.$minpad.' 0 '.$minpad;
								    elseif($imgs[$i]['isolate'] == 'align-top') 	$padding .= '0 '.$minpad.' '.$minpad.' '.$minpad;
								    elseif($imgs[$i]['isolate'] == 'align-top-right') 	$padding .= '0 0 '.$minpad.' '.$minpad;
								    elseif($imgs[$i]['isolate'] == 'align-left') 	$padding .= $minpad.' '.$minpad.' '.$minpad.' 0';
								    elseif($imgs[$i]['isolate'] == 'align-center') 	$padding .= $minpad;
								    elseif($imgs[$i]['isolate'] == 'align-right') 	$padding .= $minpad.' 0 '.$minpad.' '.$minpad;
								    elseif($imgs[$i]['isolate'] == 'align-bottom-left') $padding .= $minpad.' '.$minpad.' 0 0';
								    elseif($imgs[$i]['isolate'] == 'align-bottom') 	$padding .= $minpad.' '.$minpad.' 0 '.$minpad;
								    elseif($imgs[$i]['isolate'] == 'align-bottom-right')$padding .= $minpad.' 0 0 '.$minpad;
								    $padding .= ';';
							    endif;
							     
							    $background_color = ($imgs[$i]['background_color'] != '')?'background:'.$imgs[$i]['background_color'].';':'';
							    
							    $css .= '#pfi'.get_the_id().'{flex:'.$ratio.';'.$background_color.$padding.'}';
							    
							    if($ratio < 0.4) {
								    $imgs[$i]['col'] = 'col-2';
								    $col2[] = $imgs[$i];
							    }
							    elseif($ratio >= 0.4 && $ratio <=0.5){
								    $imgs[$i]['col'] = 'col-3';
								    $col3[] = $imgs[$i];
							    }
							    elseif($ratio > 0.5 && $ratio <= 0.8){
								    $imgs[$i]['col'] = 'col-4';
								    $col4[] = $imgs[$i];
							    }
							    elseif($ratio > 0.8 && $ratio <=1.1){
								    $imgs[$i]['col'] = 'col-6';
								    $col6[] = $imgs[$i];
							    }
							    elseif($ratio > 1.1 && $ratio <= 1.4){
								    $imgs[$i]['col'] = 'col-8';
								    $col8[] = $imgs[$i];
							    }
							    elseif($ratio > 1.4 && $ratio <= 1.7){
								    $imgs[$i]['col'] = 'col-9';
								    $col9[] = $imgs[$i];
							    }
							    elseif($ratio > 1.7){
								    $imgs[$i]['col'] = 'col-12';
								    $col12[] = $imgs[$i];
							    }
							endif; // end if has thumbnails
						
							$i++;
						elseif($portfolio_layout == 'masonry'):
							// Create Title
							$article_title = '';
												
							if($show_post_title) {
								$article_title .= '<'.$portfolio_heading_size.'><a href="'.get_the_permalink().'">'.get_the_title().'</a></'.$portfolio_heading_size.'>';
							} 
							if($portfolio_show_author_date) {
								$article_title .= '<span itemprop="author" itemscope itemtype="https://schema.org/Person">';
								if($show_post_meta):
									$article_title .= '<small><address class="post_author">';
									$article_title .= '<a itemprop="author" itemscope itemtype="https://schema.org/Person" class="post_author_link" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><span itemprop="name">';
									$article_title .= get_the_author_meta('display_name'); 
									$article_title .= '</span></a></address> | <time class="time op-published" datetime="';
									$article_title .= get_the_time('c');
									$article_title .= '">';
									$article_title .= '<span class="date">';
									$article_title .= get_the_time('F j, Y');
									$article_title .= ' </span>'.get_the_time('h:i a').'</time></small>';
								else:
									$article_title .= '<meta itemprop="name" content="'.get_the_author_meta('display_name').'">';
								endif;
								$article_title .= '</span>';
								
							}
							
							$cat_id = prime_cat('work',get_the_id());
							
							if($cat_id) {
							
								$portfolio_work_image = (get_term_meta ( $cat_id, 'portfolio_work_image', true))?get_term_meta ( $cat_id, 'portfolio_work_image', true):false;
								$article_title .= ($portfolio_work_image)?'<img src="'.$portfolio_work_image.'" class="cat-img-small" alt="'.get_the_title().'">':'';
							}
							
							$cols = '';
							
							switch ($portfolio_columns) {
								case '1': 
									$cols = ' col-12'; 
								break;
								case '2': 
									$cols = ' col-6'; 
								break;
								case '3': 
									$cols = ' col-4'; 
								break;
								case '4': 
									$cols = ' col-3'; 
								break;		
							}
							
							//get_template_part('templates/portfolio', 'loop');
							$html .= '<article class="row row-o-content-top flex-item portfolio-masonry-item" id="post-'.get_the_id().'" >';
							
							if($portfolio_title_pos == 'title-above') { 
								$html .= '<div class="content-box">'.$article_title.'</div>';
							}
							
							if(has_post_thumbnail(get_the_id())): 
									
								$tn_id = get_post_thumbnail_id( get_the_id() );
						
								$img = wp_get_attachment_image_src( $tn_id, 'large' );
								$width = $img[1];
								$height = $img[2];
							
								$html .='<figure class="flex-item">
									<a href="'.get_the_permalink().'"><img src="'.$img[0].'" width='.$width.' height='.$height.' alt="'.get_the_title().'">';
					
								$html .= '</a></figure>';
							endif;
							
								$html .= '<div class="flex-item';
								$html .= ($portfolio_image_pos=='image-left')?' col-6':' col-12';
								$html .= '">';
							
							if($portfolio_title_pos == 'title-below') { 
								$html .= $article_title;
							}
							if($portfolio_excerpt_on)$html .= '<p>'.content_excerpt($portfolio_excerpt_length).'</p>';
							if($portfolio_more_on)$html .='<a class="button" href="'.get_the_permalink().'">'.$portfolio_more_text.'</a>';
							$html .= '</div></article>';
						else: // else if not masonry-h
						
							
							// Create Title
							$article_title = '';
												
							if($show_post_title) {
								$article_title .= '<'.$portfolio_heading_size.'><a href="'.get_the_permalink().'">'.get_the_title().'</a></'.$portfolio_heading_size.'>';
							} 
							if($portfolio_show_author_date) {
								$article_title .= '<span itemprop="author" itemscope itemtype="https://schema.org/Person">';
								if($show_post_meta):
									$article_title .= '<small><address class="post_author">';
									$article_title .= '<a itemprop="author" itemscope itemtype="https://schema.org/Person" class="post_author_link" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><span itemprop="name">';
									$article_title .= get_the_author_meta('display_name'); 
									$article_title .= '</span></a></address> | <time class="time op-published" datetime="';
									$article_title .= get_the_time('c');
									$article_title .= '">';
									$article_title .= '<span class="date">';
									$article_title .= get_the_time('F j, Y');
									$article_title .= ' </span>'.get_the_time('h:i a').'</time></small>';
								else:
									$article_title .= '<meta itemprop="name" content="'.get_the_author_meta('display_name').'">';
								endif;
								$article_title .= '</span>';
							}
							
							$cols = '';
							
							switch ($portfolio_columns) {
								case '1': 
									$cols = ' col-12'; 
								break;
								case '2': 
									$cols = ' col-6'; 
								break;
								case '3': 
									$cols = ' col-4'; 
								break;
								case '4': 
									$cols = ' col-3'; 
								break;		
							}
							
							//get_template_part('templates/portfolio', 'loop');
							$html .= '<article class="row row-o-content-top blog-article flex-item '.$cols.'" id="post-'.get_the_id().'" >';
							
							if($portfolio_title_pos == 'title-above') { 
								$html .= '<div class="content-box">'.$article_title.'</div>';
							}
							
							if(has_post_thumbnail(get_the_id())): 
									
								$tn_id = get_post_thumbnail_id( get_the_id() );
						
								$img = wp_get_attachment_image_src( $tn_id, 'large' );
								$width = $img[1];
								$height = $img[2];
							
								$html .='<figure class="flex-item col-6">
									<a href="'.get_the_permalink().'"><img src="'.$img[0].'" width='.$width.' height='.$height.' alt="'.get_the_title().'">';
							
								$html .= '</a></figure>';
							endif;
			
							$html .= '<div class="flex-item content-box';
							$html .= ($portfolio_image_pos=='image-left')?' col-6':' col-12';
							$html .= '">';
							$html .= '<meta itemprop="datePublished" content="'.get_the_time('Y-m-d').'">
								<meta itemprop="dateModified" content="'.get_the_modified_date('Y-m-d').'">';
							
							if($portfolio_title_pos == 'title-below') { 
								$html .= $article_title;
							}
							if($portfolio_excerpt_on)$html .= '<p>'.content_excerpt($portfolio_excerpt_length).'</p>';
							if($portfolio_more_on)$html .='<a class="button" href="'.get_the_permalink().'">'.$portfolio_more_text.'</a>';
							$html .= '</div></article>';
						endif; // end if not masonry-h
						
					endwhile;
					
					if($portfolio_layout != 'masonry-h'){
				    	$html .= '</div>';
			    	} 
				endif; //end if attachment else
				
				if($portfolio_layout == 'masonry-h'):
					$prev2 = $prev = 12; 
					$next = array(12,9,8,6,4,3);
					$rowstart = true;
					$rowend = true;
					$rowdirection = false;
					//$html .= $ratio;
					for($k=0;$k<$i;$k++){
						$current = null;
						
						$prev2 = $prev;
						$debug = null;
						// if there are 12cols and 12 col is next
						if(!empty($col12) && in_array(12,$next) && $rowend){
							$rowstart = $rowend = true;
							$current = array_shift($col12); 
							$next = array(9,8,6,4,3);
							$prev = 12;
							$debug = '12';
						} 
						// start col 9, next col 3
						elseif(!empty($col9) && in_array(9, $next) && !empty($col3)){
							$current = array_shift($col9);
							$rowstart = true;
							$rowend = false;
							$prev = 9;
							
							$next = array(3);
							
							$rowdirection = ($rowdirection)?false:true;
							
							$debug = '9->3';
						}  
						// prev col 9 end with col 3
						elseif(!empty($col3) && in_array(3, $next) && $prev == 9){
							$rowstart = false;
							$rowend = true;
							$prev = 3;
							$current = array_shift($col3);
							$next = array(3,4,6,8,12);
							$debug = '3end';
						} 
						// start col 8 end with col 4
						elseif(!empty($col8) && in_array(8, $next) && !empty($col4)){
							$rowstart = true;
							$rowend = false;
							$current = array_shift($col8);
							$prev = 8;
							
							$next = array(4);
							$rowdirection = ($rowdirection)?false:true;
							$debug = '8->4';
						} 
						// prev col 8, end with 4
						elseif(!empty($col4) && ($prev == 8) && in_array(4, $next) && $rowstart){
							$current = array_shift($col4);
							$rowstart = false;
							$rowend = true;
							$prev = 4;
							$next = array(3,4,6,8,9,12);
							$debug = '4end';
						} 
						// start col 6, end with 6
						elseif(count($col6) >= 2 && $rowend){
							$current = array_shift($col6);
							$rowstart = true;
							$rowend = false;
							$prev = 6;
							$next = array(6,3);
							$rowdirection = ($rowdirection)?false:true;
							$debug = '6->6';
						} 
						// if prev = 6, end with 6
						elseif(count($col6) && $rowstart && in_array(6, $next) && $prev == 6){
							$current = array_shift($col6);
							$rowstart = false;
							$rowend = true;
							$prev = 6;
							$next = array(3,4,6,8,9,12);
							$debug = '6end';
						} 
						// if last col9
						elseif(empty($col3) && count($col9) == 1 && !$rowstart && !$rowend) {
							$rowstart = false;
							$rowend = true;
							$prev = 9;
							$current = array_shift($col9);
							$current['col'] = 'col-4';
							$next = array(12,9,8,6,4,3);
							$debug = '9[4]end';
						}
						// start with 4 continue with 4 if more then 2 col4s
						elseif(count($col4) > 2 && !$rowstart && $rowend){
							$current = array_shift($col4);
							$rowstart = true;
							$rowend = false;
							$prev = 4;
							$next = array(4);
							$rowdirection = ($rowdirection)?false:true;
							$debug = '4r2';
						} 
						// continue with 4 if prev was 4 in same row
						elseif(in_array(4, $next) && $rowstart && !$rowend){
							$current = array_shift($col4);
							$rowstart = false;
							$rowend = false;
							$prev = 4;
							$next = array(4);
							$debug = '4p4>4';
						} 
						
						// continue with 4 if prev was 4 in same row and end with 4
						elseif(in_array(4, $next) && !$rowstart && !$rowend){
							$current = array_shift($col4);
							$rowstart = false;
							$rowend = true;
							$prev = 4;
							$next = array(4,3,6,8,9,12);
							$debug = '4end';
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
							$debug = '3p>6>8';
						} 
						
						// cont with 3 if prev was 3
						elseif(in_array(3, $next) && !$rowstart && !$rowend){
							$rowstart = false;
							$rowend = false;
							$prev = 3;
							$current = array_shift($col3);
							$next = array(3);
							$debug = '3p>6>8';
						} 
						// cont with 3 if prev was 3
						elseif(in_array(3, $next) && !in_array(6, $next) && !$rowstart && !$rowend){
							$rowstart = false;
							$rowend = true;
							$prev = 3;
							$current = array_shift($col3);
							$next = array(3,4,6,8,9,12);
							$debug = '3p>6>8';
						} 
						
						// if only 2 3s, make 6s
						elseif(count($col3) == 2 && !$rowstart){
							$rowstart = true;
							$rowend = false;
							$prev = 3;
							$current = array_shift($col3);
							$current['col'] = 'col-6';
							$next = array(3);
							$debug = '3p>6>8';
						} 
						// if only 2 3s, make 6s
						elseif(count($col3) == 1 && $rowstart){
							$rowstart = false;
							$rowend = true;
							$prev = 3;
							$current = array_shift($col3);
							$current['col'] = 'col-6';
							$next = array(4,6,8,9,12);
							$debug = '3p>6>8';
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
							$debug = '8p>6>8';
						} 		
						elseif(count($col8) && empty($col4) && in_array(8, $next) && $prev == 8){
							$rowstart = false;
							$rowend = true;
							$prev = 8;
							$current = array_shift($col8);
							$current['col'] = 'col-6';
							$next = array(3,4,6,8,9,12);
							$debug = '8[6]end';
						}
						// last col8
						elseif(count($col8) == 1){
							$rowstart = true;
							$rowend = true;
							$prev = 8;
							$current = array_shift($col8);
							$current['col'] = 'col-12';
							$next = array(3,4,6,8,9,12);
							$debug = '8>12';
						} 
						// if last 3 col9
						elseif(empty($col3) && count($col9) == 3 && $rowend) {
							$rowstart = true;
							$rowend = false;
							$prev = 9;
							$current = array_shift($col9);
							$current['col'] = 'col-4';
							$next = array(9);
							$debug = '9[4]->9';
						}// if last col9
						elseif(empty($col3) && count($col9) == 2 && $rowstart && !$rowend) {
							$rowstart = false;
							$rowend = false;
							$prev = 9;
							$current = array_shift($col9);
							$current['col'] = 'col-4';
							$next = array(9);
							$debug = '4p9[4]>9';
						}
						// if col9 but no col 3s
						elseif(!empty($col9) && empty($col3) && $rowend && $rowstart) {
							$rowstart = true;
							$rowend = false;
							$prev = 6;
							$current = array_shift($col9);
							$current['col'] = 'col-6';
							$next = array(6,9);
							$debug = '9[6]';
						}
						
						// if col9 but no col 3s
						elseif(!empty($col9) && empty($col3) && !$rowstart) {
							$rowstart = true;
							$rowend = false;
							$prev = 6;
							$current = array_shift($col9);
							$current['col'] = 'col-6';
							$next = array(6,9);
							$debug = '9[6]';
						}
						// if col9 but no col 3s
						elseif(!empty($col9) && empty($col3) && $rowstart) {
							$rowstart = false;
							$rowend = true;
							$prev = 6;
							$current = array_shift($col9);
							$current['col'] = 'col-6';
							$next = array(3,4,6,8,9,12);
							$debug = '9[6]end';
						}
						
						// if last col 6
						elseif(count($col6) == 1 && $rowend) {
							$rowstart = true;
							$rowend = true;
							$prev = 6;
							$current = array_shift($col6);
							$current['col'] = 'col-12';
							$next = array(3,4,6,8,9,12);
							$debug = '6>12last';
						} else {
							$rowend = true;
						}
						
						
						if ($rowstart){ 
							$html .= '<div class="container_inner fixed_columns portfolio_row ';
							$html .= ($rowdirection)?'row_reverse">':'">';
						}
						if(!isset($current['isolate'])) $current['isolate'] ='';
						if(isset($current['id'])):
							$html .= '<div id="pfi'.$current['id'].'" class="flex-item '.$current['col'].' '.$current['isolate'].'">';
							//$html .= $debug;
							if($args['post_type'] != 'attachment') $html .= '<a href="'.$current['href'].'">';
							$html .= '<img src="'.$current['src'].'"  width="'.$current['width'].'" height="'.$current['height'].'"';
							if($args['post_type'] == 'attachment') $html .= ' on="tap:lightbox1" role="button" ';
							$html .= ' alt="'.get_the_title().'">';
							if($args['post_type'] != 'attachment') $html .= '</a>';
							if($args['post_type'] != 'attachment') {
								if($show_post_title ||  $show_post_meta) $html .= '<div class="post_meta">';
								if($show_post_title) $html .= '<h3>'.$current['post_title'].'</h3><br>';
								if($show_post_meta) $html .= $current['post_meta'];
								if($show_post_title ||  $show_post_meta) $html .= '</div>';
							}
							$html .= '</div>';
						
							
						endif;
						if ($rowend) $html .= '</div>';
					}
				
				endif; // end masonry-h
				
				if ($in_grid) $html .= '</div>';
				$html .= '</div>';
				
				//$hiilite_options['portfolio_custom_css'] = $css;
				
				//$html .= '<style>'.$hiilite_options['portfolio_custom_css'].'</style>';
				/*if($args['post_type'] == 'attachment') { 
					$html .= '<amp-image-lightbox id="lightbox1" layout="nodisplay"><div id="closelightbox" on="tap:lightbox1.close"></div></amp-image-lightbox>';
					$hiilite_options['portfolio_custom_css'] .= '#closelightbox{position:fixed;width:100vw;height:100vh;z-index:9999;}';
				}*/
				
				
				
			endif;
			
			return $html;
		}
	endif;


endif;
?>