<?php
/**
 * HiiWP Template: Post-Loop
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2016, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.1.0
 */
/*
TODO:
- Turn Related posts into widget and shortcode
- Turn about the author into widget and shortcode	
*/
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
$hiilite_options['amp'] = get_theme_mod('amp');
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';

?>
<!--POST-LOOP-->
<article <?php post_class('row blog-article'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" >
	<header class="page-title <?php echo get_post_meta ( $post->ID, 'page_title_bg', true); ?>">
		<div class="container_inner">
			<div class="in_grid content-box">
				
				<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">
				<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
				<meta itemprop="headline" content="<?php the_title(); ?>"><?php
				if(is_single() && get_post_meta(get_the_id(), 'show_page_title', true) != 'on'){
					echo '<a class="back_to_blog" href="'.get_permalink( get_option( 'page_for_posts' ) ).'">Back to blog</a><br>';
					echo '<h1 class="col-12">'.get_the_title().'</h1>';
				}
				?>
				<small>
					<address class="post_author">
						<a itemprop="author" itemscope itemtype="https://schema.org/Person" class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<span itemprop="name"><?php the_author_meta('display_name'); ?></span>
						</a>
					</address> 
					<time class="time op-published" datetime="<?php the_time('c'); ?>">
						<span class="date"><?php the_time('F j, Y'); ?></span> <?php the_time('h:i a'); ?>
					</time>
				
				<?php
if($hiilite_options['blog_cats_show']):
	echo '<span itemprop="articleSection" class="labels">'.get_the_category_list(' ').'</span>';
else:
	$categories = get_the_category();$cats ='';
	foreach($categories as $cat){
		$cats .= $cat->name;
	}
	echo '<meta itemprop="articleSection" content="'.$cats.'">';
endif;
?>
				</small>
			</div>
		</div>
	</header>
	
	<div class="<?php if($hiilite_options['single_full'] == false) { echo 'in_grid'; } ?>">
		<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php bloginfo('url')?>"/>
		<div class="container_inner">
			
			<?php
			echo '<div class="threequarter-width content-box  align-top">';

		
if(has_post_thumbnail($post->id) && (get_theme_mod( 'blog_show_featured_image', true ) && get_post_meta( $post->ID, 'hide_page_feature_image', true) != 'on')): 
		
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
	</figure><?php 
endif;
	
the_content();


$source = get_post_meta( $post->ID, 'source_article_link');
if(isset($source) && $source[0] != ''){ ?>
	<br>
	<div class="articleSource labels">
		<p>
			<strong class="label">Source</strong> <a href="<?=get_post_meta( $post->ID, 'source_article_link', true); ?>"><?=get_post_meta ( $post->ID, 'source_article_title', true); ?><span class="label"><?=get_post_meta( $post->ID, 'source_site_title', true); ?></span></a>
		<meta itemprop="sameAs" content="<?=get_post_meta( $post->ID, 'source_article_link', true); ?>">
		</p>
	</div>
<?php 
} 
	
if( has_tag()) { ?>
    <div class="tags_text">
		<span itemprop="keywords" class="labels">
		<?php 
			the_tags('', ' ', '');
		?></span>
	</div>
<?php 
}
	
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
	
					
	if(is_active_sidebar('post_sidebar')){	
		echo '<aside class="quarter-width content-box  align-top">';
			dynamic_sidebar( 'post_sidebar' );
		echo '</aside>'; 
	}
echo '</div>';


if($hiilite_options['blog_rel_articles'] == true):
	/////////////////////////
	//
	//	RELATED POSTS
	//
	/////////////////////////
	echo '<aside class="col-12 text-block">';
	
	//for use in the loop, list 5 post titles related to first tag on current post
	
	$args = wp_parse_args( (array) $args, array(
	        'orderby' => 'modified',
	        'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
	    ) );
	    
	$related_args = array(
	    'post_type'      => get_post_type( $post_id ),
	    'posts_per_page' => 8,
	    'post_status'    => 'publish',
	    'post__not_in'   => array( get_the_ID() ),
	    'orderby'        => $args['orderby'],
	  
	);
	/*$taxonomies = array('category','post_tag');
	foreach( $taxonomies as $taxonomy ) {
	    $terms = get_the_terms( $post_id, $taxonomy );
	    $term_list = wp_list_pluck( $terms, 'slug' );
	    $related_args['tax_query'][] = array(
	        'taxonomy' => $taxonomy,
	        'field'    => 'slug',
	        'terms'    => $term_list
	    );
	}
	if( count( $related_args['tax_query'] ) > 1 ) {
	    $related_args['tax_query']['relation'] = 'OR';
	}*/
	?>
	<div class="align-center">
		<h4>Related Articles</h4>
	</div>
	<?php
	$my_query = new WP_Query($related_args);
	if( $my_query->have_posts() ) :
		?>
		<amp-carousel height="300" layout="fixed-height" type="carousel" class="relatedposts carousel">
			<div class="carousel-wrapper" style="white-space: nowrap; position: absolute; z-index: 1; top: 0px; left: 0px; bottom: 0px;">
		      <?php
			while ($my_query->have_posts()) : $my_query->the_post();
				if ( has_post_thumbnail() ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ));
				}
				?>
			
					
					<a href="<?=get_the_permalink()?>"  class="relatedarticle slide">
				    	<img src="<?=$image[0]?>" width="200" height="200" alt="<?=get_the_title()?>">
				    	<p><?=get_the_title();?></p>
					</a>
					
			
		  <?php
			  	
			  endwhile;
			  ?>
			  </div>
		</amp-carousel> 
	<?php
	endif;
	
	echo '</aside>';


//end related Posts
endif;

if($hiilite_options['blog_comments_show']):
		echo '<div class="container_inner">';
			comments_template();
		echo '</div>';
	endif;
?>
	</div>
</article>
