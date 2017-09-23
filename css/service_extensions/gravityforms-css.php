<?php if(false): ?><style><?php endif; ?>
.gform_wrapper {
    padding: 1em;
}

body .gform_wrapper ul li.gfield {
    display: inline-block;
    flex: 1 1 auto;
    min-width: 30%;
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

body .gform_wrapper .top_label div.ginput_container {
    margin-top: 0;
}

body .gform_wrapper ul li.gfield.gform_rangeslider {
    min-width: 100%;
}

.gform_wrapper .gform_footer input.button, .gform_wrapper .gform_footer input[type=submit] { 
	cursor: pointer;
	<?php 
	get_font_css($hiilite_options[ 'typography_button_primary_font' ]);
	echo 'background:'.$hiilite_options[ 'typography_button_primary_background']['base'].';';
	echo 'padding:'.get_spacing($hiilite_options[ 'typography_button_primary_padding' ]).';';
	echo 'border: '.
		$hiilite_options[ 'typography_button_primary_border_width'].
		' solid '.
		$hiilite_options['typography_button_primary_border_color']['base'].
		';';
	echo 'border-radius:'.$hiilite_options['typography_button_primary_border_radius'].';';
	echo preg_replace('/[{}]/','',$hiilite_options['typography_button_primary_custom_css']);?>
}
.gform_wrapper .gform_footer input.button:hover, .gform_wrapper .gform_footer input[type=submit]:hover {
	color: white;
	background: <?php echo $hiilite_options['typography_button_primary_background']['hover']?>;
	border-color: <?php echo $hiilite_options['typography_button_primary_border_color']['hover']?>;
}
