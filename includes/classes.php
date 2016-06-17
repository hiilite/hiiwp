<?php


/**
* Hii Shortcodes
*/


add_filter('the_posts', 'conditionally_add_scripts_and_styles'); // the_posts gets triggered before wp_head
function conditionally_add_scripts_and_styles($posts){
	if (empty($posts)) return $posts;
 
	$shortcode_found = false; // use this flag to see if styles and scripts need to be enqueued
	foreach ($posts as $post) {
		if (stripos($post->post_content, 'hiicss') !== false) {
			// enqueue here
			add_filter('custom_css', function() use ($post){ 
				preg_match_all("/(hiicss)=[\"']?((?:.(?![\"']?\s+(?:\S+)=|[>\"']))+.)[\"']?/", $post->post_content, $output_array);
				
				
				foreach($output_array[2] as $set){
					print_r( $set );
					
				}
			}, 1);
			
		}
	}
 
	return $posts;
}

	
?>