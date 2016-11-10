<?php
/**
 * WPUM Template: User Directory.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

?>

<!-- start directory -->
<div id="wpum-user-directory-<?php echo $directory_args['directory_id']; ?>" class="wpum-user-directory directory-<?php echo $directory_args['directory_id']; ?>">

	<!-- Start Users list -->
	<?php

		do_action( 'wpum_before_user_directory', $directory_args );

		if ( ! empty( $directory_args['user_data'] ) ) {

			echo '<ul class="wpum-user-listings">';

			foreach ( $directory_args['user_data'] as $user ) {

				// Load single-user.php template to display each user individually
				get_wpum_template( "directory/single-user.php", array( 'user' => $user ) );

			}

			echo "</ul>";

		} else {

			$args = array(
				'id'   => 'wpum-no-user-found',
				'type' => 'notice',
				'text' => __( 'No users have been found', 'wpum' )
			);
			$warning = wpum_message( $args, true );

		}

		do_action( 'wpum_after_user_directory', $directory_args );

	?>

	<!-- end users list -->

</div>
<!-- end directory -->
