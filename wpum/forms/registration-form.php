<?php
/**
 * WPUM Template: Default Registration Form Template.
 *
 * Displays login form.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */
?>
<div id="wpum-form-register-<?php echo esc_attr( $atts['form_id'] );?>" class="wpum-registration-form-wrapper">

	<?php do_action( 'wpum_before_register_form_template', $atts ); ?>

	<form action="#" method="post" id="wpum-register-<?php echo esc_attr( $atts['form_id'] );?>" class="wpum-registration-form" name="wpum-register-<?php echo esc_attr( $atts['form_id'] );?>" enctype="multipart/form-data">

		<?php do_action( 'wpum_before_inside_register_form_template', $atts ); ?>

		<?php foreach ( $register_fields as $key => $field ) : ?>
			<fieldset class="fieldset-<?php esc_attr_e( $key, 'wpum' ); ?>" data-type="<?php echo esc_attr( $field['type'] );?>" data-label="<?php echo esc_attr( $field['label'] );?>" data-required="<?php echo esc_attr( $field['required'] );?>" data-name="<?php esc_attr_e( $key, 'wpum' ); ?>">
				<label for="<?php esc_attr_e( $key, 'wpum' ); ?>"><?php echo $field['label']; ?><?php if ( ! empty( $field['required'] ) ) echo '<span class="wpum-required-star">*</span>'; ?></label>
				<div class="field <?php echo $field['required'] ? 'required-field' : ''; ?> field-<?php echo esc_attr( $field['type'] ); ?>">
					<?php do_action( "wpum/form/{$form}/before/field={$key}", $field ); ?>
					<?php echo wpum_get_field_input_html( $key, $field ); ?>
					<?php do_action( "wpum/form/{$form}/after/field={$key}", $field ); ?>
				</div>
			</fieldset>
		<?php endforeach; ?>

		<?php do_action( 'wpum_after_inside_register_form_template', $atts ); ?>

		<?php wp_nonce_field( $form ); ?>

		<p>
			<input type="hidden" name="wpum_submit_form" value="<?php echo $form; ?>" />
			<input type="submit" id="submit_wpum_register" name="submit_wpum_register" class="button" value="<?php _e( 'Register', 'wpum' ); ?>" />
		</p>

	</form>

	<?php do_action( 'wpum_after_register_form_template', $atts ); ?>

</div>
