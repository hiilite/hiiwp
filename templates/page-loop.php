<?php
$hiilite_options = Hii::$hiiwp->get_options();
$post_meta = get_post_meta(get_the_id()); 
$vc_enabled = (get_post_meta(get_the_id(), '_wpb_vc_js_status', true) == true)?true:false;
?>
<!--PAGE-LOOP-->
<article  <?php post_class('row'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" >
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php echo esc_url( home_url() )?>"/>
	<div class="in_grid">
		<div class="<?php echo (!$vc_enabled)?'content-box':'container_inner';?>">
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
				<meta itemprop="url" content="<?php echo $img[0];?>">
				<meta itemprop="width" content="<?php echo $img[1];?>">
				<meta itemprop="height" content="<?php echo $img[2];?>">
			</span><?php 
				
			the_content();
	
			$options = get_option('hii_seo_settings'); ?>
		</div>
	</div>
</article>