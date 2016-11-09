<?php
/**
 * WPUM Template: Multicheckbox Field Template.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */
?>

<?php foreach ( $field['options'] as $opt_key => $value ) : ?>

	<label><input
		type="checkbox"
		class="input-checkbox"
		name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>[]"
		<?php if ( ! empty( $field['value'] ) && is_array( $field['value'] ) ) checked( in_array( $opt_key, $field['value'] ), true ); ?>
		value="<?php echo esc_attr( $opt_key ); ?>"
	/>
	<?php echo esc_html( $value ); ?></label>

<?php endforeach; ?>

<?php if ( ! empty( $field['description'] ) ) : ?><small class="description"><?php echo $field['description']; ?></small><?php endif; ?>
