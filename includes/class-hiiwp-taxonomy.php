<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * Starter Plugin Taxonomy Class
 *
 * Re-usable class for registering post type taxonomies.
 *
 * @package WordPress
 * @subpackage HiiWP
 * @category Plugin
 * @author Hiilite Creative Group
 * @since 1.0.0
 */
class HiiWP_Taxonomy {
	/**
	 * The post type to register the taxonomy for.
	 * @access  private
	 * @since   1.3.0
	 * @var     string
	 */
	private $post_type;

	/**
	 * The key of the taxonomy.
	 * @access  private
	 * @since   1.3.0
	 * @var     string
	 */
	private $token;

	/**
	 * The singular name for the taxonomy.
	 * @access  private
	 * @since   1.3.0
	 * @var     string
	 */
	private $singular;

	/**
	 * The plural name for the taxonomy.
	 * @access  private
	 * @since   1.3.0
	 * @var     string
	 */
	private $plural;

	/**
	 * The arguments to use when registering the taxonomy.
	 * @access  private
	 * @since   1.3.0
	 * @var     string
	 */
	private $args;

	/**
	 * Class constructor.
	 * @access  public
	 * @since   1.3.0
	 * @param   string $post_type The post type key.
	 * @param   string $token     The taxonomy key.
	 * @param   string $singular  Singular name.
	 * @param   string $plural    Plural  name.
	 * @param   array  $args      Array of argument overrides.
	 */
	
	public function __construct ( $post_type = 'portfolio', $token = 'work', $singular = 'Type', $plural = 'Types', $args = array() ) {
		$this->post_type = $post_type;
		$this->token = esc_attr( $token );
		$this->singular = esc_html( $singular );
		$this->plural = esc_html( $plural );

		if ( '' == $this->singular ) $this->singular = __( 'Type', 'hiiwp' );
		if ( '' == $this->plural ) $this->plural = __( 'Types', 'hiiwp' );

		$this->args = wp_parse_args( $args, $this->_get_default_args() );
	} // End __construct()

	/**
	 * Return an array of default arguments.
	 * @access  private
	 * @since   1.3.0
	 * @return  array Default arguments.
	 */
	private function _get_default_args () {
		return array( 
			'labels' 			=> $this->_get_default_labels(), 
			'public' 			=> true, 
			'hierarchical' 		=> true, 
			'show_ui' 			=> true, 
			'show_admin_column' => true, 
			'query_var' 		=> true, 
			'show_in_nav_menus' => false, 
			'show_tagcloud'	 	=> false ,
			'rewrite'		 	=> array( 'slug' => $this->token, 'with_front' => false ),
		);
	} // End _get_default_args()

	/**
	 * Return an array of default labels.
	 * @access  private
	 * @since   1.3.0
	 * @return  array Default labels.
	 */
	private function _get_default_labels () {
		return array(
			    'name'                => sprintf( _x( '%s', 'taxonomy general name', 'hiiwp' ), $this->plural ),
			    'singular_name'       => sprintf( _x( '%s', 'taxonomy singular name', 'hiiwp' ), $this->singular ),
			    'search_items'        => sprintf( __( 'Search %s', 'hiiwp' ), $this->plural ),
			    'all_items'           => sprintf( __( 'All %s', 'hiiwp' ), $this->plural ),
			    'parent_item'         => sprintf( __( 'Parent %s', 'hiiwp' ), $this->singular ),
			    'parent_item_colon'   => sprintf( __( 'Parent %s:', 'hiiwp' ), $this->singular ),
			    'edit_item'           => sprintf( __( 'Edit %s', 'hiiwp' ), $this->singular ),
			    'update_item'         => sprintf( __( 'Update %s', 'hiiwp' ), $this->singular ),
			    'add_new_item'        => sprintf( __( 'Add New %s', 'hiiwp' ), $this->singular ),
			    'new_item_name'       => sprintf( __( 'New %s Name', 'hiiwp' ), $this->singular ),
			    'menu_name'           => sprintf( __( '%s', 'hiiwp' ), $this->plural )
			  );
	} // End _get_default_labels()

	/**
	 * Register the taxonomy.
	 * @access  public
	 * @since   1.3.0
	 * @return  void
	 */
	public function register () {
		register_taxonomy( esc_attr( $this->token ), esc_attr( $this->post_type ), (array)$this->args );
	} // End register()
} // End Class
?>