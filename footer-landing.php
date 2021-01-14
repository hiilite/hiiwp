<?php
/**
 * HiiWP: Footer
 *
 * WordPress footer file
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2016, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.8
 */
$hiilite_options = Hii::get_options();
do_action( 'hii_after_content' );

do_action( 'hii_before_footer' );
?>			
<!-- FOOTER -->

<?php do_action( 'hii_after_footer' ); ?>
			
	</div>
	<?php wp_footer(); ?>
	</div>
<?php do_action( 'hii_body_end' ); ?>
</body>
</html>
