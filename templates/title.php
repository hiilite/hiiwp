<?php 
/**
 * HiiWP Template: title
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
global $post;
$hiilite_options = HiiWP::get_options();
if( (isset($post)
	&& $hiilite_options['show_page_titles'] == true 
	&& ( get_post_meta(get_the_id(), 'show_page_title', true) != 'hide' || is_post_type_archive())
	&& ( ! is_front_page() || is_home() ) ) || (is_404() || is_search()) ): 
	$page_title = $page_title_color = $page_bg_img = $page_bg_color = $post_meta = '';
	$show_title_on = $hiilite_options['show_title_on'];
	if( ( in_array(get_post_type($post), $show_title_on) )):
		$post_meta = get_post_meta(get_the_id());
		
		if(is_front_page()) 
			$page_title = get_bloginfo('name');
		else
			$page_title = hii_get_the_title();
		
		if(isset($post)) {
			$page_title_color = (get_post_meta ( $post->ID, 'page_title_color', true))?get_post_meta ( $post->ID, 'page_title_color', true):false;
			$page_title_bg = (get_post_meta ( $post->ID, 'page_title_bg', true))?get_post_meta ( $post->ID, 'page_title_bg', true):false;
			
			if(! is_archive()):
				$page_bg_img = (get_post_meta ( $post->ID, 'page_title_bgimg', false))?get_post_meta ( $post->ID, 'page_title_bgimg'):false;
			endif;
		}
		
		
		if($page_title != ''){
		?>
		<div class="page-title" style="<?php echo ($page_bg_img)?'background-image:url('.$page_bg_img[0].');':''; echo ($page_title_bg)?'background-color:'.$page_title_bg.';':'';?>">
			<div class="container_inner">
				<div class="in_grid content-box">
					<?php do_action( 'before_page_title' );?>
					<h1 style="<?php echo ($page_title_color)?'color:'.$page_title_color.';':'';?>"><?php echo esc_html__($page_title, 'hiiwp'); ?></h1>
					<?php do_action( 'after_page_title' ); ?>
				</div>
			</div>
		</div>
	<?php 
		}
	endif;
endif; 