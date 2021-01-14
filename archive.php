<?php 
/* HiiWP Template: archive
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2021, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.8
 */
$hiilite_options = Hii::$hiiwp->get_options();
get_header();

get_template_part( 'templates/title' );

$post_type = get_post_type(get_the_ID());
switch($post_type):
	case $hiilite_options['portfolio_slug']:
		get_template_part('templates/portfolio', 'archive');
		break;
	case $hiilite_options['teams_slug']:
		get_template_part('templates/team', 'archive');
		break;
	case $hiilite_options['testimonials_slug']:
		get_template_part('templates/testimonial', 'archive');
		break;
	case $hiilite_options['menu_slug']:
		get_template_part('templates/menu', 'archive');
		break;
	default:
		get_template_part('templates/default', 'archive');
		break;
		
endswitch;

get_footer();