<?php
/*
TODO:
- Turn Related posts into widget and shortcode
- Turn about the author into widget and shortcode	
*/
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
$hiilite_options['amp'] = get_theme_mod('amp');
if($hiilite_options['amp']) $_amp = 'amp-'; else $_amp = '';
if($hiilite_options['subdomain'] != 'iframe'):
?>
<article  <?php post_class('row'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" >
	<div class="in_grid">
		<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php bloginfo('url')?>"/>
		<div class="container_inner">
			<header class="full-width content-box">
				<span itemprop="articleSection" class="labels"><?php the_category(' '); ?></span>
				<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">
				<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
				<meta itemprop="headline" content="<?php the_title(); ?>"><?php
				if(is_single() && get_post_meta(get_the_id(), 'show_page_title', true) != 'on'){
					echo '<h1>'.get_the_title().'</h1>';
				}
				?><small>
				<address class="post_author">
					<a itemprop="author" itemscope itemtype="https://schema.org/Person" class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
						<span itemprop="name"><?php the_author_meta('display_name'); ?></span>
					</a>
				</address> | 
				<time class="time op-published" datetime="<?php the_time('c'); ?>"><span class="date"><?php the_time('F j, Y'); ?></span> <?php the_time('h:i a'); ?></time></small>
			</header>
			<?php
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
					<strong class="label">Source</strong> <a href="<?=get_post_meta( $post->ID, 'source_article_link', true); ?>"><?=get_post_meta ( $post->ID, 'source_article_title', true); ?><span class="label"><?=get_post_meta( $post->ID, 'source_site_title', true); ?></span></a>
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
				
								
				if(is_active_sidebar('post_sidebar')){	
				echo '<aside class="quarter-width content-box  align-top align-center">';
					dynamic_sidebar( 'post_sidebar' );
				echo '</aside>';
				}
			echo '</div>';
			endif;

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
	<amp-carousel height="300" layout="fixed-height" type="carousel" class="relatedposts">
      <?php
	while ($my_query->have_posts()) : $my_query->the_post();
		if ( has_post_thumbnail() ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ));
		}
		?>
		<article class="relatedarticle">
			
			<a href="<?=get_the_permalink()?>">
		    	<amp-img src="<?=$image[0]?>" width="200" height="200" alt="<?=get_the_title()?>"></amp-img>
		    	<p><?=get_the_title();?></p>
			</a>
			
		</article>
  <?php
	  	
	  endwhile;
	  ?>
	</amp-carousel> 
<?php
	endif;

echo '</aside>';
//end related Posts
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
