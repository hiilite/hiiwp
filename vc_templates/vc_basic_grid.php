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
$css = $el_class = '';
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
		'tax_query'	=> $taxquery,
	);
	
}
echo '<div class="container_inner">';
$colcount = ($hiilite_options['blog_layout'] =='masonry')?' col-count-'.$hiilite_options['blog_columns']:'';
	echo '<div class="'.$hiilite_options['blog_layout'].$colcount.'">';
$my_query = new WP_Query($query);
while ( $my_query->have_posts() ) {
	$my_query->the_post(); // Get post from query
		
	$post = new stdClass();
	
	$post_id = get_the_ID();
	$post->link = get_permalink( $post_id );
	
	
	get_template_part('templates/blog', 'loop');

}
echo '</div>';
echo '</div>';
wp_reset_postdata();
?>
