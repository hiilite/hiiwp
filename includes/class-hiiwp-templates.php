<?php
/**
 * The HiiWP Templats class.
 * Handles adding all template functions
 *
 * @package     HiiWP
 * @category    Core
 * @author      Peter Vigilante
 * @copyright   Copyright (c) 2019, Hiilite Creative Group
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       0.4.3
 */

/**
 * HiiWP_Templates class.
 * Handeles the connection of post type template files
 *
 * @since 0.4.3
 */
class HiiWP_Templates extends HiiWP {

	/**
	 * Returns an accessibility-friendly link to edit a post or page.
	 *
	 * This also gives us a little context about what exactly we're editing
	 * (post or page?) so that users understand a bit more where they are in terms
	 * of the template hierarchy and their content. Helpful when/if the single-page
	 * layout with multiple posts/pages shown gets confusing.
	 */
	public static function edit_link() {
		$link = '<span class="edit-link">';
		$link .= '<a class="post-edit-link" href="'.get_edit_post_link()."'>";
		$link .= sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'hiiwp' ),
					get_the_title()
				);
			
		$link .= '</a></span>';
		
	}
}