<?php 
// KIRKI SETTINGS
global $wp_customize;
include_once( dirname( __FILE__ ) . '/kirki/kirki.php' );

if ( ! function_exists( 'my_theme_kirki_update_url' ) ) {
    function my_theme_kirki_update_url( $config ) {
        $config['url_path'] = get_stylesheet_directory_uri() . '/includes/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'my_theme_kirki_update_url' );

function kirki_demo_configuration_sample_styling( $config ) {

   // $config['logo_image']   = 'https://kirki.org/img/kirki-new-logo-white.png';
    $config['description']  = __( 'The Hiilite Amp Theme', 'kirki' );
    $config['color_accent'] = '#f05023';
    $config['color_back']   = '#fff';
    $config['width']        = '30%';

    return $config;

}
add_filter( 'kirki/config', 'kirki_demo_configuration_sample_styling' );	


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

// PANELS
Kirki::add_config( 'hiiwp', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );
// GENERAL
require_once 'kirki_sets/general_panel.php';

// LOGO
require_once 'kirki_sets/logo_section.php';

// HEADER 
require_once 'kirki_sets/header_section.php';

// MENU
require_once 'kirki_sets/menu_section.php';

// TITLE
require_once 'kirki_sets/title_section.php';

// FOOTER 
require_once 'kirki_sets/footer_section.php';

// TYPOGRAPHY
require_once 'kirki_sets/typography_panel.php';
?>