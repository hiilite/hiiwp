<?php
global $hiilite_options;


/*** Removing shortcodes ***/
//vc_remove_element("vc_widget_sidebar");
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
//vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_text");
//vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
//vc_remove_element("vc_wp_categories");
//vc_remove_element("vc_wp_archives");
//vc_remove_element("vc_wp_rss");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");
//vc_remove_element("vc_message");
vc_remove_element("vc_tour");
//vc_remove_element("vc_progress_bar");
//vc_remove_element("vc_pie");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_toggle");

//vc_remove_element("vc_facebook");
//vc_remove_element("vc_tweetmeme");
//vc_remove_element("vc_googleplus");
//vc_remove_element("vc_pinterest");
//vc_remove_element("vc_flickr");
//vc_remove_element("vc_empty_space");

//vc_remove_element("vc_images_carousel"); 
//vc_remove_element("vc_posts_grid");
//vc_remove_element("vc_carousel");
//vc_remove_element("vc_cta");
//vc_remove_element("vc_round_chart");
//vc_remove_element("vc_line_chart");
vc_remove_element("vc_tta_accordion");
vc_remove_element("vc_tta_tour");
vc_remove_element("vc_tta_tabs");

//vc_remove_element('vc_basic_grid');
//vc_remove_element('vc_media_grid');
vc_remove_element('vc_masonry_grid');
vc_remove_element('vc_masonry_media_grid');
//vc_remove_element('vc_icon');
vc_remove_element('vc_button2');
//vc_remove_element("vc_custom_heading");
vc_remove_element("vc_btn");  

//vc_remove_element('vc_gallery');
vc_remove_element('vc_separator');
vc_remove_element('vc_text_separator');



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
			'type' => 'dropdown',
			'heading' => __( 'Background Color', 'js_composer' ),
			'param_name' => 'background_palette',
			'value' => array(
				'None' => '',
				'Color One' => 'bg_color_one',
				'Color Two' => 'bg_color_two',
				'Color Three' => 'bg_color_three',
				'Color Four' => 'bg_color_four',
				'White' => 'bg_white',
			),
			'std' => '0',
			'description' => __( 'Select from your predefined theme colors', 'js_composer' ),
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
				__( 'Down (Top to Bottom)', 'js_composer' ) => 'column',
				__( 'Up (Bottom to Top)', 'js_composer' ) => 'column-reverse',
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
		array(
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
		),
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
		array(
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
		),
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
			'type' => 'dropdown',
			'heading' => __( 'Background Color', 'js_composer' ),
			'param_name' => 'background_palette',
			'value' => array(
				'None' => '',
				'Color One' => 'bg_color_one',
				'Color Two' => 'bg_color_two',
				'Color Three' => 'bg_color_three',
				'Color Four' => 'bg_color_four',
				'White' => 'bg_white',
			),
			'std' => '0',
			'description' => __( 'Select from your predefined theme colors', 'js_composer' ),
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
				__( 'Down (Top to Bottom)', 'js_composer' ) => 'column',
				__( 'Up (Bottom to Top)', 'js_composer' ) => 'column-reverse',
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
		array(
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
		),
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
		array(
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
		),
		array(
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
		),
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
		array(
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
		),
		array(
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
		),
		array(
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
		),
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
		array(
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
		),
		array(
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
		),
		array(
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
		),
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




