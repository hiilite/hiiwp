<?php 
$portfolio = get_portfolio();

get_header();
get_template_part( 'templates/title' );

echo $portfolio;

get_footer(); ?>