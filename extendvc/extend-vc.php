<?php
	
$hiilite_options = Hii::get_options();
/*** Removing shortcodes ***/
vc_remove_element("vc_wp_text"); 
vc_remove_element("vc_wp_links");
//vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");
//vc_remove_element("vc_carousel");
//vc_remove_element("vc_tta_accordion");
//vc_remove_element("vc_tta_tour");
vc_remove_element('vc_button2');


////////////////////////////
//
//	ROW
//
////////////////////////////
$vc_row_params = array(
		array(
			'type' => 'checkbox',
			'heading' => __( 'In Grid?', 'js_composer' ),
			'param_name' => 'in_grid',
			'description' => __( 'If checked contents of row will stay in grid width', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Min Height', 'js_composer' ),
			'param_name' => 'row_height',
			'description' => __( 'Set a default height for the row (will grow if content is larger)', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'js_composer' ),
			'param_name' => 'content_placement',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Top', 'js_composer' ) => 'top',
				__( 'Middle', 'js_composer' ) => 'middle',
				__( 'Bottom', 'js_composer' ) => 'bottom',
			),
			'description' => __( 'Select contents vertical position within columns.', 'js_composer' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full height row?', 'js_composer' ),
			'param_name' => 'full_height',
			'description' => __( 'If checked row will be set to full height.', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),
		
		
		array(
			'type' => 'checkbox',
			'heading' => __( 'Equal height', 'js_composer' ),
			'param_name' => 'equal_height',
			'description' => __( 'If checked columns will be set to equal height.', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),
		
		array(
			'type' => 'checkbox',
			'heading' => __( 'Parallax', 'js_composer' ),
			'param_name' => 'parallax',
			'value' => array(__( 'Yes', 'js_composer' ) => 'yes'),
			'description' => __( 'Make row background image parallax. (Must set a Background image in Design Options tab.)', 'js_composer' ),
		),
		
		array(
			'type' => 'el_id',
			'heading' => __( 'Row ID', 'js_composer' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content direction', 'js_composer' ),
			'param_name' => 'content_direction',
			'value' => array(
				__( 'Default (Left to Right)', 'js_composer' ) => 'row',
				__( 'Reverse (Right to Left)', 'js_composer' ) => 'row-reverse',
				/*__( 'Down (Top to Bottom)', 'js_composer' ) => 'column',
				__( 'Up (Bottom to Top)', 'js_composer' ) => 'column-reverse',*/
			),
			'description' => __( 'Select direction content is laid out in the container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Wrap', 'js_composer' ),
			'param_name' => 'content_wrap',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Wrap', 'js_composer' ) => 'wrap',
				__( 'No Wrap', 'js_composer' ) => 'nowrap',
				__( 'Reverse Wrap', 'js_composer' ) => 'wrap-reverse',
			),
			'description' => __( 'Select wrapping option.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
		),
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Justify Content', 'js_composer' ),
			'param_name' => 'justify_content',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Start', 'js_composer' ) => 'flex-start',
				__( 'End', 'js_composer' ) => 'flex-end',
				__( 'Center', 'js_composer' ) => 'center',
				__( 'Full Width - Space Between', 'js_composer' ) => 'space-between',
				__( 'Full Width - Space Around', 'js_composer' ) => 'space-around',
			),
			'description' => __( 'Select content justification within container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
		),*/
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns position', 'js_composer' ),
			'param_name' => 'columns_placement',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Middle', 'js_composer' ) => 'middle',
				__( 'Top', 'js_composer' ) => 'top',
				__( 'Bottom', 'js_composer' ) => 'bottom',
				__( 'Stretch', 'js_composer' ) => 'stretch',
				__( 'Baseline', 'js_composer' ) => 'baseline',
			),
			'description' => __( 'Select columns position within row.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
		),
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Vertically Justify Wrapped Content', 'js_composer' ),
			'param_name' => 'v_align_w_content',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Top', 'js_composer' ) => 'flex-start',
				__( 'Bottom', 'js_composer' ) => 'flex-end',
				__( 'Middle', 'js_composer' ) => 'center',
				__( 'Stretch', 'js_composer' ) => 'stretch',
				__( 'Full Height - Space Between', 'js_composer' ) => 'space-between',
				__( 'Full Height - Space Around', 'js_composer' ) => 'space-around',
			),
			'description' => __( 'Vertically justify wrapped content within the container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
		),*/
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Background Position', 'js_composer' ),
			'param_name' => 'bg_img_pos',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Left Top', 'js_composer' ) => 'lt',
				__( 'Left Center', 'js_composer' ) => 'lc',
				__( 'Left Bottom', 'js_composer' ) => 'lb',
				__( 'Right Top', 'js_composer' ) => 'rt',
				__( 'Right Center', 'js_composer' ) => 'rc',
				__( 'Right Bottom', 'js_composer' ) => 'rb',
				__( 'Center Top', 'js_composer' ) => 'ct',
				__( 'Center Center', 'js_composer' ) => 'cc',
				__( 'Center Bottom', 'js_composer' ) => 'cb',
			),
			'description' => __( 'Positioning of background image.', 'js_composer' ),
			'group' => __( 'Design options', 'js_composer' ),
		));
vc_map( array(
	'name' => __( 'Row' , 'js_composer' ),
	"base" => "vc_row",
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Place content elements inside the row', 'js_composer' ),
	'params' => $vc_row_params,
	'js_view' => 'VcRowView',
));

////////////////////////////
//
//	INNER ROW
//
////////////////////////////

$vc_row_inner_params = array(
		array(
			'type' => 'checkbox',
			'heading' => __( 'In Grid?', 'js_composer' ),
			'param_name' => 'in_grid',
			'description' => __( 'If checked contents of row will stay in grid width', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Min Height', 'js_composer' ),
			'param_name' => 'row_height',
			'description' => __( 'Set a default height for the row (will grow if content is larger)', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'js_composer' ),
			'param_name' => 'content_placement',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Top', 'js_composer' ) => 'top',
				__( 'Middle', 'js_composer' ) => 'middle',
				__( 'Bottom', 'js_composer' ) => 'bottom',
			),
			'description' => __( 'Select contents vertical position within columns.', 'js_composer' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full height row?', 'js_composer' ),
			'param_name' => 'full_height',
			'description' => __( 'If checked row will be set to full height.', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Equal height', 'js_composer' ),
			'param_name' => 'equal_height',
			'description' => __( 'If checked columns will be set to equal height.', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),
		
		array(
			'type' => 'checkbox',
			'heading' => __( 'Parallax', 'js_composer' ),
			'param_name' => 'parallax',
			'value' => array(__( 'Yes', 'js_composer' ) => 'yes'),
			'description' => __( 'Add parallax type background for row.', 'js_composer' ),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'js_composer' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'js_composer' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'el_id',
			'heading' => __( 'Row ID', 'js_composer' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content direction', 'js_composer' ),
			'param_name' => 'content_direction',
			'value' => array(
				__( 'Default (Left to Right)', 'js_composer' ) => 'row',
				__( 'Reverse (Right to Left)', 'js_composer' ) => 'row-reverse',
				/*__( 'Down (Top to Bottom)', 'js_composer' ) => 'column',
				__( 'Up (Bottom to Top)', 'js_composer' ) => 'column-reverse',*/
			),
			'description' => __( 'Select direction content is laid out in the container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Wrap', 'js_composer' ),
			'param_name' => 'content_wrap',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Wrap', 'js_composer' ) => 'wrap',
				__( 'No Wrap', 'js_composer' ) => 'nowrap',
				__( 'Reverse Wrap', 'js_composer' ) => 'wrap-reverse',
			),
			'description' => __( 'Select wrapping option.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
		),
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Justify Content', 'js_composer' ),
			'param_name' => 'justify_content',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Start', 'js_composer' ) => 'flex-start',
				__( 'End', 'js_composer' ) => 'flex-end',
				__( 'Center', 'js_composer' ) => 'center',
				__( 'Full Width - Space Between', 'js_composer' ) => 'space-between',
				__( 'Full Width - Space Around', 'js_composer' ) => 'space-around',
			),
			'description' => __( 'Select content justification within container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
		),*/
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns position', 'js_composer' ),
			'param_name' => 'columns_placement',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Middle', 'js_composer' ) => 'middle',
				__( 'Top', 'js_composer' ) => 'top',
				__( 'Bottom', 'js_composer' ) => 'bottom',
				__( 'Stretch', 'js_composer' ) => 'stretch',
				__( 'Baseline', 'js_composer' ) => 'baseline',
			),
			'description' => __( 'Select columns position within row.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
		),
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Vertically Justify Wrapped Content', 'js_composer' ),
			'param_name' => 'v_align_w_content',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Top', 'js_composer' ) => 'flex-start',
				__( 'Bottom', 'js_composer' ) => 'flex-end',
				__( 'Middle', 'js_composer' ) => 'center',
				__( 'Stretch', 'js_composer' ) => 'stretch',
				__( 'Full Height - Space Between', 'js_composer' ) => 'space-between',
				__( 'Full Height - Space Around', 'js_composer' ) => 'space-around',
			),
			'description' => __( 'Vertically justify wrapped content within the container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
		),*/
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Align Row', 'js_composer' ),
			'param_name' => 'align_item',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Auto', 'js_composer' ) => 'auto',
				__( 'Start', 'js_composer' ) => 'start',
				__( 'End', 'js_composer' ) => 'end',
				__( 'Middle', 'js_composer' ) => 'center',
				__( 'Stretch', 'js_composer' ) => 'stretch',
				__( 'Baseline', 'js_composer' ) => 'baseline',
			),
			'description' => __( 'Align inner row within the container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
		),*/
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Background Position', 'js_composer' ),
			'param_name' => 'bg_img_pos',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Left Top', 'js_composer' ) => 'lt',
				__( 'Left Center', 'js_composer' ) => 'lc',
				__( 'Left Bottom', 'js_composer' ) => 'lb',
				__( 'Right Top', 'js_composer' ) => 'rt',
				__( 'Right Center', 'js_composer' ) => 'rc',
				__( 'Right Bottom', 'js_composer' ) => 'rb',
				__( 'Center Top', 'js_composer' ) => 'ct',
				__( 'Center Center', 'js_composer' ) => 'cc',
				__( 'Center Bottom', 'js_composer' ) => 'cb',
			),
			'description' => __( 'Positioning of background image.', 'js_composer' ),
			'group' => __( 'Design Options', 'js_composer' ),
		));
