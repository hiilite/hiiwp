<?php
function add_button_shortcode( $atts ){
	extract( shortcode_atts( array(
      'target' => '_self',
      'text'   => 'Learn More',
      'link'	=> '',
   ), $atts ) );
  
	return "<a class='button' href='{$link}' target={$target}>{$text}</a>";
}
add_shortcode( 'button', 'add_button_shortcode' );
	
	?>