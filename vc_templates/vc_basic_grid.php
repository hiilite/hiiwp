<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
global $hiilite_options;
$hiilite_options['amp'] = get_theme_mod('amp');
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';
/**
 * Shortcode attributes
 * @var $atts array
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Basic_Grid
 */
 
 
 // TESTING
$this->post_id = false;
$css = $grid = $el_class = '';
$posts = $filter_terms = array();
$this->buildAtts( $atts, $content );

$css = isset( $atts['css'] ) ? $atts['css'] : '';
$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';

$class_to_filter = 'vc_grid-container vc_clearfix wpb_content_element ' . $this->shortcode;
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$this->buildGridSettings();


if ( ! empty( $atts['page_id'] ) ) {
	$this->grid_settings['page_id'] = (int) $atts['page_id'];
}

$grid_id = $this->atts['item'];
$grid_query = new WP_Query('post_type=vc_grid_item&post='.$grid_id);
if ( $grid_query->have_posts() ) {
	$grid_query->the_post();
	$grid_code = $grid_query->post->post_content;
}

// END TESTING



$query;
if($atts['post_type'] != 'custom'){
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
		'tax_query'	=> isset($taxquery)?$taxquery:'',
	);
	
} else {
	parse_str(html_entity_decode($atts['custom_query']), $query);
}
if(isset($atts)) {
	$hiilite_options['blog_layouts'] = (isset($atts['blog_layouts']) && $atts['blog_layouts'] != '')?$atts['blog_layouts']:$hiilite_options['blog_layouts'];
	$hiilite_options['blog_col'] = isset($atts['element_width'])?(string)$atts['element_width']:3;
	$hiilite_options['blog_img_pos'] = isset($atts['blog_img_pos'])?(string)$atts['blog_img_pos']:$hiilite_options['blog_img_pos'];
	$hiilite_options['blog_title_show'] = isset($atts['blog_title_show'])?$atts['blog_title_show']:$hiilite_options['blog_title_show'];
	$hiilite_options['blog_title_position'] = isset($atts['blog_title_position'])?$atts['blog_title_position']:$hiilite_options['blog_title_position'];
	$hiilite_options['blog_heading_tag'] = isset($atts['blog_heading_tag'])?$atts['blog_heading_tag']:$hiilite_options['blog_heading_tag'];
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

echo '<div class="container_inner '.$grid.' '.$hiilite_options['blog_layouts'].$colcount.'">';

$bg_query = new WP_Query($query);
while ( $bg_query->have_posts() ) {
	$bg_query->the_post(); // Get post from query
	
	include(locate_template( 'templates/blog-loop.php' ));

}
echo '</div>';
wp_reset_postdata();
?>
