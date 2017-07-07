<?php
	// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


 
 //////////////
 //
 //	REMOVE BUTTONS
 //
 ///////////////
//add_filter('mce_buttons','myplugin_tinymce_buttons');
//add_filter('mce_buttons_2','myplugin_tinymce_buttons_2');
function myplugin_tinymce_buttons($buttons)
 {
	//Remove the format dropdown select and text color selector
	$remove = array('aligncenter','alignleft','alignright');

	return array_diff($buttons,$remove);
 }
function myplugin_tinymce_buttons_2($buttons)
 {
	//Remove the format dropdown select and text color selector
	$remove = array('alignjustify','outdent', 'indent', 'underline');

	return array_diff($buttons,$remove);
 }



//////////////
//
//	ADD BUTTONS
//
///////////////
add_filter( "mce_external_plugins", "hii_mce_buttons_plugin" );
//add_filter( 'mce_buttons', 'hii_register_mce_buttons' );
add_filter( 'mce_buttons_2', 'hii_register_mce_buttons_2' );
function hii_register_mce_buttons( $buttons ) {
	array_push( $buttons, 'AlignLeft' );
    array_push( $buttons, 'AlignCenter' );
    array_push( $buttons, 'AlignRight' );
    array_push( $buttons, 'BlockquoteLeft' );
    array_push( $buttons, 'BlockquoteCenter' );
    array_push( $buttons, 'BlockquoteRight' );
    
    $buttons = ['bold', 'italic', 'strikethrough', 'bullist', 'numlist', 'AlignLeft', 'AlignCenter' , 'AlignRight', 'link', 'unlink', 'wp_adv'];
    return $buttons;
}
function hii_register_mce_buttons_2( $buttons ) {	
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}
function hii_mce_buttons_plugin( $plugin_array ) {
    $plugin_array['hiiliteamp'] = get_template_directory_uri() . '/addons/tinymce_edits/tinymce_edits.js';
    return $plugin_array;
}









/**
 * Add styles/classes to the "Styles" drop-down
 */
add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
 
function tuts_mce_before_init( $settings ) {
 
    $style_formats = array(
        array(
            'title' => 'Custom Format 1',
            'inline' => 'span',
            'classes' => 'custom_format_1',
            'wrapper' => true,
            
         ),
        array(
            'title' => 'Custom Format 2',
            'inline' => 'span',
            'classes' => 'custom_format_2',
            'wrapper' => true,
         ),
         array(
            'title' => 'Custom Format 3',
            'inline' => 'span',
            'classes' => 'custom_format_3',
            'wrapper' => true,
            
         ),
         
    );
 
    $settings['style_formats'] = json_encode( $style_formats );
 
    return $settings;
 
}

?>