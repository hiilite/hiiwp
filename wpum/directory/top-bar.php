<?php
/**
 * WPUM Template: Directory Top Bar.
 * This template is usually used within a user directory.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

$default_sorting = wpum_directory_get_sorting_method( $directory_id );

?>

<div class="wpum-directory-top-bar">

	<div class="wpum_one_third">

		<?php echo sprintf( __( 'Found %s users.', 'wpum' ), $users_found ) ?>

	</div>

	<div class="wpum_one_third wpum-align-center">

		<?php if ( wpum_directory_display_sorter( $directory_id ) ) : ?>
		<p><?php _e( 'Sort by:', 'wpum' ); ?> <?php echo wpum_directory_sort_dropdown( "selected=$default_sorting" ); ?></p>
		<?php endif; ?>

	</div>

	<div class="wpum_one_third last wpum-align-right">
		<?php if ( wpum_directory_display_amount_sorter( $directory_id ) ) : ?>
		<p><?php _e( 'Results per page:', 'wpum' ); ?> <?php echo wpum_directory_results_amount_dropdown(); ?></p>
		<?php endif; ?>
	</div>

	<div class="wpum-clearfix"></div>

</div>
