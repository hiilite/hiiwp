<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
?>
<!--PORTFOLIO-LOOP-->
<article  <?php post_class('portfolio-piece flex-item half-width'); ?> id="post-<?php the_ID(); ?>" >
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php bloginfo('url')?>"/>
	<?php 
	if(has_post_thumbnail($post->id)): 
			
		$tn_id = get_post_thumbnail_id( $post->ID );

		$img = wp_get_attachment_image_src( $tn_id, 'large' );
		$width = $img[1];
		$height = $img[2];
	?>
	<figure class="flex-item full-width">
		<a href="<?=get_the_permalink()?>"><img src='<?=$img[0];?>' layout='responsive' width='<?=$width?>' height='<?=$height?>'></a>
	</figure><?php endif; ?>
	<div class="flex-item full-width content-box" >
		<span itemprop="articleSection" class="labels"><?php the_category(', '); ?></span>
		<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">
		<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
		<h5><span itemprop="articleSection" class="labels"><span rel="category tag"><?php 
			$terms = get_the_terms( $post->id, $hiilite_options['portfolio_tax_slug']);
			if(!empty($terms))echo $terms[0]->name;
			?></span></span>
		<a href="<?=get_the_permalink()?>"><span itemprop="headline"><?php the_title(); ?></span></a></h5>
	<div>
</article>
<?php

?>