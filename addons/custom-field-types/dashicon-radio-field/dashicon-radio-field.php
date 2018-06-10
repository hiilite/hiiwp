<?php
/*
Plugin Name: CMB2 Dashicon Radio Field
Description: https://github.com/modemlooper/cmb2-dashicon-radio
Version: 1.0.0
Author: modemlooper
Author URI: http://twitter.com/modemlooper
License: GPL-2.0+
*/

/**
 * Custom render for dashicon_radio field
 *
 * @param  object $field
 * @param  string $escaped_value
 * @param  string $object_id
 * @param  string $object_type
 * @param  object $field_type_object
 * @return void
 */
function ml_cmb2_render_dashicon_radio_callback( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {

	add_filter( 'cmb2_list_input_attributes', 'ml_cmb2_dashicon_radio_attributes', 10, 4 );

	$field->args['options'] = ml_cmb2_dashicons_return_array();
	echo $field_type_object->radio();
	remove_filter( 'cmb2_list_input_attributes', 'ml_cmb2_dashicon_radio_attributes', 10, 4 );

	ml_cmb2_dashicon_radio_css();
}
add_action( 'cmb2_render_dashicon_radio', 'ml_cmb2_render_dashicon_radio_callback', 10, 5 );

/**
 * Custom labels for dashicon_radio inputs
 *
 * @param  array $args
 * @param  array $defaults
 * @param  object $field
 * @param  object $cmb
 * @return array
 */
function ml_cmb2_dashicon_radio_attributes( $args, $defaults, $field, $cmb ) {
	if ( $args['value'] ) {
		$args['label'] = '<span class="dashicons ' . $args['value'] . '"></span> ' . $args['label'];
	}

	return $args;
}

/**
 * Custom CMB2 css for dashicon_radio field
 *
 * @return void
 */
function ml_cmb2_dashicon_radio_css() {
	static $added = false;
	if ( $added ) {
		return;
	}
	$added = true;
	?>
	<style type="text/css" media="screen">
		.cmb-type-dashicon-radio .cmb-td {
			height: 200px;
			overflow: scroll;
			background-color: rgb(240, 240, 240);
		}
		.cmb-type-dashicon-radio .cmb2-radio-list {
			padding: 10px;

		}
		.cmb-type-dashicon-radio li {
			display: inline-block;
			min-width: 222px;
		}
	</style>
	<?php
}

/**
 * Returns array of dashicon data
 *
 * @return array
 */
function ml_cmb2_dashicons_return_array() {

	$icons = array(
		'dashicons-menu'                    => __( 'Menu', 'hiiwp' ),
		'dashicons-dashboard'               => __( 'Dashboard', 'hiiwp' ),
		'dashicons-admin-site'              => __( 'Admin Site', 'hiiwp' ),
		'dashicons-admin-media'             => __( 'Admin Media', 'hiiwp' ),
		'dashicons-admin-page'              => __( 'Admin Page', 'hiiwp' ),
		'dashicons-admin-comments'          => __( 'Admin Comments', 'hiiwp' ),
		'dashicons-admin-appearance'        => __( 'Admin Appearance', 'hiiwp' ),
		'dashicons-admin-plugins'           => __( 'Admin Plugins', 'hiiwp' ),
		'dashicons-admin-users'             => __( 'Admin Users', 'hiiwp' ),
		'dashicons-admin-tools'             => __( 'Admin Tools', 'hiiwp' ),
		'dashicons-admin-settings'          => __( 'Admin Settings', 'hiiwp' ),
		'dashicons-admin-network'           => __( 'Admin Network', 'hiiwp' ),
		'dashicons-admin-generic'           => __( 'Admin Generic', 'hiiwp' ),
		'dashicons-admin-home'              => __( 'Admin Home', 'hiiwp' ),
		'dashicons-admin-collapse'          => __( 'Admin Collapse', 'hiiwp' ),
		'dashicons-admin-links'             => __( 'Admin Links', 'hiiwp' ),
		'dashicons-admin-post'              => __( 'Admin Post', 'hiiwp' ),
		'dashicons-format-standard'         => __( 'Admin Plugins', 'hiiwp' ),
		'dashicons-format-image'            => __( 'Image Post Format', 'hiiwp' ),
		'dashicons-format-gallery'          => __( 'Gallery Post Format', 'hiiwp' ),
		'dashicons-format-audio'            => __( 'Audio Post Format', 'hiiwp' ),
		'dashicons-format-video'            => __( 'Video Post Format', 'hiiwp' ),
		'dashicons-format-links'            => __( 'Link Post Format', 'hiiwp' ),
		'dashicons-format-chat'             => __( 'Chat Post Format', 'hiiwp' ),
		'dashicons-format-status'           => __( 'Status Post Format', 'hiiwp' ),
		'dashicons-format-aside'            => __( 'Aside Post Format', 'hiiwp' ),
		'dashicons-format-quote'            => __( 'Quote Post Format', 'hiiwp' ),
		'dashicons-welcome-write-blog'      => __( 'Welcome Write Blog', 'hiiwp' ),
		'dashicons-welcome-edit-page'       => __( 'Welcome Edit Page', 'hiiwp' ),
		'dashicons-welcome-add-page'        => __( 'Welcome Add Page', 'hiiwp' ),
		'dashicons-welcome-view-site'       => __( 'Welcome View Site', 'hiiwp' ),
		'dashicons-welcome-widgets-menus'   => __( 'Welcome Widget Menus', 'hiiwp' ),
		'dashicons-welcome-comments'        => __( 'Welcome Comments', 'hiiwp' ),
		'dashicons-welcome-learn-more'      => __( 'Welcome Learn More', 'hiiwp' ),
		'dashicons-image-crop'              => __( 'Image Crop', 'hiiwp' ),
		'dashicons-image-rotate-left'       => __( 'Image Rotate Left', 'hiiwp' ),
		'dashicons-image-rotate-right'      => __( 'Image Rotate Right', 'hiiwp' ),
		'dashicons-image-flip-vertical'     => __( 'Image Flip Vertical', 'hiiwp' ),
		'dashicons-image-flip-horizontal'   => __( 'Image Flip Horizontal', 'hiiwp' ),
		'dashicons-undo'                    => __( 'Undo', 'hiiwp' ),
		'dashicons-redo'                    => __( 'Redo', 'hiiwp' ),
		'dashicons-editor-bold'             => __( 'Editor Bold', 'hiiwp' ),
		'dashicons-editor-italic'           => __( 'Editor Italic', 'hiiwp' ),
		'dashicons-editor-ul'               => __( 'Editor UL', 'hiiwp' ),
		'dashicons-editor-ol'               => __( 'Editor OL', 'hiiwp' ),
		'dashicons-editor-quote'            => __( 'Editor Quote', 'hiiwp' ),
		'dashicons-editor-alignleft'        => __( 'Editor Align Left', 'hiiwp' ),
		'dashicons-editor-aligncenter'      => __( 'Editor Align Center', 'hiiwp' ),
		'dashicons-editor-alignright'       => __( 'Editor Align Right', 'hiiwp' ),
		'dashicons-editor-insertmore'       => __( 'Editor Insert More', 'hiiwp' ),
		'dashicons-editor-spellcheck'       => __( 'Editor Spell Check', 'hiiwp' ),
		'dashicons-editor-distractionfree'  => __( 'Editor Distraction Free', 'hiiwp' ),
		'dashicons-editor-expand'           => __( 'Editor Expand', 'hiiwp' ),
		'dashicons-editor-contract'         => __( 'Editor Contract', 'hiiwp' ),
		'dashicons-editor-kitchensink'      => __( 'Editor Kitchen Sink', 'hiiwp' ),
		'dashicons-editor-underline'        => __( 'Editor Underline', 'hiiwp' ),
		'dashicons-editor-justify'          => __( 'Editor Justify', 'hiiwp' ),
		'dashicons-editor-textcolor'        => __( 'Editor Text Colour', 'hiiwp' ),
		'dashicons-editor-paste-word'       => __( 'Editor Paste Word', 'hiiwp' ),
		'dashicons-editor-paste-text'       => __( 'Editor Paste Text', 'hiiwp' ),
		'dashicons-editor-removeformatting' => __( 'Editor Remove Formatting', 'hiiwp' ),
		'dashicons-editor-video'            => __( 'Editor Video', 'hiiwp' ),
		'dashicons-editor-customchar'       => __( 'Editor Custom Character', 'hiiwp' ),
		'dashicons-editor-outdent'          => __( 'Editor Outdent', 'hiiwp' ),
		'dashicons-editor-indent'           => __( 'Editor Indent', 'hiiwp' ),
		'dashicons-editor-help'             => __( 'Editor Help', 'hiiwp' ),
		'dashicons-editor-strikethrough'    => __( 'Editor Strikethrough', 'hiiwp' ),
		'dashicons-editor-unlink'           => __( 'Editor Unlink', 'hiiwp' ),
		'dashicons-editor-rtl'              => __( 'Editor RTL', 'hiiwp' ),
		'dashicons-editor-break'            => __( 'Editor Break', 'hiiwp' ),
		'dashicons-editor-code'             => __( 'Editor Code', 'hiiwp' ),
		'dashicons-editor-paragraph'        => __( 'Editor Paragraph', 'hiiwp' ),
		'dashicons-align-left'              => __( 'Align Left', 'hiiwp' ),
		'dashicons-align-right'             => __( 'Align Right', 'hiiwp' ),
		'dashicons-align-center'            => __( 'Align Center', 'hiiwp' ),
		'dashicons-align-none'              => __( 'Align None', 'hiiwp' ),
		'dashicons-lock'                    => __( 'Lock', 'hiiwp' ),
		'dashicons-calendar'                => __( 'Calendar', 'hiiwp' ),
		'dashicons-visibility'              => __( 'Visibility', 'hiiwp' ),
		'dashicons-post-status'             => __( 'Post Status', 'hiiwp' ),
		'dashicons-edit'                    => __( 'Edit', 'hiiwp' ),
		'dashicons-post-trash'              => __( 'Post Trash', 'hiiwp' ),
		'dashicons-trash'                   => __( 'Trash', 'hiiwp' ),
		'dashicons-external'                => __( 'External', 'hiiwp' ),
		'dashicons-arrow-up'                => __( 'Arrow Up', 'hiiwp' ),
		'dashicons-arrow-down'              => __( 'Arrow Down', 'hiiwp' ),
		'dashicons-arrow-left'              => __( 'Arrow Left', 'hiiwp' ),
		'dashicons-arrow-right'             => __( 'Arrow Right', 'hiiwp' ),
		'dashicons-arrow-up-alt'            => __( 'Arrow Up (alt)', 'hiiwp' ),
		'dashicons-arrow-down-alt'          => __( 'Arrow Down (alt)', 'hiiwp' ),
		'dashicons-arrow-left-alt'          => __( 'Arrow Left (alt)', 'hiiwp' ),
		'dashicons-arrow-right-alt'         => __( 'Arrow Right (alt)', 'hiiwp' ),
		'dashicons-arrow-up-alt2'           => __( 'Arrow Up (alt 2)', 'hiiwp' ),
		'dashicons-arrow-down-alt2'         => __( 'Arrow Down (alt 2)', 'hiiwp' ),
		'dashicons-arrow-left-alt2'         => __( 'Arrow Left (alt 2)', 'hiiwp' ),
		'dashicons-arrow-right-alt2'        => __( 'Arrow Right (alt 2)', 'hiiwp' ),
		'dashicons-leftright'               => __( 'Arrow Left-Right', 'hiiwp' ),
		'dashicons-sort'                    => __( 'Sort', 'hiiwp' ),
		'dashicons-randomize'               => __( 'Randomise', 'hiiwp' ),
		'dashicons-list-view'               => __( 'List View', 'hiiwp' ),
		'dashicons-exerpt-view'             => __( 'Excerpt View', 'hiiwp' ),
		'dashicons-hammer'                  => __( 'Hammer', 'hiiwp' ),
		'dashicons-art'                     => __( 'Art', 'hiiwp' ),
		'dashicons-migrate'                 => __( 'Migrate', 'hiiwp' ),
		'dashicons-performance'             => __( 'Performance', 'hiiwp' ),
		'dashicons-universal-access'        => __( 'Universal Access', 'hiiwp' ),
		'dashicons-universal-access-alt'    => __( 'Universal Access (alt)', 'hiiwp' ),
		'dashicons-tickets'                 => __( 'Tickets', 'hiiwp' ),
		'dashicons-nametag'                 => __( 'Name Tag', 'hiiwp' ),
		'dashicons-clipboard'               => __( 'Clipboard', 'hiiwp' ),
		'dashicons-heart'                   => __( 'Heart', 'hiiwp' ),
		'dashicons-megaphone'               => __( 'Megaphone', 'hiiwp' ),
		'dashicons-schedule'                => __( 'Schedule', 'hiiwp' ),
		'dashicons-wordpress'               => __( 'WordPress', 'hiiwp' ),
		'dashicons-wordpress-alt'           => __( 'WordPress (alt)', 'hiiwp' ),
		'dashicons-pressthis'               => __( 'Press This', 'hiiwp' ),
		'dashicons-update'                  => __( 'Update', 'hiiwp' ),
		'dashicons-screenoptions'           => __( 'Screen Options', 'hiiwp' ),
		'dashicons-info'                    => __( 'Info', 'hiiwp' ),
		'dashicons-cart'                    => __( 'Cart', 'hiiwp' ),
		'dashicons-feedback'                => __( 'Feedback', 'hiiwp' ),
		'dashicons-cloud'                   => __( 'Cloud', 'hiiwp' ),
		'dashicons-translation'             => __( 'Translation', 'hiiwp' ),
		'dashicons-tag'                     => __( 'Tag', 'hiiwp' ),
		'dashicons-category'                => __( 'Category', 'hiiwp' ),
		'dashicons-archive'                 => __( 'Archive', 'hiiwp' ),
		'dashicons-tagcloud'                => __( 'Tag Cloud', 'hiiwp' ),
		'dashicons-text'                    => __( 'Text', 'hiiwp' ),
		'dashicons-media-archive'           => __( 'Media Archive', 'hiiwp' ),
		'dashicons-media-audio'             => __( 'Media Audio', 'hiiwp' ),
		'dashicons-media-code'              => __( 'Media Code)', 'hiiwp' ),
		'dashicons-media-default'           => __( 'Media Default', 'hiiwp' ),
		'dashicons-media-document'          => __( 'Media Document', 'hiiwp' ),
		'dashicons-media-interactive'       => __( 'Media Interactive', 'hiiwp' ),
		'dashicons-media-spreadsheet'       => __( 'Media Spreadsheet', 'hiiwp' ),
		'dashicons-media-text'              => __( 'Media Text', 'hiiwp' ),
		'dashicons-media-video'             => __( 'Media Video', 'hiiwp' ),
		'dashicons-playlist-audio'          => __( 'Audio Playlist', 'hiiwp' ),
		'dashicons-playlist-video'          => __( 'Video Playlist', 'hiiwp' ),
		'dashicons-yes'                     => __( 'Yes', 'hiiwp' ),
		'dashicons-no'                      => __( 'No', 'hiiwp' ),
		'dashicons-no-alt'                  => __( 'No (alt)', 'hiiwp' ),
		'dashicons-plus'                    => __( 'Plus', 'hiiwp' ),
		'dashicons-plus-alt'                => __( 'Plus (alt)', 'hiiwp' ),
		'dashicons-minus'                   => __( 'Minus', 'hiiwp' ),
		'dashicons-dismiss'                 => __( 'Dismiss', 'hiiwp' ),
		'dashicons-marker'                  => __( 'Marker', 'hiiwp' ),
		'dashicons-star-filled'             => __( 'Star Filled', 'hiiwp' ),
		'dashicons-star-half'               => __( 'Star Half', 'hiiwp' ),
		'dashicons-star-empty'              => __( 'Star Empty', 'hiiwp' ),
		'dashicons-flag'                    => __( 'Flag', 'hiiwp' ),
		'dashicons-share'                   => __( 'Share', 'hiiwp' ),
		'dashicons-share1'                  => __( 'Share 1', 'hiiwp' ),
		'dashicons-share-alt'               => __( 'Share (alt)', 'hiiwp' ),
		'dashicons-share-alt2'              => __( 'Share (alt 2)', 'hiiwp' ),
		'dashicons-twitter'                 => __( 'twitter', 'hiiwp' ),
		'dashicons-rss'                     => __( 'RSS', 'hiiwp' ),
		'dashicons-email'                   => __( 'Email', 'hiiwp' ),
		'dashicons-email-alt'               => __( 'Email-(alt)', 'hiiwp' ),
		'dashicons-facebook'                => __( 'Facebook', 'hiiwp' ),
		'dashicons-facebook-alt'            => __( 'Facebook (alt)', 'hiiwp' ),
		'dashicons-networking'              => __( 'Networking', 'hiiwp' ),
		'dashicons-googleplus'              => __( 'Google+', 'hiiwp' ),
		'dashicons-location'                => __( 'Location', 'hiiwp' ),
		'dashicons-location-alt'            => __( 'Location (alt)', 'hiiwp' ),
		'dashicons-camera'                  => __( 'Camera', 'hiiwp' ),
		'dashicons-images-alt'              => __( 'Images', 'hiiwp' ),
		'dashicons-images-alt2'             => __( 'Images Alt', 'hiiwp' ),
		'dashicons-video-alt'               => __( 'Video (alt)', 'hiiwp' ),
		'dashicons-video-alt2'              => __( 'Video (alt 2)', 'hiiwp' ),
		'dashicons-video-alt3'              => __( 'Video (alt 3)', 'hiiwp' ),
		'dashicons-vault'                   => __( 'Vault', 'hiiwp' ),
		'dashicons-shield'                  => __( 'Shield', 'hiiwp' ),
		'dashicons-shield-alt'              => __( 'Shield (alt)', 'hiiwp' ),
		'dashicons-sos'                     => __( 'SOS', 'hiiwp' ),
		'dashicons-search'                  => __( 'Search', 'hiiwp' ),
		'dashicons-slides'                  => __( 'Slides', 'hiiwp' ),
		'dashicons-analytics'               => __( 'Analytics', 'hiiwp' ),
		'dashicons-chart-pie'               => __( 'Pie Chart', 'hiiwp' ),
		'dashicons-chart-bar'               => __( 'Bar Chart', 'hiiwp' ),
		'dashicons-chart-line'              => __( 'Line Chart', 'hiiwp' ),
		'dashicons-chart-area'              => __( 'Area Chart', 'hiiwp' ),
		'dashicons-groups'                  => __( 'Groups', 'hiiwp' ),
		'dashicons-businessman'             => __( 'Businessman', 'hiiwp' ),
		'dashicons-id'                      => __( 'ID', 'hiiwp' ),
		'dashicons-id-alt'                  => __( 'ID (alt)', 'hiiwp' ),
		'dashicons-products'                => __( 'Products', 'hiiwp' ),
		'dashicons-awards'                  => __( 'Awards', 'hiiwp' ),
		'dashicons-forms'                   => __( 'Forms', 'hiiwp' ),
		'dashicons-testimonial'             => __( 'Testimonial', 'hiiwp' ),
		'dashicons-portfolio'               => __( 'Portfolio', 'hiiwp' ),
		'dashicons-book'                    => __( 'Book', 'hiiwp' ),
		'dashicons-book-alt'                => __( 'Book (alt)', 'hiiwp' ),
		'dashicons-download'                => __( 'Download', 'hiiwp' ),
		'dashicons-upload'                  => __( 'Upload', 'hiiwp' ),
		'dashicons-backup'                  => __( 'Backup', 'hiiwp' ),
		'dashicons-clock'                   => __( 'Clock', 'hiiwp' ),
		'dashicons-lightbulb'               => __( 'Lightbulb', 'hiiwp' ),
		'dashicons-microphone'              => __( 'Microphone', 'hiiwp' ),
		'dashicons-desktop'                 => __( 'Desktop', 'hiiwp' ),
		'dashicons-tablet'                  => __( 'Tablet', 'hiiwp' ),
		'dashicons-smartphone'              => __( 'Smartphone', 'hiiwp' ),
		'dashicons-smiley'                  => __( 'Smiley', 'hiiwp' ),
	);

	return $icons;
}
