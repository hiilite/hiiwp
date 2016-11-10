<?php
/**
 * WPUM Template: "Comments" profile tab.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Get comments query.
$args = array(
	'user_id' => $user_data->ID,
	'status'  => 'approve',
	'number'  => '10'
);

$comments = get_comments( $args );

?>

<div class="wpum-profile-comments" id="wpum-comments-by-<?php echo $user_data->ID;?>">

	<?php

		// Check if user has made any comment.
		if( !empty( $comments ) ) :

			foreach ( $comments as $comment ) :

			?>

			<div class="wpum-single-comment" id="wpum-comment-<?php echo $comment->comment_ID;?>">

			<?php
				// Get Comment details
				$comment_content = wp_trim_words( $comment->comment_content, $num_words = 13, $more = null );
				$the_post = get_the_title( $comment->comment_post_ID );
				$the_permalink = get_post_permalink( $comment->comment_post_ID );
				$the_date = get_comment_date( get_option( 'date_format' ), $comment->comment_ID );
			?>

			<p><?php printf( _x( '"%s" on <a href="%s">%s</a>, %s.', 'This text displays the comments left by the user on his profile page.', 'wpum' ), $comment_content, $the_permalink, $the_post, $the_date ); ?></p>

			</div>

		<?php endforeach;

		else :

			// Display error message
			$args = array(
				'id'   => 'wpum-comments-not-found',
				'type' => 'notice',
				'text' => sprintf( __( '%s has not made any comment yet.', 'wpum' ), $user_data->display_name )
			);
			wpum_message( $args );

		endif;

	?>

</div>
