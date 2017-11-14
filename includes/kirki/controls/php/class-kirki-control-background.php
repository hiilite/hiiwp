<?php
/**
 * Customizer Control: background.
 *
 * Creates a new custom control.
 * Custom controls contains all background-related options.
 *
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

/**
 * Adds multiple input fiels that combined make up the background control.
 */
class Kirki_Control_Background extends Kirki_Control_Base {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'kirki-background';

	/**
	 * Returns an array of extra field dependencies for Kirki controls.
	 *
	 * @access protected
	 * @since 3.0.10
	 * @return array
	 */
	protected function kirki_script_dependencies() {
		return array( 'wp-color-picker-alpha' );
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {

		wp_enqueue_style( 'wp-color-picker-alpha' );
		wp_enqueue_script( 'wp-color-picker-alpha', kirki_controls()->get_url( 'vendor/wp-color-picker-alpha/wp-color-picker-alpha.js' ), array( 'wp-color-picker' ), '1.2', true );
		wp_enqueue_style( 'wp-color-picker' );

		parent::enqueue();
	}

	/**
	 * Returns an array of translation strings.
	 *
	 * @access protected
	 * @since 3.0.0
	 * @return array
	 */
	protected function l10n() {
		return array(
			'backgroundColor'    => esc_attr__( 'Background Color', 'hiiwp' ),
			'backgroundImage'    => esc_attr__( 'Background Image', 'hiiwp' ),
			'noFileSelected'     => esc_attr__( 'No File Selected', 'hiiwp' ),
			'remove'             => esc_attr__( 'Remove', 'hiiwp' ),
			'selectFile'         => esc_attr__( 'Select File', 'hiiwp' ),
			'backgroundRepeat'   => esc_attr__( 'Background Repeat', 'hiiwp' ),
			'noRepeat'           => esc_attr__( 'No Repeat', 'hiiwp' ),
			'repeatAll'          => esc_attr__( 'Repeat All', 'hiiwp' ),
			'repeatX'            => esc_attr__( 'Repeat Horizontally', 'hiiwp' ),
			'repeatX'            => esc_attr__( 'Repeat Vertically', 'hiiwp' ),
			'backgroundPosition' => esc_attr__( 'Background Position', 'hiiwp' ),
			'leftTop'            => esc_attr__( 'Left Top', 'hiiwp' ),
			'leftCenter'         => esc_attr__( 'Left Center', 'hiiwp' ),
			'leftBottom'         => esc_attr__( 'Left Bottom', 'hiiwp' ),
			'rightTop'           => esc_attr__( 'Right Top', 'hiiwp' ),
			'rightCenter'        => esc_attr__( 'Right Center', 'hiiwp' ),
			'rightBottom'        => esc_attr__( 'Right Bottom', 'hiiwp' ),
			'centerTop'          => esc_attr__( 'Center Top', 'hiiwp' ),
			'centerCenter'       => esc_attr__( 'Center Center', 'hiiwp' ),
			'centerBottom'       => esc_attr__( 'Center Bottom', 'hiiwp' ),
			'backgroundSize'     => esc_attr__( 'BackgroundSize', 'hiiwp' ),
			'cover'              => esc_attr__( 'Cover', 'hiiwp' ),
			'contain'            => esc_attr__( 'Contain', 'hiiwp' ),
			'auto'               => esc_attr__( 'Auto', 'hiiwp' ),
			'backgroundAttach'   => esc_attr__( 'Background Attach', 'hiiwp' ),
			'scroll'             => esc_attr__( 'Scroll', 'hiiwp' ),
			'fixed'              => esc_attr__( 'Fixed', 'hiiwp' ),
		);
	}
}
