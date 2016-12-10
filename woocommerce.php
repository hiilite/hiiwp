<?php
global $hiilite_options;
$hiilite_options['amp'] = true;
echo '<!--WOOCOMMERCE-->';
get_header();

get_template_part( 'templates/title' );


		echo '<div class="row woocommerce_container"><div class="container_inner"><div class="in_grid content-box">';
			woocommerce_content();
		echo '</div></div><div>';
	


	 
get_footer(); ?>