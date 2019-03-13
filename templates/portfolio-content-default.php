<?php
/**
 * HiiWP Template: portfolio-content-default
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
/*
	TODO:
	-	Make Title and feature image turn on by default in customizer	
*/
$hiilite_options = Hii::$hiiwp->get_options();
$post_meta = get_post_meta(get_the_id());

$portfolio_images = (get_post_meta ( $post->ID, 'project_iamges', true))?get_post_meta ( $post->ID, 'project_iamges', true):false;
$imgs_in_grid = (get_post_meta ( $post->ID, 'imgs_in_grid', true))?get_post_meta ( $post->ID, 'imgs_in_grid', true):false;
?>
<!--PORTFOLIO-CONTENT-DEFAULT-->
<article <?php post_class('row'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" >
	
<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php echo esc_url( home_url() )?>"/>
<span itemprop="author" itemscope itemtype="https://schema.org/Person"><meta itemprop="name" content="<?php the_author_meta('display_name'); ?>"></span>
<span itemprop="articleSection" class="labels"><?php the_category(' '); ?></span>
<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">

<?php
echo '<div class="container_inner scroll_snap_container">';
$show_featureimage = false;
if($show_featureimage):
?><div class="col-12"> 
	<?php
		 
		if(has_post_thumbnail($post->id) && get_post_meta(get_the_id(), 'hide_page_feature_image', true) != 'on'): 
			
		$tn_id = get_post_thumbnail_id( $post->ID );
		$img = wp_get_attachment_image_src( $tn_id, 'large' );
		$width = $img[1];
		$height = $img[2];
	?>
	<figure class="flex-item">
		<img src='<?php echo esc_url($img[0]);?>' layout='responsive' width='<?php echo intval($width);?>' height='<?php echo intval($height);?>'>
	</figure>
	<?php endif; ?>
</div><?php
	endif;
		
		$show_title = false;
		if($show_title):
	if(is_single() && get_post_meta(get_the_id(), 'show_page_title', true) != 'on'){
		echo '<h1 itemprop="headline">';
		the_title();
		echo '</h1>';
	}
	
	endif;
	
	echo ($hiilite_options['portfolio_single_in_grid'] === true)?'<div class="in_grid">':'';
	the_content();
	echo ($hiilite_options['portfolio_single_in_grid'] === true)?'</div>':'';
		
	if($imgs_in_grid == true) 	echo '<div class="in_grid">';
		cmb2_output_portfolio_imgs($portfolio_images);
	
	if($imgs_in_grid == true) 	echo '</div>';
	
	$source = get_post_meta( $post->ID, 'source_article_link');
	if($source && $source[0] != ''){ ?>
	<br>
	<div class="articleSource labels">
		<p>
			<strong class="label">Source</strong> <a href="<?php echo get_post_meta( $post->ID, 'source_article_link', true); ?>"><?php echo get_post_meta ( $post->ID, 'source_article_title', true); ?></a> <span class="label"><?php echo get_post_meta( $post->ID, 'source_site_title', true); ?></span>
		<meta itemprop="sameAs" content="<?php echo get_post_meta( $post->ID, 'source_article_link'); ?>">
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

echo '</div>';
if($hiilite_options['show_more_projects']):
?>
<aside class="col-12">
	<div class="align-center">
		<h4>More Projects</h4>
	</div>
	<?php
	$slug = $hiilite_options[ 'portfolio_slug' ];
	$args = array('post_type'=>$slug,'posts_per_page'=> -1,'nopaging'=>true,'order'=>'ASC','orderby'=>'menu_order');
	$query = new WP_Query($args);
	?>
	
	<amp-carousel height="300" layout="fixed-height" type="carousel" class="relatedposts carousel in_grid">
		<div class="carousel-wrapper" style="white-space: nowrap; position: absolute; z-index: 1; top: 0px; left: 0px; bottom: 0px;"><?php
		while ($query->have_posts()) : $query->the_post();
			if ( has_post_thumbnail() ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ));
				?>
				<a href="<?php echo get_the_permalink()?>"  class="relatedarticle slide">
			    	<figure><img src="<?php echo esc_url($image[0]);?>" width="200" height="200" alt="<?php echo get_the_title()?>"></figure>
			    	<p><?php echo get_the_title();?></p>
				</a>
				<?php
			} else {
				?>
				<a href="<?php echo get_the_permalink()?>"  class="relatedarticle slide">
			    	<img src="<?php echo esc_url($hiilite_options['main_logo']);?>" width="200" height="200" alt="<?php echo get_the_title()?>">
			    	<p><?php echo get_the_title();?></p>
				</a>
				<?php
			}	
		  endwhile;		  ?>
		  </div>
	</amp-carousel>
</aside>
<?php
	
endif;
if($hiilite_options['portfolio_comments']):
	echo '<div class="container_inner">';
		comments_template();
	echo '</div>';
endif;

if($hiilite_options['show_next_prev_posts'] == true):
echo '<div class="container_inner next-prev-posts">';
	
	hii_post_navigation( array(
						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'hiiwp' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'hiiwp' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper"><i class="fa fa-angle-left"></i></span>%title</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'hiiwp' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'hiiwp' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper"><i class="fa fa-angle-right"></i></span></span>',
					) );
	
	
echo '</div>';

endif;

echo '</article>';
