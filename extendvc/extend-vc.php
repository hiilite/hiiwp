<?php

/*** Removing shortcodes ***/
vc_remove_element("vc_widget_sidebar");
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");
vc_remove_element("vc_message");
vc_remove_element("vc_tour");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_pie");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_toggle");
vc_remove_element("vc_images_carousel");
//vc_remove_element("vc_posts_grid");
vc_remove_element("vc_carousel");
vc_remove_element("vc_cta");
vc_remove_element("vc_round_chart");
vc_remove_element("vc_line_chart");
vc_remove_element("vc_tta_accordion");
vc_remove_element("vc_tta_tour");
vc_remove_element("vc_tta_tabs");

//vc_remove_element('vc_basic_grid');
vc_remove_element('vc_media_grid');
vc_remove_element('vc_masonry_grid');
vc_remove_element('vc_masonry_media_grid');
vc_remove_element('vc_icon');
vc_remove_element('vc_button2');
vc_remove_element("vc_custom_heading");
vc_remove_element("vc_btn");



vc_map( array(
		"name" => "Button",
		"base" => "button",
		"category" => 'by Hiilite',
		"icon" => "icon-wpb-button",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Style",
				"param_name" => "style",
				"value" => array(
					"Default" => "",
					"White" => "white"
				)
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
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "ID",
                "param_name" => "button_id",
                "description" => "Set unique button ID attribute"
            ),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Color",
				"param_name" => "color"
			),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Hover Color",
                "param_name" => "hover_color"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Background Color",
                "param_name" => "background_color"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Hover Background Color",
                "param_name" => "hover_background_color"
            ),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => "Border Color",
				"param_name" => "border_color"
			),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => "Hover Border Color",
                "param_name" => "hover_border_color"
            ),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Font Style",
				"param_name" => "font_style",
				"value" => array(
					"" => "",
					"Normal" => "normal",	
					"Italic" => "italic"
				)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Font Weight",
				"param_name" => "font_weight",
				"value" => array(
					"Default" => "",
					"Thin 100" => "100",
					"Extra-Light 200" => "200",
					"Light 300" => "300",
					"Regular 400" => "400",
					"Medium 500" => "500",
					"Semi-Bold 600" => "600",
					"Bold 700" => "700",
					"Extra-Bold 800" => "800",
					"Ultra-Bold 900" => "900"
				)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Text Align",
				"param_name" => "text_align",
				"value" => array(
					"" => "",
					"Left" => "left",	
					"Right" => "right",
					"Center" => "center"
				)
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Margin",
				"param_name" => "margin",
				"description" => __("Please insert margin in format: 0px 0px 1px 0px", 'qode')
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Border radius",
				"param_name" => "border_radius",
				"description" => __("Please insert border radius(Rounded corners) in px. For example: 4 ", 'qode')
			)
		)
) );


?>