<?php 
if($hiilite_options['teams_on']):
/*
Template Name: Team Page
*/ 
endif;
get_header();
get_template_part( 'templates/title' );
$query = new WP_Query();
$query->query('post_type=team');
if($query->have_posts()):
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';

	while($query->have_posts()):
		$query->the_post();
		
		get_template_part('templates/team', 'loop');
		
		
	endwhile;
	echo '</div></div></div>';

endif;
get_footer(); ?>