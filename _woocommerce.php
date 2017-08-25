<?php
get_header();

echo '<!--WOOCOMMERCE-->';
get_template_part( 'templates/title' );


echo '<div class="row woocommerce_container"><div class="container_inner"><div class="in_grid content-box">';
	woocommerce_content();
echo '</div></div><div>';
	


	 
get_footer(); ?>