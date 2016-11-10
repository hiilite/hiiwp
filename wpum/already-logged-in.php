<?php
/**
 * WPUM Template: Already Logged In.
 *
 * Displays a message telling the user he is already logged in.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

$current_user = wp_get_current_user();

?>

<?php do_action( 'wpum_before_logged_in_template', $current_user, $args ); ?>

<div id="wpum-form-<?php echo $args['form_id'];?>" class="wpum-login-form loggedin">

	<p><?php printf( __( 'You are currently logged in as %s. <a href="%s">Logout &raquo;</a>', 'wpum' ), $current_user->display_name, wpum_logout_url() );?></p>

</div>

<?php do_action( 'wpum_after_logged_in_template', $current_user, $args ); ?>
