<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
?>
<article  <?php post_class('row blog-article'); ?> id="post-<?php the_ID(); ?>" >
	<div class="in_grid">
<?php
echo '<div class="container_inner">';

	
	if(has_post_thumbnail($post->id)): 
		
	$tn_id = get_post_thumbnail_id( $post->ID );

	$img = wp_get_attachment_image_src( $tn_id, 'large' );
	$width = $img[1];
		$height = $img[2];
	?>
	<figure class="flex-item third-width align-top">
		<img src='<?php echo $img[0];?>' layout='responsive' width='<?php echo $width?>' height='<?php echo $height?>'>
	</figure>
	<?php endif; 
		
echo '<div class="twothird-width content-box">';
	if(is_single() && get_post_meta(get_the_id(), 'show_page_title', true) != 'on'){
		?>
		<span itemprop="articleSection" class="labels"><a rel="category tag"><?php 
			$terms = get_the_terms( $post->id, 'position');
			if($terms)echo $terms[0]->name;
		?></a>
		<?php
		echo '<h1>';
		the_title();
		echo '</h1>';
	}
	if(has_excerpt($post->id)){
		the_excerpt();
	} else {
		the_content();
	}
	$exclude = array(get_the_id());
echo '</div>';
if(has_excerpt($post->id)){
echo '<div class="row"><div class="container_inner"><div class="in_grid">';
		the_content();
echo '</div></div></div>';
}
endif;



if($hiilite_options['subdomain'] != 'iframe'):
echo '</div>';
echo '</article>';

$team = new WP_Query(
array(	'post_type'=>'team',
		'posts_per_page'=>3,
		'orderby' => 'rand',
		'post__not_in' => $exclude
	));
if($team->have_posts()):
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';
	echo '<h2 class="full-width">Meet the rest of the team</h2>';
	while($team->have_posts()):
		$team->the_post();
		
		get_template_part('templates/team', 'loop');
		
		
	endwhile;
	echo '</div></div></div>';

endif;
echo '<div class="row"><div class="container_inner"><div class="in_grid content-box">';
echo '<a class="button full-width align-center" href="/team/">Meet the Whole Team</a>';
echo '</div></div></div>';

endif;
?>
