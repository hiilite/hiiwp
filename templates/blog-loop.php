<?php
/**
 * HiiWP Template: blog-loop
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
global $post;
if(!isset($atts)) $hiilite_options = Hii::get_options();
$post_meta = get_post_meta(get_the_id());
$post_format_icon = $article_title = $dateline = $article_cat = $embedded_media = '';

$_post_format = get_post_format();

$blogs_image_style = $hiilite_options['blogs_image_style'];

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


if($hiilite_options['blog_title_show'] == 'true' || $hiilite_options['blog_title_show'] == true) {
	if ( is_sticky() ) {
		$post_format_icon .= '<i class="fa fa-thumb-tack post-format-icon"> </i>';
	}
	if ($_post_format !== NULL) {
		switch ($_post_format ) {
			case 'video':
				$post_format_icon .= '<i class="fa fa-film post-format-icon"> </i>';
				$embedded_media = get_media_embedded_in_content( apply_filters( 'the_content', get_the_content() ), array( 'video', 'object', 'embed', 'iframe' ) );
			break;
			case 'audio':
				$post_format_icon .= '<i class="fa fa-music post-format-icon"> </i>';
				$embedded_media = get_media_embedded_in_content(  apply_filters( 'the_content', get_the_content() ), array( 'audio', 'object', 'embed', 'iframe' ) );
			
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
	$article_title .= '';
	
	$article_title .= '<' . $hiilite_options['blog_heading_tag'] . ' class="entry-title"><a href="' . get_the_permalink() . '">' . $post_format_icon . get_the_title().'</a></' . $hiilite_options['blog_heading_tag'] . '>';
} 

if($hiilite_options['blog_cats_show'] == 'true' || $hiilite_options['blog_cats_show'] === true):
	$dateline = $article_cat.$dateline;
endif;

if($hiilite_options['blog_date_pos'] == 'date-above'):
	$article_title = $dateline.$article_title;
else:
	$article_title = $article_title.$dateline;
endif;


$cols = 'col-12';
if($hiilite_options['blog_layouts'] =='boxed'){
	switch ($hiilite_options['blog_col']) {
		case '1':
			$cols = ' col-12';
		break;
		case '2': 
			$cols = ' col-6'; 
		break;
		case '3': 
			$cols = ' col-4'; 
		break;
		case '4': 
			$cols = ' col-3'; 
		break;		
		case '6':
			$cols = ' col-2';
		break;
	}
}
do_action( 'hii_before_blog_loop' );
?>
<!--BLOG-LOOP-->
<article <?php post_class('flex-item blog-article '.$cols); ?> id="post-<?php the_ID(); ?>" >
	<?php 
	if($hiilite_options['blog_title_position'] == 'title-above') { 
		echo '<header class="entry-header content-box col-12">';
		echo $article_title; // WPCS: XSS ok.
		echo '</header>';
	}
	$thumb_size = ($hiilite_options['blog_img_pos']=='image-left')?'col-6':'col-12';
	switch ($_post_format ) {
		case 'video':
			echo (!empty($embedded_media))?'<figure class="flex-item post-thumbnail ' . $thumb_size . '">'.$embedded_media[0].'</figure>':'';
		break;
		case 'audio':
			echo (!empty($embedded_media))?'<figure class="flex-item post-thumbnail ' . $thumb_size . '">'.$embedded_media[0].'</figure>':'';
		break;
		default:
			if(has_post_thumbnail($post->ID)): 
				echo '<div class="flex-item ' . $thumb_size . '"' . '><figure class="post-thumbnail ' . $blogs_image_style . '">';
				$tn_id = get_post_thumbnail_id( $post->ID );
				$img = wp_get_attachment_image_src( $tn_id, 'large' );
				$width = ($img[1])?$img[1]:$hiilite_options['logo_width'];
				$height = ($img[2])?$img[2]:$hiilite_options['logo_height'];
				$img_src = ($img[0] != '')?$img[0]:$hiilite_options['main_logo'];
				
				
					echo '<a href="' . get_the_permalink() . '">';
					echo '<img src=' . $img_src . ' width="' . $width . '" height="' . $height . '" alt="Read more on ' . get_the_title() . '">';
					echo '</a>';
				
				echo '</figure></div>';
			endif;
		break;
	} 
	
	?>
	<div class="flex-item <?php echo ($hiilite_options['blog_img_pos']=='image-left')?'col-6':'col-12'; ?> content-box">
		<?php 
		if($hiilite_options['blog_title_position'] == 'title-below') { 
			echo '<header class="entry-header">';
			echo $article_title; // WPCS: XSS ok.
			echo '</header>';
		}
		echo '<div class="entry-content">';
		if($hiilite_options['blog_excerpt_show'] == 'true'):
			echo '<p>'.content_excerpt($hiilite_options['blog_excerpt_len']).'</p>';
		endif;
		if($hiilite_options['blog_more_show'] == 'true'):
			$more_button_class = get_theme_mod( 'blog_more_type', 'button' );
			$more_button_class .= ($more_button_class != 'link' && $more_button_class != 'button')?' button readmore':' readmore';
			?>
			<a class="<?php echo sanitize_html_class($more_button_class);?>" href="<?php the_permalink() ?>" title="<?php echo __('Read more on ' . get_the_title(), 'hiiwp'); ?>"><?php echo esc_html__($hiilite_options['blog_more_ex'], 'hiiwp');?></a><?php 
		endif;
		echo '</div>';
		?>
	</div>
</article>
<?php
do_action( 'hii_after_blog_loop' );	