vc_map( array(
	'name' => __( 'Inner Row' , 'js_composer' ),
	"base" => "vc_row_inner",
	"content_element" => false,
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Place content elements inside the row', 'js_composer' ),
	'params' => $vc_row_inner_params,
	'js_view' => 'VcRowView',
));
////////////////////////////
//
//	COLUMN
//
////////////////////////////
$vc_column_params = array(
	array(
		'type' => 'el_id',
		'heading' => __( 'Column ID', 'js_composer' ),
		'param_name' => 'el_id',
		'description' => sprintf( __( 'Enter column ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
	),
		
	array(
		'type' => 'textfield',
		'heading' => __( 'Extra class name', 'js_composer' ),
		'param_name' => 'el_class',
		'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Content Alignment', 'js_composer' ),
		'param_name' => 'content_alignment',
		'value' => array(
			__( 'Default', 'js_composer' ) => '',
			__( 'Left', 'js_composer' ) => 'align-left',
			__( 'Center', 'js_composer' ) => 'align-center',
			__( 'Right', 'js_composer' ) => 'align-right',
		),
		'description' => __( 'Select content position within columns.', 'js_composer' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Width', 'js_composer' ),
		'param_name' => 'width',
		'value' => array(
			__( '1 column - 1/12', 'js_composer' ) => '1/12',
			__( '2 columns - 1/6', 'js_composer' ) => '1/6',
			__( '3 columns - 1/4', 'js_composer' ) => '1/4',
			__( '4 columns - 1/3', 'js_composer' ) => '1/3',
			__( '5 columns - 5/12', 'js_composer' ) => '5/12',
			__( '6 columns - 1/2', 'js_composer' ) => '1/2',
			__( '7 columns - 7/12', 'js_composer' ) => '7/12',
			__( '8 columns - 2/3', 'js_composer' ) => '2/3',
			__( '9 columns - 3/4', 'js_composer' ) => '3/4',
			__( '10 columns - 5/6', 'js_composer' ) => '5/6',
			__( '11 columns - 11/12', 'js_composer' ) => '11/12',
			__( '12 columns - 1/1', 'js_composer' ) => '1/1',
		),
		'group' => __( 'Responsive Options', 'js_composer' ),
		'description' => __( 'Select column width.', 'js_composer' ),
		'std' => '1/1',
	),
	array(
		'type' => 'column_offset',
		'heading' => __( 'Responsiveness', 'js_composer' ),
		'param_name' => 'offset',
		'group' => __( 'Responsive Options', 'js_composer' ),
		'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'js_composer' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Align Column', 'js_composer' ),
		'param_name' => 'align_item',
		'value' => array(
			__( 'Default', 'js_composer' ) => '',
			__( 'Auto', 'js_composer' ) => 'auto',
			__( 'Start', 'js_composer' ) => 'start',
			__( 'End', 'js_composer' ) => 'end',
			__( 'Middle', 'js_composer' ) => 'center',
			__( 'Stretch', 'js_composer' ) => 'stretch',
			__( 'Baseline', 'js_composer' ) => 'baseline',
		),
		'description' => __( 'Align column within the row.', 'js_composer' ),
		'group' => __( 'Flex Options', 'js_composer' ),
	),
	array(
		'type' => 'checkbox',
		'heading' => __( 'Is Flex Container?', 'js_composer' ),
		'param_name' => 'is_flex',
		'description' => __( 'If checked this column will be a flex container.', 'js_composer' ),
		'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		'group' => __( 'Flex Options', 'js_composer' ),
	),
	array(
			'type' => 'dropdown',
			'heading' => __( 'Content direction', 'js_composer' ),
			'param_name' => 'content_direction',
			'value' => array(
				__( 'Default (Left to Right)', 'js_composer' ) => 'row',
				__( 'Reverse (Right to Left)', 'js_composer' ) => 'row-reverse',
				__( 'Down (Top to Bottom)', 'js_composer' ) => 'column',
				__( 'Up (Bottom to Top)', 'js_composer' ) => 'column-reverse',
			),
			'description' => __( 'Select direction content is laid out in the container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Wrap', 'js_composer' ),
			'param_name' => 'content_wrap',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Wrap', 'js_composer' ) => 'wrap',
				__( 'No Wrap', 'js_composer' ) => 'nowrap',
				__( 'Reverse Wrap', 'js_composer' ) => 'wrap-reverse',
			),
			'description' => __( 'Select wrapping option.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Justify Content', 'js_composer' ),
			'param_name' => 'justify_content',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Start', 'js_composer' ) => 'flex-start',
				__( 'End', 'js_composer' ) => 'flex-end',
				__( 'Center', 'js_composer' ) => 'center',
				__( 'Full Width - Space Between', 'js_composer' ) => 'space-between',
				__( 'Full Width - Space Around', 'js_composer' ) => 'space-around',
			),
			'description' => __( 'Select content justification within container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),*/
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'js_composer' ),
			'param_name' => 'columns_placement',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Middle', 'js_composer' ) => 'middle',
				__( 'Top', 'js_composer' ) => 'top',
				__( 'Bottom', 'js_composer' ) => 'bottom',
				__( 'Stretch', 'js_composer' ) => 'stretch',
				__( 'Baseline', 'js_composer' ) => 'baseline',
			),
			'description' => __( 'Select columns position within row.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),*/
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Vertically Justify Wrapped Content', 'js_composer' ),
			'param_name' => 'v_align_w_content',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Top', 'js_composer' ) => 'flex-start',
				__( 'Bottom', 'js_composer' ) => 'flex-end',
				__( 'Middle', 'js_composer' ) => 'center',
				__( 'Stretch', 'js_composer' ) => 'stretch',
				__( 'Full Height - Space Between', 'js_composer' ) => 'space-between',
				__( 'Full Height - Space Around', 'js_composer' ) => 'space-around',
			),
			'description' => __( 'Vertically justify wrapped content within the container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),*/
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Background Position', 'js_composer' ),
			'param_name' => 'bg_img_pos',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Left Top', 'js_composer' ) => 'lt',
				__( 'Left Center', 'js_composer' ) => 'lc',
				__( 'Left Bottom', 'js_composer' ) => 'lb',
				__( 'Right Top', 'js_composer' ) => 'rt',
				__( 'Right Center', 'js_composer' ) => 'rc',
				__( 'Right Bottom', 'js_composer' ) => 'rb',
				__( 'Center Top', 'js_composer' ) => 'ct',
				__( 'Center Center', 'js_composer' ) => 'cc',
				__( 'Center Bottom', 'js_composer' ) => 'cb',
			),
			'description' => __( 'Positioning of background image.', 'js_composer' ),
			'group' => __( 'Design Options', 'js_composer' ),
		));
