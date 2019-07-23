<?php
/**
 * HiiWP: Elements Panel
 *
 * Adds the customizer the Elements panel
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.1
 */
Kirki::add_panel( 'elements_panel', array(
    'priority'    => 6,
    'title'       => __( 'Elements', 'hiiwp' ),
    'icon' => 'dashicons-welcome-widgets-menus'
) );	

include_once 'elements/buttons.php';
include_once 'elements/social_icons.php';
include_once 'elements/back_to_top.php';
?>