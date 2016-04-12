<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return array(
	'name' => __( 'AMP Slider', 'js_composer' ),
	'base' => 'vc_tta_pageable',
	'icon' => 'icon-wpb-ui-pageable',
	'is_container' => true,
	'show_settings_on_create' => true,
	'as_parent' => array(
		'only' => 'vc_tta_section',
	),
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'AMP Slideshow carousel', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'hidden',
			'param_name' => 'no_fill_content_area',
			'std' => true,
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Slider Width', 'js_composer' ),
			'param_name' => 'slider_width',
			'value'		 => '1100',
			'description' => __( '(px) Slider is responsive, but needs a set width and height to calculate ratio for images', 'js_composer' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full Height', 'js_composer' ),
			'param_name' => 'slider_full_height',
			'value'		 => 'true',
			'description' => __( 'Set the slider to be the full height of the screen', 'js_composer' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Slider Height', 'js_composer' ),
			'param_name' => 'slider_height',
			'value'		 => '530',
			'description' => __( '(px) Slider is responsive, but needs a set width and height to calculate ratio for images', 'js_composer' ),
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
);
