<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
?>
<article  <?php post_class('team-member flex-item third-width'); ?> id="post-<?php the_ID(); ?>" >
	<?php 
	if(has_post_thumbnail($post->id)): 
			
		$tn_id = get_post_thumbnail_id( $post->ID );

		$img = wp_get_attachment_image_src( $tn_id, 'large' );
		$width = $img[1];
		$height = $img[2];
	?>
	<figure class="flex-item full-width">
		<a href="<?php echo get_the_permalink()?>"><img src='<?php echo $img[0];?>' layout='responsive' width='<?php echo $width?>' height='<?php echo $height?>'></a>
	</figure><?php endif; ?>
	<div class="flex-item full-width content-box align-center">
		<h3><a href="<?php echo get_the_permalink()?>"><?php the_title(); ?></a></h3>
		<span itemprop="articleSection" class="labels"><span class="category tag"><?php 
			$terms = get_the_terms( $post->id, 'position');
			if($terms)echo $terms[0]->name;
			?></span></span>
	<div>
</article>
<?php
	
?>