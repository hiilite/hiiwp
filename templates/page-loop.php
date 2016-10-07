<?php
global $hiilite_options;

$post_meta = get_post_meta(get_the_id()); 
?>
<!--PAGE-LOOP-->
<article  <?php post_class('row'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" >
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php bloginfo('url')?>"/>
	<div class="in_grid">
		<div class="container_inner">
			<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">
			<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
			<meta itemprop="headline" content="<?php the_title(); ?>">
			<span itemprop="author" itemscope itemtype="https://schema.org/Person">
				<meta itemprop="name" content="<?php the_author_meta('display_name'); ?>">
			</span>

		
<?php
	if(has_post_thumbnail(get_the_id()) && $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' )): 	
		$width = $img[1];
		$height = $img[2];
	else:
		$img[0] = $hiilite_options['main_logo'];
		$img[1] = $hiilite_options['logo_width'];
		$img[2] = $hiilite_options['logo_height'];
	endif;
?>
	<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
		<meta itemprop="url" content="<?=$img[0];?>">
		<meta itemprop="width" content="<?=$img[1];?>">
		<meta itemprop="height" content="<?=$img[2];?>"></span><?php 
				
	the_content();
	
	$options = get_option('hii_seo_settings'); ?>
		<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
			<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
			  <meta itemprop="url" content="<?=$options['business_logo']?>">
			  <meta itemprop="width" content="150">
			  <meta itemprop="height" content="150">
			</div>
			<meta itemprop="name" content="<?=$options['business_name']?>">
		</div><?php
						
?>
		</div>
	</div>
</article><?php

	
?>