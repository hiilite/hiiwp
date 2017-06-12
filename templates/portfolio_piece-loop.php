<?php
/*

	TODO:
	-	Make Title and feature image turn on by default in customizer	
*/
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());

?>
<!--PORTFOLIO_PIECE-LOOP-->
<article  <?php post_class('row'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" >
	
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php bloginfo('url')?>"/>
<?php
echo '<div class="container_inner">';
$show_featureimage = false;
if($show_featureimage):
?><div class="full-width"> 
	<?php
		
		if(has_post_thumbnail($post->id) && get_post_meta(get_the_id(), 'hide_page_feature_image', true) != 'on'): 
			
		$tn_id = get_post_thumbnail_id( $post->ID );

		$img = wp_get_attachment_image_src( $tn_id, 'large' );
		$width = $img[1];
		$height = $img[2];
	?>
	<figure class="flex-item full-width" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
		<meta itemprop="url" content="<?=$img[0];?>">
		<meta itemprop="width" content="<?=$img[1];?>">
		<meta itemprop="height" content="<?=$img[2];?>">
		<img src='<?=$img[0];?>' layout='responsive' width='<?=$width?>' height='<?=$height?>'>
	</figure>
	<?php endif; ?>
</div><?php
	endif;
echo '<div class="full-width  align-top">';
	?>
	<span itemprop="articleSection" class="labels"><?php the_category(' '); ?></span>
	<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
	<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">
	<?php
		
		$show_title = false;
		if($show_title):
	if(is_single() && get_post_meta(get_the_id(), 'show_page_title', true) != 'on'){
		echo '<h1 itemprop="headline">';
		the_title();
		echo '</h1>';
	}
	
	endif;
?>

<span itemprop="author" itemscope itemtype="https://schema.org/Person"><meta itemprop="name" content="<?php the_author_meta('display_name'); ?>"></span>



	<?php	
	the_content();
	
	
	$source = get_post_meta( $post->ID, 'source_article_link');
	if($source && $source[0] != ''){ ?>
	<br>
	<div class="articleSource labels">
		<p>
			<strong class="label">Source</strong> <a href="<?=get_post_meta( $post->ID, 'source_article_link', true); ?>"><?=get_post_meta ( $post->ID, 'source_article_title', true); ?></a> <span class="label"><?=get_post_meta( $post->ID, 'source_site_title', true); ?></span>
		<meta itemprop="sameAs" content="<?=get_post_meta( $post->ID, 'source_article_link'); ?>">
		</p>
	</div>
	<?php } 
		
	if( has_tag()) { ?>
        <div class="tags_text">
			<span itemprop="keywords" class="labels">
			<?php 
				the_tags('', ' ', '');
			?></span>
		</div>
	<?php }
		
	$options = get_option('hii_seo_settings'); ?>
			<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
				<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
				  <meta itemprop="url" content="<?=$options['business_logo']?>">
				  <meta itemprop="width" content="150">
				  <meta itemprop="height" content="150">
				</div>
				<meta itemprop="name" content="<?=$options['business_name']?>">
			</div><?php

		echo '</div>';
		
					
		/*echo '<aside class="quarter-width content-box  align-top align-center">';
			dynamic_sidebar( 'post_sidebar' );
		echo '</aside>';*/
		
echo '</div>';

$hiilite_options['show_more_projects'] = false;
if($hiilite_options['show_more_projects']):
?>
<aside class="col-12">
	<div class="align-center">
		<h4>More Projects</h4>
	</div>
	<?php
	$slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
	$args = array('post_type'=>$slug,'posts_per_page'=> -1,'nopaging'=>true,'order'=>'ASC','orderby'=>'menu_order');
	echo '<pre>'.print_r($args,true).'</pre>';
	$query = new WP_Query($args);
	?>
	
	<amp-carousel height="300" layout="fixed-height" type="carousel" class="carousel">
      <?php
	while($query->have_posts()):
		$query->the_post();
		if ( has_post_thumbnail() ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' );
			$hratio = (300 / $image[2]);
		?>
	<a href="<?=get_the_permalink()?>">
    	<amp-img src="<?=$image[0]?>" width="<?=$image[1]*$hratio?>" height="<?=$image[2]*$hratio?>" alt="<?=get_the_title()?>"></amp-img>
	</a>
  <?php
	  	}
	  endwhile;
	  ?>
	</amp-carousel>
</aside>
<?php
	
endif;

if($hiilite_options['portfolio_comments']):
	echo '<div class="container_inner">';
		comments_template();
	echo '</div>';
endif;
	


echo '</article>';

?>
