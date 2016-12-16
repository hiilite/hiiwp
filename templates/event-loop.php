<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
$hiilite_options['amp'] = get_theme_mod('amp');
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';

// Create Title
$article_title = '';

if(isset($atts)) {
	$hiilite_options['blog_columns'] = isset($atts['element_width'])?(string)$atts['element_width']:$hiilite_options['blog_columns'];
	$hiilite_options['blog_layout'] = 'boxed';
}

$event_date = $post->EE_Event->first_datetime(); 
$event_date = $event_date->start_date();
$event_date = strtotime($event_date);
if($hiilite_options['blog_date_style'] == 'date-full')
{
	$event_date = date('F d,Y',$event_date);	
}
elseif($hiilite_options['blog_date_style'] == 'date-abr')
{
	$event_date = date('M d,Y', $event_date);	
}
elseif($hiilite_options['blog_date_style'] == 'date-myd')
{
	$event_date = date('m/d/Y', $event_date);	
}
$event_date = '<div class="event_date">'.$event_date.'</div>';

if($hiilite_options['blog_cats_on']):
	$article_cat .= '<span itemprop="articleSection" class="labels">'.get_the_category_list(' ').'</span>';
else:
	$categories = get_the_category();$cats ='';
	foreach($categories as $cat){
		$cats .= $cat->name;
	}
	$article_cat .= '<meta itemprop="articleSection" content="'.$cats.'">';
endif;

if($hiilite_options['blog_title_on']) {
	$article_title .= '<'.$hiilite_options['blog_heading_size'].'><a href="'.get_the_permalink().'">'.get_the_title().'</a></'.$hiilite_options['blog_heading_size'].'>';
} 

if($hiilite_options['blog_cats_on']):
	$dateline = $dateline.$article_cat;
endif;

if($hiilite_options['blog_dateline_pos'] == 'date-above'):
	$article_title = $event_date.$article_title;
else:
	$article_title = $article_title.$event_date;
endif;


$cols = '';
if($hiilite_options['blog_layout'] =='boxed'){
	switch ($hiilite_options['blog_columns']) {
		case '2': 
			$cols = ' col-6'; 
		break;
		case '3': 
			$cols = ' col-4'; 
		break;
		case '4': 
			$cols = ' col-3'; 
		break;		
	}
}
?>
<!--BLOG-LOOP-->
<article <?php post_class('row row-o-content-top blog-article'.$cols); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" >
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php bloginfo('url')?>"/>
	<?php 
	if($hiilite_options['blog_title_pos'] == 'title-above') { 
		echo '<div class="content-box col-12">';
		
		echo $article_title;
		
		echo '</div>';
	}
	echo '<figure class="flex-item ';
	echo ($hiilite_options['blog_image_pos']=='image-left')?'col-6':'col-12';
	
	echo '" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">';
	if(has_post_thumbnail($post->ID)): 
		$tn_id = get_post_thumbnail_id( $post->ID );
		$img = wp_get_attachment_image_src( $tn_id, 'large' );
		$width = ($img[1])?$img[1]:$hiilite_options['logo_width'];
		$height = ($img[2])?$img[2]:$hiilite_options['logo_height'];
		$img_src = ($img[0] != '')?$img[0]:$hiilite_options['main_logo'];
	else: 
		$width = $hiilite_options['logo_width'];
		$height = $hiilite_options['logo_height'];
		$img_src = $hiilite_options['main_logo'];
	endif;?>
		<meta itemprop="url" content="<?=$img_src;?>">
		<meta itemprop="width" content="<?=$width;?>">
		<meta itemprop="height" content="<?=$height;?>">
		<a href="<?=get_the_permalink()?>"><<?=$_amp?>img src='<?=$img_src;?>' layout='responsive' width='<?=$width?>' height='<?=$height?>'><?=($_amp!='')?'</amp-img>':''?></a>
		<?php
	echo '</figure>'; ?>
	<div class="flex-item <?=($hiilite_options['blog_image_pos']=='image-left')?'col-6':'col-12'; ?> content-box" >
		<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">
		<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
		<meta itemprop="headline" content="<?php the_title(); ?>">
		<?php 
		if($hiilite_options['blog_title_pos'] == 'title-below') { 
			
			echo $article_title;
		
		}
		if($hiilite_options['blog_excerpt_on']):?><p><?=content_excerpt($hiilite_options['blog_excerpt_length']); ?></p><?php endif;
		if($hiilite_options['blog_more_on']):?><a class="button readmore" href="<?php the_permalink() ?>"><?=$hiilite_options['blog_more_text'];?></a><?php endif;?>
	<div>
		<?php $options = get_option('hii_seo_settings'); ?>
		<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
			<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
			  <meta itemprop="url" content="<?=$options['business_logo']?>">
			  <meta itemprop="width" content="150">
			  <meta itemprop="height" content="150">
			</div>
			<meta itemprop="name" content="<?=$options['business_name']?>">
		</div>

</article>
<?php
	
?>