<?php
/**
 * WPUM Template: Number Field Template.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */
?>
<input
	type="number"
	class="input-number <?php echo ! empty( $field['class'] ) ? $field['class'] : ''; ?>"
	name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>"
	id="<?php echo esc_attr( $key ); ?>"
	placeholder="<?php echo ! empty( $field['placeholder'] ) ? esc_attr( $field['placeholder'] ) : ''; ?>"
	value="<?php echo isset( $field['value'] ) ? esc_attr( $field['value'] ) : ''; ?>"
	maxlength="<?php echo ! empty( $field['maxlength'] ) ? $field['maxlength'] : ''; ?>"
	max="<?php echo ! empty( $field['max'] ) ? $field['max'] : ''; ?>"
	min="<?php echo ! empty( $field['min'] ) ? $field['min'] : ''; ?>"
	step="<?php echo ! empty( $field['step'] ) ? $field['step'] : ''; ?>"
	<?php if ( ! empty( $field['required'] ) ) echo 'required'; ?>
	<?php if ( isset( $field['read_only'] ) && $field['read_only'] ) echo 'readonly'; ?>
	/>
<?php if ( ! empty( $field['description'] ) ) : ?><small class="description"><?php echo $field['description']; ?></small><?php endif; ?>
