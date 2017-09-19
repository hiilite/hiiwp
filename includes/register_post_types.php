<?php 
if($hiilite_options['testimonials_on'] == true) require_once HIILITE_DIR.'/includes/post_types/testimonial_post_type.php';
if($hiilite_options['portfolio_on']) 	require_once HIILITE_DIR.'/includes/post_types/portfolio_post_type.php';
if($hiilite_options['menus_on']) 		require_once HIILITE_DIR.'/includes/post_types/menu_post_type.php';
if($hiilite_options['teams_on'])		require_once HIILITE_DIR.'/includes/post_types/team_post_type.php';
?>