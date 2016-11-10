<?php
/**
 * WPUM Template: Profile.
 * Displays the user profile.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Display error message if no user has been found.
if ( !is_object( $user_data ) ) {
	$args = array(
		'id'   => 'wpum-profile-not-found',
		'type' => 'error',
		'text' => __( 'User not found.', 'wpum' )
	);
	wpum_message( $args );
	return;
}

do_action( "wpum_before_profile", $user_data );

?>

<!-- start profile -->
<div class="wpum-single-profile" id="wpum-profile-<?php echo $user_data->ID;?>">

	<?php do_action( "wpum_before_profile_details", $user_data ); ?>

	<!-- Profile details wrapper -->
	<div class="wpum-user-details">

		<!-- First column -->
		<div class="wpum_three_fourth wpum-main-profile-details">

			<div class="wpum-avatar-img wpum_one_sixth">
				<a href="<?php echo wpum_get_user_profile_url( $user_data ); ?>"><?php echo get_avatar( $user_data->ID , 128 ); ?></a>
				<?php do_action( "wpum_profile_after_avatar", $user_data ); ?>
			</div>

			<div class="wpum-inner-details wpum_five_sixth last">
				<?php do_action( 'wpum_main_profile_details', $user_data ); ?>
			</div>

		</div>
		<!-- end first column -->

		<!-- last column -->
		<div class="wpum_one_fourth last wpum-secondary-profile-details">
			<?php do_action( 'wpum_secondary_profile_details', $user_data ); ?>
		</div>
		<!-- end last column -->

		<div class="wpum-clearfix"></div>

	</div>
	<!-- end profile details wrapper -->

	<?php do_action( "wpum_after_profile_details", $user_data ); ?>

</div>
<!-- end profile -->

<?php do_action( "wpum_after_profile", $user_data ); ?>
