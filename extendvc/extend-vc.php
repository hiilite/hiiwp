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
vc_remove_element('vc_btn');


////////////////////////////
//
//	ROW
//
////////////////////////////
$vc_row_params = array(
		array(
			'type' => 'checkbox',
			'heading' => __( 'In Grid?', 'hiiwp' ),
			'param_name' => 'in_grid',
			'description' => __( 'If checked contents of row will stay in grid width', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'In Grid Left Side', 'hiiwp' ),
			'param_name' => 'grid_left',
			'description' => __( 'If checked contents of row will stay in grid on the left side', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'In Grid Right Side', 'hiiwp' ),
			'param_name' => 'grid_right',
			'description' => __( 'If checked contents of row will stay in grid on the right side', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Min Height', 'hiiwp' ),
			'param_name' => 'row_height',
			'description' => __( 'Set a default height for the row (will grow if content is larger)', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'hiiwp' ),
			'param_name' => 'content_placement',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Top', 'hiiwp' ) => 'top',
				__( 'Middle', 'hiiwp' ) => 'middle',
				__( 'Bottom', 'hiiwp' ) => 'bottom',
			),
			'description' => __( 'Select contents vertical position within columns.', 'hiiwp' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full height row?', 'hiiwp' ),
			'param_name' => 'full_height',
			'description' => __( 'If checked row will be set to full height.', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),
		
		
		array(
			'type' => 'checkbox',
			'heading' => __( 'Equal height', 'hiiwp' ),
			'param_name' => 'equal_height',
			'description' => __( 'If checked columns will be set to equal height.', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),
		
		array(
			'type' => 'checkbox',
			'heading' => __( 'Parallax', 'hiiwp' ),
			'param_name' => 'parallax',
			'value' => array(__( 'Yes', 'hiiwp' ) => 'yes'),
			'description' => __( 'Make row background image parallax. (Must set a Background image in Design Options tab.)', 'hiiwp' ),
		),
		
		array(
			'type' => 'el_id',
			'heading' => __( 'Row ID', 'hiiwp' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'hiiwp' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'hiiwp' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content direction', 'hiiwp' ),
			'param_name' => 'content_direction',
			'value' => array(
				__( 'Default (Left to Right)', 'hiiwp' ) => 'row',
				__( 'Reverse (Right to Left)', 'hiiwp' ) => 'row-reverse',
				/*__( 'Down (Top to Bottom)', 'hiiwp' ) => 'column',
				__( 'Up (Bottom to Top)', 'hiiwp' ) => 'column-reverse',*/
			),
			'description' => __( 'Select direction content is laid out in the container.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Wrap', 'hiiwp' ),
			'param_name' => 'content_wrap',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Wrap', 'hiiwp' ) => 'wrap',
				__( 'No Wrap', 'hiiwp' ) => 'nowrap',
				__( 'Reverse Wrap', 'hiiwp' ) => 'wrap-reverse',
			),
			'description' => __( 'Select wrapping option.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns position', 'hiiwp' ),
			'param_name' => 'columns_placement',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Middle', 'hiiwp' ) => 'middle',
				__( 'Top', 'hiiwp' ) => 'top',
				__( 'Bottom', 'hiiwp' ) => 'bottom',
				__( 'Stretch', 'hiiwp' ) => 'stretch',
				__( 'Baseline', 'hiiwp' ) => 'baseline',
			),
			'description' => __( 'Select columns position within row.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'hiiwp' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Background Position', 'hiiwp' ),
			'param_name' => 'bg_img_pos',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Left Top', 'hiiwp' ) => 'lt',
				__( 'Left Center', 'hiiwp' ) => 'lc',
				__( 'Left Bottom', 'hiiwp' ) => 'lb',
				__( 'Right Top', 'hiiwp' ) => 'rt',
				__( 'Right Center', 'hiiwp' ) => 'rc',
				__( 'Right Bottom', 'hiiwp' ) => 'rb',
				__( 'Center Top', 'hiiwp' ) => 'ct',
				__( 'Center Center', 'hiiwp' ) => 'cc',
				__( 'Center Bottom', 'hiiwp' ) => 'cb',
			),
			'description' => __( 'Positioning of background image.', 'hiiwp' ),
			'group' => __( 'Design options', 'hiiwp' ),
		));
vc_map( array(
	'name' => __( 'Row' , 'hiiwp' ),
	"base" => "vc_row",
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'hiiwp' ),
	'description' => __( 'Place content elements inside the row', 'hiiwp' ),
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
			'heading' => __( 'In Grid?', 'hiiwp' ),
			'param_name' => 'in_grid',
			'description' => __( 'If checked contents of row will stay in grid width', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'In Grid Left Side', 'hiiwp' ),
			'param_name' => 'grid_left',
			'description' => __( 'If checked contents of row will stay in grid on the left side', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'In Grid Right Side', 'hiiwp' ),
			'param_name' => 'grid_right',
			'description' => __( 'If checked contents of row will stay in grid on the right side', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Min Height', 'hiiwp' ),
			'param_name' => 'row_height',
			'description' => __( 'Set a default height for the row (will grow if content is larger)', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'hiiwp' ),
			'param_name' => 'content_placement',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Top', 'hiiwp' ) => 'top',
				__( 'Middle', 'hiiwp' ) => 'middle',
				__( 'Bottom', 'hiiwp' ) => 'bottom',
			),
			'description' => __( 'Select contents vertical position within columns.', 'hiiwp' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full height row?', 'hiiwp' ),
			'param_name' => 'full_height',
			'description' => __( 'If checked row will be set to full height.', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Equal height', 'hiiwp' ),
			'param_name' => 'equal_height',
			'description' => __( 'If checked columns will be set to equal height.', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),
		
		array(
			'type' => 'checkbox',
			'heading' => __( 'Parallax', 'hiiwp' ),
			'param_name' => 'parallax',
			'value' => array(__( 'Yes', 'hiiwp' ) => 'yes'),
			'description' => __( 'Add parallax type background for row.', 'hiiwp' ),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'hiiwp' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'hiiwp' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'el_id',
			'heading' => __( 'Row ID', 'hiiwp' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'hiiwp' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'hiiwp' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content direction', 'hiiwp' ),
			'param_name' => 'content_direction',
			'value' => array(
				__( 'Default (Left to Right)', 'hiiwp' ) => 'row',
				__( 'Reverse (Right to Left)', 'hiiwp' ) => 'row-reverse',
				/*__( 'Down (Top to Bottom)', 'hiiwp' ) => 'column',
				__( 'Up (Bottom to Top)', 'hiiwp' ) => 'column-reverse',*/
			),
			'description' => __( 'Select direction content is laid out in the container.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Wrap', 'hiiwp' ),
			'param_name' => 'content_wrap',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Wrap', 'hiiwp' ) => 'wrap',
				__( 'No Wrap', 'hiiwp' ) => 'nowrap',
				__( 'Reverse Wrap', 'hiiwp' ) => 'wrap-reverse',
			),
			'description' => __( 'Select wrapping option.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
		),
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Justify Content', 'hiiwp' ),
			'param_name' => 'justify_content',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Start', 'hiiwp' ) => 'flex-start',
				__( 'End', 'hiiwp' ) => 'flex-end',
				__( 'Center', 'hiiwp' ) => 'center',
				__( 'Full Width - Space Between', 'hiiwp' ) => 'space-between',
				__( 'Full Width - Space Around', 'hiiwp' ) => 'space-around',
			),
			'description' => __( 'Select content justification within container.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
		),*/
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns position', 'hiiwp' ),
			'param_name' => 'columns_placement',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Middle', 'hiiwp' ) => 'middle',
				__( 'Top', 'hiiwp' ) => 'top',
				__( 'Bottom', 'hiiwp' ) => 'bottom',
				__( 'Stretch', 'hiiwp' ) => 'stretch',
				__( 'Baseline', 'hiiwp' ) => 'baseline',
			),
			'description' => __( 'Select columns position within row.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
		),
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Vertically Justify Wrapped Content', 'hiiwp' ),
			'param_name' => 'v_align_w_content',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Top', 'hiiwp' ) => 'flex-start',
				__( 'Bottom', 'hiiwp' ) => 'flex-end',
				__( 'Middle', 'hiiwp' ) => 'center',
				__( 'Stretch', 'hiiwp' ) => 'stretch',
				__( 'Full Height - Space Between', 'hiiwp' ) => 'space-between',
				__( 'Full Height - Space Around', 'hiiwp' ) => 'space-around',
			),
			'description' => __( 'Vertically justify wrapped content within the container.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
		),*/
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Align Row', 'hiiwp' ),
			'param_name' => 'align_item',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Auto', 'hiiwp' ) => 'auto',
				__( 'Start', 'hiiwp' ) => 'start',
				__( 'End', 'hiiwp' ) => 'end',
				__( 'Middle', 'hiiwp' ) => 'center',
				__( 'Stretch', 'hiiwp' ) => 'stretch',
				__( 'Baseline', 'hiiwp' ) => 'baseline',
			),
			'description' => __( 'Align inner row within the container.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
		),*/
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'hiiwp' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Background Position', 'hiiwp' ),
			'param_name' => 'bg_img_pos',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Left Top', 'hiiwp' ) => 'lt',
				__( 'Left Center', 'hiiwp' ) => 'lc',
				__( 'Left Bottom', 'hiiwp' ) => 'lb',
				__( 'Right Top', 'hiiwp' ) => 'rt',
				__( 'Right Center', 'hiiwp' ) => 'rc',
				__( 'Right Bottom', 'hiiwp' ) => 'rb',
				__( 'Center Top', 'hiiwp' ) => 'ct',
				__( 'Center Center', 'hiiwp' ) => 'cc',
				__( 'Center Bottom', 'hiiwp' ) => 'cb',
			),
			'description' => __( 'Positioning of background image.', 'hiiwp' ),
			'group' => __( 'Design Options', 'hiiwp' ),
		));
