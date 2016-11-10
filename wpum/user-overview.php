<?php
/**
 * WPUM Template: Current user overview.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

$user_profile_user = wpum_get_user_profile_url( $current_user );

?>

<div id="wpum-current-user-overview-<?php echo $current_user->ID; ?>" class="wpum-user-overview">

	<div class="wpum_one_fourth user-avatar">
		<a href="<?php echo esc_url( $user_profile_user ); ?>"><?php echo get_avatar( $current_user->ID, 48 ); ?></a>
	</div>

	<div class="wpum_three_fourth user-content last">

		<a href="<?php echo esc_url( $user_profile_user ); ?>"><?php echo $current_user->display_name; ?></a>

		<ul class="wpum-overview-links">
			<li><a href="<?php echo esc_url( wpum_get_core_page_url('account') ); ?>"><?php _e('Edit Account', 'wpum'); ?></a></li>
			<li>|</li>
			<li><a href="<?php echo esc_url( wpum_logout_url() ); ?>"><?php _e('Logout', 'wpum'); ?></a></li>
		</ul>

	</div>

	<div class="wpum-clearfix"></div>

</div>
