<?php
/**
 * WPUM Template: Radio Field Template.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */
?>
<?php foreach ( $field['options'] as $opt_key => $value ) : ?>

<label><input
	type="radio"
	class="input-radio"
	name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>"
	<?php checked( ( ! empty( $field['value'] ) && $opt_key == $field['value'] ), true ); ?>
	value="<?php echo esc_attr( $opt_key ); ?>"
/>
<?php echo esc_html( $value ); ?></label>

<?php endforeach; ?>

<?php if ( ! empty( $field['description'] ) ) : ?><small class="description"><?php echo $field['description']; ?></small><?php endif; ?>