vc_map( array(
	'name' => __( 'Column' , 'js_composer' ),
	"content_element" => false,
	"base" => "vc_column",
	'is_container' => true,
	'icon' => 'icon-wpb-column',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Place content elements inside the column', 'js_composer' ),
	'params' => $vc_column_params,
	'js_view' => 'VcColumnView',
));


////////////////////////////
//
//	INNER COLUMN
//
////////////////////////////
$vc_column_inner_params = array(
	array(
		'type' => 'el_id',
		'heading' => __( 'Column ID', 'js_composer' ),
		'param_name' => 'el_id',
		'description' => sprintf( __( 'Enter column ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
	),
	array(
		'type' => 'textfield',
		'heading' => __( 'Extra class name', 'js_composer' ),
		'param_name' => 'el_class',
		'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Content Alignment', 'js_composer' ),
		'param_name' => 'content_alignment',
		'value' => array(
			__( 'Default', 'js_composer' ) => '',
			__( 'Left', 'js_composer' ) => 'align-left',
			__( 'Center', 'js_composer' ) => 'align-center',
			__( 'Right', 'js_composer' ) => 'align-right',
		),
		'description' => __( 'Select content position within columns.', 'js_composer' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Width', 'js_composer' ),
		'param_name' => 'width',
		'value' => array(
			__( '1 column - 1/12', 'js_composer' ) => '1/12',
			__( '2 columns - 1/6', 'js_composer' ) => '1/6',
			__( '3 columns - 1/4', 'js_composer' ) => '1/4',
			__( '4 columns - 1/3', 'js_composer' ) => '1/3',
			__( '5 columns - 5/12', 'js_composer' ) => '5/12',
			__( '6 columns - 1/2', 'js_composer' ) => '1/2',
			__( '7 columns - 7/12', 'js_composer' ) => '7/12',
			__( '8 columns - 2/3', 'js_composer' ) => '2/3',
			__( '9 columns - 3/4', 'js_composer' ) => '3/4',
			__( '10 columns - 5/6', 'js_composer' ) => '5/6',
			__( '11 columns - 11/12', 'js_composer' ) => '11/12',
			__( '12 columns - 1/1', 'js_composer' ) => '1/1',
		),
		'group' => __( 'Responsive Options', 'js_composer' ),
		'description' => __( 'Select column width.', 'js_composer' ),
		'std' => '1/1',
	),
	array(
		'type' => 'column_offset',
		'heading' => __( 'Responsiveness', 'js_composer' ),
		'param_name' => 'offset',
		'group' => __( 'Responsive Options', 'js_composer' ),
		'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'js_composer' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Align Column', 'js_composer' ),
		'param_name' => 'align_item',
		'value' => array(
			__( 'Default', 'js_composer' ) => '',
			__( 'Auto', 'js_composer' ) => 'auto',
			__( 'Start', 'js_composer' ) => 'start',
			__( 'End', 'js_composer' ) => 'end',
			__( 'Middle', 'js_composer' ) => 'center',
			__( 'Stretch', 'js_composer' ) => 'stretch',
			__( 'Baseline', 'js_composer' ) => 'baseline',
		),
		'description' => __( 'Align column within the row.', 'js_composer' ),
		'group' => __( 'Flex Options', 'js_composer' ),
	),
	array(
		'type' => 'checkbox',
		'heading' => __( 'Is Flex Container?', 'js_composer' ),
		'param_name' => 'is_flex',
		'description' => __( 'If checked this column will be a flex container.', 'js_composer' ),
		'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		'group' => __( 'Flex Options', 'js_composer' ),
	),
	array(
			'type' => 'dropdown',
			'heading' => __( 'Content direction', 'js_composer' ),
			'param_name' => 'content_direction',
			'value' => array(
				__( 'Default (Left to Right)', 'js_composer' ) => 'row',
				__( 'Reverse (Right to Left)', 'js_composer' ) => 'row-reverse',
				__( 'Down (Top to Bottom)', 'js_composer' ) => 'column',
				__( 'Up (Bottom to Top)', 'js_composer' ) => 'column-reverse',
			),
			'description' => __( 'Select direction content is laid out in the container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Wrap', 'js_composer' ),
			'param_name' => 'content_wrap',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Wrap', 'js_composer' ) => 'wrap',
				__( 'No Wrap', 'js_composer' ) => 'nowrap',
				__( 'Reverse Wrap', 'js_composer' ) => 'wrap-reverse',
			),
			'description' => __( 'Select wrapping option.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),*/
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Justify Content', 'js_composer' ),
			'param_name' => 'justify_content',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Start', 'js_composer' ) => 'flex-start',
				__( 'End', 'js_composer' ) => 'flex-end',
				__( 'Center', 'js_composer' ) => 'center',
				__( 'Full Width - Space Between', 'js_composer' ) => 'space-between',
				__( 'Full Width - Space Around', 'js_composer' ) => 'space-around',
			),
			'description' => __( 'Select content justification within container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),*/
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'js_composer' ),
			'param_name' => 'columns_placement',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Middle', 'js_composer' ) => 'middle',
				__( 'Top', 'js_composer' ) => 'top',
				__( 'Bottom', 'js_composer' ) => 'bottom',
				__( 'Stretch', 'js_composer' ) => 'stretch',
				__( 'Baseline', 'js_composer' ) => 'baseline',
			),
			'description' => __( 'Select columns position within row.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),*/
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Vertically Justify Wrapped Content', 'js_composer' ),
			'param_name' => 'v_align_w_content',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Top', 'js_composer' ) => 'flex-start',
				__( 'Bottom', 'js_composer' ) => 'flex-end',
				__( 'Middle', 'js_composer' ) => 'center',
				__( 'Stretch', 'js_composer' ) => 'stretch',
				__( 'Full Height - Space Between', 'js_composer' ) => 'space-between',
				__( 'Full Height - Space Around', 'js_composer' ) => 'space-around',
			),
			'description' => __( 'Vertically justify wrapped content within the container.', 'js_composer' ),
			'group' => __( 'Flex Options', 'js_composer' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),*/
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Background Position', 'js_composer' ),
			'param_name' => 'bg_img_pos',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Left Top', 'js_composer' ) => 'lt',
				__( 'Left Center', 'js_composer' ) => 'lc',
				__( 'Left Bottom', 'js_composer' ) => 'lb',
				__( 'Right Top', 'js_composer' ) => 'rt',
				__( 'Right Center', 'js_composer' ) => 'rc',
				__( 'Right Bottom', 'js_composer' ) => 'rb',
				__( 'Center Top', 'js_composer' ) => 'ct',
				__( 'Center Center', 'js_composer' ) => 'cc',
				__( 'Center Bottom', 'js_composer' ) => 'cb',
			),
			'description' => __( 'Positioning of background image.', 'js_composer' ),
			'group' => __( 'Design Options', 'js_composer' ),
		));
