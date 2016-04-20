<?php 
global $hiilite_options;
if(	(!is_single() &&
	(
		$hiilite_options['subdomain'] != 'iframe' && 
		get_post_meta(get_the_id(), 'show_page_title', true) != 'on' && 
		$hiilite_options['show_page_titles'] == true
	)) || 
	is_archive() || 
	is_post_type_archive()): 
$post_meta = get_post_meta(get_the_id());
?>
<div class="page-title <?php echo get_post_meta ( $post->ID, 'page_title_bg', true); ?>" >
	<div class="container_inner">
		<div class="in_grid content-box">
			<h1 class="<?php echo get_post_meta ( $post->ID, 'page_title_color', true); ?>"><?php wp_title(''); ?></h1>
		</div>
	</div>
</div>

<?php endif; ?>