////////////////////////////
//
//	Title
//
/////////////////////////////
vc_map( array(
		"name" => "Title",
		"base" => "title",
		"category" => 'by Hiilite',
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
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Size",
				"param_name" => "size",
				"value" => array(
					"h1" => "h1",
                    "h2" => "h2",
					"h3" => "h3",	
					"h4" => "h4",
					"h5" => "h5",
					"h6" => "h6"
				)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Color",
				"param_name" => "color",
				"value" => array(
					"Default" => "",
                    "Color 1" => "color_one",
					"Color 2" => "color_two",	
					"Color 3" => "color_three",
					"Color 4" => "color_four",
					"White" => "white"
				)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Align",
				"param_name" => "align",
				"value" => array(
					"None" => "",
					"Center" => "align-center",
                    "Left" => "align-left",
					"Right" => "align-right"
				)
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
			"category" => 'by Hiilite',
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
		"category" => 'by Hiilite',
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
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Link",
				"param_name" => "link"
			),
			
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Link Target",
				"param_name" => "target",
				"value" => array(
					"Self" => "_self",
					"Blank" => "_blank",	
					"Parent" => "_parent",
					"Top" => "_top"	
				),
				'save_always' => true
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
		"category" => 'by Hiilite',
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
					"" => "",
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
		"category" => 'by Hiilite',
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
					"Theme Default" => "default",
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
		"category" => 'by Hiilite',
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
//	Post Grid
//
/////////////////////////////
vc_map( array(
		"name" => "Media Gallery",
		"base" => "media-gallery",
		"category" => 'by Hiilite',
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
		"name" => "AMP Image Carousel",
		"base" => "amp-carousel",
		"category" => 'by Hiilite',
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
		),
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
//	Multi Screen Showcase
//
///////////////////////////// 
vc_map( array(
		"name" => "Multi Screen Showcase",
		"base" => "screen-showcase",
		"category" => 'by Hiilite',
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
/////////////////////////////
vc_map( array(
		"name" => "Empty Space",
		"base" => "vc_empty_space",
		"category" => 'by Hiilite',
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

// Menu
/*  Section (All, loop), 
	Title Tag (span,p,h3,h4,h5.h6), 
	Ingredients (span,p,hide), 
	Seperator (-,|,<br>),
	Price (span,p,h3,h4,h5,h6,hide)
	
*/

vc_add_param( 'vc_row', array(
    'type' => 'css_editor',
    'heading' => __( 'Css', 'my-text-domain' ),
    'param_name' => 'css',
    'group' => __( 'Design options', 'my-text-domain' ),
));

vc_remove_param( "vc_column_text", "css_animation" );

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
    'type' => 'attach_image',
    'heading' => __( 'Hover Image', 'my-text-domain' ),
    'description'	=> __('The hover image should be the same dimensions as the original image','hiiwp'),
    'param_name' => 'hover_image',
));
vc_remove_param( "vc_single_image", "style" ); 



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


if(class_exists('SrUtils')):
	
	////////////////////////////
	//
	//	SimplyRETS Listings
	//
	/////////////////////////////
	vc_map( array(
			"name" => "RETS Listings",
			"base" => "sr_listings",
			"category" => 'SimplyRETS',
			"description" => "Show all listings from your MLS",
			"icon" => "icon-wpb-images-carousel",
			"allowed_container_element" => 'vc_row',
			"params" => array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Agent",
					"param_name" => "agent"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Min Price",
					"param_name" => "minprice"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Min Price",
					"param_name" => "minprice"
				),
			)
	) );
	
	////////////////////////////
	//
	//	SimplyRETS Listings
	//
	/////////////////////////////
	vc_map( array(
			"name" => "RETS Search Form",
			"base" => "sr_search_form",
			"category" => 'SimplyRETS',
			"description" => "Show all listings from your MLS",
			"icon" => "icon-wpb-images-carousel",
			"allowed_container_element" => 'vc_row',
			"params" => array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Brokers",
					"param_name" => "brokers"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Type",
					"param_name" => "type"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Min Price",
					"param_name" => "minprice"
				),
			)
	) );
	
	////////////////////////////
	//
	//	SimplyRETS Listings
	//
	/////////////////////////////
	vc_map( array(
			"name" => "RETS Listings Slider",
			"base" => "sr_listings_slider",
			"category" => 'SimplyRETS',
			"description" => "Show all listings from your MLS",
			"icon" => "icon-wpb-images-carousel",
			"allowed_container_element" => 'vc_row',
			"params" => array(
				array(
					"type" => "checkbox",
					"holder" => "div",
					"class" => "",
					"heading" => "Random",
					"param_name" => "random"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Min Price",
					"param_name" => "minprice"
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Agent ID",
					"param_name" => "agent"
				),
			)
	) );

endif;

////////////////////////////
//
//	SimplyRETS Listings
//
/////////////////////////////
vc_map( array(
		"name" => "Calculation Table",
		"base" => "calculation_table",
		"category" => 'Real Estate',
		"description" => "Add fields to be calculated for an average",
		"icon" => "icon-wpb-table",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				'type'	=> 'param_group',
				'value'	=> 'Listing',
				'heading'	=> 'Listing Row',
				'param_name'	=> 'listings',
				'params'	=> array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"edit_field_class" => "vc_col-xs-4",
						"heading" => "Style",
						"param_name" => "home_style",
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"edit_field_class" => "vc_col-xs-1",
						"heading" => "Beds",
						"param_name" => "beds",
						"value"	=> array(
							"1" => "1",	
							"2" => "2",	
							"3" => "3",	
							"4" => "4",	
							"5" => "5",	
							"6" => "6",	
							"7" => "7",	
						),
						
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"edit_field_class" => "vc_col-xs-1",
						"heading" => "Baths",
						"param_name" => "baths",
						"value"	=> array(
							"1" => "1",	
							"2" => "2",	
							"3" => "3",	
							"4" => "4",	
							"5" => "5",	
							"6" => "6",	
							"7" => "7",	
						),
						
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"edit_field_class" => "vc_col-xs-2",
						"heading" => "Sq. Ft",
						"param_name" => "sqft",
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"edit_field_class" => "vc_col-xs-2",
						"heading" => "Sold $",
						"param_name" => "sold",
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"edit_field_class" => "vc_col-xs-2",
						"heading" => "Days On Market",
						"param_name" => "dom",
					),
				),
			),
			
		),
		
) );

vc_add_shortcode_param( 'date', 'date_settings_field' );
function date_settings_field( $settings, $value ) {
   return '<div class="date_block">'
             .'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
             esc_attr( $settings['param_name'] ) . ' ' .
             esc_attr( $settings['type'] ) . '_field" type="date" value="' . esc_attr( $value ) . '" />' .
             '</div>'; // This is html markup that will be outputted in content elements edit form
}



?>