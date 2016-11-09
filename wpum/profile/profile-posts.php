<?php
/**
 * WPUM Template: "Posts" profile tab.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Query arguments
$args = array( 'author' => $user_data->ID );

// The Query
$posts_query = new WP_Query( apply_filters( 'wpum_profile_posts_query_args', $args ) );
?>

<div class="wpum-user-posts-list">

	<!-- the loop -->
	<?php

		if ( $posts_query->have_posts() ) :

			while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>

				<div class="wpum-post" id="wpum-post-<?php echo the_id();?>">

					<a href="<?php the_permalink();?>" class="wpum-post-title"><?php the_title();?></a>

					<ul class="wpum-post-meta">
						<li>
							<strong><?php _e( 'Posted on:', 'wpum' ); ?></strong>
							<?php echo get_the_date(); ?> -
						</li>
						<li>
							<strong><?php _e( 'Comments:', 'wpum' ); ?></strong>
							<?php comments_popup_link( __( 'No Comments', 'wpum' ), __( '1 Comment', 'wpum' ), __( '% Comments', 'wpum' ) ); ?>
						</li>
					</ul>

				</div>

			<?php endwhile;

		else :

			// Display error message
			$args = array(
				'id'   => 'wpum-posts-not-found',
				'type' => 'notice',
				'text' => sprintf( __( '%s did not submit any posts yet.', 'wpum' ), $user_data->display_name )
			);
			wpum_message( $args );

		endif;

		// Reset the original query - do not remove this.
		wp_reset_postdata();

	?>
	<!-- end loop -->

</div>
