<?php
/**
 * WPUM Template: Account page tabs.
 *
 * @package     wp-user-manager
 * @copyright   Copyright (c) 2015, Alessandro Tesoro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

?>

<div id="wpum-account-forms-tabs" class="wpum-account-forms-tabs">

	<?php if( $tabs && is_array( $tabs ) ) : ?>

		<ul>

		<?php foreach ( $tabs as $key => $tab ) : ?>
			<li class="wpum-form-tab tab-<?php echo $key; ?> <?php echo $current_tab == $key || $current_tab == null && $all_tabs[0] == $key ? 'active' : ''?>">
				<a href="<?php echo esc_url( wpum_get_account_tab_url( $tab['id'] ) ); ?>"><?php echo $tab['title']; ?></a>
			</li>
		<?php endforeach; ?>

		</ul>

		<div class="wpum-clearfix"></div>

	<?php endif; ?>

</div>