vc_map( array(
	'name' => __( 'Inner Row' , 'hiiwp' ),
	"base" => "vc_row_inner",
	"content_element" => false,
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'hiiwp' ),
	'description' => __( 'Place content elements inside the row', 'hiiwp' ),
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
		'heading' => __( 'Column ID', 'hiiwp' ),
		'param_name' => 'el_id',
		'description' => sprintf( __( 'Enter column ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'hiiwp' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
	),
		
	array(
		'type' => 'textfield',
		'heading' => __( 'Extra class name', 'hiiwp' ),
		'param_name' => 'el_class',
		'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'hiiwp' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Content Alignment', 'hiiwp' ),
		'param_name' => 'content_alignment',
		'value' => array(
			__( 'Default', 'hiiwp' ) => '',
			__( 'Left', 'hiiwp' ) => 'align-left',
			__( 'Center', 'hiiwp' ) => 'align-center',
			__( 'Right', 'hiiwp' ) => 'align-right',
		),
		'description' => __( 'Select content position within columns.', 'hiiwp' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Width', 'hiiwp' ),
		'param_name' => 'width',
		'value' => array(
			__( '1 column - 1/12', 'hiiwp' ) => '1/12',
			__( '2 columns - 1/6', 'hiiwp' ) => '1/6',
			__( '3 columns - 1/4', 'hiiwp' ) => '1/4',
			__( '4 columns - 1/3', 'hiiwp' ) => '1/3',
			__( '5 columns - 5/12', 'hiiwp' ) => '5/12',
			__( '6 columns - 1/2', 'hiiwp' ) => '1/2',
			__( '7 columns - 7/12', 'hiiwp' ) => '7/12',
			__( '8 columns - 2/3', 'hiiwp' ) => '2/3',
			__( '9 columns - 3/4', 'hiiwp' ) => '3/4',
			__( '10 columns - 5/6', 'hiiwp' ) => '5/6',
			__( '11 columns - 11/12', 'hiiwp' ) => '11/12',
			__( '12 columns - 1/1', 'hiiwp' ) => '1/1',
		),
		'group' => __( 'Responsive Options', 'hiiwp' ),
		'description' => __( 'Select column width.', 'hiiwp' ),
		'std' => '1/1',
	),
	array(
		'type' => 'column_offset',
		'heading' => __( 'Responsiveness', 'hiiwp' ),
		'param_name' => 'offset',
		'group' => __( 'Responsive Options', 'hiiwp' ),
		'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'hiiwp' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Align Column', 'hiiwp' ),
		'param_name' => 'align_item',
		'value' => array(
			__( 'Default', 'hiiwp' ) => '',
			__( 'Auto', 'hiiwp' ) => 'auto',
			__( 'Start', 'hiiwp' ) => 'start',
			__( 'End', 'hiiwp' ) => 'end',
			__( 'Middle', 'hiiwp' ) => 'center',
			__( 'Stretch', 'hiiwp' ) => 'stretch',
			__( 'Baseline', 'hiiwp' ) => 'baseline',
		),
		'description' => __( 'Align column within the row.', 'hiiwp' ),
		'group' => __( 'Flex Options', 'hiiwp' ),
	),
	array(
		'type' => 'checkbox',
		'heading' => __( 'Is Flex Container?', 'hiiwp' ),
		'param_name' => 'is_flex',
		'description' => __( 'If checked this column will be a flex container.', 'hiiwp' ),
		'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		'group' => __( 'Flex Options', 'hiiwp' ),
	),
	array(
			'type' => 'dropdown',
			'heading' => __( 'Content direction', 'hiiwp' ),
			'param_name' => 'content_direction',
			'value' => array(
				__( 'Default (Left to Right)', 'hiiwp' ) => 'row',
				__( 'Reverse (Right to Left)', 'hiiwp' ) => 'row-reverse',
				__( 'Down (Top to Bottom)', 'hiiwp' ) => 'column',
				__( 'Up (Bottom to Top)', 'hiiwp' ) => 'column-reverse',
			),
			'description' => __( 'Select direction content is laid out in the container.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Wrap', 'hiiwp' ),
			'param_name' => 'content_wrap',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Wrap', 'hiiwp' ) => 'wrap',
				__( 'No Wrap', 'hiiwp' ) => 'nowrap',
				__( 'Reverse Wrap', 'hiiwp' ) => 'wrap-reverse',
			),
			'description' => __( 'Select wrapping option.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'hiiwp' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Background Position', 'hiiwp' ),
			'param_name' => 'bg_img_pos',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Left Top', 'hiiwp' ) => 'lt',
				__( 'Left Center', 'hiiwp' ) => 'lc',
				__( 'Left Bottom', 'hiiwp' ) => 'lb',
				__( 'Right Top', 'hiiwp' ) => 'rt',
				__( 'Right Center', 'hiiwp' ) => 'rc',
				__( 'Right Bottom', 'hiiwp' ) => 'rb',
				__( 'Center Top', 'hiiwp' ) => 'ct',
				__( 'Center Center', 'hiiwp' ) => 'cc',
				__( 'Center Bottom', 'hiiwp' ) => 'cb',
			),
			'description' => __( 'Positioning of background image.', 'hiiwp' ),
			'group' => __( 'Design Options', 'hiiwp' ),
		));
