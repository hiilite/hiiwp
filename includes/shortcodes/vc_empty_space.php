<?php
function add_vc_empty_space_shortcode( $atts ){
	extract( shortcode_atts( array(
      'target' => '_self',
      'text'   => 'Learn More',
      'link'	=> '',
   ), $atts ) );
  
	return "<div class='vc_empty_space'></div>";
}
add_shortcode( 'vc_empty_space', 'add_vc_empty_space_shortcode' );
	
	?>