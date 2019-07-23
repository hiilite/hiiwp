<?php
/**
 * HiiWP Template: portfolio-single-loop
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
$hiilite_options = Hii::$hiiwp->get_options();
if($hiilite_options['portfolio_template'] == 'split') {
	get_template_part('templates/portfolio-content-split', 'loop');
}
else {
	get_template_part('templates/portfolio-content-default', 'loop');
}										
?>