<?php
/**
 * HiiWP Template: portfolio-single-loop
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Peter Vigilante
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
$hiilite_options = Hii::$hiiwp->get_options();
do_action( 'hii_before_portfolio_single' );
switch($hiilite_options['portfolio_template']):
	case 'split':
		get_template_part('templates/portfolio-content-split', 'loop');
	break;
	default;
		get_template_part('templates/portfolio-content-default', 'loop');
	break;
endswitch;
do_action( 'hii_after_portfolio_single' );