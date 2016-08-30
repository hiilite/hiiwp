<?php 
// Include each post type if turned on
if($hiilite_options['testimonials_on']) require_once HIILITE_DIR.'/includes/post_types/testimonial_post_type.php';
if($hiilite_options['portfolio_on']) 	require_once HIILITE_DIR.'/includes/post_types/portfolio_post_type.php';
if($hiilite_options['menus_on']) 		require_once HIILITE_DIR.'/includes/post_types/menu_post_type.php';
if($hiilite_options['teams_on'])		require_once HIILITE_DIR.'/includes/post_types/team_post_type.php';




//////////////////////////
//
//	GET PORTFOLIO TEMPLATE
//
//////////////////////////
if(!function_exists('get_portfolio')):
function get_portfolio($args = null, $options = null){
	global $hiilite_options;
	$hiilite_options['portfolio_show_filter'] = get_theme_mod( 'portfolio_show_filter', true );
	$html = '';
	$css = '';
	$slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
	$hiilite_options['amp'] = get_theme_mod('amp');
	if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';
	
	extract( shortcode_atts( array(
	    'show_post_meta'  	=> get_theme_mod( 'portfolio_show_post_meta', false ),
	    'show_post_title'  	=> get_theme_mod( 'portfolio_show_post_title', false ),
	    'in_grid'			=> get_theme_mod( 'portfolio_in_grid', false ),
	    'add_padding'		=> get_theme_mod( 'portfolio_add_padding', '0px' ),
	    'portfolio_layout'	=> get_theme_mod( 'portfolio_layout', false ),
	    'portfolio_columns'	=> get_theme_mod( 'portfolio_columns', '1' ),
		'portfolio_image_pos'=> get_theme_mod( 'portfolio_image_pos', 'image-left' ),
		'portfolio_title_pos'=> get_theme_mod( 'portfolio_title_pos', 'title-below' ),
		'portfolio_heading_size'=> get_theme_mod( 'portfolio_heading_size', 'h2' ),
		'portfolio_excerpt_on'=> get_theme_mod( 'portfolio_excerpt_on', false ),
		'portfolio_more_on'=> get_theme_mod( 'portfolio_more_on', false ),
		'css_class'		=> '',

    ), $options ) );
	$args = ($args==null)?array('post_type'=>$slug,'posts_per_page'=> -1,'nopaging'=>true,'order'=>'ASC','orderby'=>'menu_order'):$args;
	
	$query = new WP_Query($args);
	
	if($query->have_posts()):
		
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
		    if($portfolio_layout == 'masonry') $html .= '<div class="row masonry col-count-'.$portfolio_columns.'">';
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
						<'.$_amp.'img src="'.$imgs[$i]['src'].'" layout="responsive" on="tap:lightbox1" width='.$imgs[$i]['width'].' height='.$imgs[$i]['height'].'>';
					$html .= ($_amp!='')?'</amp-img>':'';
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
						<a href="'.$imgs[$i]['src'].'"><'.$_amp.'img src="'.$imgs[$i]['src'].'" layout="responsive" width='.$imgs[$i]['width'].' height='.$imgs[$i]['height'].'>';
					$html .= ($_amp!='')?'</amp-img>':'';
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
	    	if($portfolio_layout != 'masonry-h'){
		    	$html .= '<div class="container_inner">';
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
					$html .= '<article class="row row-o-content-top blog-article flex-item '.$cols.'" id="post-'.get_the_id().'" >
					<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="'.get_bloginfo('url').'"/>';
					
					if($portfolio_title_pos == 'title-above') { 
						$html .= '<div class="content-box">'.$article_title.'</div>';
					}
					
					if(has_post_thumbnail(get_the_id())): 
							
						$tn_id = get_post_thumbnail_id( get_the_id() );
				
						$img = wp_get_attachment_image_src( $tn_id, 'large' );
						$width = $img[1];
						$height = $img[2];
					
						$html .='<figure class="flex-item col-6">
							<a href="'.get_the_permalink().'"><'.$_amp.'img src="'.$img[0].'" layout="responsive" width='.$width.' height='.$height.'>';
						$html .= ($_amp!='')?'</amp-img>':'';
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
					if($portfolio_excerpt_on)$html .= '<p>'.get_the_excerpt().'</p>';
					if($portfolio_more_on)$html .='<a class="button" href="'.get_the_permalink().'">Read More</a>';
					$html .= '<div></article>';
				else: // else if not masonry-h
				
					
					// Create Title
					$article_title = '';
										
					if($show_post_title) {
						$article_title .= '<'.$portfolio_heading_size.'><a href="'.get_the_permalink().'">'.get_the_title().'</a></'.$portfolio_heading_size.'>';
					} 
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
					$html .= '<article class="row row-o-content-top blog-article flex-item '.$cols.'" id="post-'.get_the_id().'" >
					<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="'.get_bloginfo('url').'"/>';
					
					if($portfolio_title_pos == 'title-above') { 
						$html .= '<div class="content-box">'.$article_title.'</div>';
					}
					
					if(has_post_thumbnail(get_the_id())): 
							
						$tn_id = get_post_thumbnail_id( get_the_id() );
				
						$img = wp_get_attachment_image_src( $tn_id, 'large' );
						$width = $img[1];
						$height = $img[2];
					
						$html .='<figure class="flex-item col-6">
							<a href="'.get_the_permalink().'"><'.$_amp.'img src="'.$img[0].'" layout="responsive" width='.$width.' height='.$height.'>';
						$html .= ($_amp!='')?'</amp-img>':'';
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
					if($portfolio_excerpt_on)$html .= '<p>'.get_the_excerpt().'</p>';
					if($portfolio_more_on)$html .='<a class="button" href="'.get_the_permalink().'">Read More</a>';
					$html .= '<div></article>';
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
					$html .= '<amp-img src="'.$current['src'].'" layout="responsive" width="'.$current['width'].'" height="'.$current['height'].'"';
					if($args['post_type'] == 'attachment') $html .= ' on="tap:lightbox1" role="button" ';
					$html .= '></amp-img>';
					if($args['post_type'] != 'attachment') $html .= '</a>';
					if($args['post_type'] != 'attachment') {
						if($show_post_title ||  $show_post_meta) $html .= '<div class="post_meta">';
						if($show_post_title) $html .= '<h3>'.$current['post_title'].'</h3><br>';
						if($show_post_meta) $html .= $current['post_meta'];
						if($show_post_title ||  $show_post_meta) $html .= '</div>';
					}
					$html .= '</div>';
				
					if ($rowend) $html .= '</div>';
				endif;
			}
		
		endif; // end masonry-h
		
		if ($in_grid) $html .= '</div>';
		$html .= '</div>';
		
		$hiilite_options['portfolio_custom_css'] = $css;
		
		$html .= '<style>'.$hiilite_options['portfolio_custom_css'].'"</style>';
		if($args['post_type'] == 'attachment') { 
			$html .= '<amp-image-lightbox id="lightbox1" layout="nodisplay"><div id="closelightbox" on="tap:lightbox1.close"></div></amp-image-lightbox>';
			$hiilite_options['portfolio_custom_css'] .= '#closelightbox{position:fixed;width:100vw;height:100vh;z-index:9999;}';
		}
		
		
		
	endif;
	
	return $html;
}
endif;







?>