vc_map( array(
	'name' => __( 'Column' , 'hiiwp' ),
	"content_element" => false,
	"base" => "vc_column",
	'is_container' => true,
	'icon' => 'icon-wpb-column',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'hiiwp' ),
	'description' => __( 'Place content elements inside the column', 'hiiwp' ),
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
		'heading' => __( 'Column ID', 'hiiwp' ),
		'param_name' => 'el_id',
		'description' => sprintf( __( 'Enter column ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'hiiwp' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
	),
	array(
		'type' => 'textfield',
		'heading' => __( 'Extra class name', 'hiiwp' ),
		'param_name' => 'el_class',
		'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'hiiwp' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Content Alignment', 'hiiwp' ),
		'param_name' => 'content_alignment',
		'value' => array(
			__( 'Default', 'hiiwp' ) => '',
			__( 'Left', 'hiiwp' ) => 'align-left',
			__( 'Center', 'hiiwp' ) => 'align-center',
			__( 'Right', 'hiiwp' ) => 'align-right',
		),
		'description' => __( 'Select content position within columns.', 'hiiwp' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Width', 'hiiwp' ),
		'param_name' => 'width',
		'value' => array(
			__( '1 column - 1/12', 'hiiwp' ) => '1/12',
			__( '2 columns - 1/6', 'hiiwp' ) => '1/6',
			__( '3 columns - 1/4', 'hiiwp' ) => '1/4',
			__( '4 columns - 1/3', 'hiiwp' ) => '1/3',
			__( '5 columns - 5/12', 'hiiwp' ) => '5/12',
			__( '6 columns - 1/2', 'hiiwp' ) => '1/2',
			__( '7 columns - 7/12', 'hiiwp' ) => '7/12',
			__( '8 columns - 2/3', 'hiiwp' ) => '2/3',
			__( '9 columns - 3/4', 'hiiwp' ) => '3/4',
			__( '10 columns - 5/6', 'hiiwp' ) => '5/6',
			__( '11 columns - 11/12', 'hiiwp' ) => '11/12',
			__( '12 columns - 1/1', 'hiiwp' ) => '1/1',
		),
		'group' => __( 'Responsive Options', 'hiiwp' ),
		'description' => __( 'Select column width.', 'hiiwp' ),
		'std' => '1/1',
	),
	array(
		'type' => 'column_offset',
		'heading' => __( 'Responsiveness', 'hiiwp' ),
		'param_name' => 'offset',
		'group' => __( 'Responsive Options', 'hiiwp' ),
		'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'hiiwp' ),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Align Column', 'hiiwp' ),
		'param_name' => 'align_item',
		'value' => array(
			__( 'Default', 'hiiwp' ) => '',
			__( 'Auto', 'hiiwp' ) => 'auto',
			__( 'Start', 'hiiwp' ) => 'start',
			__( 'End', 'hiiwp' ) => 'end',
			__( 'Middle', 'hiiwp' ) => 'center',
			__( 'Stretch', 'hiiwp' ) => 'stretch',
			__( 'Baseline', 'hiiwp' ) => 'baseline',
		),
		'description' => __( 'Align column within the row.', 'hiiwp' ),
		'group' => __( 'Flex Options', 'hiiwp' ),
	),
	array(
		'type' => 'checkbox',
		'heading' => __( 'Is Flex Container?', 'hiiwp' ),
		'param_name' => 'is_flex',
		'description' => __( 'If checked this column will be a flex container.', 'hiiwp' ),
		'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		'group' => __( 'Flex Options', 'hiiwp' ),
	),
	array(
			'type' => 'dropdown',
			'heading' => __( 'Content direction', 'hiiwp' ),
			'param_name' => 'content_direction',
			'value' => array(
				__( 'Default (Left to Right)', 'hiiwp' ) => 'row',
				__( 'Reverse (Right to Left)', 'hiiwp' ) => 'row-reverse',
				__( 'Down (Top to Bottom)', 'hiiwp' ) => 'column',
				__( 'Up (Bottom to Top)', 'hiiwp' ) => 'column-reverse',
			),
			'description' => __( 'Select direction content is laid out in the container.', 'hiiwp' ),
			'group' => __( 'Flex Options', 'hiiwp' ),
			"dependency" => array (
					"element" => "is_flex",
					"value" => "yes"
				),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'hiiwp' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Background Position', 'hiiwp' ),
			'param_name' => 'bg_img_pos',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Left Top', 'hiiwp' ) => 'lt',
				__( 'Left Center', 'hiiwp' ) => 'lc',
				__( 'Left Bottom', 'hiiwp' ) => 'lb',
				__( 'Right Top', 'hiiwp' ) => 'rt',
				__( 'Right Center', 'hiiwp' ) => 'rc',
				__( 'Right Bottom', 'hiiwp' ) => 'rb',
				__( 'Center Top', 'hiiwp' ) => 'ct',
				__( 'Center Center', 'hiiwp' ) => 'cc',
				__( 'Center Bottom', 'hiiwp' ) => 'cb',
			),
			'description' => __( 'Positioning of background image.', 'hiiwp' ),
			'group' => __( 'Design Options', 'hiiwp' ),
		));
vc_map( array(
	'name' => __( 'Inner Column' , 'hiiwp' ),
	"content_element" => false,
	"base" => "vc_column_inner",
	'is_container' => true,
	'icon' => 'icon-wpb-column',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'hiiwp' ),
	'description' => __( 'Place content elements inside the column', 'hiiwp' ),
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
						__( 'Use Theme Template', 'hiiwp' ) => 'true',
						__( 'Use Grid Builder', 'hiiwp' ) => 'false'
					)
				));

vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				'holder'	=> 'div',
				"heading" => "Grid Elements Per Row",
				"param_name" => "element_width",
				'save_always' => true,
				'std'	=> 'true',
				'description' => 'Layout must be set to Boxed or Masonry in the item design tab',
				'value' => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'6' => '6'
					)
				));			
				
vc_add_param( 'vc_basic_grid',  array(
				"type" => "dropdown",
				"class" => "",
				"heading" => "Layout",
				"param_name" => "blog_layouts",
				'group' => 'Item Design',
				'value' => array(
						__( 'Theme Default', 'hiiwp' ) => '',
						__( 'Boxed', 'hiiwp' ) => 'boxed',
						__( 'Masonry', 'hiiwp' ) => 'masonry',
						__( 'Full Width', 'hiiwp' ) => 'full-width',
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
						__( 'Theme Default', 'hiiwp' ) => '',
						__( 'Image Left', 'hiiwp' ) => 'image-left',
						__( 'Image Above', 'hiiwp' ) => 'image-above',
						
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
						__( 'Theme Default', 'hiiwp' ) => '',
						__( 'On', 'hiiwp' ) => 'true',
						__( 'Off', 'hiiwp' ) => 'false',
						
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
						__( 'Theme Default', 'hiiwp' ) => '',
						__( 'Above', 'hiiwp' ) => 'title-above',
						__( 'Below', 'hiiwp' ) => 'title-below',
						
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
						__( 'Theme Default', 'hiiwp' ) => '',
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
						__( 'Theme Default', 'hiiwp' ) => '',
						__( 'On', 'hiiwp' ) => 'true',
						__( 'Off', 'hiiwp' ) => 'false',
						
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
						__( 'Theme Default', 'hiiwp' ) => '',
						__( 'On', 'hiiwp' ) => 'true',
						__( 'Off', 'hiiwp' ) => 'false',
						
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
						__( 'Theme Default', 'hiiwp' ) => '',
						__( 'On', 'hiiwp' ) => 'true',
						__( 'Off', 'hiiwp' ) => 'false',
						
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
						__( 'Theme Default', 'hiiwp' ) => '',
						__( 'On', 'hiiwp' ) => 'true',
						__( 'Off', 'hiiwp' ) => 'false',
						
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
						__( 'Theme Default', 'hiiwp' ) => '',
						__( 'On', 'hiiwp' ) => 'true',
						__( 'Off', 'hiiwp' ) => 'false',
						
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
		
		                'tag_description' => __('Select element tag.','hiiwp'),
		                'color_description' => __('Select color for your element.','hiiwp'),
		            ),
		        ),
		    ),
		    array(
				'type' => 'checkbox',
				'heading' => __( 'Use a Google Font?', 'hiiwp' ),
				'param_name' => 'use_google_font',
				'description' => __( 'Override the default font and select from a list of Google Fonts.', 'hiiwp' ),
				'value' => array( __( 'Yes', 'hiiwp' ) => 'true' ),
			),
			array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts',
                'value' => __( 'Default value', 'hiiwp' ),
                'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900bold italic:900:italic'),
                'settings' => array(
                    'fields'=>array(
	                    'font_family_description' => __('Select font family.','hiiwp'),
                        'font_style_description' => __('Select font styling.','hiiwp')
                  )
                ),
                'description' => __( 'Description for this group', 'hiiwp' ), 
                "dependency" => array (
					"element" => "use_google_font",
					"value" => "true"
				),
            ),
            array(
				'type' => 'dropdown',
				'heading' => __( 'Align Title', 'hiiwp' ),
				'param_name' => 'align',
				'value' => array(
					__( 'Default', 'hiiwp' ) => '',
					__( 'Left', 'hiiwp' ) => 'align-left',
					__( 'Center', 'hiiwp' ) => 'align-center',
					__( 'Right', 'hiiwp' ) => 'align-right',
				),
				'description' => __( 'Select content position within columns.', 'hiiwp' ),
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
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
	        ),
	        array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Max Width",
				"param_name" => "max_width",
				'group' => __( 'Design options', 'hiiwp' ),
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
			"icon" => esc_url( get_template_directory_uri() )."/images/icons/gravity-forms.png",
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
		"name" => "Hii Button", 
		"base" => "button",
		"category" => 'HiiWP',
		"description" => "HiiWP Themes default button",
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
				'heading' => __( 'Use a Google Font?', 'hiiwp' ),
				'param_name' => 'use_google_font',
				'description' => __( 'Override the default font and select from a list of Google Fonts.', 'hiiwp' ),
				'value' => array( __( 'Yes', 'hiiwp' ) => 'true' ),
			),
			array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts',
                'value' => __( 'Default value', 'hiiwp' ),
                'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900bold italic:900:italic'),
                'settings' => array(
                    'fields'=>array(
	                    'font_family_description' => __('Select font family.','hiiwp'),
                        'font_style_description' => __('Select font styling.','hiiwp')
                  )
                ),
                'description' => __( 'Description for this group', 'hiiwp' ), 
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
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
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
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
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
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
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
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
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
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
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
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
	        ),
		)
) );

