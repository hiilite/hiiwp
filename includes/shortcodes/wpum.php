<?php
function add_wpum_random_profile_card_shortcode( $atts ){

	$args = array(
      'link_to_profile'	=> 'yes',
      'display_buttons' => 'yes',
     
   );
//   print_r($atts);
   extract( shortcode_atts( $args, $atts ) );
   
}

add_shortcode( 'wpum_random_profile_card', 'add_wpum_random_profile_card_shortcode' );
	
	?>