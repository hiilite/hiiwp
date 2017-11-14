<?php
/**
 * Customizer Control: dashicons.
 *
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       2.2.4
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Dashicons control (modified radio).
 */
class Kirki_Control_Dashicons extends Kirki_Control_Base {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'kirki-dashicons';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @access public
	 */
	public function to_json() {
		parent::to_json();
		$this->json['icons'] = Kirki_Helper::get_dashicons();
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
			'admin-menu'     => esc_attr__( 'Admin Menu', 'hiiwp' ),
			'welcome-screen' => esc_attr__( 'Welcome Screen', 'hiiwp' ),
			'post-formats'   => esc_attr__( 'Post Formats', 'hiiwp' ),
			'media'          => esc_attr__( 'Media', 'hiiwp' ),
			'image-editing'  => esc_attr__( 'Image Editing', 'hiiwp' ),
			'tinymce'        => esc_attr__( 'TinyMCE', 'hiiwp' ),
			'posts'          => esc_attr__( 'Posts', 'hiiwp' ),
			'sorting'        => esc_attr__( 'Sorting', 'hiiwp' ),
			'social'         => esc_attr__( 'Social', 'hiiwp' ),
			'wordpress_org'  => esc_attr__( 'WordPress', 'hiiwp' ),
			'products'       => esc_attr__( 'Products', 'hiiwp' ),
			'taxonomies'     => esc_attr__( 'Taxonomies', 'hiiwp' ),
			'widgets'        => esc_attr__( 'Widgets', 'hiiwp' ),
			'notifications'  => esc_attr__( 'Notifications', 'hiiwp' ),
			'misc'           => esc_attr__( 'Miscelaneous', 'hiiwp' ),
		);
	}
}
