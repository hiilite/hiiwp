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
do_action( 'before_portfolio' );
echo $portfolio;
do_action( 'after_portfolio' );
get_footer(); ?>