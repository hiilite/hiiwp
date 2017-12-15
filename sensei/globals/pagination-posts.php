<?php
/**
 * Pagination - Posts
 *
 * @author 		WooThemes
 * @package 	Sensei/Templates
 * @version     1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="container_inner">';
	the_post_navigation( array(
						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'hiiwp' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'hiiwp' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper"><i class="fa fa-angle-left"></i></span>%title</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'hiiwp' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'hiiwp' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper"><i class="fa fa-angle-right"></i></span></span>',
					) );
echo '</div>';
?>