vc_map( array(
	'name' => __( 'Inner Column' , 'js_composer' ),
	"content_element" => false,
	"base" => "vc_column_inner",
	'is_container' => true,
	'icon' => 'icon-wpb-column',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Place content elements inside the column', 'js_composer' ),
	'params' => $vc_column_inner_params,
	'js_view' => 'VcColumnView',
));

/////////////////////////////
//
//	POST GRID
//
///////////////////////////// 
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				'holder'	=> 'div',
				"heading" => "Use Theme Item Design",
				"param_name" => "use_blog_layouts",
				'save_always' => true,
				'group' => 'Item Design',
				'std'	=> 'true',
				'value' => array(
						__( 'Use Theme Template', 'js_composer' ) => 'true',
						__( 'Use Grid Builder', 'js_composer' ) => 'false'
					)
				));
				
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Layout",
				"param_name" => "blog_layouts",
				'group' => 'Item Design',
				'value' => array(
						__( 'Theme Default', 'js_composer' ) => '',
						__( 'Boxed', 'js_composer' ) => 'boxed',
						__( 'Masonry', 'js_composer' ) => 'masonry',
						__( 'Full Width', 'js_composer' ) => 'full-width',
					),
				"dependency" => array (
					"element" => "use_blog_layouts",
					"value" => "true"
				)));
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Image Position",
				"param_name" => "blog_img_pos",
				'group' => 'Item Design',
				'value' => array(
						__( 'Theme Default', 'js_composer' ) => '',
						__( 'Image Left', 'js_composer' ) => 'image-left',
						__( 'Image Above', 'js_composer' ) => 'image-above',
						
					),
				"dependency" => array (
					"element" => "use_blog_layouts",
					"value" => "true"
				)));
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Show Title",
				"param_name" => "blog_title_show",
				'group' => 'Item Design',
				'value' => array(
						__( 'Theme Default', 'js_composer' ) => '',
						__( 'On', 'js_composer' ) => 'true',
						__( 'Off', 'js_composer' ) => 'false',
						
					),
				"dependency" => array (
					"element" => "use_blog_layouts",
					"value" => "true"
				)));
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Title Position",
				"param_name" => "blog_title_position",
				'group' => 'Item Design',
				'value' => array(
						__( 'Theme Default', 'js_composer' ) => '',
						__( 'Above', 'js_composer' ) => 'title-above',
						__( 'Below', 'js_composer' ) => 'title-below',
						
					),
				"dependency" => array (
					"element" => "use_blog_layouts",
					"value" => "true"
				)));
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Title Size",
				"param_name" => "blog_heading_tag",
				'group' => 'Item Design',
				'value' => array(
						__( 'Theme Default', 'js_composer' ) => '',
						'H1' => 'h1',
						'H2' => 'h2',
						'H3' => 'h3',
						'H4' => 'h4',
						'H5' => 'h5',
						'H6' => 'h6',
						
					),
				"dependency" => array (
					"element" => "use_blog_layouts",
					"value" => "true"
				)));
				
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Show Category",
				"param_name" => "blog_cats_show",
				'group' => 'Item Design',
				'value' => array(
						__( 'Theme Default', 'js_composer' ) => '',
						__( 'On', 'js_composer' ) => true,
						__( 'Off', 'js_composer' ) => false,
						
					),
				"dependency" => array (
					"element" => "use_blog_layouts",
					"value" => "true"
				)));
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Show Meta Information",
				"param_name" => "blog_meta_show",
				'group' => 'Item Design',
				'value' => array(
						__( 'Theme Default', 'js_composer' ) => '',
						__( 'On', 'js_composer' ) => 'true',
						__( 'Off', 'js_composer' ) => 'false',
						
					),
				"dependency" => array (
					"element" => "use_blog_layouts",
					"value" => "true"
				)));
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Show Excerpt",
				"param_name" => "blog_excerpt_show",
				'group' => 'Item Design',
				'value' => array(
						__( 'Theme Default', 'js_composer' ) => '',
						__( 'On', 'js_composer' ) => 'true',
						__( 'Off', 'js_composer' ) => 'false',
						
					),
				"dependency" => array (
					"element" => "use_blog_layouts",
					"value" => "true"
				)));
vc_add_param( 'vc_basic_grid',  array(
				"type" => "textfield",
				"class" => "",
				"heading" => "Excerpt Length",
				"param_name" => "blog_excerpt_len",
				'group' => 'Item Design',
				'value' => '40',
				"dependency" => array (
					"element" => "use_blog_layouts",
					"value" => "true"
				)));
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Show More Button",
				"param_name" => "blog_more_show",
				'group' => 'Item Design',
				'value' => array(
						__( 'Theme Default', 'js_composer' ) => '',
						__( 'On', 'js_composer' ) => 'true',
						__( 'Off', 'js_composer' ) => 'false',
						
					),
				"dependency" => array (
					"element" => "use_blog_layouts",
					"value" => "true"
				)
			));
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Show Pagination",
				"param_name" => "blog_pag_show",
				'group' => 'Item Design',
				'value' => array(
						__( 'Theme Default', 'js_composer' ) => '',
						__( 'On', 'js_composer' ) => 'true',
						__( 'Off', 'js_composer' ) => 'false',
						
					),
				"dependency" => array (
					"element" => "use_blog_layouts",
					"value" => "true"
				)
			));
			
//vc_remove_param( "vc_basic_grid", "item" );
//vc_remove_param( "vc_basic_grid", "gap" );
//vc_remove_param( "vc_basic_grid", "initial_loading_animation" );


////////////////////////////
//
//	Title
//
/////////////////////////////
vc_map( array(
		"name" => "Title",
		"base" => "title",
		"category" => 'HiiWP',
		"icon" => "icon-wpb-layer-shape-text",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Text",
				"param_name" => "text",
			),
			array(
		        'type' => 'font_container',
		        'param_name' => 'font_container',
		        'value'=>'',
		        'settings'=>array(
		            'fields'=>array(
		                'tag'=>'h2',
		                'color',
		
		                'tag_description' => __('Select element tag.','js_composer'),
		                'color_description' => __('Select color for your element.','js_composer'),
		            ),
		        ),
		    ),
		    array(
				'type' => 'checkbox',
				'heading' => __( 'Use a Google Font?', 'js_composer' ),
				'param_name' => 'use_google_font',
				'description' => __( 'Override the default font and select from a list of Google Fonts.', 'js_composer' ),
				'value' => array( __( 'Yes', 'js_composer' ) => 'true' ),
			),
			array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts',
                'value' => __( 'Default value', 'text-domain' ),
                'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900bold italic:900:italic'),
                'settings' => array(
                    'fields'=>array(
	                    'font_family_description' => __('Select font family.','js_composer'),
                        'font_style_description' => __('Select font styling.','js_composer')
                  )
                ),
                'description' => __( 'Description for this group', 'js_composer' ), 
                "dependency" => array (
					"element" => "use_google_font",
					"value" => "true"
				),
            ),
            array(
				'type' => 'dropdown',
				'heading' => __( 'Align Title', 'js_composer' ),
				'param_name' => 'align',
				'value' => array(
					__( 'Default', 'js_composer' ) => '',
					__( 'Left', 'js_composer' ) => 'align-left',
					__( 'Center', 'js_composer' ) => 'align-center',
					__( 'Right', 'js_composer' ) => 'align-right',
				),
				'description' => __( 'Select content position within columns.', 'js_composer' ),
			),
			array(
				"type" => "vc_link",
				"holder" => "div",
				"class" => "",
				"heading" => "Link",
				"param_name" => "link"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Class",
				"param_name" => "class"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "ID",
				"param_name" => "id"
			),
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'my-text-domain' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
	        array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Max Width",
				"param_name" => "max_width",
				'group' => __( 'Design options', 'my-text-domain' ),
			),
		)
) );


