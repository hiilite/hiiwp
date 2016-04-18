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

$query;
if($atts['post_type'] != 'custom'){
	$query = array(
		'post_type' => $atts['post_type'],
		'posts_per_page' => $atts['max_items']
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
				<a href="<?=$post->link?>"><<?=$_amp?>img src='<?=$img[0];?>' layout='responsive' width='<?=$width?>' height='<?=($width * 0.75)?>'><?=($_amp!='')?'</amp-img>':''?></a>
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
