.button, .btn {
	-webkit-appearance: none;
	display: inline-block;
}
.button,
.btn,
.vc_general.vc_btn3, 
.vc_general.vc_btn3:focus, 
.vc_general.vc_btn3:hover, 
button.single_add_to_cart_button.button.alt, 
button.single_add_to_cart_button.button.alt.disabled.wc-variation-selection-needed { <?php 
	get_font_css(Hii::$options[ 'typography_button_default_font' ]);
	echo 'background:'.Hii::$options[ 'typography_button_default_background' ]['base'].';';
	echo 'padding:'.get_spacing(Hii::$options[ 'typography_button_default_padding' ]).';';
	echo 'border:'.
		Hii::$options['typography_button_default_border_width'].
		' solid '.
		Hii::$options['typography_button_default_border_color']['base'].
		';';
	echo 'border-radius:'.Hii::$options[ 'typography_button_default_border_radius' ].';';?>
}
<?php
if(strpos(Hii::$options['typography_button_custom_css'], '.button') === false) echo '.button { '.Hii::$options['typography_button_custom_css']. '}';
else echo Hii::$options['typography_button_custom_css'];
?>	
.button:hover,
.btn:hover {
	color: <?php echo Hii::$options['typography_button_default_hover_color']?>;
	background: <?php echo Hii::$options['typography_button_default_background']['hover']?>;
	border-color: <?php echo Hii::$options['typography_button_default_border_color']['hover']?>;
}
.btn:hover .fa,
.btn:hover svg {
	color: <?php echo Hii::$options['typography_button_default_hover_color']?>;
	fill: <?php echo Hii::$options['typography_button_default_hover_color']?>;
}

.button-primary,
.btn-primary, 
body .woocommerce #respond input#submit.alt, 
body .woocommerce a.button.alt, 
body .woocommerce button.button.alt, 
body .woocommerce input.button.alt { <?php 
	get_font_css(Hii::$options[ 'typography_button_primary_font' ]);
	echo 'background:'.Hii::$options[ 'typography_button_primary_background']['base'].';';
	echo 'padding:'.get_spacing(Hii::$options[ 'typography_button_primary_padding' ]).';';
	echo 'border: '.
		Hii::$options[ 'typography_button_primary_border_width'].
		' solid '.
		Hii::$options['typography_button_primary_border_color']['base'].
		';';
	echo 'border-radius:'.Hii::$options['typography_button_primary_border_radius'].';';?>
	display: inline-block;
}
<?php 
if(strpos(Hii::$options['typography_button_primary_custom_css'], '.button-primary') === false) echo '.button-primary { '.Hii::$options['typography_button_primary_custom_css']. '}';
else echo Hii::$options['typography_button_primary_custom_css'];
?>
.button-primary:hover,
.btn-primary:hover {
	color: <?php echo Hii::$options['typography_button_primary_hover_color']?>;
	background: <?php echo Hii::$options['typography_button_primary_background']['hover']?>;
	border-color: <?php echo Hii::$options['typography_button_primary_border_color']['hover']?>;
}
.btn-primary:hover .fa,
.btn-primary:hover svg {
	color: <?php echo Hii::$options['typography_button_primary_hover_color']?>;
	fill: <?php echo Hii::$options['typography_button_primary_hover_color']?>;
}

.button-secondary,
.btn-secondary { <?php 
	get_font_css(Hii::$options[ 'typography_button_secondary_font' ]);
	echo 'background:'.Hii::$options[ 'typography_button_secondary_background']['base'].';';
	echo 'padding:'.get_spacing(Hii::$options[ 'typography_button_secondary_padding' ]).';';
	echo 'border: '.Hii::$options[ 'typography_button_secondary_border_width'].' solid '.Hii::$options['typography_button_secondary_border_color']['base'].';';
	echo 'border-radius:'.Hii::$options['typography_button_secondary_border_radius'].';';?>
	display: inline-block;
}
.button-secondary .fa,
.btn-secondary .fa,
.button-secondary svg,
.btn-secondary svg {
	color: <?php echo Hii::$options['typography_button_secondary_font']['color'];?>;
	fill: <?php echo Hii::$options['typography_button_secondary_font']['color'];?>;
}
<?php
if(strpos(Hii::$options['typography_button_secondary_custom_css'], '.button-secondary') === false) echo '.button-secondary { '.Hii::$options['typography_button_secondary_custom_css']. '}';
else echo Hii::$options['typography_button_secondary_custom_css'];
?>
.button-secondary:hover,
.btn-secondary:hover {
	color: <?php echo Hii::$options['typography_button_secondary_hover_color']?>;
	background: <?php echo Hii::$options['typography_button_secondary_background']['hover']?>;
	border-color: <?php echo Hii::$options['typography_button_secondary_border_color']['hover']?>;
}
.btn-secondary:hover .fa,
.btn-secondary:hover svg {
	color: <?php echo Hii::$options['typography_button_secondary_hover_color']?>;
	fill: <?php echo Hii::$options['typography_button_secondary_hover_color']?>;
}
.button-dis { 
	border: 2px solid #989898;
	color: #989898;
}


.btn-group, .btn-group-vertical {
    position: relative;
    display: -ms-inline-flexbox;
    display: inline-flex;
    vertical-align: middle;
}

.btn-group>.btn-group:not(:last-child)>.btn, .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.btn-group>.btn-group:not(:first-child)>.btn, .btn-group>.btn:not(:first-child) {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
.btn-group>.btn-group:not(:first-child)>.btn, .btn-group>.btn:not(:first-child) {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}