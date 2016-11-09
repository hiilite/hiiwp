<?php
/**
 * WPUM Template: Account Page.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */
?>

<div id="wpum-account" class="wpum-account-wrapper">

	<?php do_action( 'wpum_before_account', $current_tab, $all_tabs, $form, $fields, $user_id, $atts ); ?>

	<?php

		// Display tabs content.
		// Check that the tab exists or - null if we're on /account/ page.
		if ( $current_tab === null || wpum_account_tab_exists( $current_tab ) ) {

			switch ( $current_tab ) {
				case null: // Return first tab if null - meaning we're on /account/ page
					do_action( "wpum_account_tab_{$all_tabs[0]}", $current_tab, $all_tabs, $form, $fields, $user_id, $atts );
					break;
				case $current_tab:
					do_action( "wpum_account_tab_{$current_tab}", $current_tab, $all_tabs, $form, $fields, $user_id, $atts );
					break;
			}

			// Display not found error if tab doesn't exist
		} else {

			// Display error message
			$args = array(
				'id'   => 'wpum-not-found',
				'type' => 'notice',
				'text' => __( 'Content not found.', 'wpum' )
			);
			wpum_message( $args );

		}

	?>

	<?php do_action( 'wpum_after_account', $current_tab, $all_tabs, $form, $fields, $user_id, $atts ); ?>

</div>