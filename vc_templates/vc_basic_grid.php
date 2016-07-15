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
	$query = array(
		'post_type' => $atts['post_type'],
		'posts_per_page' => isset($atts['max_items'])?$atts['max_items']:10
	);
}
echo '<div class="container_inner">';
$my_query = new WP_Query($query);
while ( $my_query->have_posts() ) {
	$my_query->the_post(); // Get post from query
		
	$post = new stdClass();
	
	$post_id = get_the_ID();
	$post->link = get_permalink( $post_id );

	?>
	<div class="flex-item third-width">
		<article class="content-box">
			<?php 
			if(has_post_thumbnail($post_id)): 
				
				$tn_id = get_post_thumbnail_id( $post_id );
		
				$img = wp_get_attachment_image_src( $tn_id, 'large' );
				$width = $img[1];
				$height = $img[2];
			?>
			<figure>
				<a href="<?=$post->link?>"><<?=$_amp?>img src='<?=$img[0];?>' layout='responsive' width='<?=$width?>' height='<?=($height)?>'><?=($_amp!='')?'</amp-img>':''?></a>
			</figure>
			<?php endif; ?>
			<h5><a href="<?=$post->link?>"><?php the_title(); ?></a></h5>
			
			<p><?php the_excerpt(); ?></p>
		
		</article>
	</div>
	<?php
}
echo '</div>';
wp_reset_postdata();
?>
