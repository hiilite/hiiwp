<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
if(is_single()) {
	get_template_part('templates/post', 'loop');
	
} else {
	get_template_part('templates/page', 'loop');
}


										
?>