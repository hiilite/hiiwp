<?php
/* HiiWP Template: team-archive
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.3
 */
$hiilite_options = Hii::$hiiwp->get_options();
if(have_posts()):
	echo '<div class="row"><div class="container_inner"><div class="in_grid">';

	while(have_posts()):
		the_post();
		
		get_template_part('templates/team', 'loop');
		
		
	endwhile;
	hiilite_numeric_posts_nav();
	echo '</div></div></div>';

endif;