////////////////////////////
//
//	Hii Slider
//
/////////////////////////////
vc_map( array(
	'name' => __( 'Hii Slider', 'hiiwp' ),
	'base' => 'vc_tta_pageable',
	'icon' => 'icon-wpb-ui-pageable',
	'is_container' => true,
	'show_settings_on_create' => true,
	'as_parent' => array(
		'only' => 'vc_tta_section',
	),
	'category' => __( 'HiiWP', 'hiiwp' ),
	'description' => __( 'Simple content slider ', 'hiiwp' ),
	'params' => array(
		array(
			'type' => 'hidden',
			'param_name' => 'no_fill_content_area',
			'std' => true,
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Slider Layout'),
			'param_name'=> 'slider_layout',
			'description' => __( 'Responsive: will fit to the content within the slider (ideal for slides with text content). Fixed: Will maintain a fixed aspect ratio based on an initially set width and height (ideal for background image only sliders)', 'hiiwp' ),
			'value'		=> array(
				'Responsive' => 'responsive',
				'Fixed' => 'fixed',
			),
			'std' 		=> 'responsive',
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Width', 'hiiwp' ),
			'param_name' => 'slider_width',
			'value'		 => '1100',
			'description' => __( '(px) Slider will scale, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'fixed',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Height', 'hiiwp' ),
			'param_name' => 'slider_height',
			'value'		 => '530',
			'description' => __( '(px) Slider will scale, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'fixed',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Min Height', 'hiiwp' ),
			'param_name' => 'slider_min_height',
			'value'		 => '530',
			'description' => __( 'Site a minimum height the slider can scale down too.', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'responsive',
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full Height', 'hiiwp' ),
			'param_name' => 'slider_full_height',
			'value'		 => false,
			'description' => __( 'Set the slider to be the full height of the screen (100% the viewport height)', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'autoplay',
			'value' => array(
				__( 'None', 'hiiwp' ) => 'none',
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
			'heading' => __( 'Autoplay', 'hiiwp' ),
			'description' => __( 'Select auto rotate for pageable in seconds (Note: disabled by default).', 'hiiwp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'hiiwp' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'hiiwp' ),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Show Arrows'),
			'param_name'=> 'show_arrows',
			'value'		=> 'true',
			'std' 		=> 'true',
			'group'		=> __('Arrows', 'hiiwp'),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Hide Arrows on Mobile'),
			'param_name'=> 'hide_arrows_on_mobile',
			'value'		=> false,
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Icon'),
			'param_name'=> 'arrow_icon',
			'class'		=> 'fa',
			'value'		=> array(
				'Arrow' => 'arrow',
				'Arrow Circle' => 'arrow-alt-circle',
				'Caret' => 'caret',
				'Chevron' => 'chevron',
				'Chevron Circle' => 'chevron-circle',
			),
			'std' 		=> 'chevron',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Size'),
			'param_name'=> 'arrow_size',
			'value'		=> array(
				'Small' => 'small',
				'Regular' => 'regular',
				'Large' => 'large',
			),
			'std' 		=> 'regular',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Background Type'),
			'param_name'=> 'arrow_background_type',
			'class'		=> 'fa',
			'value'		=> array(
				'No Background'	=> 'none',
				'Circle'		=> 'circle',
				'Square'		=> 'square',
				'Rounded Square'=> 'round-square',
			),
			'std' 		=> 'none',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Color'),
			'param_name'=> 'arrow_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#333333',
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Background Color'),
			'param_name'=> 'arrow_background_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#ffffff',
			'dependency' => array(
				'element' => 'arrow_background_type',
				'value_not_equal_to' => array(
						'none',
					),
			),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Show Bullets'),
			'param_name'=> 'show_bullets',
			'value'		=> 'true',
			'std' 		=> 'true',
			'group'		=> __('Bullets', 'hiiwp'),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Bullet Color'),
			'param_name'=> 'bullet_color',
			'group'		=> __('Bullets', 'hiiwp'),
			'std'		=> '#ffffff',
			'dependency' => array(
				'element' => 'show_bullets',
				'value' => 'true'
			),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'hiiwp' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'hiiwp' ),
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
[vc_tta_section title="' . sprintf( '%s %d', __( 'Slide', 'hiiwp' ), 1 ) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf( '%s %d', __( 'Slide', 'hiiwp' ), 2 ) . '"][/vc_tta_section]
	',
	'admin_enqueue_js' => array(
		vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
	),
));


vc_map( array(
	'name' => __( 'Slide', 'hiiwp' ),
	'base' => 'vc_tta_section',
	'icon' => 'icon-wpb-ui-tta-section',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'show_settings_on_create' => false,
	'as_child' => array(
		'only' => 'vc_tta_tour,vc_tta_tabs,vc_tta_accordion',
	),
	'category' => __( 'Content', 'hiiwp' ),
	'description' => __( 'Section for Tabs, Tours, Accordions.', 'hiiwp' ),
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
			'heading' => __( 'Active', 'hiiwp' ),
			'param_name' => 'active',
			'description' => __( 'If unchecked, slide will not be displayed', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
			'std'	=> 'yes',
		),
		array(
			'type' => 'textfield',
			'param_name' => 'title',
			'heading' => __( 'Title', 'hiiwp' ),
			'description' => __( 'Enter section title (Note: you can leave it empty).', 'hiiwp' ),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Slide Image', 'hiiwp' ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'hiiwp' ),
		),
		array(
			'type' => 'el_id',
			'param_name' => 'tab_id',
			'settings' => array(
				'auto_generate' => true,
			),
			'heading' => __( 'Section ID', 'hiiwp' ),
			'description' => __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'hiiwp' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'hiiwp' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Background Position', 'hiiwp' ),
			'param_name' => 'bg_img_pos',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Left Top', 'hiiwp' ) => 'lt',
				__( 'Left Center', 'hiiwp' ) => 'lc',
				__( 'Left Bottom', 'hiiwp' ) => 'lb',
				__( 'Right Top', 'hiiwp' ) => 'rt',
				__( 'Right Center', 'hiiwp' ) => 'rc',
				__( 'Right Bottom', 'hiiwp' ) => 'rb',
				__( 'Center Top', 'hiiwp' ) => 'ct',
				__( 'Center Center', 'hiiwp' ) => 'cc',
				__( 'Center Bottom', 'hiiwp' ) => 'cb',
			),
			'description' => __( 'Positioning of background image.', 'hiiwp' ),
			'group' => __( 'Design options', 'hiiwp' ),
		)
	),
) );

////////////////////////////
//
//	Accordion
//
///////////////////////////// 
vc_map( array(
	'name' => __( 'Accordion', 'hiiwp' ),
	'base' => 'vc_accordion',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-ui-accordion',
	'category' => __( 'Content', 'hiiwp' ),
	'description' => __( 'Collapsible content panels', 'hiiwp' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'hiiwp' ),
			'param_name' => 'title',
			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'hiiwp' ),
		),
		/*array(
			'type' => 'checkbox',
			'heading' => __( 'Allow collapse all sections?', 'hiiwp' ),
			'param_name' => 'collapsible',
			'description' => __( 'If checked, it is allowed to collapse all sections.', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),*/
		/*array(
			'type' => 'checkbox',
			'heading' => __( 'Disable keyboard interactions?', 'hiiwp' ),
			'param_name' => 'disable_keyboard',
			'description' => __( 'If checked, disables keyboard arrow interactions (Keys: Left, Up, Right, Down, Space).', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),*/
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'hiiwp' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'hiiwp' ),
		),
	),
	'custom_markup' => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
    <a class="add_tab" title="' . __( 'Add section', 'hiiwp' ) . '"><span class="vc_icon"></span> <span class="tab-label">' . __( 'Add section', 'hiiwp' ) . '</span></a>