////////////////////////////
//
//	Gravity Forms
//
/////////////////////////////
if(class_exists('GFForms')) {
	$forms = RGFormsModel::get_forms( null, 'title' );
	$select = array();
	foreach( $forms as $form ):
	  $select[$form->title] = $form->id;
	endforeach;
	vc_map( array(
			"name" => "Gravity Forms",
			"base" => "gravityform",
			"category" => 'HiiWP',
			"icon" => get_bloginfo('template_url')."/images/icons/gravity-forms.png",
			"allowed_container_element" => 'vc_row',
			"params" => array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"description" => "Select a form below to add it to your post or page",
					"class" => "",
					"heading" => "Forms",
					"param_name" => "id",
					"value" => $select,
					"save_always" => true
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Display form title",
					"param_name" => "title",
					"value" => array(
						'Yes' => true,
						'No' => 'false',
					),
					"save_always" => true
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Display form description",
					"param_name" => "description",
					"value" =>  array(
						'Yes' => true,
						'No' => 'false',
					),
					"save_always" => true
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => "Use Ajax",
					"param_name" => "ajax",
					"value" =>  array(
						'Yes' => true,
						'No' => 'false',
					),
					"save_always" => true
				),
				
			)
	) );
}

////////////////////////////
//
//	Button
//
/////////////////////////////
vc_map( array( 
		"name" => "Button", 
		"base" => "button",
		"category" => 'HiiWP',
		"icon" => "icon-wpb-ui-button",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Button Type",
				"description" => "Defined in the customizer",
				"param_name" => "button_type",
				"value" => array(
					"Default" => "",
					"Primary" => "button-primary",	
					"Secondary" => "button-secondary",
				),
				'save_always' => true
			),
			
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Text",
				"param_name" => "text"
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Use a Google Font?', 'js_composer' ),
				'param_name' => 'use_google_font',
				'description' => __( 'Override the default font and select from a list of Google Fonts.', 'js_composer' ),
				'value' => array( __( 'Yes', 'js_composer' ) => 'true' ),
			),
			array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts',
                'value' => __( 'Default value', 'text-domain' ),
                'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900bold italic:900:italic'),
                'settings' => array(
                    'fields'=>array(
	                    'font_family_description' => __('Select font family.','js_composer'),
                        'font_style_description' => __('Select font styling.','js_composer')
                  )
                ),
                'description' => __( 'Description for this group', 'js_composer' ), 
                "dependency" => array (
					"element" => "use_google_font",
					"value" => "true"
				),
            ),
			array(
				"type" => "vc_link",
				"holder" => "div",
				"class" => "",
				"heading" => "Link",
				"param_name" => "link"
			),
			
			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Align",
				"param_name" => "button_align",
				"value" => array(
					"Default" => "",
					"Left" => "align-left",	
					"Center" => "align-center",
					"Right" => "align-right"	
				),
				'save_always' => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Classes",
				"param_name" => "classes"
			),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "ID",
                "param_name" => "button_id",
                "description" => "Set unique button ID attribute"
            ),
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'my-text-domain' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
	       
		)
) );

////////////////////////////
//
//	Social Share
//
/////////////////////////////
vc_map( array(
		"name" => "Social Share",
		"base" => "social-share",
		"category" => 'HiiWP',
		"description" => "Allow users to share the page on social media",
		"icon" => "icon-wpb-flickr",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Google+",
				"param_name" => "gp"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Facebook",
				"param_name" => "fa"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Twitter",
				"param_name" => "tw"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Pinterest",
				"param_name" => "pt"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "LinkedIn",
				"param_name" => "li"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Email",
				"param_name" => "em"
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Text Align",
				"param_name" => "text_align",
				"value" => array(
					"Default" => "",
					"Left" => "align-left",	
					"Right" => "align-right",
					"Center" => "align-center"
				)
			),
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'my-text-domain' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
		)
) );

////////////////////////////
//
//	Social Profiles
//
/////////////////////////////
vc_map( array(
		"name" => "Social Profiles",
		"base" => "social-profiles",
		"category" => 'HiiWP',
		"description" => "Display your social media profiles",
		"icon" => "icon-wpb-flickr",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Icon Style",
				"param_name" => "icon_style",
				"description" => "Select the social icon style",
				"value" => array(
					"Theme Default" => "",
					"Round Background" => "round",
					"Square Background" => "square",
					"Inside Circle" => "circle",
					"No Background" => "no-bg",
				)
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Facebook",
				"param_name" => "facebook"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Twitter",
				"param_name" => "twitter"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Google+",
				"param_name" => "google-plus"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Instagram",
				"param_name" => "instagram"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "LinkedIn",
				"param_name" => "linkedin"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Pinterest",
				"param_name" => "pinterest"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Houzz",
				"param_name" => "houzz"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "YouTube",
				"param_name" => "youtube"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "TripAdvisor",
				"param_name" => "tripadvisor"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Yelp",
				"param_name" => "yelp"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Zomato",
				"param_name" => "zomato"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Email",
				"param_name" => "email"
			),
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'my-text-domain' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
		)
) );


////////////////////////////
//
//	Media Gallery
//
/////////////////////////////
vc_map( array(
		"name" => "Media Gallery",
		"base" => "media-gallery",
		"category" => 'HiiWP',
		"description" => "Select a set of images to display in a selected layout",
		"icon" => "icon-wpb-images-stack",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "attach_images",
				"holder" => "div",
				"class" => "",
				"heading" => "Images",
				"param_name" => "media_grid_images"
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Portfolio Layout",
				"param_name" => "portfolio_layout",
				"description" => "Select the layout type for your grid",
				"value" => array(
					"Horizontal Masonry" => "masonry-h",
					"Vertical Masonry" => "masonry",
					"Boxed Layout" => "boxed",
				)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Columns",
				"param_name" => "portfolio_columns",
				"value" => array(
					'1 Column'   => '1',
					'2 Columns'  => '2',
					'3 Columns'  => '3',
					'4 Columns'	 => '4',
				),
				"dependency" => array (
					"element" => "portfolio_layout",
					"value" => array("masonry", "boxed")
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "In Grid",
				"param_name" => "in_grid"
			),
			
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Title",
				"param_name" => "show_post_title"
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Heading Size",
				"param_name" => "portfolio_heading_size",
				"dependency" => array (
					"element" => "show_post_title",
					"not_empty" => true
				),
				"value" => array(
					"H1" => "h1",
					"H2" => "h2",
					"H3" => "h3",
					"H4" => "h4",
					"H5" => "h5",
					"H6" => "h6",
				)
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Meta",
				"param_name" => "show_post_meta"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Padding",
				"param_name" => "add_padding"
			),
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'hiiamp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
		)
	)
);


////////////////////////////
//
//	Media Gallery Grid
//
/////////////////////////////
vc_map( array(
		"name" => "HiiWP Media Gallery",
		"base" => "media-gallery",
		"category" => 'HiiWP',
		"description" => "Select a set of images to display in a selected layout",
		"icon" => "icon-wpb-images-stack",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "attach_images",
				"holder" => "div",
				"class" => "",
				"heading" => "Images",
				"param_name" => "media_grid_images"
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Portfolio Layout",
				"param_name" => "portfolio_layout",
				"description" => "Select the layout type for your grid",
				"value" => array(
					"Horizontal Masonry" => "masonry-h",
					"Vertical Masonry" => "masonry",
					"Boxed Layout" => "boxed",
				)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Columns",
				"param_name" => "portfolio_columns",
				"value" => array(
					'1 Column'   => '1',
					'2 Columns'  => '2',
					'3 Columns'  => '3',
					'4 Columns'	 => '4',
				),
				"dependency" => array (
					"element" => "portfolio_layout",
					"value" => array("masonry", "boxed")
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "In Grid",
				"param_name" => "in_grid"
			),
			
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Title",
				"param_name" => "show_post_title"
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Heading Size",
				"param_name" => "portfolio_heading_size",
				"dependency" => array (
					"element" => "show_post_title",
					"not_empty" => true
				),
				"value" => array(
					"H1" => "h1",
					"H2" => "h2",
					"H3" => "h3",
					"H4" => "h4",
					"H5" => "h5",
					"H6" => "h6",
				)
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Meta",
				"param_name" => "show_post_meta"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Padding",
				"param_name" => "add_padding"
			),
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'hiiamp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
		)
	)
);

