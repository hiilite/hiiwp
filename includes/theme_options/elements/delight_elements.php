<?php
/**
 * HiiWP: Delight Element Settings
 *
 * Adds the customizer settings for the various delight elements
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.2
 */
 
$section = 'delight_elements_section';
Kirki::add_section( $section, array(
    'priority'    => 4,
    'title'       => __( 'Delight Elements', 'hiiwp' ),
    'panel'		 => 'elements_panel',
) );

Kirki::add_field( 'hiiwp', array(
    'type'        => 'switch',
    'settings'    => 'list_anim_yesno',
    'label'       => __( 'Enable List Animations', 'hiiwp' ),
    'description'  => __( 'Enabling this option will fade in list items with a delay', 'hiiwp' ),
    'section'     => $section,
    'default'     => $hiilite_options['list_anim_yesno'],
    'priority'    => 1,
) );