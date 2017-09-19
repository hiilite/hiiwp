<!--TITLE-->
<?php 
global $post;
$hiilite_options = HiiWP::get_options();
if( isset($post) && ( get_post_meta(get_the_id(), 'show_page_title', true) != 'hide' || is_post_type_archive()) ): 

	$show_title_on = $hiilite_options['show_title_on'];
	if( ( in_array(get_post_type($post), $show_title_on) )):
		$post_meta = get_post_meta(get_the_id());
		
		// Page Title
		if( is_archive(  )){ 
			$page_title = get_the_archive_title();
		} elseif(is_home()) {
			$page_title = get_the_title( get_option('page_for_posts', true) );
		} else {
			$page_title = get_the_title( get_the_id( ));
		} 
		
		$page_title_color = (get_post_meta ( $post->ID, 'page_title_color', true))?get_post_meta ( $post->ID, 'page_title_color', true):false;
		$page_bg_color = (get_post_meta ( $post->ID, 'page_title_bg', true))?get_post_meta ( $post->ID, 'page_title_bg', true):false;
		
		if(! is_archive()):
			$page_bg_img = (get_post_meta ( $post->ID, 'page_title_bgimg', false))?get_post_meta ( $post->ID, 'page_title_bgimg'):false;
		endif;
		
		if($page_title != ''){
		?>
		<div class="page-title" style="<?=($page_bg_img)?'background-image:url('.$page_bg_img[0].');':'';?><?=($page_bg_img)?'background-color:'.$page_bg_img[0].';':'';?>">
	<?php if(is_customize_preview()) echo '<div class="customizer_quick_links"><button class="customizer-edit" data-control=\'{"name":"show_page_titles"}\'>Page Titles</button><button class="customizer-edit font-edit" data-control=\'{"name":"title_font"}\'>Page Titles</button></div>';?>
			<div class="container_inner">
				<div class="in_grid content-box">
					<h1 style="<?=($page_title_color)?'color:'.$page_title_color.';':'';?>"><?php echo $page_title; ?></h1>
				</div>
			</div>
		</div>
	
	<?php 
		}
	endif;
endif; ?>