<?php
/**
 * HiiWP Template: default-loop
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
global $post;
if(!isset($atts)) $hiilite_options = Hii::$hiiwp->get_options();
$post_meta = get_post_meta(get_the_id());
echo '<!--DEFAULT-LOOP-->';
// Create Title
$article_title = $dateline = $article_cat = '';

if($hiilite_options['blog_cats_show'] == 'true' || $hiilite_options['blog_cats_show'] == true):
	$article_cat .= '<span itemprop="articleSection" class="labels">'.get_the_category_list(', ').' </span> <br>';
else:
	$categories = get_the_category();$cats ='';
	foreach($categories as $cat){
		$cats .= $cat->name.' ';
	}
	$article_cat .= '<meta itemprop="articleSection" content="'.$cats.'"> ';
endif;

$article_title .= '<span itemprop="author" itemscope itemtype="https://schema.org/Person">';
if($hiilite_options['blog_meta_show'] == 'true'):
	$dateline .= '<small><address class="post_author">';
	$dateline .= '<a itemprop="author" itemscope itemtype="https://schema.org/Person" class="post_author_link" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'"><span itemprop="name">';
	$dateline .= get_the_author_meta('display_name'); 
	$dateline .= '</span></a> </address> <time class="time op-published" datetime="';
	$dateline .= get_the_time('c');
	$dateline .= '">';
	$dateline .= '<span class="date">';
	$dateline .= get_the_time('d F, Y');
	$dateline .= ' </span>';
	//$article_title .= get_the_time('h:i a')
	$dateline .= '</time></small>';
else:
	$dateline .= '<meta itemprop="name" content="'.get_the_author_meta('display_name').'">';
endif;
$article_title .= '</span>';



if($hiilite_options['blog_title_show'] == 'true' || $hiilite_options['blog_title_show'] == true) {
	$article_title .= '<'.$hiilite_options['blog_heading_tag'].'><a href="'.get_the_permalink().'">'.get_the_title().'</a></'.$hiilite_options['blog_heading_tag'].'>';
} 

if($hiilite_options['blog_cats_show'] == 'true' || $hiilite_options['blog_cats_show'] == true):
	$dateline = $article_cat.$dateline;
endif;

if($hiilite_options['blog_date_pos'] == 'date-above'):
	$article_title = $dateline.$article_title;
else:
	$article_title = $article_title.$dateline;
endif;


$cols = '';
if($hiilite_options['blog_layouts'] =='boxed'){
	switch ($hiilite_options['blog_col']) {
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
do_action( 'hii_before_blog_loop' );

if(is_customize_preview()) echo '<div class="customizer_quick_links"><button class="customizer-edit" data-control=\'{"name":"blog_layouts"}\'>Blog List</button></div>';?>
<!--BLOG-LOOP-->
<article <?php post_class('row blog-article'.$cols); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" >
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php echo esc_url( home_url() )?>"/>
	<?php 
	if($hiilite_options['blog_title_position'] == 'title-above') { 
		echo '<div class="content-box col-12">';
		
		echo balenceTags($article_title);
		
		echo '</div>';
	}
	echo '<figure class="flex-item ';
	echo ($hiilite_options['blog_img_pos']=='image-left')?'col-6':'col-12';
	echo '">';
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
		<a href="<?php echo get_the_permalink()?>"><img src='<?php echo esc_url($img_src);?>' layout='responsive' width='<?php echo intval($width);?>' height='<?php echo intval($height);?>'></a>
		<?php
	echo '</figure>'; ?>
	<div class="flex-item <?php echo ($hiilite_options['blog_img_pos']=='image-left')?'col-6':'col-12'; ?> content-box" >
		<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>">
		<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>">
		<meta itemprop="headline" content="<?php the_title(); ?>">
		<?php 
		if($hiilite_options['blog_title_position'] == 'title-below') { 
			
			echo balenceTags($article_title);
		
		}
		if($hiilite_options['blog_excerpt_show'] == 'true'):
			echo '<p>'.content_excerpt($hiilite_options['blog_excerpt_len']).'</p>';
		endif;
		if($hiilite_options['blog_more_show'] == 'true'):
			$more_button_class = get_theme_mod( 'blog_more_type', 'button' );
			$more_button_class .= ($more_button_class != 'link' && $more_button_class != 'button')?' button readmore':' readmore';
			?>
			<a class="<?php echo sanitize_html_class($more_button_class);?>" href="<?php the_permalink() ?>"><?php echo esc_html__($hiilite_options['blog_more_ex'], 'hiiwp');?></a><?php 
				
		endif;?>
	<div>
</article>
<?php
do_action( 'hii_after_blog_loop' );	
?>