<?php 
/*
Template Name: Team Page
*/ 
$hiilite_options = HiiWP::get_options();
get_header();
get_template_part( 'templates/title' );
echo '<!--TEAM_PAGE-->';
if(have_posts()):
	while(have_posts()):
		the_post();
		the_content();
	endwhile;
endif; 
$args = array(
	'posts_per_page' => -1,
	'post_type' => $hiilite_options['teams_slug']
);
$team_query = new WP_Query($args);
if($team_query->have_posts()):
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';

	while($team_query->have_posts()):
		$team_query->the_post();
		
		get_template_part('templates/team', 'loop');
		
		
	endwhile;
	echo '</div></div></div>';

endif;

get_footer(); ?>