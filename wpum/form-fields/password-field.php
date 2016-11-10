<?php
/**
 * WPUM Template: Password Field Template.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */
?>
<input
	type="password"
	class="input-text <?php echo ! empty( $field['class'] ) ? $field['class'] : ''; ?>"
	name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>"
	id="<?php echo esc_attr( $key ); ?>"
	placeholder="<?php echo ! empty( $field['placeholder'] ) ? esc_attr( $field['placeholder'] ) : ''; ?>"
	value="<?php echo isset( $field['value'] ) ? esc_attr( $field['value'] ) : ''; ?>"
	maxlength="<?php echo ! empty( $field['maxlength'] ) ? $field['maxlength'] : ''; ?>"
	/>

<?php if( wpum_is_psw_cloacking_enabled() && $key == 'password' ) : ?>
<div id="wpum-psw-footer">
	<input type="checkbox" id="wpum-show-password"><label for="wpum-show-password"><?php esc_html_e( 'Show Password', 'wpum' ); ?></label>
</div>
<?php endif; ?>

<?php if ( ! empty( $field['description'] ) ) : ?><small class="description"><?php echo $field['description']; ?></small><?php endif; ?>
