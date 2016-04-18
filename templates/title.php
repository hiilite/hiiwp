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
?>
<div class="page-title">
	<div class="container_inner">
		<div class="in_grid">
			<h1><?php wp_title(''); ?></h1>
		</div>
	</div>
</div>

<?php endif; ?>