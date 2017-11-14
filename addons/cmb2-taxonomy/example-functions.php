<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB Taxonomy directory)
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jcchavezs/cmb2-taxonomy
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */
if ( !file_exists(  dirname(__FILE__) .'/init.php' ) ) {
	exit;
}

require_once  dirname(__FILE__) .'/init.php';

add_filter('cmb2-taxonomy_meta_boxes', 'cmb2_taxonomy_sample_metaboxes');

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_taxonomy_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb2_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['test_metabox'] = array(
		'id'            => 'test_metabox',
		'title'         => __( 'Test Metabox', 'hiiwp' ),
		'object_types'  => array( 'category', ), // Taxonomy
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		'fields'        => array(
			array(
				'name'       => __( 'Test Text', 'hiiwp' ),
				'desc'       => __( 'field description (optional)', 'hiiwp' ),
				'id'         => $prefix . 'test_text',
				'type'       => 'text'
			),
			array(
				'name' => __( 'Test Text Small', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'test_textsmall',
				'type' => 'text_small',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Test Text Medium', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'test_textmedium',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Website URL', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'url',
				'type' => 'text_url',
				// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Test Text Email', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'email',
				'type' => 'text_email',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Test Time', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'test_time',
				'type' => 'text_time',
			),
			array(
				'name' => __( 'Time zone', 'hiiwp' ),
				'desc' => __( 'Time zone', 'hiiwp' ),
				'id'   => $prefix . 'timezone',
				'type' => 'select_timezone',
			),
			array(
				'name' => __( 'Test Date Picker', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'test_textdate',
				'type' => 'text_date',
			),
			array(
				'name' => __( 'Test Date Picker (UNIX timestamp)', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'test_textdate_timestamp',
				'type' => 'text_date_timestamp',
				// 'timezone_meta_key' => $prefix . 'timezone', // Optionally make this field honor the timezone selected in the select_timezone specified above
			),
			array(
				'name' => __( 'Test Date/Time Picker Combo (UNIX timestamp)', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'test_datetime_timestamp',
				'type' => 'text_datetime_timestamp',
			),
			// This text_datetime_timestamp_timezone field type
			// is only compatible with PHP versions 5.3 or above.
			// Feel free to uncomment and use if your server meets the requirement
			// array(
			// 	'name' => __( 'Test Date/Time Picker/Time zone Combo (serialized DateTime object)', 'hiiwp' ),
			// 	'desc' => __( 'field description (optional)', 'hiiwp' ),
			// 	'id'   => $prefix . 'test_datetime_timestamp_timezone',
			// 	'type' => 'text_datetime_timestamp_timezone',
			// ),
			array(
				'name' => __( 'Test Money', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'test_textmoney',
				'type' => 'text_money',
				// 'before_field' => '£', // override '$' symbol if needed
				// 'repeatable' => true,
			),
			array(
				'name'    => __( 'Test Color Picker', 'hiiwp' ),
				'desc'    => __( 'field description (optional)', 'hiiwp' ),
				'id'      => $prefix . 'test_colorpicker',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
			array(
				'name' => __( 'Test Text Area', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'test_textarea',
				'type' => 'textarea',
			),
			array(
				'name' => __( 'Test Text Area Small', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'test_textareasmall',
				'type' => 'textarea_small',
			),
			array(
				'name' => __( 'Test Text Area for Code', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'test_textarea_code',
				'type' => 'textarea_code',
			),
			array(
				'name' => __( 'Test Title Weeeee', 'hiiwp' ),
				'desc' => __( 'This is a title description', 'hiiwp' ),
				'id'   => $prefix . 'test_title',
				'type' => 'title',
			),
			array(
				'name'    => __( 'Test Select', 'hiiwp' ),
				'desc'    => __( 'field description (optional)', 'hiiwp' ),
				'id'      => $prefix . 'test_select',
				'type'    => 'select',
				'options' => array(
					'standard' => __( 'Option One', 'hiiwp' ),
					'custom'   => __( 'Option Two', 'hiiwp' ),
					'none'     => __( 'Option Three', 'hiiwp' ),
				),
			),
			array(
				'name'    => __( 'Test Radio inline', 'hiiwp' ),
				'desc'    => __( 'field description (optional)', 'hiiwp' ),
				'id'      => $prefix . 'test_radio_inline',
				'type'    => 'radio_inline',
				'options' => array(
					'standard' => __( 'Option One', 'hiiwp' ),
					'custom'   => __( 'Option Two', 'hiiwp' ),
					'none'     => __( 'Option Three', 'hiiwp' ),
				),
			),
			array(
				'name'    => __( 'Test Radio', 'hiiwp' ),
				'desc'    => __( 'field description (optional)', 'hiiwp' ),
				'id'      => $prefix . 'test_radio',
				'type'    => 'radio',
				'options' => array(
					'option1' => __( 'Option One', 'hiiwp' ),
					'option2' => __( 'Option Two', 'hiiwp' ),
					'option3' => __( 'Option Three', 'hiiwp' ),
				),
			),
			array(
				'name'     => __( 'Test Taxonomy Radio', 'hiiwp' ),
				'desc'     => __( 'field description (optional)', 'hiiwp' ),
				'id'       => $prefix . 'text_taxonomy_radio',
				'type'     => 'taxonomy_radio',
				'taxonomy' => 'category', // Taxonomy Slug
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name'     => __( 'Test Taxonomy Select', 'hiiwp' ),
				'desc'     => __( 'field description (optional)', 'hiiwp' ),
				'id'       => $prefix . 'text_taxonomy_select',
				'type'     => 'taxonomy_select',
				'taxonomy' => 'category', // Taxonomy Slug
			),
			array(
				'name'     => __( 'Test Taxonomy Multi Checkbox', 'hiiwp' ),
				'desc'     => __( 'field description (optional)', 'hiiwp' ),
				'id'       => $prefix . 'test_multitaxonomy',
				'type'     => 'taxonomy_multicheck',
				'taxonomy' => 'post_tag', // Taxonomy Slug
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name' => __( 'Test Checkbox', 'hiiwp' ),
				'desc' => __( 'field description (optional)', 'hiiwp' ),
				'id'   => $prefix . 'test_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name'    => __( 'Test Multi Checkbox', 'hiiwp' ),
				'desc'    => __( 'field description (optional)', 'hiiwp' ),
				'id'      => $prefix . 'test_multicheckbox',
				'type'    => 'multicheck',
				'options' => array(
					'check1' => __( 'Check One', 'hiiwp' ),
					'check2' => __( 'Check Two', 'hiiwp' ),
					'check3' => __( 'Check Three', 'hiiwp' ),
				),
				// 'inline'  => true, // Toggles display to inline
			),
			array(
				'name'    => __( 'Test wysiwyg', 'hiiwp' ),
				'desc'    => __( 'field description (optional)', 'hiiwp' ),
				'id'      => $prefix . 'test_wysiwyg',
				'type'    => 'wysiwyg',
				'options' => array( 'textarea_rows' => 5, ),
			),
			array(
				'name' => __( 'Test Image', 'hiiwp' ),
				'desc' => __( 'Upload an image or enter a URL.', 'hiiwp' ),
				'id'   => $prefix . 'test_image',
				'type' => 'file',
			),
			array(
				'name'         => __( 'Multiple Files', 'hiiwp' ),
				'desc'         => __( 'Upload or add multiple images/attachments.', 'hiiwp' ),
				'id'           => $prefix . 'test_file_list',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
			array(
				'name' => __( 'oEmbed', 'hiiwp' ),
				'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'hiiwp' ),
				'id'   => $prefix . 'test_embed',
				'type' => 'oembed',
			),
		),
	);

	return $meta_boxes;
}