</div>
',
	'default_content' => '
    [vc_accordion_tab title="' . __( 'Section 1', 'hiiwp' ) . '"][/vc_accordion_tab]
    [vc_accordion_tab title="' . __( 'Section 2', 'hiiwp' ) . '"][/vc_accordion_tab]
',
	'js_view' => 'VcAccordionView',
) );

////////////////////////////
//
//	Accordion Tab
//
///////////////////////////// 
vc_map( array(
	'name' => __( 'Section', 'hiiwp' ),
	'base' => 'vc_accordion_tab',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'content_element' => false,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'hiiwp' ),
			'param_name' => 'title',
			'value' => __( 'Section', 'hiiwp' ),
			'description' => __( 'Enter accordion section title.', 'hiiwp' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Load open?', 'hiiwp' ),
			'param_name' => 'is_open',
			'description' => __( 'Have section be open on page load.', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),
		array(
			'type' => 'el_id',
			'heading' => __( 'Section ID', 'hiiwp' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'hiiwp' ), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . __( 'link', 'hiiwp' ) . '</a>' ),
		),
	),
	'js_view' => 'VcAccordionTabView',
) );


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
		'category' => __( 'Content', 'hiiwp' ),
		'description' => __( 'A block of text with WYSIWYG editor', 'hiiwp' ),
		'params' => array(
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'Text', 'hiiwp' ),
				'param_name' => 'content',
				'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'hiiwp' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'White Text', 'hiiwp' ),
				'param_name' => 'white_text',
				'description' => __( 'Set text color to white.', 'hiiwp' ),
				'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
			),
			array(
				'type' => 'el_id',
				'heading' => __( 'Element ID', 'hiiwp' ),
				'param_name' => 'el_id',
				'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'hiiwp' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'hiiwp' ),
				'param_name' => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'hiiwp' ),
			),
			array(
				'type' 			=> 'iconpicker',
				'heading' 		=> __( 'Icon', 'hiiwp' ),
				'param_name' 	=> 'icon',
				'description' 	=> __( 'Add an Icon to the text box', 'hiiwp' ),
				'group'			=> __( 'Icon', 'hiiwp' ),
				'settings' 		=> array(
					'emptyIcon'		=> true,
					'type'			=> 'fontawesome',
					'iconsPerPage'	=> 200
				),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Icon Size', 'hiiwp' ),
				'param_name' 	=> 'icon_size',
				'group'			=> __('Icon', 'hiiwp'),
				'description' 	=> __( 'Size of the icon', 'hiiwp' ),
				'value' => array(
					__( 'Small', 'hiiwp' ) => 'small',
					__( 'Regular', 'hiiwp' ) => 'regular',
					__( 'Large', 'hiiwp' ) => 'large',
					__( 'Extra Large', 'hiiwp' ) => 'extra-large',
				),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Icon Position', 'hiiwp' ),
				'param_name' 	=> 'icon_position',
				'group'			=> __('Icon', 'hiiwp'),
				'description' 	=> __( 'Where would you like the icon positioned in relation to the text box', 'hiiwp' ),
				'value' => array(
					__( 'Top', 'hiiwp' ) => 'top',
					__( 'Right', 'hiiwp' ) => 'right',
					__( 'Bottom', 'hiiwp' ) => 'bottom',
					__( 'Left', 'hiiwp' ) => 'left',
				),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> __( 'Icon Align', 'hiiwp' ),
				'param_name' 	=> 'icon_align',
				'group'			=> __('Icon', 'hiiwp'),
				'description' 	=> __( 'How would you like the icon aligned', 'hiiwp' ),
				'value' => array(
					__( 'Center', 'hiiwp' ) => 'center',
					__( 'Left', 'hiiwp' ) => 'left',
					__( 'Right', 'hiiwp' ) => 'right',
				),
			),
			array(
				'type' 			=> 'colorpicker',
				'heading' 		=> __( 'Icon Color', 'hiiwp' ),
				'param_name' 	=> 'icon_color',
				'group'			=> __('Icon', 'hiiwp'),
				'description' 	=> __( 'Color of icon', 'hiiwp' ),
				'value'			=> '#c3c3c3'
			),
			
			array(
				'type' => 'css_editor',
				'heading' => __( 'CSS box', 'hiiwp' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'hiiwp' ),
			),
		)

) );
vc_remove_param( "vc_column_text", "css_animation" );


vc_add_param( 'vc_row', array(
    'type' => 'css_editor',
    'heading' => __( 'Css', 'hiiwp' ),
    'param_name' => 'css',
    'group' => __( 'Design options', 'hiiwp' ),
));

vc_add_param( 'vc_tta_section', array(
    'type' => 'textfield',
    'heading' => __( 'Min Height', 'hiiwp' ),
    'param_name' => 'css',
    'group' => __( 'Design options', 'hiiwp' ),
));


vc_add_param( 'vc_single_image', array(
    'type' => 'checkbox',
    'heading' => __( 'Default Padding', 'hiiwp' ),
    'param_name' => 'default_padding',
    'description' => __('Add default theme padding of 1em to match text blocks.', 'hiiwp'),
));

vc_add_param( 'vc_single_image', array(
    'type' => 'vc_link',
    'heading' => __( 'Image Link', 'hiiwp' ),
    'param_name' => 'link',
    'dependency' => array(
	    'element' => 'onclick',
	    'value'	=> 'custom_link',
    )
));

vc_add_param( 'vc_single_image', array(
    'type' => 'textfield',
    'heading' => __( 'Image size', 'hiiwp' ),
    'description' => __('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme).', 'hiiwp'),
    'param_name' => 'img_size',
    'value' => 'full',
));

vc_add_param( 'vc_single_image', array(
    'type' => 'attach_image',
    'heading' => __( 'Hover Image', 'hiiwp' ),
    'description'	=> __('The hover image should be the same dimensions as the original image','hiiwp'),
    'param_name' => 'hover_image',
));
vc_remove_param( "vc_single_image", "title" ); 
vc_remove_param( "vc_single_image", "style" ); 
vc_remove_param( "vc_single_image", "img_link_target" );
vc_remove_param( "vc_single_image", "border_color" );

/*
 *	vc_video
 */
vc_add_param( 'vc_video', array(
    'type' => 'checkbox',
    'heading' => __( 'Default Padding', 'hiiwp' ),
    'param_name' => 'default_padding',
    'description' => __('Add default theme padding of 1em to match text blocks.', 'hiiwp'),
));
vc_remove_param( "vc_video", "title" );

/*
 *	WooCommerce
 */
