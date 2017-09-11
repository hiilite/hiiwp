<?php if(false): ?><style><?php endif; ?>
.woocommerce, .woocommerce div.product, .woocommerce_before_shop_loop{
	width: 100%;
}

.woocommerce #content div.product div.images, .woocommerce div.product div.images, .woocommerce-page #content div.product div.images, .woocommerce-page div.product div.images, .woocommerce #content div.product div.summary, .woocommerce div.product div.summary, .woocommerce-page #content div.product div.summary, .woocommerce-page div.product div.summary {
    float: none;
    width: auto;
}
.woocommerce-account .woocommerce {
    display: flex;
    flex-wrap: wrap;
}
.woocommerce-account .woocommerce-MyAccount-navigation,
.woocommerce-account .woocommerce-MyAccount-content {
	box-sizing: border-box;
	width:auto;
}
.woocommerce-MyAccount-navigation {
	box-sizing: border-box;
	min-width: 120px;
	flex:1 1 25%;
	border-right: 1px solid #dad8da;
	border-left: 1px solid #dad8da;
}
.woocommerce-MyAccount-content {
	padding:1em;
	min-width: 300px;
	flex:1 1 75%;
}
.woocommerce-MyAccount-navigation ul  {
	list-style: none;
    padding: 0;
    margin: 0;
}
.woocommerce-account .woocommerce-MyAccount-navigation a {
	text-decoration: none;
	display:block;
    color: #515151;
    background-color: #ebe9eb;
    background: none;
    padding: 0.5em 1.5em 0.5em 1.5em;
    margin-bottom: 1px;
    font-weight: 600;
        font-weight: 600;
    border-bottom: 1px solid #ebe9eb;
}
.woocommerce-account .woocommerce-MyAccount-navigation a:hover {
	background-color: #dad8da;
}
.woocommerce table.shop_table {
    margin-top: 1em;
}
.woocommerce table.my_account_orders .button {
    margin-right: 0.4em;
}
ul.download-versions {
    list-style: none;
    padding: 0;
}
.woocommerce ul.products li.product .button {
	<?php
	get_font_css($hiilite_options[ 'typography_button_default_font' ]);
	echo 'background:'.$hiilite_options[ 'typography_button_default_background' ]['base'].';';
	echo 'padding:'.get_spacing($hiilite_options[ 'typography_button_default_padding' ]).';';
	echo 'border:'.
		$hiilite_options['typography_button_default_border_width'].
		' solid '.
		$hiilite_options['typography_button_default_border_color']['base'].
		';';
	echo 'border-radius:'.$hiilite_options[ 'typography_button_default_border_radius' ].';';
	echo preg_replace('/[{}]/','',$hiilite_options['typography_button_custom_css']);?>

}

.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {<?php 
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

.product_summary {
	padding:0 1em;
}
.woocommerce div.product form.cart div.quantity, .woocommerce div.product form.cart .button {
    float: none;
    display: inline-block;
}
.woocommerce div.product form.cart .variations td, .woocommerce div.product form.cart .variations th {
    vertical-align: middle;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li::before {
    content: none;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li::after {
    content: none;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li {
    margin: 0 -2px;
    border-radius: 2px 2px 0 0;
    flex: 1 1 auto;
    padding: 0;
}

.woocommerce div.product .woocommerce-tabs ul.tabs {
    display: flex;
    flex-wrap: wrap;
    padding: 0px 1px;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li a {
    display: block;
    padding: 0.5em 1em;
}

.woocommerce-tabs.wc-tabs-wrapper {
    border-left: 1px solid #d3ced2;
    border-right: 1px solid #d3ced2;
    border-bottom: 1px solid #d3ced2;
}

.woocommerce div.product .woocommerce-tabs .panel {
    padding: 1em;
}