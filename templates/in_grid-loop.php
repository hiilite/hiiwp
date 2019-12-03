<?php
/**
 * HiiWP Template: full_width-loop
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
global $hiilite_options;
$post_meta = get_post_meta(get_the_id());
?>
<div class="in_grid">
<?php
	the_content();
?>
</div>