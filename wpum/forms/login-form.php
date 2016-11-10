<?php
/**
 * WPUM Template: Login Form Template.
 *
 * Displays login form.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */
?>

<?php do_action( 'wpum_before_login_form', $args ); ?>

<div id="wpum-form-<?php echo esc_attr( $args['form_id'] );?>" class="wpum-login-form" data-redirect="<?php echo esc_attr( $args['redirect'] );?>">

	<?php do_action( 'wpum_top_login_form', $args ); ?>

	<?php wp_login_form( apply_filters( 'wpum_login_shortcode_args', $args ) ); ?>

	<?php do_action( 'wpum_bottom_login_form', $args ); ?>

</div>

<?php do_action( 'wpum_after_login_form', $args ); ?>