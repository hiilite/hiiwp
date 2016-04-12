<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
echo '<div class="row"><div class="container_inner"><div class="in_grid">';
	the_content();
echo '</div></div><div>';

	
?>