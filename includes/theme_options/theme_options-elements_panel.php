<?php
Kirki::add_panel( 'elements_panel', array(
    'priority'    => 6,
    'title'       => __( 'Elements', 'hiiwp' ),
    'icon' => 'dashicons-welcome-widgets-menus'
) );	

include_once 'elements/buttons.php';
?>