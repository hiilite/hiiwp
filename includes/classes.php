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
		
		if(stripos($post->post_content, 'screen-showcase') !== false) {
			add_filter('custom_css', function() use ($post){ 
				preg_match_all("/screen-showcase\simac_image=[\"']?((?:.(?![\"']))+.)[\"']\smacbook_image=[\"']?((?:.(?![\"']))+.)[\"']\sipad_image=[\"']?((?:.(?![\"']))+.)[\"']\siphone_image=[\"']?((?:.(?![\"']))+.)[\"']/", $post->post_content, $output_array);
				
				$imac = 	wp_get_attachment_image_src($output_array[1][0], 'large');
				$macbook =	wp_get_attachment_image_src($output_array[2][0], 'large');
				$ipad = 	wp_get_attachment_image_src($output_array[3][0], 'large');
				$iphone = 	wp_get_attachment_image_src($output_array[4][0], 'large');
				
				echo '.hii_scrolling_screens {position: relative;margin:auto;height: 500px;display: flex;align-items: baseline;}.hii_scrolling_screens img {max-width: 100%;}.imac_scrolling_screen {position: absolute;width: 60%;left: 15%;right: auto;margin: auto;bottom: 0;}.macbook_scrolling_screen {position: absolute;width: 46%;left: auto;right: 0;bottom: 0;}.ipad_scrolling_screen {position: absolute;width: 19%;left: 3%;right: auto;bottom: 0;}.iphone_scrolling_screen {position: absolute;width: 6%;left: 0%;right: auto;bottom: 0;}.imac_scrolling_screen .screen_area {background: url('.$imac[0].') no-repeat;background-size: 100%;width: 92%;height: 67%;position: absolute;bottom: 28%;left: 4%;animation: imac 10s ease-in-out 1s infinite;}.ipad_scrolling_screen .screen_area {background: url('.$ipad[0].') no-repeat;background-size: 100%;width: 87%;height: 80%;position: absolute;bottom: 12%;left: 7%;animation: imac 10s ease-in-out 1s infinite;}.iphone_scrolling_screen .screen_area {background: url('.$iphone[0].') no-repeat;background-size: 100%;width: 87%;height: 80%;position: absolute;bottom: 12%;left: 7%;animation: imac 10s ease-in-out 1s infinite;}.macbook_scrolling_screen .screen_area {background: url('.$macbook[0].') no-repeat;background-size: 100%;width: 76%;height: 80%;position: absolute;bottom: 14%;left: 12%;animation: imac 10s ease-in-out 1s infinite;}@keyframes imac {0% {background-position-y: 0%;}15% {background-position-y: 0%;}30% {background-position-y: 25%;}50% {background-position-y: 50%;}70% {background-position-y: 75%;}90% {background-position-y: 100%;}100% {background-position-y: 0%;}}';
			}, 1);
		}
	}
 
	return $posts;
}

	
?>