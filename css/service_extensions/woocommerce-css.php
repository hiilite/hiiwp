<?php if(false): ?><style><?php endif; ?>
.woocommerce, .woocommerce div.product, .woocommerce_before_shop_loop{
	width: 100%;
}

.woocommerce #content div.product div.images, .woocommerce div.product div.images, .woocommerce-page #content div.product div.images, .woocommerce-page div.product div.images, .woocommerce #content div.product div.summary, .woocommerce div.product div.summary, .woocommerce-page #content div.product div.summary, .woocommerce-page div.product div.summary {
    float: none;
    width: auto;
}

.woocommerce-MyAccount-navigation ul  {
	list-style: none;
    padding: 0;
    margin: 0;
}
.woocommerce-MyAccount-navigation a {
	text-decoration: none;
	display:block;
	<?php 
	get_font_css($hiilite_options['main_menu_font']);
	?>
	<?=$hiilite_options['main_menu_links_css'];?>
}

.woocommerce-MyAccount-navigation li:hover {
	background: <?=$main_menu_colors['hover_background'];?>;
}
.woocommerce-MyAccount-navigation .current-menu-item a {
	color:<?=$main_menu_colors['active'];?>;
}
.woocommerce-MyAccount-navigation li:hover a {
	color:<?=$main_menu_colors['hover'];?>;
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