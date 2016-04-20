<?php 
if($hiilite_options['portfolio_on']):
/*
Template Name: Portfolio Page
*/ 
endif;
get_header();
get_template_part( 'templates/title' );
$query = new WP_Query();
$query->query('post_type=portfolio&posts_per_page=-1&nopaging=true');
if($query->have_posts()):
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';

	while($query->have_posts()):
		$query->the_post();
		
		get_template_part('templates/portfolio', 'loop');
		
		
	endwhile;
	echo '</div></div></div>';

endif;
get_footer(); ?>