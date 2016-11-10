<?php
/**
 * Template Name: Event Details
 *
 * This is template will display all of your event's details
 *
 * @ package		Event Espresso - Event Registration and Management Plugin for WordPress
 * @ link			http://www.eventespresso.com
 * @ version		EE4+
 */
get_header();
get_template_part( 'templates/title' );
//echo '<br/><h6 style="color:#2EA2CC;">' . __FILE__ . ' &nbsp; <span style="font-weight:normal;color:#E76700"> Line #: ' . __LINE__ . '</span></h6>';
?>
<article  <?php post_class('row'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" >
	<div class="in_grid">
	<div id="primary" class="col-12">
		<div id="content" class="site-content" role="main">

			<div id="espresso-event-details-wrap-dv" class="">
				<div id="espresso-event-details-dv" class="" >
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
					//  Include the post TYPE-specific template for the content.
					espresso_get_template_part( 'content', 'espresso_events' );
				
				endwhile;
			?>
				</div>
			</div>

		</div><!-- #content -->
	</div><!-- #primary -->
	</div>
</article>
<?php
//get_sidebar( 'content' );
//get_sidebar();
get_footer();