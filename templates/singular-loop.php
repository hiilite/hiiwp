<?php
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
//echo get_post_type($post);
switch (get_post_type($post)) {
	case get_theme_mod( 'portfolio_slug', 'portfolio' ):
		get_template_part('templates/portfolio_piece', 'loop');
		break;
	case 'team':
		get_template_part('templates/team_member', 'loop');
		break;
	case 'menu':
		get_template_part('templates/menu_item', 'loop');
		break;
	case 'post':
		get_template_part('templates/post', 'loop');
		break;
	case 'sr-listings':
		get_template_part('templates/listing', 'loop');
		break;
	case 'listing':
		get_template_part('templates/listing', 'loop');
		break;
	default:
		get_template_part('templates/page', 'loop');
}

										
?>