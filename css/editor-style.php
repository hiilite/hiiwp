<?php
global $hiilite_options;

$css = '.align-center {
	text-align: center;
}
.align-left {
	text-align: left;
}
.align-right {
	text-align: right;
}
.custom_format_1 {
	'.preg_replace('/[{}]/','',$hiilite_options['custom_format_1']).'
}
.custom_format_2 {
	'.preg_replace('/[{}]/','',$hiilite_options['custom_format_2']).'
}
.custom_format_3 {
	'.preg_replace('/[{}]/','',$hiilite_options['custom_format_3']).'
}';


$myfile = fopen(dirname( __FILE__ ) . "/editor-style.css", "w") or die("Unable to open file!");
fwrite($myfile, $css);
fclose($myfile);

echo $css;
?>