////////////////////////////
//
//	AMP Carousel
//
/////////////////////////////
vc_map( array(
		"name" => "Hii Image Carousel",
		"base" => "amp-carousel",
		"category" => 'HiiWP',
		"description" => "Carousel of images",
		"icon" => "icon-wpb-images-carousel",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			
			array(
				"type" => "attach_images",
				"holder" => "div",
				"class" => "",
				"heading" => "Images",
				"param_name" => "media_grid_images"
			),
			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Type",
				"param_name" => "type",
				'default'	=> 'carousel',
				'value' => array (
		            "Carousel" => "carousel",
		            "Slider" => "slides",
	            )
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Thumbnails",
				"param_name" => "thumbnails",
				"default"	=> false,
				"dependency" => array (
					"element" => "type",
					"value" => array("slides"),
				),
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Width",
				"param_name" => "width",
				"default"	=> "1000",
				"dependency" => array (
					"element" => "type",
					"value" => array("slides"),
				),
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Height",
				"param_name" => "height",
				"default"	=> "300"
			),
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'hiiamp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
		)
) );

////////////////////////////
//
//	AMP Slider
//
/////////////////////////////
vc_map( array(
	'name' => __( 'Hii Slider', 'js_composer' ),
	'base' => 'vc_tta_pageable',
	'icon' => 'icon-wpb-ui-pageable',
	'is_container' => true,
	'show_settings_on_create' => true,
	'as_parent' => array(
		'only' => 'vc_tta_section',
	),
	'category' => __( 'HiiWP', 'js_composer' ),
	'description' => __( 'Simple content slider ', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'hidden',
			'param_name' => 'no_fill_content_area',
			'std' => true,
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'slider_type',
			'value' => array(
				__( 'Default', 'js_composer' ) => 'default',
				'Angled' => 'angled',
			),
			'default' => 'default',
			'heading' => __( 'Slider Type', 'js_composer' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Slider Width', 'js_composer' ),
			'param_name' => 'slider_width',
			'value'		 => '1100',
			'description' => __( '(px) Slider is responsive, but needs a set width and height to calculate ratio for images', 'js_composer' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Slider Height', 'js_composer' ),
			'param_name' => 'slider_height',
			'value'		 => '530',
			'description' => __( '(px) Slider is responsive, but needs a set width and height to calculate ratio for images', 'js_composer' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full Height', 'js_composer' ),
			'param_name' => 'slider_full_height',
			'value'		 => false,
			'description' => __( 'Set the slider to be the full height of the screen', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'autoplay',
			'value' => array(
				__( 'None', 'js_composer' ) => 'none',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'20' => '20',
				'30' => '30',
				'40' => '40',
				'50' => '50',
				'60' => '60',
			),
			'std' => 'none',
			'heading' => __( 'Autoplay', 'js_composer' ),
			'description' => __( 'Select auto rotate for pageable in seconds (Note: disabled by default).', 'js_composer' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' ),
		),
	),
	'js_view' => 'VcBackendTtaPageableView',
	'custom_markup' => '
<div class="vc_tta-container vc_tta-o-non-responsive" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-pageable vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">'
	                   . '<ul class="vc_tta-tabs-list">'
	                   . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
	                   . '</ul>
		</div>
		<div class="vc_tta-panels vc_clearfix {{container-class}}">
		  {{ content }}
		</div>
	</div>
</div>',
	'default_content' => '
[vc_tta_section title="' . sprintf( '%s %d', __( 'Slide', 'js_composer' ), 1 ) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf( '%s %d', __( 'Slide', 'js_composer' ), 2 ) . '"][/vc_tta_section]
	',
	'admin_enqueue_js' => array(
		vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
	),
));


vc_map( array(
	'name' => __( 'Slide', 'js_composer' ),
	'base' => 'vc_tta_section',
	'icon' => 'icon-wpb-ui-tta-section',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'show_settings_on_create' => false,
	'as_child' => array(
		'only' => 'vc_tta_tour,vc_tta_tabs,vc_tta_accordion',
	),
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Section for Tabs, Tours, Accordions.', 'js_composer' ),
	'js_view' => 'VcBackendTtaSectionView',
	'custom_markup' => '
		<div class="vc_tta-panel-heading">
		    <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
		</div>
		<div class="vc_tta-panel-body">
			{{ editor_controls }}
			<div class="{{ container-class }}">
			{{ content }}
			</div>
		</div>',
	'default_content' => '',
	'params' => array(
		array(
			'type' => 'checkbox',
			'heading' => __( 'Active', 'js_composer' ),
			'param_name' => 'active',
			'description' => __( 'If unchecked, slide will not be displayed', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
			'std'	=> 'yes',
		),
		/*array(
			'type' => 'checkbox',
			'heading' => __( 'Show on page load', 'js_composer' ),
			'param_name' => 'show_tab',
			'description' => __( 'The content will start out visible', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),*/
		array(
			'type' => 'textfield',
			'param_name' => 'title',
			'heading' => __( 'Title', 'js_composer' ),
			'description' => __( 'Enter section title (Note: you can leave it empty).', 'js_composer' ),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Slide Image', 'js_composer' ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'js_composer' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Position', 'js_composer' ),
			'param_name' => 'bg_img_pos',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Left Top', 'js_composer' ) => 'lt',
				__( 'Left Center', 'js_composer' ) => 'lc',
				__( 'Left Bottom', 'js_composer' ) => 'lb',
				__( 'Right Top', 'js_composer' ) => 'rt',
				__( 'Right Center', 'js_composer' ) => 'rc',
				__( 'Right Bottom', 'js_composer' ) => 'rb',
				__( 'Center Top', 'js_composer' ) => 'ct',
				__( 'Center Center', 'js_composer' ) => 'cc',
				__( 'Center Bottom', 'js_composer' ) => 'cb',
			),
			'description' => __( 'Positioning of image.', 'js_composer' ),
			),	
		array(
			'type' => 'el_id',
			'param_name' => 'tab_id',
			'settings' => array(
				'auto_generate' => true,
			),
			'heading' => __( 'Section ID', 'js_composer' ),
			'description' => __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ),
		),
	),
) );

////////////////////////////
//
//	Accordion
//
///////////////////////////// 
vc_map( array(
	'name' => __( 'Accordion', 'js_composer' ),
	'base' => 'vc_accordion',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-ui-accordion',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Collapsible content panels', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'js_composer' ),
		),
		/*array(
			'type' => 'checkbox',
			'heading' => __( 'Allow collapse all sections?', 'js_composer' ),
			'param_name' => 'collapsible',
			'description' => __( 'If checked, it is allowed to collapse all sections.', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),*/
		/*array(
			'type' => 'checkbox',
			'heading' => __( 'Disable keyboard interactions?', 'js_composer' ),
			'param_name' => 'disable_keyboard',
			'description' => __( 'If checked, disables keyboard arrow interactions (Keys: Left, Up, Right, Down, Space).', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),*/
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
	),
	'custom_markup' => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
    <a class="add_tab" title="' . __( 'Add section', 'js_composer' ) . '"><span class="vc_icon"></span> <span class="tab-label">' . __( 'Add section', 'js_composer' ) . '</span></a>
</div>
',
	'default_content' => '
    [vc_accordion_tab title="' . __( 'Section 1', 'js_composer' ) . '"][/vc_accordion_tab]
    [vc_accordion_tab title="' . __( 'Section 2', 'js_composer' ) . '"][/vc_accordion_tab]
',
	'js_view' => 'VcAccordionView',
) );

