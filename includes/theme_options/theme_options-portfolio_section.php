<?php
/*
 // TODO: Add Horizontal Masonry option to portfolio_layout
 */

Kirki::add_panel( 'portfolio_panel', array(
    'priority'    => 7,
    'title'       => __( 'Portfolio', 'hiiwp' ),
    'description' => __( 'Portfolio settings', 'hiiwp' ),
    'icon' => 'dashicons-grid-view',
) );

Kirki::add_section( 'portfolio_section', array(
    'priority'    => 1,
    'title'       => __( 'Portfolio Page', 'hiiwp' ),
    'description' => __( 'Portfolio settings', 'hiiwp' ),
    'panel'       => 'portfolio_panel', 
) );


Kirki::add_section( 'portfolio_piece_section', array(
    'priority'    => 2,
    'title'       => __( 'Portfolio Piece', 'hiiwp' ),
    'description' => __( 'Portfolio piece settings', 'hiiwp' ),
    'panel'       => 'portfolio_panel',   
) );

include 'portfolio/portfolio_list.php';
include 'portfolio/portfolio_piece.php';
