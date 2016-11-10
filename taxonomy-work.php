<?php 
$queried_object = get_queried_object();
$args =  array(
		'post_type' => 'portfolio',
		'tax_query' => array(
			array(
				'taxonomy' => $queried_object->taxonomy,
				'field'    => 'slug',
				'terms'    => $queried_object->slug,
			),
		),
	);
$portfolio = get_portfolio($args);

get_header();
get_template_part( 'templates/title' );

echo $portfolio;

get_footer(); ?>