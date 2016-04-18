<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
$hiilite_options['amp'] = get_theme_mod('amp');
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';
?>
<article  <?php post_class('team-member flex-item threquarter-width'); ?> id="post-<?php the_ID(); ?>" >
	<?php 
	if(has_post_thumbnail($post->id)): 
			
		$tn_id = get_post_thumbnail_id( $post->ID );

		$img = wp_get_attachment_image_src( $tn_id, 'large' );
		$width = $img[1];
		$height = $img[2];
	?>
	<figure class="flex-item full-width">
		<a href="<?=get_the_permalink()?>"><<?=$_amp?>img src='<?=$img[0];?>' layout='responsive' width='<?=$width?>' height='<?=$height?>'><?=($_amp!='')?'</amp-img>':''?></a>
	</figure><?php endif; ?>
	<div class="flex-item full-width content-box align-center">
		<span itemprop="articleSection" class="labels"><?php the_category(', '); ?></span>
		<h3><span itemprop="articleSection" class="labels"><span rel="category tag"><?php 
			$terms = get_the_terms( $post->id, 'position');
			if($terms)echo $terms[0]->name;
			?></span></span>
		<a href="<?=get_the_permalink()?>"><?php the_title(); ?></a></h3>
	<div>
</article>
<?php
	
?>