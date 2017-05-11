<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

add_action( 'cmb2_admin_init', array( "HiiDdfAdminSettings", 'hii_rets_options_page') );


/**
 * HiiDdfAdminSettings class.
 */
class HiiDdfAdminSettings {
	
	public static function add_to_admin_menu() {
		add_options_page('DDF Listings Settings'
		               , 'DDF Listings'
		               , 'manage_options'
		               , 'hiiddf-admin.php'
		               , array('HiiDdfAdminSettings', 'hiiddf_admin_page')
		);
    }
    
    
    /**
     * register_admin_settings function.
     * 
     * @access public
     * @static
     * @return void
     */
    public static function register_admin_settings() {
		//DDF Settings
		register_setting('sr_admin_settings', 'rets_username');
		register_setting('sr_admin_settings', 'rets_password');
		register_setting('sr_admin_settings', 'rets_url');
	}
	
	
	
	/**
	 * hii_rets_options_page function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function hii_rets_options_page() {


		// the options key fields will be saved under
		$opt_key = 'hii_rets_settings';
		
		// the show_on parameter for configuring the CMB2 box, this is critical!
	    $show_on = array( 'key' => 'options-page', 'value' => array( $opt_key ) );
	    
	    // an array to hold our boxes
	    $boxes = array();
	
	    // an array to hold some tabs
	    $tabs = array();
	    	    
	    
	    /*
		 *
		 *	DDF TAB
		 *
		 */
		 
		 //
		 //	DDF Credentials BOX
		 //
	    $cmb = new_cmb2_box( array(
	        'id'        => 'ddf_settings',
	        'title'     => __( 'Account Credentials ', 'cmb2' ),
	        'show_on'   => $show_on,
	    ));
	    
	    $cmb->add_field( array(
	        'name'       => __( 'RETS Username', 'cmb2' ),
	        'id'         => 'rets_username',
	        'type'       => 'text_small',
	    ));
	    $cmb->add_field( array(
	        'name'       => __( 'RETS Password', 'cmb2' ),
	        'id'         => 'rets_password',
	        'type'       => 'text_small',
	    ));
	    $cmb->add_field( array(
	        'name'       => __( 'RETS URL', 'cmb2' ),
	        'id'         => 'rets_url',
	        'type'       => 'text_url',
	    ));
	    
	    $cmb->object_type( 'options-page' );
	    $boxes[] = $cmb;
		 
		 
		 
	    /*
		 *
		 *	TABS
		 *
		 */
	    
	    $tabs[] = array(
	         'id'    => 'hiilite_ddf_tab',
	         'title' => 'DirectDataFeed',
	         'desc'  => '',
	         'boxes' => array(
		         'ddf_settings',
	         ),
	    ); 
		
		
		
		 
	
		/*
		*
		*	GENERATE PAGE
		*	
		*/
	    $args = array(
	        'key'        => $opt_key,
	        'title'      => 'RETS Settings',
	        'menuargs' => array(
	        	'icon_url'	=>	'dashicons-admin-home',
	        	'position'	=> 2,
	        ),
	        'boxes'      => $boxes,
	        'tabs'       => $tabs,
	        'cols'       => 2,
	        'savetxt'    => 'Save',
	    );
	    new Cmb2_Metatabs_Options( $args );
    }
}

?>