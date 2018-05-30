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
$hiilite_options = Hii::get_options();

$post_meta = get_post_meta(get_the_id());
$post_format_icon = $article_title = $dateline = $article_cat = '';

if($hiilite_options['blog_cats_show'] == 'true' || $hiilite_options['blog_cats_show'] == true):
	$article_cat .= '<span class="cat-links"><span class="screen-reader-text">Tags</span>'.get_the_category_list(', ').'</span>';
else:
	$categories = get_the_category();$cats ='';
	foreach($categories as $cat){
		$cats .= $cat->name.' ';
	}
endif;

if($hiilite_options['blog_meta_show'] == 'true'):
	$dateline .= '<div class="entry-meta">';
		$dateline .= '<span class="posted-on"><span class="screen-reader-text">Posted on</span>';
			$dateline .= '<a href="'.get_the_permalink().'" rel="bookmark">';
				$dateline .= '<time class="time op-published" datetime="' . get_the_time('c') . '">';
					$dateline .= get_the_time('d F, Y');
				$dateline .= '</time></a>';
		$dateline .= '<span class="byline"> by <span class="author vcard">';
			$dateline .= '<a class="post_author_link" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">';
				$dateline .= get_the_author_meta('display_name'); 
			$dateline .= '</a>';
		$dateline .= '</span></span>';
		$dateline .= HiiWP_Templates::edit_link();
	$dateline .= '</div>';
endif;

if(in_array('post', $hiilite_options['show_title_on'])) {
	if ( is_sticky() ) {
		$post_format_icon .= '<i class="fa fa-thumb-tack post-format-icon"> </i>';
	}
	if (get_post_format() !== NULL) {
		switch (get_post_format() ) {
			case 'video':
				$post_format_icon .= '<i class="fa fa-film post-format-icon"> </i>';
			break;
			case 'audio':
				$post_format_icon .= '<i class="fa fa-music post-format-icon"> </i>';
			break;
			case 'link':
				$post_format_icon .= '<i class="fa fa-link post-format-icon"> </i>';
			break;
			case 'image':
			case 'gallery':
				$post_format_icon .= '<i class="fa fa-picture-o post-format-icon"> </i>';
			break;
			case 'chat':
				$post_format_icon .= '<i class="fa fa-wechat post-format-icon"> </i>';
			break;
			case 'quote':
				$post_format_icon .= '<i class="fa fa-quote-left post-format-icon"> </i>';
			break;
			case 'aside':
				$post_format_icon .= '<i class="fa fa-sticky-note post-format-icon"> </i>';
			break;
		} 
	}
	
	$article_title .= '<h1 class="entry-title">' . $post_format_icon . get_the_title() . '</h1>';
} 


$article_title = $article_title.$dateline;


