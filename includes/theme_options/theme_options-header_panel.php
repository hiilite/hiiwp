<?php
Kirki::add_panel( 'header_panel', array(
    'priority'    => 3,
    'title'       => __( 'Header', 'hiiwp' ),
    'description' => __( 'Header settings', 'hiiwp' ),
    'icon' => 'dashicons-upload'
) );


include_once 'header/header.php';
include_once 'header/menus.php';
include_once 'header/header_top.php';
?>