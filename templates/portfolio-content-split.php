<?php
/*

	TODO:
	-	Make Title and feature image turn on by default in customizer	
*/
$hiilite_options = Hii::$hiiwp->get_options();
$post_meta = get_post_meta(get_the_id());

if(is_front_page() || is_archive(  )){ 
	$page_title = get_wp_title('');
} elseif(is_home()) {
	$page_title = get_the_title( get_option('page_for_posts', true) );
} else {
	$page_title = get_the_title( get_the_id( ));
} 
	
$page_bg = (get_post_meta ( $post->ID, 'page_bg', true))?get_post_meta ( $post->ID, 'page_bg', true):false;
$portfolio_description = (get_post_meta ( $post->ID, 'portfolio_description', true))?get_post_meta ( $post->ID, 'portfolio_description', true):false;
$portfolio_client = (get_post_meta ( $post->ID, 'portfolio_client', true))?get_post_meta ( $post->ID, 'portfolio_client', true):false;
?>
<!--PORTFOLIO_PIECE-LOOP-->
<article  <?php post_class('row'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" style="<?=($page_bg)?'background-color:'.$page_bg.';':'';?>">
	
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






echo '<div class="in_grid  align-top">';
	?>
	<span itemprop="articleSection" class="labels"><?php the_category(' '); ?></span>
	<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
	<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">
	
	<!-- Gallery -->
	<div class="col-8 portfolio-gallery">
		<?php	
		the_content();
		?>
		
		<?php
		if($hiilite_options['show_more_projects']):
		?>
			<div class="project-comments">
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
			</div>
		<?php
		endif;
		?>
		
		<?php
		if($hiilite_options['portfolio_comments']):
		?>
			<div class="project-comments">
				<div class="container_inner">
					<?php comments_template(); ?>
				</div>
			</div>
		<?php
		endif;
		?>
	</div>
	
	<!-- Sidebar -->
	<div class="col-2 project-info">
		<div class="row project-client">
			<div class="col-11">
				<h3>CLIENT</h3>
				<h1 itemprop="headline">
					<?=($portfolio_client)?$portfolio_client:'';?>
				</h1>
			</div>
			<div class="col-1 project-icon">
				ICON
			</div>
		</div>
		<div>
			<div class="col-12 project-title">
				<?php
				echo '<h2 itemprop="headline">'.$page_title.'</h2>';
				?>
			</div>
		</div>

		<div class="row">
			<?php
			if( has_tag()) { ?>
		        <div class="tags_text">
					<span itemprop="keywords" class="labels">
					TAGS
					</span>
				</div>
			<?php 
			}
			?>
		</div>
		
		<div class="row">
			<?php
			echo '<time class="time op-published" datetime="'.get_the_time('c').'><span class="date">'.get_the_time('F jS, Y').'</span></time>';;
			?>
		</div>
		
		<div class="row project-group">
		ROLES AND TEAM MEMBERS
		</div>
		
		<div class="row project-social">
			SOCIAL LINKS
			<br>Appriciate and Share
		</div>
		
		<div class="row project-author">
			<div class="col-2 project-icon">
				ICON
			</div>
			<div class="col-10">
				AUTHOR NAME
				<br><small>Author</small>
				<div class="project-description">
					<?=($portfolio_description)?$portfolio_description:'';?>
				</div>
			</div>
		</div>
	</div>
	
	
	
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

echo '</article>';

?>
