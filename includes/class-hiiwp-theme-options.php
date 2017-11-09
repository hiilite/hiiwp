<?php
/**
 * The HiiWP Theme Options class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.3
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HiiWP_Theme_Options class.
 * Adds options to the customizer and Theme Options page by passing settings through to Kirki and CMB2
 *
 * @since 0.4.3
 */
class HiiWP_Theme_Options extends Hii {
	
	public function __construct() {
		
		$this->init_kirki();

	}
	
	private function init_kirki(){
		global $wp_customize;
		include_once( HIILITE_DIR . '/includes/kirki/kirki.php' );
		
		add_filter( 'kirki/config', array( $this, 'update_kirki_url' ) );
		add_filter( 'kirki/config', array( $this, 'kirki_configuration_styling' ));
		
		Kirki::add_config( 'hiiwp', array(
			'capability'    => 'edit_theme_options',
			'option_type'   => 'theme_mod',
		) );
		
		$this->get_options_panels();
	}
	
	
	public function update_kirki_url( $config ) {
        $config['url_path'] = get_template_directory_uri() . '/includes/kirki/';
        return $config;
    }
    
    public function kirki_configuration_styling( $config ) {
	
	    $config['logo_image']   = get_template_directory_uri() . '/images/Hiilite_Hii_Logo.png';
	    $config['description']  = __( 'The HiiWP Theme', 'kirki' );
	    $config['color_accent'] = '#f05023';
	    $config['width']        = '30%';
	
	    return $config;
	
	}	
	
	private function get_options_panels() {
		$hiilite_options = Hii::get_options();
		foreach (glob(HIILITE_DIR."/includes/theme_options/theme_options-*.php") as $filename) {
		    include_once( $filename );
		} 
	}
}

add_action( 'customize_register', function( $wp_customize ) {
	/**
	 * The custom control class
	 */
	class Kirki_Controls_Text_Limited_Control extends WP_Customize_Control {
		public $type = 'textlimited';
		public function render_content() { ?>
			<label>
        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        	<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<input type=text maxlength=55 <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>"> </label>
			<?php
		}
	}
	// Register our custom control with Kirki
	add_filter( 'kirki/control_types', function( $controls ) {
		$controls['textlimited'] = 'Kirki_Controls_Text_Limited_Control';
		return $controls;
	} );
	
	
	class Kirki_Controls_Textarea_Limited_Control extends WP_Customize_Control {
		public $type = 'textarealimited';
		public function render_content() { ?>
			<label>
        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        	<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<textarea style="width:100%" rows="4" maxlength=155 <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea></label>
			<?php
		}
	}
	// Register our custom control with Kirki
	add_filter( 'kirki/control_types', function( $controls ) {
		$controls['textarealimited'] = 'Kirki_Controls_Textarea_Limited_Control';
		return $controls;
	} );
	
	

} );