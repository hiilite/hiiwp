<?php


/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $content - shortcode content
 */


function add_hii_infinite_carousel_shortcode( $atts ){
	
	$html= '<div class="container">
	  <ul class="slider">
	    <li class="item"><a href="#">x</a></li>
	    <li class="item"><a href="#">x</a></li>
	    <li class="item"><a href="#">x</a></li>
	    <li class="item"><a href="#">x</a></li>
	    <li class="item"><a href="#">x</a></li>
	    <li class="item"><a href="#">x</a></li>
	    <li class="item"><a href="#">x</a></li>
	  </ul>
	  <div class="controls">
	    <button class="prev">Prev</button>
	    <div class="progress-bar"></div>
	    <button class="next">Next</button>
	  </div>
	</div>';


	return $html;


}
add_shortcode( 'hii_infinite_carousel', 'add_hii_infinite_carousel_shortcode' );
?>