if ( class_exists( 'WooCommerce' ) ) {
	vc_map( array(
		"name" => "Cart Page",
		"base" => "woocommerce_cart",
		"category" => 'WooCommerce',
		"description" => "shows the cart page",
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
	));
	vc_map( array(
		"name" => "Checkout Page",
		"base" => "woocommerce_checkout",
		"category" => 'WooCommerce',
		"description" => "shows the checkout page",
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
	));
	vc_map( array(
		"name" => "Order Tracking Page",
		"base" => "woocommerce_order_tracking",
		"category" => 'WooCommerce',
		"description" => "shows the order tracking form",
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
	));
	
	vc_map( array(
		"name" => "My Account Page",
		"base" => "woocommerce_my_account",
		"category" => 'WooCommerce',
		"description" => "shows the user account page",
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
	));
	vc_map( array(
		"name" => "Recent Products",
		"base" => "recent_products",
		"category" => 'WooCommerce',
		"description" => "Lists recent products",
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
	            'type' => 'textfield',
	            'heading' => __( 'Products Per Page', 'hiiwp' ),
	            'param_name' => 'per_page',
	            'default' => '12',
	        ),
	        array(
	            'type' => 'textfield',
	            'heading' => __( 'Columns', 'hiiwp' ),
	            'param_name' => 'columns',
	            'default' => '3',
	        ),
	        array(
	            'type' => 'dropdown',
	            'heading' => __( 'Order By', 'hiiwp' ),
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
	            'heading' => __( 'Order', 'hiiwp' ),
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
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
	            'type' => 'textfield',
	            'heading' => __( 'Products Per Page', 'hiiwp' ),
	            'param_name' => 'per_page',
	            'default' => '12',
	        ),
	        array(
	            'type' => 'textfield',
	            'heading' => __( 'Columns', 'hiiwp' ),
	            'param_name' => 'columns',
	            'default' => '3',
	        ),
	        array(
	            'type' => 'dropdown',
	            'heading' => __( 'Order By', 'hiiwp' ),
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
	            'heading' => __( 'Order', 'hiiwp' ),
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
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/woocommerce.svg",
		"allowed_container_element" => 'vc_row',
		"params" => array(
	        array(
	            'type' => 'textfield',
	            'heading' => __( 'Columns', 'hiiwp' ),
	            'param_name' => 'columns',
	            'default' => '3',
	        ),
	        array(
	            'type' => 'dropdown',
	            'heading' => __( 'Order By', 'hiiwp' ),
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
	            'heading' => __( 'Order', 'hiiwp' ),
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
		"category" => 'Content',
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
        "name" => "Hii Waterwheel Carousel",
		"base" => "hii_post_carousel",
		"category" => 'by Hiilite',
		"icon" => "icon-wpb-images-carousel",
		"description" => __("Create a rotating carousel with a waterwheel effect of posts.", 'hiiwp' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => "Post IDs",
				"param_name" => "post_ids",
				"value" => "",
				"description" => __( 'Enter posts IDs to display, minimum of 3. Note: separate values by commas (,)', 'hiiwp' ),
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
                "description" => __( 'Show the post title', 'hiiwp' ),
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
                "description" => __( 'Show the post excerpt', 'hiiwp' ),
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
                "description" => __( 'Show Read More button', 'hiiwp' ),
				'save_always' => true,
                "description" => "",
				'admin_label' => true
            ),
            array(
                "type" => "textfield",
                "heading" => "Button Text",
                "param_name" => "btn_text",
                "value" => "Read More",
                "description" => __( 'Change Read More button text', 'hiiwp' ),
				'save_always' => true,
				'admin_label' => true,
				'dependency' => array(
					'element' => 'show_btn',
					'value' => 'yes',
				)
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'CSS box', 'hiiwp' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'hiiwp' ),
			)
		)
) );

// HII INFINITE CAROUSEL 
// TODO: Finish shortcode before activating on frontend
/* 
vc_map( array(
	'name' => __( 'Hii Content Slider', 'hiiwp' ),
	'base' => 'hii_infinite_carousel', 
	'icon' => 'icon-wpb-images-carousel',
	'is_container' => true,
	'show_settings_on_create' => true,
	'as_parent' => array(
		'only' => 'vc_tta_section',
	),
	'category' => 'HiiWP',
	'description' => __( 'Simple content slider', 'hiiwp' ),
	'params' => array(
		array(
			'type' => 'hidden',
			'param_name' => 'no_fill_content_area',
			'std' => true,
		),
		array(
			'type' => 'hidden',
			'param_name' => 'slider_type',
			'value' => array(
				__( 'Default', 'hiiwp' ) => 'default',
				'Angled' => 'angled',
			),
			'default' => 'default',
			'heading' => __( 'Slider Type', 'hiiwp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Carousel Width', 'hiiwp' ),
			'param_name' => 'slider_width',
			'value'		 => '1100',
			'description' => __( '(px) Slider is responsive, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Carousel Height', 'hiiwp' ),
			'param_name' => 'slider_height',
			'value'		 => '530',
			'description' => __( '(px) Slider is responsive, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
		),
		array(
			'type' => 'hidden',
			'heading' => __( 'Full Height', 'hiiwp' ),
			'param_name' => 'slider_full_height',
			'value'		 => false,
			'description' => __( 'Set the slider to be the full height of the screen', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'autoplay',
			'value' => array(
				__( 'None', 'hiiwp' ) => 'none',
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
			'heading' => __( 'Autoplay', 'hiiwp' ),
			'description' => __( 'Select auto rotate for pageable in seconds (Note: disabled by default).', 'hiiwp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'hiiwp' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'hiiwp' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'hiiwp' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'hiiwp' ),
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
[vc_tta_section title="' . sprintf( '%s %d', __( 'Slide', 'hiiwp' ), 1 ) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf( '%s %d', __( 'Slide', 'hiiwp' ), 2 ) . '"][/vc_tta_section]
	',
	'admin_enqueue_js' => array(
		vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
	),
));
*/

vc_map( array(
	'name' => __( 'Slide', 'hiiwp' ),
	'base' => 'vc_tta_section',
	'icon' => 'icon-wpb-ui-tta-section',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'show_settings_on_create' => false,
	'as_child' => array(
		'only' => 'vc_tta_tour,vc_tta_tabs,vc_tta_accordion',
	),
	'category' => __( 'Content', 'hiiwp' ),
	'description' => __( 'Section for Tabs, Tours, Accordions.', 'hiiwp' ),
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
			'heading' => __( 'Active', 'hiiwp' ),
			'param_name' => 'active',
			'description' => __( 'If unchecked, slide will not be displayed', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
			'std'	=> 'yes',
		),
		/*array(
			'type' => 'checkbox',
			'heading' => __( 'Show on page load', 'hiiwp' ),
			'param_name' => 'show_tab',
			'description' => __( 'The content will start out visible', 'hiiwp' ),
			'value' => array( __( 'Yes', 'hiiwp' ) => 'yes' ),
		),*/
		array(
			'type' => 'textfield',
			'param_name' => 'title',
			'heading' => __( 'Title', 'hiiwp' ),
			'description' => __( 'Enter section title (Note: you can leave it empty).', 'hiiwp' ),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Slide Image', 'hiiwp' ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'hiiwp' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Position', 'hiiwp' ),
			'param_name' => 'bg_img_pos',
			'value' => array(
				__( 'Default', 'hiiwp' ) => '',
				__( 'Left Top', 'hiiwp' ) => 'lt',
				__( 'Left Center', 'hiiwp' ) => 'lc',
				__( 'Left Bottom', 'hiiwp' ) => 'lb',
				__( 'Right Top', 'hiiwp' ) => 'rt',
				__( 'Right Center', 'hiiwp' ) => 'rc',
				__( 'Right Bottom', 'hiiwp' ) => 'rb',
				__( 'Center Top', 'hiiwp' ) => 'ct',
				__( 'Center Center', 'hiiwp' ) => 'cc',
				__( 'Center Bottom', 'hiiwp' ) => 'cb',
			),
			'description' => __( 'Positioning of image.', 'hiiwp' ),
			),	
		array(
			'type' => 'el_id',
			'param_name' => 'tab_id',
			'settings' => array(
				'auto_generate' => true,
			),
			'heading' => __( 'Section ID', 'hiiwp' ),
			'description' => __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'hiiwp' ),
		),
	),
) );





$postTypes = get_post_types( array() );
$postTypesList = array();
$excludedPostTypes = array(
	'revision',
	'nav_menu_item',
	'vc_grid_item',
);
if ( is_array( $postTypes ) && ! empty( $postTypes ) ) {
	foreach ( $postTypes as $postType ) {
		if ( ! in_array( $postType, $excludedPostTypes ) ) {
			$label = ucfirst( $postType );
			$postTypesList[] = array(
				$postType,
				$label,
			);
		}
	}
}
$postTypesList[] = array(
	'custom',
	__( 'Custom query', 'js_composer' ),
);
$postTypesList[] = array(
	'ids',
	__( 'List of IDs', 'js_composer' ),
);


