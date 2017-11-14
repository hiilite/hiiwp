<?php
/**
 * Customizer Control: dimensions.
 *
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       2.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Dimensions control.
 * multiple fields with CSS units validation.
 */
class Kirki_Control_Dimensions extends Kirki_Control_Base {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'kirki-dimensions';

	/**
	 * Returns an array of translation strings.
	 *
	 * @access protected
	 * @since 3.0.0
	 * @return array
	 */
	protected function l10n() {
		return array(
			'left-top'              => esc_attr__( 'Left Top', 'hiiwp' ),
			'left-center'           => esc_attr__( 'Left Center', 'hiiwp' ),
			'left-bottom'           => esc_attr__( 'Left Bottom', 'hiiwp' ),
			'right-top'             => esc_attr__( 'Right Top', 'hiiwp' ),
			'right-center'          => esc_attr__( 'Right Center', 'hiiwp' ),
			'right-bottom'          => esc_attr__( 'Right Bottom', 'hiiwp' ),
			'center-top'            => esc_attr__( 'Center Top', 'hiiwp' ),
			'center-center'         => esc_attr__( 'Center Center', 'hiiwp' ),
			'center-bottom'         => esc_attr__( 'Center Bottom', 'hiiwp' ),
			'font-size'             => esc_attr__( 'Font Size', 'hiiwp' ),
			'font-weight'           => esc_attr__( 'Font Weight', 'hiiwp' ),
			'line-height'           => esc_attr__( 'Line Height', 'hiiwp' ),
			'font-style'            => esc_attr__( 'Font Style', 'hiiwp' ),
			'letter-spacing'        => esc_attr__( 'Letter Spacing', 'hiiwp' ),
			'word-spacing'          => esc_attr__( 'Word Spacing', 'hiiwp' ),
			'top'                   => esc_attr__( 'Top', 'hiiwp' ),
			'bottom'                => esc_attr__( 'Bottom', 'hiiwp' ),
			'left'                  => esc_attr__( 'Left', 'hiiwp' ),
			'right'                 => esc_attr__( 'Right', 'hiiwp' ),
			'center'                => esc_attr__( 'Center', 'hiiwp' ),
			'size'                  => esc_attr__( 'Size', 'hiiwp' ),
			'height'                => esc_attr__( 'Height', 'hiiwp' ),
			'spacing'               => esc_attr__( 'Spacing', 'hiiwp' ),
			'width'                 => esc_attr__( 'Width', 'hiiwp' ),
			'height'                => esc_attr__( 'Height', 'hiiwp' ),
			'invalid-value'         => esc_attr__( 'Invalid Value', 'hiiwp' ),
		);
	}
}
