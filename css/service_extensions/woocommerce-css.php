<?php
/**
 * HiiWP: Woocommerce-CSS
 *
 * Service extension CSS file for WooCommerce
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.1
 */
if(false): ?><style><?php endif; ?>
.woocommerce label {
    display: block;
}



/*
	PRODUCT GENERAL
*/
.woocommerce .woocommerce-breadcrumb,
.woocommerce .woocommerce-breadcrumb a {
	margin-bottom: 0;
	color: <?php echo Hii::$options['title_font']['color']; ?>;
	font-size:0.92rem;
	    width: 100%;
}
.woocommerce .products ul li, .woocommerce ul.products li {
    list-style: none outside;
}
.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
    float: left;
    margin: 0 3.8% 2.992em 0;
    padding: 0;
    position: relative;
    margin-left: 0;
}
.woocommerce .products ul, .woocommerce ul.products,
.woocommerce ul.product-categories {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    padding-left: 0;
    box-sizing: border-box; 
}
.woocommerce ul.products li.product .woocommerce-loop-product__link {
	display: inline-block;
    margin-bottom: auto;
}
.woocommerce ul.products li.product .button {
	margin-top: auto;
}
.woocommerce .sidebar ul.product-categories {
	display: block;
}
.woocommerce div.product .product_title {
    font-size: 40px;
    line-height: 1.5;
    margin-bottom:20px;
    display:inline-block;
}
.woocommerce .product_summary {
	padding:1em;
}
.woocommerce .products .star-rating {
    display: block;
    margin: 0.5em auto;
    float: none;
    text-align: center;
}
.woocommerce, .woocommerce div.product, .woocommerce_before_shop_loop, .woocommerce-page amp-carousel .slide li.product {
	width: 100%;
}

.woocommerce #content div.product div.images, .woocommerce div.product div.images, .woocommerce-page #content div.product div.images, .woocommerce-page div.product div.images, .woocommerce #content div.product div.summary, .woocommerce div.product div.summary, .woocommerce-page #content div.product div.summary, .woocommerce-page div.product div.summary {
    float: none;
    width: auto;
}
.woocommerce a.button,
.woocommerce button.button {
	<?php
	echo get_font_css(Hii::$options[ 'typography_button_default_font' ]);
	echo 'background:'.Hii::$options[ 'typography_button_default_background' ]['base'].';';
	echo 'padding:'.get_spacing(Hii::$options[ 'typography_button_default_padding' ]).';';
	echo 'border:'.
		Hii::$options['typography_button_default_border_width']. 
		' solid '.
		Hii::$options['typography_button_default_border_color']['base'].
		';';
	echo 'border-radius:'.Hii::$options[ 'typography_button_default_border_radius' ].';';
	//echo preg_replace('/[{}]/','',Hii::$options['typography_button_custom_css']);?>
}

.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {<?php 
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
.woocommerce #respond input#submit.disabled, .woocommerce #respond input#submit:disabled, .woocommerce #respond input#submit:disabled[disabled], .woocommerce a.button.disabled, .woocommerce a.button:disabled, .woocommerce a.button:disabled[disabled], .woocommerce button.button.disabled, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled], .woocommerce input.button.disabled, .woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled] {
	<?php echo 'padding:'.get_spacing(Hii::$options[ 'typography_button_default_padding' ]).';'; ?>
}
.woocommerce div.product p.price, .woocommerce div.product span.price {
    color: #525252;
}
.woocommerce ul.products li.product .price {
	font-size: 100%;
	font-weight: bold;
}
/*
.woocommerce.single-product .product.row {
    background: #f2f2f2;
}

.woocommerce.single-product .col-4.product_summary {
    background: #f2f2f2; 
}
*/
.up-sells h2 {
	padding-left: 1rem;
}

/*
	GALLERY
*/
.woocommerce.single-product .col-8.product_images {
    background: white;
}
.product_title_row figure.product-image-wrapper {
    margin-right: 1em;
    width: 40px;
    height: 40px;
    vertical-align: text-bottom;
    display: inline-block;
}

.woocommerce div.product .woocommerce-product-gallery--columns-4 .flex-control-thumbs li:nth-child(4n+1) {
	clear:none;
}
/* 
	CART
*/
.woocommerce div.product form.cart .variations td.label {
    padding: 1em;
}
.woocommerce div.product form.cart .nm-productmeta-box select {
    line-height: 3;
    text-indent: 1em;
}
.woocommerce div.product form.cart div.quantity, .woocommerce div.product form.cart .button {
    font-size: 16px;
    margin: auto;
    display: block;
}
.woocommerce div.product form.cart {
    clear: both;
}

.woocommerce div.product form.cart .nm-productmeta-box {
    display: flex;
    flex-wrap: wrap;
}

.woocommerce div.product form.cart .nm-productmeta-box
 > div {
    background: #efefef;
    padding: 1em;
    flex: 1 1 200px;
}

.woocommerce div.product form.cart .nm-productmeta-box
div:last-child {
    display: none;
}

.woocommerce .cart span.subscription-details {
    display: inline-block;
}

.woocommerce .cart .price > span.woocommerce-Price-amount.amount {
    font-size: 42px;
    font-weight: bold;
}

.woocommerce .cart .price {
    text-align: center;
}
/*
	ACCOUNTS
*/
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

/*
	MISC
*/

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

.woocommerce div.product .woocommerce-tabs .panel {
    padding: 1em;
}
.woocommerce ul.product-categories li.product mark {
	display:none;
}
ul.product-categories li.product a {
    display: block;
}


ul.products li.product, ul.product-categories li.product { 
    float: none;
    flex: 1 1 auto;
    margin: 1em;
    text-align: center;
    max-width: 300px;
    min-width: 160px;
    justify-content: space-between;
    flex-direction: column;
    display: flex;
}

.woocommerce ul.product-categories li.product a img {
    width: 100px;
    display: block;
    padding: 0.5em;
    margin: 0;
    vertical-align: middle;
    box-sizing: border-box;
    margin:auto;
	max-height: 40px;
}

ul.product-categories li.product a h2.woocommerce-loop-category__title {
    display: inline-block;
    padding-left: 30px;
}

ul.product-categories li.product {
    border: 1px solid #ccc;
    max-width: 100%;
    margin: 0.1em;
}
/* SUBSCRIPTIONS */
.woocommerce .subscription-details span.woocommerce-Price-amount.amount {
    margin-top: 0.5em;
}

/* CART */
.woocommerce-cart table.cart td.actions .coupon .input-text {
    padding: 7px;
    width: auto;
    line-height: 1.2;
}
@media only screen and (max-width: 1000px) {
	.woocommerce ul.products li.last, .woocommerce-page ul.products li.last {
		margin-right: 3.8% !important;
	}
}
@media only screen and (max-width: 768px) {
	.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
		width:46%;
	}
}

.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
	margin-right: 0;
}

.woocommerce-notices-wrapper {
	width:100%;
}
