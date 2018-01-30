<?php
/**
 * The HiiWP Shortcodes class.
 * Handles adding all admin options
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2017, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.3
 */

/**
 * HiiWP_Shortcodes class.
 * Handels the creation of shortcodes, including the output of front end CSS, JS, and display of options panels
 *
 * @since 0.4.3
 */
class HiiWP_Shortcodes extends HiiWP {
	
	public function __construct(){
		/* Add with options in Custumizer */
		if(get_theme_mod( 'blog_author_bio' ) == true){
			require_once( HIILITE_DIR . '/includes/shortcodes/author-info.php');
		}
	}
	
}