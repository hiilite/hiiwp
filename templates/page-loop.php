<?php
/**
 * HiiWP Template: page-loop
 *
 * @package     hiiwp
 * @copyright   Copyright (c) 2018, Hiilite Creative Group
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
global $post;
$hiilite_options = Hii::$hiiwp->get_options();
$post_meta = get_post_meta($post->ID); 
$vc_enabled = (get_post_meta($post->ID, '_wpb_vc_js_status', true) == 'true')?true:false;
?>
<!--PAGE-LOOP-->
<article  <?php post_class('row'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>" >
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php echo esc_url( home_url() )?>"/>
	<div class="in_grid">
		<div class="<?php echo (!$vc_enabled)?'content-box':'container_inner';?>">
<?php
the_content();
?>
		</div>
	</div>
</article>