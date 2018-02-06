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
			<?php 
				if ( is_archive() ) the_archive_description( '<div class="taxonomy-description">', '</div>' ); 
				
				 while ( have_posts() ) : the_post();
				the_content(  )	;
				
				if ( is_archive() && 'sp_event' === get_post_type() ):
					
					sp_get_template( 'event-logos.php' );

				endif;
				
			endwhile; // end of the loop. ?>

		</main><!-- #main -->
		<?php get_sidebar(); ?>
		</div>
	</section><!-- #primary -->
<?php get_footer(); ?>
