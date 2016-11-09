<?php
/**
 * WPUM Template: Uploaded content template.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

$value = is_array( $value ) && array_key_exists( 'url' , $value ) ? $value['url'] : $value;

?>
<div class="wpum-uploaded-file">
	<?php
	$extension = ! empty( $extension ) ? $extension : substr( strrchr( $value, '.' ), 1 );

	if ( 3 !== strlen( $extension ) || in_array( $extension, array( 'jpg', 'gif', 'png', 'jpeg', 'jpe' ) ) ) : ?>
		<span class="wpum-uploaded-file-preview"><img src="<?php echo esc_url( $value ); ?>" /></span>
	<?php else : ?>
		<span class="wpum-uploaded-file-name"><code><?php echo esc_html( basename( $value ) ); ?></code></span>
	<?php endif; ?>

	<input type="hidden" class="input-text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
</div>
