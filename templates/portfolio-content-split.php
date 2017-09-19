<?php
/*

	TODO:
	-	Make Title and feature image turn on by default in customizer	
*/
$hiilite_options = Hii::$hiiwp->get_options();
$post_meta = get_post_meta(get_the_id());
$category = get_the_terms( $post->ID, 'work' );

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
$portfolio_images = (get_post_meta ( $post->ID, 'project_iamges', true))?get_post_meta ( $post->ID, 'project_iamges', true):false;
$contributers = (get_post_meta ( $post->ID, 'contributers_group', true))?get_post_meta ( $post->ID, 'contributers_group', true):false;
$project_share = (get_post_meta ( $post->ID, 'project_share', true))?get_post_meta ( $post->ID, 'project_share', true):false;

$social_url = esc_url( get_permalink($post->ID) );
     
$portfolio_work_image = (get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_image', true))?get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_image', true):false;
$portfolio_work_color = (get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_color', true))?get_term_meta ( $category[0]->term_taxonomy_id, 'portfolio_work_color', true):false;

$author_id=$post->post_author;


$tags = get_the_terms( $post->ID, 'porfolio_tag');
?>
<!--PORTFOLIO-CONTENT-SPLIT-->
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
		<?php the_content(); ?>
		<?php cmb2_output_portfolio_imgs($portfolio_images); ?>
		
		<?php
		if($hiilite_options['show_more_projects']):
		?>
			<div class="project-comments">
				<div class="align-center">
					<h4>More Projects</h4>
				</div>
				<?php
				$slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
				$args = array('post_type'=>$slug,'posts_per_page'=> '10','nopaging'=>true,'order'=>'ASC','orderby'=>'rand');
				$query = new WP_Query($args);
				?>
				
				<amp-carousel height="300" layout="fixed-height" type="carousel" class="carousel">
				<div class="carousel-wrapper">
			      <?php
				while($query->have_posts()):
					$query->the_post();
					if ( has_post_thumbnail() ) {
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' );
						$hratio = (300 / $image[2]);
					?>
				<a href="<?=get_the_permalink()?>" class="slide">
			    	<img src="<?=$image[0]?>" width="<?=$image[1]*$hratio?>" height="<?=$image[2]*$hratio?>" alt="<?=get_the_title()?>">
 				</a>
			  <?php
				  	}
				  endwhile;
				  ?>
				</div>
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
		
		<div class="row project-title">
			<div class="col-11">
				<div class="col-12">
				<?php
				echo '<h1 itemprop="headline">'.$page_title.'</h1>';
				?>
			</div>
			</div>
			<div class="col-1 project-icon cat-icon">
				<img src="<?=$portfolio_work_image;?>">
			</div>
		</div>

		<hr style="color:<?=$portfolio_work_color;?>;border-color: <?=$portfolio_work_color;?>;background: <?=$portfolio_work_color;?>;height: 2px;border: none;">
	
		<?php
		if($portfolio_client) {
		?>
		<div>
			<div class="col-12 project-client">
				<h3>CLIENT</h3>
				<h2>
					<?=$portfolio_client;?>
				</h2>
			</div>
		</div>
		<?php
		}
		?>
		
		<div class="row">
			<?php
			echo '<small><time class="time op-published" datetime="'.get_the_time('c').'><span class="date">'.get_the_time('F jS, Y').'</span></time></small>';
			?>
		</div>

		<div class="row">
			<?php

			if($tags) { ?>
		        <div class="tags_text">
					<span itemprop="keywords" class="labels">
						<small>
							<?php 
							foreach($tags as $tag) {
								$tad_id = get_tag_link($tag->term_id);
								echo '<a href="'.$tad_id.'">#'.$tag->name.'</a> ';
							}
							?>
						</small>
					</span>
				</div>
			<?php 
			}
			?>
		</div>
		
		<div class="row project-group">
			<?php
			foreach ( $contributers as $key => $entry ) {
			
				$role = $name = '';
			
				if ( isset( $entry['role'] ) && isset( $entry['name'] )) { 
					echo '<div class="row"><div class="col-6"><strong>';
					echo __( $entry['role'], 'hiilite' );
					echo ': </strong>';
					echo $entry['name'];
					echo '</div></div>';
				}			
			}	
			?>
		</div>
		
		<?php
		if($project_share){
		?>
		<div class="row project-social">
			<div>
			<?php
			foreach($project_share as $share) {
				if($share == 'fb') {
					echo '<a href="https://www.facebook.com/sharer/sharer.php?u='.$social_url.'"><i class="fa fa-facebook" aria-hidden="true"></i></a>';	
				}
				if($share == 'tw') {
					echo '<a href="https://twitter.com/home?status='.$social_url.'"><i class="fa fa-twitter" aria-hidden="true"></i></a>';	
				}
				if($share == 'gp') {
					echo '<a href="https://plus.google.com/share?url='.$social_url.'"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';	
				}
				if($share == 'pn') {
					echo '<a href="https://pinterest.com/pin/create/button/?url='.$social_url.'"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';	
				}
				if($share == 'ln') {
					echo '<a href="https://www.linkedin.com/shareArticle?mini=true&url='.$social_url.'"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';	
				}
			}
			?>
			</div>
			<div>
				<?php echo __( 'Appreciate and Share', 'hiilite' ); ?>
			</div>
		</div>
		<?php	
		}
		?>
		<div class="row project-author">
			<div class="col-2 author-icon project-icon">
				<a href="<?php echo get_author_posts_url( $author_id ); ?>">
					<img src="<?php echo get_avatar_url( $author_id ); ?> " width="50" height="50" class="avatar" alt="<?php echo the_author_meta( 'display_name' , $author_id ); ?>" />
				</a>
			</div>
			<div class="col-10">
				<a href="<?php echo get_author_posts_url( $author_id ); ?>"><h4><?php the_author_meta( 'display_name' , $author_id ); ?></h4></a>
				<small><?php echo __( 'Author', 'hiilite' ); ?></small>
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
	$args = array('post_type'=>$slug,'posts_per_page'=> '10','nopaging'=>true,'order'=>'ASC','orderby'=>'RAND');
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
    	<img src="<?=$image[0]?>" width="<?=$image[1]*$hratio?>" height="<?=$image[2]*$hratio?>" alt="<?=get_the_title()?>">
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
