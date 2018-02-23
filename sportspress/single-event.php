<?php
/**
 * The template for displaying all SportsPress pages.
 *
 * @package HiiWP
 */
get_header();
echo '<!--SportPress-->';
get_template_part( 'templates/title' ); ?>

	<section id="primary" class="row"> 
		<div class="in_grid">
		<main id="main" role="main" class="col-9 content-box">

			<?php while ( have_posts() ) : the_post();
				the_content(  )	;
			endwhile; // end of the loop. ?>

		</main><!-- #main -->
		</div>
	</section><!-- #primary -->
<?php get_footer(); ?>
