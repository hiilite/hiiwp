<?php
/**
 * HiiWP: Sidebar
 *
 * Loads sidebar widgets video the hii_sidebar hook
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2016, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.5.0
 */
$hiilite_options = Hii::get_options();
if ( ! is_active_sidebar( 'blog_sidebar' ) ) {
	return;
}
if ( $hiilite_options['blog_sidebar_show'] == true ) :
?>
<aside id="blog_sidebar" class="widget-area col-3 sidebar" role="complementary">
	<?php
	do_action( 'hii_before_sidebar' );
	
	dynamic_sidebar( 'blog_sidebar' );
	
	do_action( 'hii_after_sidebar' );
	?>
</aside>
<?php
endif;?>