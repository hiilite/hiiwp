<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
if(get_post_type($post) == 'portfolio'){
	get_template_part('templates/portfolio_piece', 'loop');
} elseif(get_post_type($post) == 'team'){
	get_template_part('templates/team_member', 'loop');
} elseif(is_single()) {
	get_template_part('templates/post', 'loop');
} else {
	get_template_part('templates/page', 'loop');
}


										
?>