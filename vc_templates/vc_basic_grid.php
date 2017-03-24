<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
global $hiilite_options;
/**
 * Shortcode attributes
 * @var $atts array
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Basic_Grid
 */
 

$this->post_id = false;
$css = $el_class = '';
$posts = $filter_terms = array();
$this->buildAtts( $atts, $content );

$grid = $query = '';
$css = isset( $atts['css'] ) ? $atts['css'] : '';
$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';

$class_to_filter = 'vc_grid-container vc_clearfix wpb_content_element ' . $this->shortcode;
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$this->buildGridSettings();



$grid_id = $this->atts['item'];
$grid_query = new WP_Query('post_type=vc_grid_item&post='.$grid_id);
if ( $grid_query->have_posts() ) {
	$grid_query->the_post();
	$grid_code = $grid_query->post->post_content;
}



$wrapper_attributes = array();
if ( ! empty( $atts['el_id'] ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $atts['el_id'] ) . '"';
}

// END TESTING



$query;
if(isset($atts['post_type']) && $atts['post_type'] != 'custom'){
	if(isset($atts['taxonomies'])) {
		$terms = get_object_taxonomies($atts['post_type'], 'names');
		$taxquery = array(
			array(
				'taxonomy'	=> $terms[0],
				'field'		=> 'term_id',
				'terms' 	=> array($atts['taxonomies']),
				'operator'	=> 'IN',
			)
		);
	}
	
	$query = array(
		'post_type' => $atts['post_type'],
		'posts_per_page' => isset($atts['max_items'])?$atts['max_items']:10,
		'tax_query'	=> $taxquery,
	);
	
} elseif(isset($atts['custom_query'])) {
	parse_str(html_entity_decode($atts['custom_query']), $query);
}
if(isset($atts)) {
	$hiilite_options['blog_layouts'] = (isset($atts['blog_layouts']) && $atts['blog_layouts'] != '')?$atts['blog_layouts']:$hiilite_options['blog_layouts'];
	$hiilite_options['blog_col'] = isset($atts['element_width'])?(string)$atts['element_width']:$hiilite_options['blog_col'];
	$hiilite_options['blog_img_pos'] = isset($atts['blog_img_pos'])?(string)$atts['blog_img_pos']:$hiilite_options['blog_img_pos'];
	$hiilite_options['blog_title_show'] = isset($atts['blog_title_show'])?$atts['blog_title_show']:$hiilite_options['blog_title_show'];
	$hiilite_options['blog_title_position'] = isset($atts['blog_title_position'])?$atts['blog_title_position']:$hiilite_options['blog_title_position'];
	$hiilite_options['blog_cats_show'] = isset($atts['blog_cats_show'])?$atts['blog_cats_show']:$hiilite_options['blog_cats_show'];
	$hiilite_options['blog_meta_show'] = isset($atts['blog_meta_show'])?$atts['blog_cats_show']:$hiilite_options['blog_meta_show'];
	$hiilite_options['blog_excerpt_show'] = isset($atts['blog_excerpt_show'])?$atts['blog_cats_show']:$hiilite_options['blog_excerpt_show'];
	$hiilite_options['blog_excerpt_len'] = isset($atts['blog_excerpt_len'])?$atts['blog_excerpt_len']:$hiilite_options['blog_excerpt_len'];
	$hiilite_options['blog_more_show'] = isset($atts['blog_more_show'])?$atts['blog_more_show']:$hiilite_options['blog_more_show'];
	
	
	switch ($hiilite_options['blog_col']) {
		case '6': 
			$hiilite_options['blog_col'] = '2'; 
		break;
		case '4': 
			$hiilite_options['blog_col'] = '3'; 
		break;
		case '3': 
			$hiilite_options['blog_col'] = '4'; 
		break;
		case '2': 
			$hiilite_options['blog_col'] = '6'; 
		break;
		case '1': 
			$hiilite_options['blog_col'] = '12'; 
		break;		
	}
}

$colcount = ($hiilite_options['blog_layouts'] =='masonry')?' col-count-'.$hiilite_options['blog_col']:'';

echo '<!-- vc_grid start --><div class="vc_grid-container-wrapper vc_clearfix container_inner '.$grid.' '.$hiilite_options['blog_layouts'].$colcount.'" '.implode( ' ', $wrapper_attributes ).'>';

if(isset($query) && $query != ''){
	$bg_query = new WP_Query($query);
	while ( $bg_query->have_posts() ) {
		$bg_query->the_post(); // Get post from query
		
		include(locate_template( 'templates/blog-loop.php' ));
	
	}
	wp_reset_postdata();
} else {
	wp_enqueue_script( 'prettyphoto' );
	wp_enqueue_style( 'prettyphoto' );
	if ( isset( $this->atts['style'] ) && 'pagination' === $this->atts['style'] ) {
		wp_enqueue_script( 'twbs-pagination' );
	}
	
	if ( ! empty( $atts['page_id'] ) ) {
		$this->grid_settings['page_id'] = (int) $atts['page_id'];
	}
	
	$this->enqueueScripts();
	
	$animation = isset( $this->atts['initial_loading_animation'] ) ? $this->atts['initial_loading_animation'] : 'zoomIn';

	
	?>
	
	<div class="<?php echo esc_attr( $css_class ) ?>" data-initial-loading-animation="<?php echo esc_attr( $animation );?>" data-vc-<?php echo esc_attr( $this->pagable_type ); ?>-settings="<?php echo esc_attr( json_encode( $this->grid_settings ) ); ?>" data-vc-request="<?php echo esc_attr( apply_filters( 'vc_grid_request_url', admin_url( 'admin-ajax.php' ) ) ); ?>" data-vc-post-id="<?php echo esc_attr( get_the_ID() ); ?>" data-vc-public-nonce="<?php echo vc_generate_nonce( 'vc-public-nonce' ); ?>">
	</div>
	
	<?php
	
}
echo '</div><!-- vc_grid end -->';

?>
