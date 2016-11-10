<?php 
/*
Template Name: Featured Listings
*/ 
get_header();
get_template_part( 'templates/title' );
echo '<div class="row"><div class="container_inner"><div class="in_grid">';
	the_content();
echo '</div></div><div>';

$query = new WP_Query();
$args = array(
	'post_type'=>'listing',
);

$query->query($args);
if($query->have_posts()):
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';

	while($query->have_posts()):
		$query->the_post();
		$listing = get_post_meta(get_the_id());
		
		echo get_short_listing_template($listing);
        
		
		
	endwhile;
	echo '</div></div></div>';

endif;
get_footer(); ?>