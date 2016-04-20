<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
$hiilite_options['amp'] = get_theme_mod('amp');
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';
if($hiilite_options['subdomain'] != 'iframe'):
?>
<article  <?php post_class('row'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" >
	<div class="in_grid">
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php bloginfo('url')?>"/>
<?php
echo '<div class="container_inner">';
?><div class="full-width content-box">
	<span itemprop="articleSection" class="labels"><?php the_category(' '); ?></span>
	<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">
	<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
	<meta itemprop="headline" content="<?php the_title(); ?>"><?php
	if(is_single() && get_post_meta(get_the_id(), 'show_page_title', true) != 'on'){
		echo '<h1>';
		the_title();
		echo '</h1>';
	}
?><small>
<span class="post_author">
	<?php _e('by','hiilite'); ?>
	<a itemprop="author" itemscope itemtype="https://schema.org/Person" class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
		<span itemprop="name"><?php the_author_meta('display_name'); ?></span>
	</a>
</span>
<span class="time"> <?php _e('on ','hiilite'); ?> <span class="date"><?php the_time('F j, Y'); ?></span> <?php the_time('h:i a'); ?></span></small>
</div><?php
echo '<div class="threequarter-width content-box  align-top">';

	
	if(has_post_thumbnail($post->id)): 
			
		$tn_id = get_post_thumbnail_id( $post->ID );

		$img = wp_get_attachment_image_src( $tn_id, 'large' );
		$width = $img[1];
		$height = $img[2];
	?>
	<figure class="flex-item full-width" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
		<meta itemprop="url" content="<?=$img[0];?>">
		<meta itemprop="width" content="<?=$img[1];?>">
		<meta itemprop="height" content="<?=$img[2];?>">
		<<?=$_amp?>img src='<?=$img[0];?>' layout='responsive' width='<?=$width?>' height='<?=$height?>'><?=($_amp!='')?'</amp-img>':''?>
	</figure><?php endif;
		
	the_content();
	
	
	$source = get_post_meta( $post->ID, 'source_article_link');
	if(isset($source) && $source[0] != ''){ ?>
	<br>
	<div class="articleSource labels">
		<p>
			<strong class="label">Source</strong> <a href="<?=get_post_meta( $post->ID, 'source_article_link', true); ?>"><?=get_post_meta ( $post->ID, 'source_article_title', true); ?></a> <span class="label"><?=get_post_meta( $post->ID, 'source_site_title', true); ?></span>
		<meta itemprop="sameAs" content="<?=get_post_meta( $post->ID, 'source_article_link', true); ?>">
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
		
	$options = get_option('company_options'); ?>
			<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
				<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
				  <meta itemprop="url" content="<?=$options['business_logo']?>">
				  <meta itemprop="width" content="150">
				  <meta itemprop="height" content="150">
				</div>
				<meta itemprop="name" content="<?=$options['business_name']?>">
			</div><?php

		echo '</div>';
		
						
					
		echo '<aside class="quarter-width content-box  align-top align-center">';
			dynamic_sidebar( 'post_sidebar' );
		echo '</aside>';
	
echo '</div>';
endif;
/*
if($hiilite_options['subdomain'] != 'iframe'){
	echo '<div class="iframe-content container_inner">';
	echo '<amp-iframe width="100vw" height="100vh"
            sandbox="allow-forms allow-modals allow-popups allow-popups-to-escape-sandbox allow-scripts allow-same-origin"
            frameborder="0"
            src="https://iframe.'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"].'">';
    echo '</amp-iframe>';
    echo '</div>';
} elseif ($hiilite_options['subdomain'] == 'iframe') {
	echo '<div class="container_inner">';
		comments_template();
	echo '</div>';
}

*/

if($hiilite_options['subdomain'] != 'iframe'):
echo '</div>';
echo '</article>';
endif;
?>