?>
<!--POST-LOOP-->
<article <?php post_class('row blog-article'); ?> id="post-<?php the_ID(); ?>" >
	<header class="page-title entry-header <?php echo get_post_meta ( $post->ID, 'page_title_bg', true); ?>">
		<div class="container_inner">
			<div class="in_grid content-box">
			<?php
				if(is_single() && get_post_meta(get_the_id(), 'show_page_title', true) != 'on') {
					
					$blog_link = ( get_option( 'page_for_posts' ) != false ) ? get_permalink( get_option( 'page_for_posts' ) ) : get_bloginfo( 'url' );
					echo '<a class="back_to_blog" href="' . $blog_link . '"><i class="fa fa-angle-left"></i>Back to blog</a><br>';
					echo $article_title;
				}
				?>
			</div>
		</div>
	</header>
	
	<div class="<?php if($hiilite_options['single_full'] == false) { echo 'in_grid'; } ?>">
		<div class="container_inner">
		<?php
		echo '<div class="col-9 content-box align-top">';

		
			if(has_post_thumbnail($post->id) && ($hiilite_options[ 'blog_show_featured_image' ] && get_post_meta( $post->ID, 'hide_page_feature_image', true) != 'hide')): 
					
				$tn_id = get_post_thumbnail_id( $post->ID );
			
				$img = wp_get_attachment_image_src( $tn_id, 'large' );
				$width = $img[1];
				$height = $img[2];
			?>
				<figure class="flex-item full-width post-thumbnail">
					<img src='<?php echo $img[0];?>'  width='<?php echo $width?>' height='<?php echo $height?>' alt="<?php echo get_the_title()?>">
				</figure><?php 
			endif;
			
			echo '<div class="entry-content">';
				the_content();
				echo '<div class="post-navigation">';
					wp_link_pages(array(
						'next_or_number'	=>'next', 
						'previouspagelink' 	=> '<span class="screen-reader-text">' . __( 'Previous Page', 'hiiwp' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Go back to', 'hiiwp' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper"><i class="fa fa-angle-left"></i></span>' . __( 'Previous Page', 'hiiwp' ) . '</span>', 
						'nextpagelink' 		=> '<span class="screen-reader-text">' . __( 'Next Page', 'hiiwp' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Continue Reading on', 'hiiwp' ) . '</span> <span class="nav-title">' . __( 'Next Page', 'hiiwp' ) . '<span class="nav-title-icon-wrapper"><i class="fa fa-angle-right"></i></span></span>', 
						'before'			=> ''));
				echo '</div>';
			echo '</div>';
			
			//////////////////
			/* translators: used between list items, there is a space after the comma */
			$separate_meta = __( ', ', 'hiiwp' );
		
			// Get Categories for posts.
			$categories_list = get_the_category_list( $separate_meta );
		
			// Get Tags for posts.
			$tags_list = get_the_tag_list( '', $separate_meta );
		
			// We don't want to output .entry-footer if it will be empty, so make sure its not.
			if ( ( $categories_list || $tags_list ) || get_edit_post_link() ) {
		
				echo '<footer class="entry-footer">';
		
					if ( 'post' === get_post_type() ) {
						if ( $categories_list || $tags_list ) {
							echo '<span class="cat-tags-links">';
		
								// Make sure there's more than one category before displaying.
								if ( $categories_list ) {
									echo '<span class="cat-links"><i class="fa fa-folder-open"></i><span class="screen-reader-text">' . __( 'Categories', 'twentyseventeen' ) . '</span>' . $categories_list . '</span>';
								}
		
								if ( $tags_list && ! is_wp_error( $tags_list ) ) {
									echo '<span class="tags-links"><i class="fa fa-hashtag"></i><span class="screen-reader-text">' . __( 'Tags', 'twentyseventeen' ) . '</span>' . $tags_list . '</span>';
								}
		
							echo '</span>';
						}
					}
		
					echo HiiWP_Templates::edit_link();
		
				echo '</footer> <!-- .entry-footer -->';
			}
			//////////////////
		echo '</div>';
		
	if(is_active_sidebar('post_sidebar') && $hiilite_options['blog_show_sidebar']){	
		echo '<aside id="post_sidebar" class="col-3 content-box">';
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
	$args = null;
	$args = wp_parse_args( (array) $args, array(
	        'orderby' => 'modified',
	        'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
	    ) );
	    
	$related_args = array(
	    'post_type'      => get_post_type( $post->ID ),
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
			<div class="carousel-wrapper">
		      <?php
			while ($my_query->have_posts()) : $my_query->the_post();
				if ( has_post_thumbnail() ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ));
					?>
					<a href="<?php echo get_the_permalink()?>"  class="relatedarticle slide" id="post-<?php echo get_the_id() ?>">
				    	<img src="<?php echo $image[0]?>" width="200" height="200" alt="<?php echo get_the_title()?>">
				    	<p><?php echo get_the_title();?></p>
					</a>
					<?php
				} else {
					?>
					<a href="<?php echo get_the_permalink()?>"  class="relatedarticle slide">
				    	<img src="<?php echo $hiilite_options['main_logo']?>" width="200" height="200" alt="<?php echo get_the_title()?>">
				    	<p><?php echo get_the_title();?></p>
					</a>
					<?php
				}
				
			  	
			  endwhile;
			  wp_reset_postdata(  );
			  ?>
			  </div>
		</amp-carousel> 
	<?php
	endif;
	
	echo '</aside>';


//end related Posts
endif;

if($hiilite_options['blog_comments_show'] == true):
	echo '<div class="container_inner">';
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	echo '</div>';
endif;
echo '<div class="container_inner">';
	the_post_navigation( array(
						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'hiiwp' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'hiiwp' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper"><i class="fa fa-angle-left"></i></span>%title</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'hiiwp' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'hiiwp' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper"><i class="fa fa-angle-right"></i></span></span>',
					) );
echo '</div>';
?>
	</div>
</article>
