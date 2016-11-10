<?php
/**
 * WPUM Template: User Links.
 * Displays helper links below the forms.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */
?>
<div class="wpum-helper-links">

	<?php if ( $login == 'yes' ) : ?>
	<p class="wpum-login-url">
		<?php echo apply_filters( 'wpum_login_link_label', sprintf( __( 'Already have an account? <a href="%s">Sign In &raquo;</a>', 'wpum' ), esc_url( get_permalink( wpum_get_option( 'login_page' ) ) ) ) ); ?>
	</p>
	<?php endif; ?>

	<?php if ( $register == 'yes' ) : ?>
	<p class="wpum-register-url">
		<?php echo apply_filters( 'wpum_registration_link_label', sprintf( __( 'Don\'t have an account? <a href="%s">Signup Now &raquo;</a>', 'wpum' ), esc_url( get_permalink( wpum_get_option( 'registration_page' ) ) ) ) ); ?>
	</p>
	<?php endif; ?>

	<?php if ( $password == 'yes' ) : ?>
	<p class="wpum-password-recovery-url">
		<a href="<?php echo esc_url( get_permalink( wpum_get_option( 'password_recovery_page' ) ) );?>">
			<?php echo apply_filters( 'wpum_password_link_label', __( 'Lost your password?', 'wpum' ) ); ?>
		</a>
	</p>
	<?php endif; ?>

</div>
