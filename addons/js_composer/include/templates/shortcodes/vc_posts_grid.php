<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $grid_columns_count
 * @var $grid_teasers_count
 * @var $grid_layout
 * @var $grid_link_target
 * @var $filter
 * @var $grid_thumb_size
 * @var $grid_layout_mode
 * @var $el_class
 * @var $loop
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Posts_Grid
 */
$title = $grid_columns_count = $grid_teasers_count = $grid_layout =
$grid_link_target = $filter = $grid_thumb_size = $grid_layout_mode = $el_class = $loop = '';

global $vc_teaser_box;
$grid_link = '';
$posts = array();
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$this->resetTaxonomies();
if ( empty( $loop ) ) {
	return;
}
$this->getLoop( $loop );
$my_query = $this->query;
$args = $this->loop_args;
$teaser_blocks = vc_sorted_list_parse_value( $grid_layout );
global $vc_posts_grid_exclude_id;
/** @var $my_query WP_Query */
while ( $my_query->have_posts() ) {
	$my_query->the_post(); // Get post from query
	$post = new stdClass(); // Creating post object.
	if ( in_array( get_the_ID(), $vc_posts_grid_exclude_id ) ) {
		continue;
	}
	$post->id = get_the_ID();
	$post->link = get_permalink( $post->id );
	
	$post->custom_user_teaser = false;
	$post->title = the_title( '', '', false );
	$post->title_attribute = the_title_attribute( 'echo=0' );
	$post->post_type = get_post_type();
	$post->content = $this->getPostContent();
	$post->excerpt = $this->getPostExcerpt();
	$post->thumbnail_data = $this->getPostThumbnail( $post->id, $grid_thumb_size );
	$post->thumbnail = $post->thumbnail_data && isset( $post->thumbnail_data['thumbnail'] ) ? $post->thumbnail_data['thumbnail'] : '';
	$video = get_post_meta( $post->id, '_p_video', true );
	$post->image_link = empty( $video ) && $post->thumbnail && isset( $post->thumbnail_data['p_img_large'][0] ) ? $post->thumbnail_data['p_img_large'][0] : $video;
	

	$post->categories_css = $this->getCategoriesCss( $post->id );

	$posts[] = $post;
	
	?>
	
	<article>
		<h2><?php the_title(); ?></h2>
		
		
		
	</article>
	
	<?php
}
wp_reset_query();
?>