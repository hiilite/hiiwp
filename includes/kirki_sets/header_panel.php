<?php
Kirki::add_panel( 'header_panel', array(
    'priority'    => 3,
    'title'       => __( 'Header', 'textdomain' ),
    'description' => __( 'Header settings', 'textdomain' ),
    'icon' => 'dashicons-upload'
) );


include_once 'header/header.php';
include_once 'header/menus.php';
include_once 'header/header_top.php';
//include_once 'header/mobile_menu.php';

?>