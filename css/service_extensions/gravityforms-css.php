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
	padding:13px;
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

.gform_wrapper .chosen-container-single .chosen-single {
	-webkit-appearance: none;
	border: 1px solid rgba(203, 203, 203, 1);
	max-width: 100%;
    border-radius: 0;
    background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%), linear-gradient(to right, #ccc, #ccc);
    background-position: calc(100% - 20px) 50%, calc(100% - 15px) 50%, calc(100% - 43px) 30%;
    background-size: 5px 5px, 5px 5px, 1px 2em;
    background-repeat: no-repeat;
    padding:13px 3em 13px 13px;
    text-indent: 1em;
    margin:2px 0;
    height: auto;
    line-height: 1.5;
}
.ui-datepicker-title select,
.ui-datepicker-title select:focus {
	text-indent: 0;
	-webkit-appearance: menulist;
	background-image: none;
}


.gform_wrapper ul.gfield_radio li input[value=gf_other_choice] {
	margin-right:0.6em;
}
input[value="gf_other_choice"] + input[type="text"] {
    padding: 0 !important;
    transition: all 0.4s;
    line-height: 1;
    border: none;
}
input[value="gf_other_choice"] + input[type="text"]:focus {
	padding: 13px !important;
	border: 1px solid rgba(203, 203, 203, 1);
}

.gform_wrapper .chosen-container-single .chosen-single div b {
    display: none;
}

select:focus {
    background-image: linear-gradient(45deg,<?php echo Hii::$options['color_one'];?> 50%,transparent 50%),linear-gradient(135deg,transparent 50%,<?php echo Hii::$options['color_one'];?> 50%),linear-gradient(to right,#ccc,#ccc);
    background-position: calc(100% - 15px) 50%,calc(100% - 20px) 50%,calc(100% - 43px) 30%;
    background-size: 5px 5px,4px 5px,1px 2em;
    background-repeat: no-repeat;
    border-color: <?php echo Hii::$options['color_one'];?>;
    box-shadow: 0 1px 4px rgb(77, 144, 254), inset 0 1px 4px rgb(77, 144, 254);
    outline: 0;
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
	echo get_font_css(Hii::$options[ 'typography_button_primary_font' ]);
	echo 'background:'.Hii::$options[ 'typography_button_primary_background']['base'].';';
	echo 'padding:'.get_spacing(Hii::$options[ 'typography_button_primary_padding' ]).';';
	echo 'border: '.
		Hii::$options[ 'typography_button_primary_border_width'].
		' solid '.
		Hii::$options['typography_button_primary_border_color']['base'].
		';';
	echo 'border-radius:'.Hii::$options['typography_button_primary_border_radius'].';';
	//echo preg_replace('/[{}]/','',Hii::$options['typography_button_primary_custom_css']);?>
}
.gform_wrapper .gform_footer input.button:hover, .gform_wrapper .gform_footer input[type=submit]:hover {
	color: white;
	background: <?php echo Hii::$options['typography_button_primary_background']['hover']?>;
	border-color: <?php echo Hii::$options['typography_button_primary_border_color']['hover']?>;
}
