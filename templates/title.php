<?php 
global $hiilite_options;
if(	(
		get_post_meta(get_the_id(), 'show_page_title', true) != 'on' && 
		$hiilite_options['show_page_titles'] == true
	) || 
	is_archive() || 
	is_post_type_archive()): 
$post_meta = get_post_meta(get_the_id());

// Page Title
$brand_title = (get_theme_mod('brand_seo_title')!='')?get_theme_mod('brand_seo_title'):get_bloginfo('title');
if(get_post_meta(get_the_id(), 'page_seo_title', true) != ''){
	$page_title = get_post_meta(get_the_id(), 'page_seo_title', true);
} elseif(get_theme_mod('site_seo_title') != '' && is_front_page()) {
	$page_title = get_theme_mod('site_seo_title');
} else {
	$page_title = get_the_title( $post->ID);
}
?>
<div class="page-title <?php echo get_post_meta ( $post->ID, 'page_title_bg', true); ?>" >
	<div class="container_inner">
		<div class="in_grid content-box">
			<h1 class="<?php echo get_post_meta ( $post->ID, 'page_title_color', true); ?>"><?php echo $page_title; ?></h1>
		</div>
	</div>
</div>

<?php endif; ?>