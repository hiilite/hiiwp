<?php
/**
 * WPUM Template: Textarea Field Template.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */
?>
<textarea
	cols="20"
	rows="3"
	class="input-text <?php echo ! empty( $field['class'] ) ? $field['class'] : ''; ?>"
	name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>"
	id="<?php echo esc_attr( $key ); ?>"
	placeholder="<?php echo ! empty( $field['placeholder'] ) ? esc_attr( $field['placeholder'] ) : ''; ?>"
	maxlength="<?php echo ! empty( $field['maxlength'] ) ? $field['maxlength'] : ''; ?>"
	<?php if ( ! empty( $field['required'] ) ) echo 'required'; ?>
	<?php if ( isset( $field['read_only'] ) && $field['read_only'] ) echo 'readonly'; ?>
	><?php echo isset( $field['value'] ) ? esc_textarea( $field['value'] ) : ''; ?></textarea>
<?php if ( ! empty( $field['description'] ) ) : ?><small class="description"><?php echo $field['description']; ?></small><?php endif; ?>
