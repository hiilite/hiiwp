<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_id
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Accordion_tab
 */
$title = $el_id = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base'], $atts );

$output = '
	<details ' . ( isset( $el_id ) && ! empty( $el_id ) ? "id='" . esc_attr( $el_id ) . "'" : '' ) . 'class="' . esc_attr( $css_class ) . '" '.( isset( $is_open ) && $is_open == 'yes' ? "open" : '' ).'>
		<summary class="wpb_accordion_header ui-accordion-header"><h3>' . $title . '</h3></summary>
		<div class="wpb_accordion_content ui-accordion-content vc_clearfix">
			' . ( ( '' === trim( $content ) ) ? __( 'Empty section. Edit page to add content here.', 'hiiwp' ) : wpb_js_remove_wpautop( $content ) ) . '
		</div>
	</details>
';

echo $output;