////////////////////////////
//
//	Accordion Tab
//
///////////////////////////// 
vc_map( array(
	'name' => __( 'Section', 'js_composer' ),
	'base' => 'vc_accordion_tab',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'content_element' => false,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'js_composer' ),
			'param_name' => 'title',
			'value' => __( 'Section', 'js_composer' ),
			'description' => __( 'Enter accordion section title.', 'js_composer' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Load open?', 'js_composer' ),
			'param_name' => 'is_open',
			'description' => __( 'Have section be open on page load.', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),
		array(
			'type' => 'el_id',
			'heading' => __( 'Section ID', 'js_composer' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'js_composer' ), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . __( 'link', 'js_composer' ) . '</a>' ),
		),
	),
	'js_view' => 'VcAccordionTabView',
) );
////////////////////////////
//
//	Multi Screen Showcase
//
///////////////////////////// 
vc_map( array(
		"name" => "Multi Screen Showcase",
		"base" => "screen-showcase",
		"category" => 'HiiWP',
		"description" => "Shows scrolling images within multiple screen sizes",
		"icon" => get_bloginfo('template_url')."/images/icons/multi-screens.png",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "iMac Image",
				"param_name" => "imac_image",
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "MacBook Image",
				"param_name" => "macbook_image"
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "iPad Image",
				"param_name" => "ipad_image"
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "iPhone Image",
				"param_name" => "iphone_image"
			),
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'hiiamp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
		)
) );

////////////////////////////
//
//	Empty Space
//
////////////////////////////
/*
vc_map( array(
		"name" => "Empty Space",
		"base" => "vc_empty_space",
		"category" => 'HiiWP',
		"description" => "2em of empty space",
		"icon" => "icon-wpb-ui-empty_space",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'my-text-domain' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
)));
*/
// Menu
/*  Section (All, loop), 
	Title Tag (span,p,h3,h4,h5.h6), 
	Ingredients (span,p,hide), 
	Seperator (-,|,<br>),
	Price (span,p,h3,h4,h5,h6,hide)
*/



////////////////////////////
//
//	Text Block
//
///////////////////////////// 
vc_map( array(
		"name" => "Text Block",
		"base" => "vc_column_text",
		"category" => 'HiiWP',
		'icon' => 'icon-wpb-layer-shape-text',
		'wrapper_class' => 'clearfix',
		'category' => __( 'Content', 'js_composer' ),
		'description' => __( 'A block of text with WYSIWYG editor', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'Text', 'js_composer' ),
				'param_name' => 'content',
				'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'js_composer' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'White Text', 'js_composer' ),
				'param_name' => 'white_text',
				'description' => __( 'Set text color to white.', 'js_composer' ),
				'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
			),
			array(
				'type' => 'el_id',
				'heading' => __( 'Element ID', 'js_composer' ),
				'param_name' => 'el_id',
				'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'js_composer' ),
			),
		)

) );
vc_remove_param( "vc_column_text", "css_animation" );


vc_add_param( 'vc_row', array(
    'type' => 'css_editor',
    'heading' => __( 'Css', 'my-text-domain' ),
    'param_name' => 'css',
    'group' => __( 'Design options', 'my-text-domain' ),
));

vc_add_param( 'vc_tta_section', array(
    'type' => 'textfield',
    'heading' => __( 'Min Height', 'my-text-domain' ),
    'param_name' => 'css',
    'group' => __( 'Design options', 'my-text-domain' ),
));



vc_add_param( 'vc_single_image', array(
    'type' => 'textfield',
    'heading' => __( 'Banner Text', 'my-text-domain' ),
    'param_name' => 'banner_text',
));

vc_add_param( 'vc_single_image', array(
    'type' => 'vc_link',
    'heading' => __( 'Image Link', 'my-text-domain' ),
    'param_name' => 'link',
    'dependency' => array(
	    'element' => 'onclick',
	    'value'	=> 'custom_link',
	    
	    
    )
));

vc_add_param( 'vc_single_image', array(
    'type' => 'textfield',
    'heading' => __( 'Image size', 'my-text-domain' ),
    'description' => __('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).'),
    'param_name' => 'img_size',
    'value' => 'full',
));

vc_add_param( 'vc_single_image', array(
    'type' => 'attach_image',
    'heading' => __( 'Hover Image', 'my-text-domain' ),
    'description'	=> __('The hover image should be the same dimensions as the original image','hiiwp'),
    'param_name' => 'hover_image',
));
//vc_remove_param( "vc_single_image", "onclick" ); 
vc_remove_param( "vc_single_image", "style" ); 
vc_remove_param( "vc_single_image", "img_link_target" );


if ( class_exists( 'WooCommerce' ) ) {
	vc_map( array(
		"name" => "Cart Page",
		"base" => "woocommerce_cart",
		"category" => 'WooCommerce',
		"description" => "shows the cart page",
		"icon" => get_bloginfo('template_url')."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
	));
	vc_map( array(
		"name" => "Checkout Page",
		"base" => "woocommerce_checkout",
		"category" => 'WooCommerce',
		"description" => "shows the checkout page",
		"icon" => get_bloginfo('template_url')."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
	));
	vc_map( array(
		"name" => "Order Tracking Page",
		"base" => "woocommerce_order_tracking",
		"category" => 'WooCommerce',
		"description" => "shows the order tracking form",
		"icon" => get_bloginfo('template_url')."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
	));
	
	vc_map( array(
		"name" => "My Account Page",
		"base" => "woocommerce_my_account",
		"category" => 'WooCommerce',
		"description" => "shows the user account page",
		"icon" => get_bloginfo('template_url')."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
	));
	vc_map( array(
		"name" => "Recent Products",
		"base" => "recent_products",
		"category" => 'WooCommerce',
		"description" => "Lists recent products",
		"icon" => get_bloginfo('template_url')."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
	            'type' => 'textfield',
	            'heading' => __( 'Products Per Page', 'my-text-domain' ),
	            'param_name' => 'per_page',
	            'default' => '12',
	        ),
	        array(
	            'type' => 'textfield',
	            'heading' => __( 'Columns', 'my-text-domain' ),
	            'param_name' => 'columns',
	            'default' => '3',
	        ),
	        array(
	            'type' => 'dropdown',
	            'heading' => __( 'Order By', 'my-text-domain' ),
	            'param_name' => 'orderby',
	            'default' => 'date',
	            'value' => array (
		            "ID" => "ID",
		            "author" => "author",
		            "title" => "title",
		            "name" => "name",
		            "date" => "date",
		            "modified" => "modified",
		            "rand" => "rand",
		            "menu_order" => "menu_order",
	            )
	        ),
	        array(
	            'type' => 'dropdown',
	            'heading' => __( 'Order', 'my-text-domain' ),
	            'param_name' => 'order',
	            'default' => 'desc',
	            'value' => array (
		            "DESC" => "desc",
		            "ASC" => "asc",
	            )
	        ),
	)));
	
	vc_map( array(
		"name" => "Featured Products",
		"base" => "featured_products",
		"category" => 'WooCommerce',
		"description" => "displays products that have been set as featured",
		"icon" => get_bloginfo('template_url')."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
	            'type' => 'textfield',
	            'heading' => __( 'Products Per Page', 'my-text-domain' ),
	            'param_name' => 'per_page',
	            'default' => '12',
	        ),
	        array(
	            'type' => 'textfield',
	            'heading' => __( 'Columns', 'my-text-domain' ),
	            'param_name' => 'columns',
	            'default' => '3',
	        ),
	        array(
	            'type' => 'dropdown',
	            'heading' => __( 'Order By', 'my-text-domain' ),
	            'param_name' => 'orderby',
	            'default' => 'date',
	            'value' => array (
		            "ID" => "ID",
		            "author" => "author",
		            "title" => "title",
		            "name" => "name",
		            "date" => "date",
		            "modified" => "modified",
		            "rand" => "rand",
		            "menu_order" => "menu_order",
	            )
	        ),
	        array(
	            'type' => 'dropdown',
	            'heading' => __( 'Order', 'my-text-domain' ),
	            'param_name' => 'order',
	            'default' => 'desc',
	            'value' => array (
		            "DESC" => "desc",
		            "ASC" => "asc",
	            )
	        ),
	)));
	vc_map( array(
		"name" => "Products",
		"base" => "products", 
		"category" => 'WooCommerce',
		"description" => "Show multiple products by ID or SKU.",
		"icon" => get_bloginfo('template_url')."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
		"params" => array(
	        array(
	            'type' => 'textfield',
	            'heading' => __( 'Columns', 'my-text-domain' ),
	            'param_name' => 'columns',
	            'default' => '3',
	        ),
	        array(
	            'type' => 'dropdown',
	            'heading' => __( 'Order By', 'my-text-domain' ),
	            'param_name' => 'orderby',
	            'default' => 'date',
	            'value' => array (
		            "ID" => "ID",
		            "author" => "author",
		            "title" => "title",
		            "name" => "name",
		            "date" => "date",
		            "modified" => "modified",
		            "rand" => "rand",
		            "menu_order" => "menu_order",
	            )
	        ),
	        array(
	            'type' => 'dropdown',
	            'heading' => __( 'Order', 'my-text-domain' ),
	            'param_name' => 'order',
	            'default' => 'desc',
	            'value' => array (
		            "DESC" => "desc",
		            "ASC" => "asc",
	            )
	        ),
	)));
}


