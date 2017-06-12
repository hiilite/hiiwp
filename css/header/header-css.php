<?php if(false): ?><style><?php endif; ?>
header#main_header {
	position: relative;
	width: 100%;
	align-items: center;
	flex-wrap: wrap;
	z-index: 9999;
	transition: all 0.5s;
	<?php 
	if ($hiilite_options['header_above_content'] == false){ 
		echo 'position:absolute;'; 
	} 
	echo ($hiilite_options['header_background_image'] != '')?'background-image:url('.$hiilite_options['header_background_image'].');':'';
	echo 'background-repeat:'.$hiilite_options['header_background_repeat'].';';
	echo 'background-size:'.$hiilite_options['header_background_size'].';';
	echo 'background-attachment:'.$hiilite_options['header_background_attach'].';';
	echo 'background-position:'.str_replace('-', ' ', $hiilite_options['header_background_position']).';';
	echo 'background-color:'.$hiilite_options['header_background_color'].';';	
	?>
}
<?php
if($hiilite_options['header_top_home'] == true): ?>

	#header_top_pages {<?php
		echo ($hiilite_options['header_top_pages_background_image'] != '')?'background-image:url('.$hiilite_options['header_top_pages_background_image'].');':'';
		echo 'background-repeat:'.$hiilite_options['header_top_pages_background_repeat'].';';
		echo 'background-size:'.$hiilite_options['header_top_pages_background_size'].';';
		echo 'background-attachment:'.$hiilite_options['header_top_pages_background_attach'].';';
		echo 'background-position:'.str_replace('-', ' ', $hiilite_options['header_top_pages_background_position']).';';
		echo 'background-color:'.$hiilite_options['header_top_pages_background_color'].';';	
		echo 'height:'.$hiilite_options['header_top_pages_height'].';'; ?>
	}

<?php
endif;
?>

#main-nav {
	margin:<?=get_spacing($hiilite_options['menu_margin']);?>;
}
<?php
if($hiilite_options['header_type'] == 'centered') : ?>

	header.centered, 
	header.centered .container_inner,
	header.centered .in_grid,
	header.centered .main-menu,
	#main-nav .main-menu {
		justify-content: center;
		flex-wrap: wrap;
		text-align: center;
	}
	header.centered #main-nav, header.centered .search_button {
		margin: auto 0 auto 0;
		flex: 0 1 auto;
	}
	header.centered #logo_container {
		margin: auto;
		width:100%;
	}

<?php 
elseif($hiilite_options['header_type'] == 'fixed'):	?>
	header#main_header.fixed.scrolled {
	    position: fixed;
	    top: 0;
	    padding: 0;
	}
	header#main_header.fixed.scrolled #logo_container img {
	    width: auto;
	    max-height: 2em;
	    margin: 0.5em;
	}
	header#main_header.fixed.scrolled ~ section:first-of-type {
	    margin-top:5em !important;
	}
<?php
else: ?>
	#main_header .container_inner, #main_header .in_grid {
	    justify-content: space-between;
	}
<?php
endif;

if($hiilite_options['header_bottom_on'] == true) : ?>

#header_bottom_left, #header_bottom_right {
	width:50%;	
}
<?php
endif;
?>

@media (max-width:<?=$hiilite_options['grid_width'];?>){
	.container_inner {
		padding: 0em;
	}
}
<?php
if($hiilite_options['header_top_area_yesno'] == true):
	/*
	//  note: Header Top
	*/	
	$header_top_colors = get_theme_mod( 'header_top_colors' );
	?>
	#header_top {
		background: <?=get_theme_mod('header_top_background_color', '#f8f8f8');?>;
		border-top: <?=get_theme_mod('header_top_border_width', '0px').' solid '.get_theme_mod('header_top_border_color', 'transparent');?>;
		border-bottom: <?=get_theme_mod('header_bottom_border_width', '0px').' solid '.get_theme_mod('header_bottom_border_color', 'transparent');?>;
		<?php 
		get_font_css($hiilite_options['header_top_font']);
	?>
	}
	#header_top a{
		color:<?=$header_top_colors['link'];?>;
	}
	#header_top a:hover{
		color:<?=$header_top_colors['hover'];?>;
	}
	<?php if(get_theme_mod('hide_top_bar_on_mobile_yesno') == true): ?>
	@media (max-width:<?=get_theme_mod('mobile_menu_switch','768px')?>){
		#header_top {
			display:none;
		}
	}
	<?php 
	endif;
endif; ?>
#main_search {
	position: relative;
	display: none;
}
#main_search input.search-field {
    width: 100%;
    text-indent: 2em;
}
#main_search:before {
    position: absolute;
    left: 0;
    top: 0;
    padding: 1em 1.5em;
    font-family: FontAwesome;
    content: '\f002';
    
}


#header_bottom {
	border-bottom-style: solid;
}
#main_header #header_bottom .menu .menu-item a{
	<?php 
	get_font_css(get_theme_mod( 'header_bottom_font' ));
	?>
}

#header_bottom .bottom-menu {
	justify-content: center;
}


#logo_container {
    max-width: 100%;
    position: relative;
    <?php 
    foreach($hiilite_options['logo_padding'] as $key=>$value){
	    echo 'padding-'.$key.':'.$value.';';
    }
    ?>
}

#logo_container img {
    height: auto;
    transition: all 0.5s;
    
}
<?php
	
?>