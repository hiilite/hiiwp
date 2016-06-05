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
vc_remove_element("vc_message");
vc_remove_element("vc_tour");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_pie");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_toggle");

vc_remove_element("vc_facebook");
vc_remove_element("vc_tweetmeme");
vc_remove_element("vc_googleplus");
vc_remove_element("vc_pinterest");
vc_remove_element("vc_flickr");
//vc_remove_element("vc_empty_space");

vc_remove_element("vc_images_carousel");
vc_remove_element("vc_posts_grid");
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

vc_remove_element('vc_gallery');

// Title
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




// Button
vc_map( array(
		"name" => "Button",
		"base" => "button",
		"category" => 'by Hiilite',
		"icon" => "icon-wpb-ui-button",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			
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


// Social Share
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
	            'type' => 'css_editor',
	            'heading' => __( 'Css', 'my-text-domain' ),
	            'param_name' => 'css',
	            'group' => __( 'Design options', 'my-text-domain' ),
	        ),
		)
) );

// Social Share
vc_map( array(
		"name" => "Social Profiles",
		"base" => "social-profiles",
		"category" => 'by Hiilite',
		"description" => "Display your social media profiles",
		"icon" => "icon-wpb-flickr",
		"allowed_container_element" => 'vc_row',
		"params" => array(
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
				"heading" => "Pinterest",
				"param_name" => "pinterest"
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
				"heading" => "YouTube",
				"param_name" => "youtube"
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

// Media Gallery
vc_map( array(
		"name" => "Media Gallery",
		"base" => "media-gallery",
		"category" => 'by Hiilite',
		"description" => "Show links to all social profiles listed in Business Profiles",
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
				"heading" => "Show Meta",
				"param_name" => "show_post_meta"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Title",
				"param_name" => "show_post_title"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Padding",
				"param_name" => "add_padding"
			),
		)
	)
);


// Social Share
vc_map( array(
		"name" => "Media Gallery",
		"base" => "media-gallery",
		"category" => 'by Hiilite',
		"description" => "Show links to all social profiles listed in Business Profiles",
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
				"heading" => "Show Meta",
				"param_name" => "show_post_meta"
			),
			array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => "Show Title",
				"param_name" => "show_post_title"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Padding",
				"param_name" => "add_padding"
			),
		)
	)
);


// Social Share
vc_map( array(
		"name" => "AMP Carousel",
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
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Height",
				"param_name" => "height",
				"default"	=> "300"
			),
		)
) );

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




?>