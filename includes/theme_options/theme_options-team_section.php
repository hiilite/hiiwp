<?php
//////////////////////
//
//	TEAMS PANEL
//
//////////////////////
Kirki::add_panel( 'team_panel', array(
    'priority'    => 7,
    'title'       => __( 'Teams', 'hiiwp' ),
    'description' => __( 'Teams settings', 'hiiwp' ),
    'icon' => 'dashicons-groups',
) );

Kirki::add_section( 'team_section', array(
    'priority'    => 1,
    'title'       => __( 'Team Page', 'hiiwp' ),
    'description' => __( 'Team settings', 'hiiwp' ),
    'panel'       => 'team_panel', 
) );


Kirki::add_section( 'team_member_section', array(
    'priority'    => 2,
    'title'       => __( 'Team Member Page', 'hiiwp' ),
    'description' => __( 'Team Member settings', 'hiiwp' ),
    'panel'       => 'team_panel',   
) );


include 'teams/team_list.php';
include 'teams/team_member.php';
