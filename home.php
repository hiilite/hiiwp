<?php 
/* HiiWP Template: home
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2021, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.3
 */
get_header();
$hiilite_options = Hii::$hiiwp->get_options();

if(in_array('0', $hiilite_options['show_title_on'])) get_template_part( 'templates/title' );

get_template_part('templates/default', 'archive');

get_footer(); 