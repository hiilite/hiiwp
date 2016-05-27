<?php
global $hiilite_options;
$hiilite_options['amp'] = true;
get_header();

get_template_part( 'templates/title' );
//echo '<div class="row-o-full-height"></div>';
	/*if($hiilite_options['subdomain'] != 'iframe'){
		echo '<div class="iframe-content container_inner">';
		echo '<amp-iframe width="100vw" height="100vh"
	            sandbox="allow-forms allow-modals allow-popups allow-popups-to-escape-sandbox allow-scripts allow-same-origin"
	            frameborder="0"
	            src="https://iframe.'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"].'">';
	    echo '</amp-iframe>';
	    echo '</div>';
	} elseif ($hiilite_options['subdomain'] == 'iframe') {*/
		echo '<div class="row"><div class="container_inner"><div class="in_grid">';
			woocommerce_content();
		echo '</div></div><div>';
	//}
	


	 
get_footer(); ?>