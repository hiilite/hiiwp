<?php
/**
 * WPUM Template: Recently Registered users list.
 * Displays a list of recently registered users.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Get the query
$users = wpum_get_recent_users( $amount );

?>

<div class="wpum-recent-users">

<?php if ( $users ) : ?>

	<ul class="wpum-users-list">
		<?php foreach ( $users as $user ) : ?>

			<li>
			<?php if ( $link_to_profile == 'yes' ) : ?>
				<a href="<?php echo wpum_get_user_profile_url( $user ); ?>"><?php echo $user->display_name; ?></a>
			<?php else : ?>
				<?php echo $user->display_name; ?>
			<?php endif; ?>

			</li>

		<?php endforeach; ?>
	</ul>

<?php else :

	$args = array(
		'id'   => 'wpum-users-not-found',
		'type' => 'error',
		'text' => __( 'No user has been found.', 'wpum' )
	);
	wpum_message( $args );

endif;

?>

</div>
