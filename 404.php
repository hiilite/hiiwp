<?php 
global $hiilite_options;
get_header();
get_template_part( 'templates/title' );
?>
<section class="row">
	<div class="container_inner in_grid">
		<div class="page_not_found align-center">
			
			<p class="not-found-text">The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site’s homepage and see if you can find what you are looking for.</p>
			
			<div class="error-page">
				<div>
					<h1 data-h1="404">404</h1>
					<p data-p="NOT FOUND">NOT FOUND</p>
				</div>
			</div>
			<div id="particles-js"></div>
			<div class="separator  transparent center  " style="margin-top:35px;"></div>
			<p><a itemprop="url" class="notfound-home-btn button button-primary" href="<?php echo esc_url( home_url() ); ?>">Back to homepage</a></p>
			
		</div>
	</div>
</section>

<?php
get_footer(); 
?>