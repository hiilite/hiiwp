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
if(is_home() || is_archive(  )){
	$page_title = get_wp_title('');
} else {
	$page_title = get_the_title( get_the_id( ));
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