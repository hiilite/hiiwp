<?php if(false): ?><style><?php endif; ?>
.gform_wrapper {
    padding: 1em;
}
.gform_fields {
	padding: 0;
	list-style: none; 
}

.ginput_full {
    width: 100%;
}
.gfield {
    margin-bottom: 2em;
}
.gform_wrapper input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]) {
	padding:1em;
}
.gform_wrapper .chosen-container-single .chosen-single,.gform_wrapper.gf_browser_chrome .ginput_complex .ginput_right select, .gform_wrapper.gf_browser_chrome .ginput_complex select {
	height: 3.4em;
    margin-top: 0;
    line-height: 3; 
}

.gfield span label { 
    /* width: 100%; */
    display: inline-block;
    position: relative;
    left: 0;
    font-size: 12px;
}

.gfield span {
    position: relative;
    display: inline-block;
}

body .gform_wrapper ul li.gfield {
    display: inline-block;
    flex: 1 1 auto;
    min-width: 30%;
}
body .gform_wrapper ul li.gsection {
	min-width: 100%;
	display: block;
}
.gform_wrapper ul.gform_fields {
    display: flex;
    flex-wrap: wrap;
}

.gform_wrapper .top_label input.medium, .gform_wrapper .top_label select.medium {
    width: 100%;
}

.gform_wrapper li.hidden_label input {
    margin-top: 0;
}
.gform_wrapper.gf_browser_chrome select {
    padding: 13px;
}
body .gform_wrapper .top_label div.ginput_container {
    margin-top: 0;
}

body .gform_wrapper ul li.gfield.gform_rangeslider {
    min-width: 100%;
}

.gform_wrapper .gform_footer input.button, .gform_wrapper .gform_footer input[type=submit] { 
	cursor: pointer;
	<?php 
	get_font_css(Hii::$options[ 'typography_button_primary_font' ]);
	echo 'background:'.Hii::$options[ 'typography_button_primary_background']['base'].';';
	echo 'padding:'.get_spacing(Hii::$options[ 'typography_button_primary_padding' ]).';';
	echo 'border: '.
		Hii::$options[ 'typography_button_primary_border_width'].
		' solid '.
		Hii::$options['typography_button_primary_border_color']['base'].
		';';
	echo 'border-radius:'.Hii::$options['typography_button_primary_border_radius'].';';
	echo preg_replace('/[{}]/','',Hii::$options['typography_button_primary_custom_css']);?>
}
.gform_wrapper .gform_footer input.button:hover, .gform_wrapper .gform_footer input[type=submit]:hover {
	color: white;
	background: <?php echo Hii::$options['typography_button_primary_background']['hover']?>;
	border-color: <?php echo Hii::$options['typography_button_primary_border_color']['hover']?>;
}
