<?php 
global $hiilite_options;
get_header();
get_template_part( 'templates/title' );
?>
<section class="row">
	<div class="container_inner in_grid">
		<div class="page_not_found align-center">
			<h2> The page you are looking for is not found </h2>
		    <p> The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site’s homepage and see if you can find what you are looking for. </p>
			<div class="separator  transparent center  " style="margin-top:35px;"></div>
			<p><a itemprop="url" class="button button-primary" href="<?php bloginfo( 'url' ); ?>"> Back to homepage </a></p>
		</div>
	</div>
</section>
<?php
get_footer(); ?>