// HII ROTATING CAROUSEL 
vc_map( array(
        "name" => "Hii Rotating Carousel",
		"base" => "hii_rotating_carousel",
		"category" => 'by Hiilite',
		"icon" => "icon-wpb-images-carousel",
		"description" => __("Carousel of posts.", 'hiiwp' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Data source', 'js_composer' ),
				'param_name' => 'post_type',
				'value' => $postTypesList,
				'save_always' => true,
				'description' => __( 'Select content type for your grid.', 'js_composer' ),
				'admin_label' => true,
			),
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Include only', 'js_composer' ),
				'param_name' => 'include',
				'description' => __( 'Add posts, pages, etc. by title.', 'js_composer' ),
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'groups' => true,
				),
				'dependency' => array(
					'element' => 'post_type',
					'value' => array( 'ids' ),
				),
			),
			// Custom query tab
			array(
				'type' => 'textarea_safe',
				'heading' => __( 'Custom query', 'js_composer' ),
				'param_name' => 'custom_query',
				'description' => __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'js_composer' ),
				'dependency' => array(
					'element' => 'post_type',
					'value' => array( 'custom' ),
				),
			),
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Narrow data source', 'js_composer' ),
				'param_name' => 'taxonomies',
				'settings' => array(
					'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true,
					// auto focus input, default true
				),
				'param_holder_class' => 'vc_not-for-custom',
				'description' => __( 'Enter categories, tags or custom taxonomies.', 'js_composer' ),
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Total items', 'js_composer' ),
				'param_name' => 'max_items',
				'value' => 10,
				// default value
				'param_holder_class' => 'vc_not-for-custom',
				'description' => __( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'js_composer' ),
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
			),
			// Data settings
			array(
				'type' => 'dropdown',
				'heading' => __( 'Order by', 'js_composer' ),
				'param_name' => 'orderby',
				'value' => array(
					__( 'Date', 'js_composer' ) => 'date',
					__( 'Order by post ID', 'js_composer' ) => 'ID',
					__( 'Author', 'js_composer' ) => 'author',
					__( 'Title', 'js_composer' ) => 'title',
					__( 'Last modified date', 'js_composer' ) => 'modified',
					__( 'Post/page parent ID', 'js_composer' ) => 'parent',
					__( 'Number of comments', 'js_composer' ) => 'comment_count',
					__( 'Menu order/Page Order', 'js_composer' ) => 'menu_order',
					__( 'Meta value', 'js_composer' ) => 'meta_value',
					__( 'Meta value number', 'js_composer' ) => 'meta_value_num',
					__( 'Random order', 'js_composer' ) => 'rand',
				),
				'description' => __( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'js_composer' ),
				'group' => __( 'Data Settings', 'js_composer' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Sort order', 'js_composer' ),
				'param_name' => 'order',
				'group' => __( 'Data Settings', 'js_composer' ),
				'value' => array(
					__( 'Descending', 'js_composer' ) => 'DESC',
					__( 'Ascending', 'js_composer' ) => 'ASC',
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'description' => __( 'Select sorting order.', 'js_composer' ),
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Meta key', 'js_composer' ),
				'param_name' => 'meta_key',
				'description' => __( 'Input meta key for grid ordering.', 'js_composer' ),
				'group' => __( 'Data Settings', 'js_composer' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency' => array(
					'element' => 'orderby',
					'value' => array(
						'meta_value',
						'meta_value_num',
					),
				),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Offset', 'js_composer' ),
				'param_name' => 'offset',
				'description' => __( 'Number of grid elements to displace or pass over.', 'js_composer' ),
				'group' => __( 'Data Settings', 'js_composer' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
			),
			array(
				'type' => 'autocomplete',
				'heading' => __( 'Exclude', 'js_composer' ),
				'param_name' => 'exclude',
				'description' => __( 'Exclude posts, pages, etc. by title.', 'js_composer' ),
				'group' => __( 'Data Settings', 'js_composer' ),
				'settings' => array(
					'multiple' => true,
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
					'callback' => 'vc_grid_exclude_dependency_callback',
				),
			),
			// Extras
            array(
                "type" => "dropdown",
                "heading" => "Show Title",
                "param_name" => "show_title",
                "value" => array(
                    "Yes" => "yes",
                    "No" => "no"
                ),
                "default" => "yes",
                "description" => __( 'Show the post title', 'hiiwp' ),
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
                "description" => __( 'Show the post excerpt', 'hiiwp' ),
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
                "description" => __( 'Show Read More button', 'hiiwp' ),
				'save_always' => true,
                "description" => "",
				'admin_label' => true
            ),
            array(
                "type" => "textfield",
                "heading" => "Button Text",
                "param_name" => "btn_text",
                "value" => "Read More",
                "description" => __( 'Change Read More button text', 'hiiwp' ),
				'save_always' => true,
				'admin_label' => true,
				'dependency' => array(
					'element' => 'show_btn',
					'value' => 'yes',
				)
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'autoplay',
				'value' => array(
					__( 'None', 'hiiwp' ) => 'none',
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
				'heading' => __( 'Autoplay', 'hiiwp' ),
				'description' => __( 'Select auto rotate for carousel in seconds (Note: disabled by default).', 'hiiwp' ),
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
				'heading' => __( 'CSS box', 'hiiwp' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'hiiwp' ),
			)
		)
) );
 
// Portfolio
if($hiilite_options['portfolio_on']):
	$title = get_theme_mod( 'portfolio_title', 'Portfolio' );
	$portfolio_slug = get_theme_mod( 'portfolio_slug', 'portfolio' );
	$tax_title = get_theme_mod( 'portfolio_tax_title', 'Work' );
	$portfolio_tax_slug = get_theme_mod( 'portfolio_tax_slug', 'work' );

	$sections = get_terms($portfolio_tax_slug);
	$hiilite_options['portfolio_work']['all'] = 'All';
	foreach($sections as $section){
		$hiilite_options['portfolio_work'][$section->name] = $section->slug;
	}
	vc_map( array(
		"name" => $title,
		"base" => "portfolio",
		"category" => 'by Hiilite',
		"description" => "Show your portfolio work",
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/layout-boxed.png",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Work",
				"param_name" => "section",
				"default"	=> "all",
				"value" => $hiilite_options['portfolio_work']
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => "Image Style",
				"param_name" => "portfolio_image_style",
				'save_always' => true,
				"value" => array(
					'Default' => 'default',
					'Square' => 'square',
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Info Box",
				"param_name" => "portfolio_show_info",
				'save_always' => true,
				"value" => true,
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => "Image Position",
				"param_name" => "portfolio_image_pos",
				'save_always' => true,
				"value" => array(
					'Image Behind' => 'image-behind',
					'Image Left' => 'image-left',
					'Image Above' => 'image-above',
				),
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Title",
				'save_always' => true,
				"param_name" => "show_title",
				"value" => true,
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Heading tag",
				"param_name" => "portfolio_heading_size",
				"value" => array(
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
				"heading" => "Is Slider",
				"param_name" => "is_slider",
				"value" => true,
			),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'hiiwp' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'hiiwp' ),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Show Arrows'),
			'param_name'=> 'show_arrows',
			'value'		=> 'true',
			'std' 		=> 'true',
			'group'		=> __('Arrows', 'hiiwp'),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Hide Arrows on Mobile'),
			'param_name'=> 'hide_arrows_on_mobile',
			'value'		=> false,
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Icon'),
			'param_name'=> 'arrow_icon',
			'class'		=> 'fa',
			'value'		=> array(
				'Arrow' => 'arrow',
				'Arrow Circle' => 'arrow-alt-circle',
				'Caret' => 'caret',
				'Chevron' => 'chevron',
				'Chevron Circle' => 'chevron-circle',
			),
			'std' 		=> 'chevron',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Size'),
			'param_name'=> 'arrow_size',
			'value'		=> array(
				'Small' => 'small',
				'Regular' => 'regular',
				'Large' => 'large',
			),
			'std' 		=> 'regular',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Background Type'),
			'param_name'=> 'arrow_background_type',
			'class'		=> 'fa',
			'value'		=> array(
				'No Background'	=> 'none',
				'Circle'		=> 'circle',
				'Square'		=> 'square',
				'Rounded Square'=> 'round-square',
			),
			'std' 		=> 'none',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Color'),
			'param_name'=> 'arrow_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#333333',
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Background Color'),
			'param_name'=> 'arrow_background_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#ffffff',
			'dependency' => array(
				'element' => 'arrow_background_type',
				'value_not_equal_to' => array(
						'none',
					),
			),
		),
/* end slider standard */
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
	        ),
			
		)
	) );
endif; // end portfolio_on