// Blockquote 
vc_map( array(
        "name" => "Blockquote",
		"base" => "blockquote",
		"category" => 'by Hiilite',
		"icon" => "extended-custom-icon-qode icon-wpb-blockquote",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textarea",
				"heading" => "Text",
				"param_name" => "text",
				"value" => "Blockquote text",
				'save_always' => true,
				'admin_label' => true

			),
            array(
				"type" => "colorpicker",
				"heading" => "Text Color",
				"param_name" => "text_color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"heading" => "Width",
				"param_name" => "width",
				"description" => "Width (%)",
				'admin_label' => true
			),
			array(
				"type" => "textfield",
				"heading" => "Line Height",
				"param_name" => "line_height",
				"description" => "Line Height (px)"
			),
            array(
				"type" => "colorpicker",
				"heading" => "Background Color",
				"param_name" => "background_color",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"heading" => "Border Color",
				"param_name" => "border_color",
				"description" => ""
			),
            array(
                "type" => "dropdown",
                "heading" => "Show Quote Icon",
                "param_name" => "show_quote_icon",
                "value" => array(
                    "Yes" => "yes",
                    "No" => "no"
                ),
				'save_always' => true,
                "description" => "",
				'admin_label' => true
            ),
            array(
                "type" => "colorpicker",
                "heading" => "Quote Icon Color",
                "param_name" => "quote_icon_color",
                "description" => "",
                "dependency" => array('element' => "show_quote_icon", 'value' => 'yes'),
            )
		)
) );

// HII POST CAROUSEL 
vc_map( array(
        "name" => "Hii Post Carousel",
		"base" => "hii_post_carousel",
		"category" => 'by Hiilite',
		"icon" => "icon-wpb-images-carousel",
		"description" => __("Carousel of posts.", 'my-text-domain' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => "Post IDs",
				"param_name" => "post_ids",
				"value" => "",
				"description" => __( 'Enter posts IDs to display, minimum of 3. Note: separate values by commas (,)', 'my-text-domain' ),
				'save_always' => true,
				'admin_label' => true

			),
            array(
                "type" => "dropdown",
                "heading" => "Show Title",
                "param_name" => "show_title",
                "value" => array(
                    "Yes" => "yes",
                    "No" => "no"
                ),
                "default" => "yes",
                "description" => __( 'Show the post title', 'my-text-domain' ),
				'save_always' => true,
				'admin_label' => true
            ),
            array(
                "type" => "dropdown",
                "heading" => "Show Excerpt",
                "param_name" => "show_excerpt",
                "value" => array(
                    "Yes" => "yes",
                    "No" => "no"
                ),
                "default" => "yes",
                "description" => __( 'Show the post excerpt', 'my-text-domain' ),
				'save_always' => true,
                "description" => "",
				'admin_label' => true
            ),
            array(
                "type" => "dropdown",
                "heading" => "Show More Button",
                "param_name" => "show_btn",
                "value" => array(
                    "Yes" => "yes",
                    "No" => "no"
                ),
                "default" => "yes",
                "description" => __( 'Show Read More button', 'my-text-domain' ),
				'save_always' => true,
                "description" => "",
				'admin_label' => true
            ),
            array(
                "type" => "textfield",
                "heading" => "Button Text",
                "param_name" => "btn_text",
                "value" => "Read More",
                "description" => __( 'Change Read More button text', 'my-text-domain' ),
				'save_always' => true,
				'admin_label' => true,
				'dependency' => array(
					'element' => 'show_btn',
					'value' => 'yes',
				)
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'js_composer' ),
			)
		)
) );

// TESTIMONIALS
if($hiilite_options['testimonials_on']){
	$title = get_theme_mod( 'testimonials_title', 'Testimonials' );
	$testimonials_slug = get_theme_mod( 'testimonials_slug', 'testimonials' );
	$tax_title = get_theme_mod( 'testimonials_tax_title', 'Testimonials Categories' );
	$testimonials_tax_slug = get_theme_mod( 'testimonials_tax_slug', 'testimonials_category' );

	$sections = get_terms($testimonials_tax_slug);
	$hiilite_options['testimonials_sections']['all'] = 'All';
	foreach($sections as $section){
		$hiilite_options['testimonials_sections'][$section->name] = $section->slug;
	}
	vc_map( array(
		"name" => $title,
		"base" => "testimonials",
		"category" => 'by Hiilite',
		"description" => "Show your testimonials",
		"icon" => get_bloginfo('template_url')."/images/icons/comments.png",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Categories",
				"param_name" => "section",
				"default"	=> "all",
				"value" => $hiilite_options['testimonials_sections']
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Image",
				"param_name" => "show_image",
				"value" => true,
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => "Image Style",
				"param_name" => "image_style",
				"value" => array(
					'none' => 'None',
					'circle' => 'Circle',
					'ad_background' => 'As Background',
				),
				"dependency" => array (
					"element" => "show_image",
					"value" => array('true'),
				),
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => "Image Position",
				"param_name" => "image_position",
				"value" => array(
					'above' => 'Above',
					'right' => 'Right',
					'bottom' => 'Bottom',
					'left' => 'Left',
				),
				"dependency" => array (
					"element" => "show_image",
					"value" => array('true'),
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Title",
				"param_name" => "show_title",
				"value" => true,
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Heading tag",
				"param_name" => "heading_tag",
				"value" => array(
					'h1' => 'h1',
					'h2' => 'h2',
					'h3' => 'h3',
					'h4' => 'h4',
					'h5' => 'h5',
					'h6' => 'h6',
					'strong' => 'strong',
				),
				"dependency" => array (
					"element" => "show_title",
					"value" => array('true'),
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"heading" => "Show Rating",
				"param_name" => "show_rating",
				"value" => true,
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"heading" => "Is Slider",
				"param_name" => "is_slider",
				"value" => true,
			),
			array(
				"type" => "textfield", 
				"holder" => "div",
				"heading" => "Slider Height",
				"param_name" => "height",
				"default"	=> "500px",
				"value"	=> "500px",
				"dependency" => array (
					"element" => "is_slider",
					"value" => array('true')
				),
			),
			array(
				"type" => "textfield", 
				"holder" => "div",
				"heading" => "Slider Speed",
				"param_name" => "slider_speed",
				"description" => "Speed in milliseconds",
				"default"	=> "5000",
				"value"	=> "5000",
				"dependency" => array (
					"element" => "is_slider",
					"value" => array('true')
				),
			),
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'my-text-domain' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
			
		)
	) );
}
vc_add_shortcode_param( 'date', 'date_settings_field' );
function date_settings_field( $settings, $value ) {
   return '<div class="date_block">'
             .'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
             esc_attr( $settings['param_name'] ) . ' ' .
             esc_attr( $settings['type'] ) . '_field" type="date" value="' . esc_attr( $value ) . '" />' .
             '</div>'; // This is html markup that will be outputted in content elements edit form
}


add_filter( 'vc_grid_item_shortcodes', 'button_add_grid_shortcodes' );
function button_add_grid_shortcodes( $shortcodes ) {
	$shortcodes['button'] = array(
		'name' => __( 'Button', 'hiiwp' ),
		'base' => 'button',
		'category' => __( 'Content', 'my-text-domain' ),
		'description' => __( 'Just outputs Hello World', 'my-text-domain' ),
		'post_type' => Vc_Grid_Item_Editor::postType(),
	);
	return $shortcodes;
}

?>