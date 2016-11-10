<?php
/**
 * WPUM Template: General form template used to display fields of groups into the account page.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */
?>
<div id="wpum-form-group" class="wpum-group-form-wrapper">

	<form action="#" method="post" id="wpum-group-form" class="wpum-profile-form" name="wpum-group-form" enctype="multipart/form-data">

		<?php foreach ( $group_fields as $key => $field ) : ?>
			<fieldset class="fieldset-<?php echo esc_attr( $key ); ?>" data-type="<?php echo esc_attr( $field['type'] );?>" data-label="<?php echo esc_attr( $field['label'] );?>" data-required="<?php echo esc_attr( $field['required'] );?>" data-name="<?php echo esc_attr( $key ); ?>">
				<label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ); ?><?php if ( ! empty( $field['required'] ) ) echo '<span class="wpum-required-star">*</span>'; ?></label>
				<div class="field <?php echo $field['required'] ? 'required-field' : ''; ?> field-<?php echo esc_attr( $field['type'] ); ?>">
					<?php do_action( "wpum/form/{$form}/before/field={$key}", $field ); ?>
					<?php echo wpum_get_field_input_html( $key, $field ); ?>
					<?php do_action( "wpum/form/{$form}/after/field={$key}", $field ); ?>
				</div>
			</fieldset>
		<?php endforeach; ?>

		<?php wp_nonce_field( $form ); ?>

		<p>
			<input type="hidden" name="wpum_submit_form" value="<?php echo $form; ?>" />
			<input type="hidden" name="wpum_group_form_id" value="<?php echo $group_id; ?>" />
			<input type="submit" id="submit_wpum_group_form" name="submit_wpum_group_form" class="button" value="<?php esc_html_e( 'Update Profile', 'wpum' ); ?>" />
		</p>

	</form>

</div>
