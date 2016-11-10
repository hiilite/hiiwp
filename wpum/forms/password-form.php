<?php
/**
 * WPUM Template: Password Form Template.
 *
 * Displays password recovery form.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Define the form status
$form_status = 'recover';
$key         = null;
$login       = null;
$reset_key   = '';

if ( isset( $_GET['password-reset'] ) )
	$form_status = 'reset';

// Retrieve reset key and login
if ( isset( $_GET['password-reset'] ) ) {
	$reset_key = $_GET['key'];
	$login     = $_GET['login'];
}

?>
<div id="wpum-form-password-<?php echo $atts['form_id'];?>" class="wpum-password-form-wrapper-<?php echo $form_status; ?>">

	<?php do_action( 'wpum_before_password_form_template', $atts ); ?>

	<!-- Display only when psw reset -->
	<?php if ( isset( $_GET['reset'] ) && $_GET['reset'] == true ) : ?>
		<p class="wpum-message wpum-success wpum-lost-psw-message">
			<?php echo apply_filters( 'wpum_reset_successful_password_message', __( 'Your password has been reset.', 'wpum' ) ); ?>
		</p>
	<?php endif; ?>
	<!-- Display only when psw reset -->

	<?php if ( !isset( $_GET['reset'] ) ) : ?>
	<form action="#" method="post" id="wpum-password-<?php echo esc_attr( $atts['form_id'] );?>" class="wpum-password-form" name="wpum-password-<?php echo esc_attr( $atts['form_id'] );?>">

		<?php do_action( 'wpum_before_inside_password_form_template', $atts ); ?>

		<?php if ( isset( $_GET['password-reset'] ) && $_GET['password-reset'] == true ) : ?>

			<p class="wpum-message wpum-info wpum-lost-psw-message">
				<?php echo apply_filters( 'wpum_reset_password_message', __( 'Enter a new password below.', 'wpum' ) ); ?>
			</p>

			<!-- Start Password Replace Fields -->
			<?php foreach ( $password_fields as $key => $field ) : ?>
				<fieldset class="fieldset-<?php esc_attr_e( $key, 'wpum' ); ?>">
					<label for="<?php esc_attr_e( $key, 'wpum' ); ?>"><?php echo esc_html( $field['label'] ); ?> <?php if ( ! empty( $field['required'] ) ) echo '<span class="wpum-required-star">*</span>'; ?></label>
					<div class="field <?php echo $field['required'] ? 'required-field' : ''; ?> field-<?php echo esc_attr( $field['type'] ); ?>">
						<?php echo wpum_get_field_input_html( $key, $field ); ?>
					</div>
				</fieldset>
			<?php endforeach; ?>
			<!-- End Password Replace Fields -->

		<?php else : ?>

			<p class="wpum-message wpum-info wpum-lost-psw-message">
				<?php echo apply_filters( 'wpum_lost_password_message', __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'wpum' ) ); ?>
			</p>

			<!-- Start Password User Fields -->
			<?php foreach ( $user_fields as $key => $field ) : ?>
				<fieldset class="fieldset-<?php esc_attr_e( $key, 'wpum' ); ?>">
					<label for="<?php esc_attr_e( $key, 'wpum' ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
					<div class="field <?php echo $field['required'] ? 'required-field' : ''; ?>">
						<?php get_wpum_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) ); ?>
					</div>
				</fieldset>
			<?php endforeach; ?>
			<!-- End Password User Fields -->

		<?php endif; ?>

		<?php do_action( 'wpum_after_inside_password_form_template', $atts ); ?>

		<?php wp_nonce_field( $form ); ?>

		<p class="wpum-submit">
			<input type="hidden" name="wpum_submit_form" value="<?php echo $form; ?>" />
			<input type="hidden" name="wpum_password_form_status" id="wpum_password_form_status" value="<?php echo $form_status; ?>" />
			<input type="hidden" name="wpum_psw_reset_key" value="<?php echo esc_attr( $reset_key ); ?>" />
			<input type="hidden" name="wpum_psw_reset_login" value="<?php echo esc_attr( $login ); ?>" />
			<input type="submit" id="submit_wpum_password" name="submit_wpum_password" class="button" value="<?php _e( 'Reset Password', 'wpum' ); ?>" />
		</p>

	</form>
	<?php endif; ?>

	<?php do_action( 'wpum_after_password_form_template', $atts ); ?>

</div>