// TESTIMONIALS
if($hiilite_options['testimonials_on']):
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
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/comments.png",
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
					'Circle' => 'circle',
					'As Background' => 'ad_background',
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
					'above' => 'above',
					//'right' => 'right',
					'bottom' => 'bottom',
					//'left' => 'left',
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
/* slider standards */
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Slider Layout'),
			'param_name'=> 'slider_layout',
			'description' => __( 'Responsive: will fit to the content within the slider (ideal for slides with text content). Fixed: Will maintain a fixed aspect ratio based on an initially set width and height (ideal for background image only sliders)', 'hiiwp' ),
			'value'		=> array(
				'Responsive' => 'responsive',
				'Fixed' => 'fixed',
			),
			'std' 		=> 'responsive',
			'dependency' => array(
				'element' => 'is_slider',
				'value' => 'true',
			),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Width', 'hiiwp' ),
			'param_name' => 'slider_width',
			'value'		 => '1100',
			'description' => __( '(px) Slider will scale, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'fixed',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Height', 'hiiwp' ),
			'param_name' => 'slider_height',
			'value'		 => '530',
			'description' => __( '(px) Slider will scale, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'fixed',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Min Height', 'hiiwp' ),
			'param_name' => 'slider_min_height',
			'value'		 => '530',
			'description' => __( 'Site a minimum height the slider can scale down too.', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'responsive',
			),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'autoplay',
			'value' => array(
				__( 'None', 'hiiwp' ) => 'none',
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
			'heading' => __( 'Autoplay', 'hiiwp' ),
			'description' => __( 'Select auto rotate for pageable in seconds (Note: disabled by default).', 'hiiwp' ),
			'dependency' => array(
				'element' => 'is_slider',
				'value' => 'true',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'hiiwp' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'hiiwp' ),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Show Arrows'),
			'param_name'=> 'show_arrows',
			'value'		=> 'true',
			'std' 		=> 'true',
			'group'		=> __('Arrows', 'hiiwp'),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Hide Arrows on Mobile'),
			'param_name'=> 'hide_arrows_on_mobile',
			'value'		=> false,
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Icon'),
			'param_name'=> 'arrow_icon',
			'class'		=> 'fa',
			'value'		=> array(
				'Arrow' => 'arrow',
				'Arrow Circle' => 'arrow-alt-circle',
				'Caret' => 'caret',
				'Chevron' => 'chevron',
				'Chevron Circle' => 'chevron-circle',
			),
			'std' 		=> 'chevron',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Size'),
			'param_name'=> 'arrow_size',
			'value'		=> array(
				'Small' => 'small',
				'Regular' => 'regular',
				'Large' => 'large',
			),
			'std' 		=> 'regular',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Background Type'),
			'param_name'=> 'arrow_background_type',
			'class'		=> 'fa',
			'value'		=> array(
				'No Background'	=> 'none',
				'Circle'		=> 'circle',
				'Square'		=> 'square',
				'Rounded Square'=> 'round-square',
			),
			'std' 		=> 'none',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Color'),
			'param_name'=> 'arrow_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#333333',
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Background Color'),
			'param_name'=> 'arrow_background_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#ffffff',
			'dependency' => array(
				'element' => 'arrow_background_type',
				'value_not_equal_to' => array(
						'none',
					),
			),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Show Bullets'),
			'param_name'=> 'show_bullets',
			'value'		=> 'true',
			'std' 		=> 'true',
			'group'		=> __('Bullets', 'hiiwp'),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Bullet Color'),
			'param_name'=> 'bullet_color',
			'group'		=> __('Bullets', 'hiiwp'),
			'std'		=> '#ffffff',
			'dependency' => array(
				'element' => 'show_bullets',
				'value' => 'true'
			),
		),
/* end slider standard */
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
	        ),
			
		)
	) );
endif; // end testimonials_on

// TEAMS
if($hiilite_options['teams_on']):
	$title = get_theme_mod( 'team_title', 'Teams' );
	$teams_slug = get_theme_mod( 'team_slug', 'team' );
	$tax_title = get_theme_mod( 'team_tax_title', 'Position' );
	$teams_tax_slug = get_theme_mod( 'team_tax_slug', 'position' );

	$sections = get_terms($teams_tax_slug);
	$hiilite_options['team_positions']['all'] = 'All';
	foreach($sections as $section){
		$hiilite_options['team_positions'][$section->name] = $section->slug;
	}
	vc_map( array(
		"name" => $title,
		"base" => "teams",
		"category" => 'by Hiilite',
		"description" => "Show your team members",
		"icon" => esc_url( get_template_directory_uri() )."/images/icons/user-group.png",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Positions",
				"param_name" => "section",
				"default"	=> "all",
				"value" => $hiilite_options['team_positions']
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
					'Circle' => 'circle',
					'As Background' => 'ad_background',
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
					'above' => 'above',
					//'right' => 'right',
					'bottom' => 'bottom',
					//'left' => 'left',
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
/* slider standards 
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Slider Layout'),
			'param_name'=> 'slider_layout',
			'description' => __( 'Responsive: will fit to the content within the slider (ideal for slides with text content). Fixed: Will maintain a fixed aspect ratio based on an initially set width and height (ideal for background image only sliders)', 'hiiwp' ),
			'value'		=> array(
				'Responsive' => 'responsive',
				'Fixed' => 'fixed',
			),
			'std' 		=> 'responsive',
			'dependency' => array(
				'element' => 'is_slider',
				'value' => 'true',
			),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Width', 'hiiwp' ),
			'param_name' => 'slider_width',
			'value'		 => '1100',
			'description' => __( '(px) Slider will scale, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'fixed',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Height', 'hiiwp' ),
			'param_name' => 'slider_height',
			'value'		 => '530',
			'description' => __( '(px) Slider will scale, but needs a set width and height to calculate ratio for images', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'fixed',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Min Height', 'hiiwp' ),
			'param_name' => 'slider_min_height',
			'value'		 => '530',
			'description' => __( 'Site a minimum height the slider can scale down too.', 'hiiwp' ),
			'dependency' => array(
				'element' => 'slider_layout',
				'value' => 'responsive',
			),
		),
		
		array(
			'type' => 'dropdown',
			'param_name' => 'autoplay',
			'value' => array(
				__( 'None', 'hiiwp' ) => 'none',
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
			'heading' => __( 'Autoplay', 'hiiwp' ),
			'description' => __( 'Select auto rotate for pageable in seconds (Note: disabled by default).', 'hiiwp' ),
			'dependency' => array(
				'element' => 'is_slider',
				'value' => 'true',
			),
		),*/
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'hiiwp' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'hiiwp' ),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Show Arrows'),
			'param_name'=> 'show_arrows',
			'value'		=> 'true',
			'std' 		=> 'true',
			'group'		=> __('Arrows', 'hiiwp'),
		),
		array(
			'type'  	=> 'checkbox',
			'heading'	=> __('Hide Arrows on Mobile'),
			'param_name'=> 'hide_arrows_on_mobile',
			'value'		=> false,
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Icon'),
			'param_name'=> 'arrow_icon',
			'class'		=> 'fa',
			'value'		=> array(
				'Arrow' => 'arrow',
				'Arrow Circle' => 'arrow-alt-circle',
				'Caret' => 'caret',
				'Chevron' => 'chevron',
				'Chevron Circle' => 'chevron-circle',
			),
			'std' 		=> 'chevron',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Size'),
			'param_name'=> 'arrow_size',
			'value'		=> array(
				'Small' => 'small',
				'Regular' => 'regular',
				'Large' => 'large',
			),
			'std' 		=> 'regular',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'dropdown',
			'heading'	=> __('Arrow Background Type'),
			'param_name'=> 'arrow_background_type',
			'class'		=> 'fa',
			'value'		=> array(
				'No Background'	=> 'none',
				'Circle'		=> 'circle',
				'Square'		=> 'square',
				'Rounded Square'=> 'round-square',
			),
			'std' 		=> 'none',
			'group'		=> __('Arrows', 'hiiwp'),
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Color'),
			'param_name'=> 'arrow_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#333333',
			'dependency' => array(
				'element' => 'show_arrows',
				'value' => 'true',
			),
		),
		array(
			'type'  	=> 'colorpicker',
			'heading'	=> __('Arrow Background Color'),
			'param_name'=> 'arrow_background_color',
			'group'		=> __('Arrows', 'hiiwp'),
			'std'		=> '#ffffff',
			'dependency' => array(
				'element' => 'arrow_background_type',
				'value_not_equal_to' => array(
						'none',
					),
			),
		),
/* end slider standard */
			array(
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'hiiwp' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'hiiwp' ),
	        ),
			
		)
	) );
endif; // end teams_on

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
		'category' => __( 'Content', 'hiiwp' ),
		'description' => __( 'Just outputs Hello World', 'hiiwp' ),
		'post_type' => Vc_Grid_Item_Editor::postType(),
	);
	return $shortcodes;
}

?>