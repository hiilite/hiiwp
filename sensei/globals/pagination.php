<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Pagination - Show numbered pagination for sensei archives
 *
 * @author 		Automattic
 * @package 	Sensei
 * @category    Templates
 * @version     1.9.0
 */
// Exit if accessed directly

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
    return;
}

?>
<nav class="sensei-pagination">
    <?php
    echo paginate_links( apply_filters( 'sensei_pagination_args', array(
        'base'         => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),
        'format'       => '',
        'add_args'     => '',
        'current'      => max( 1, get_query_var( 'paged' ) ),
        'total'        => $wp_query->max_num_pages,
        'prev_text'    => '<span class="screen-reader-text">' . __( 'Previous Post', 'hiiwp' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'hiiwp' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper"><i class="fa fa-angle-left"></i></span>%title</span>',
        'next_text'    => '<span class="screen-reader-text">' . __( 'Next Post', 'hiiwp' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'hiiwp' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper"><i class="fa fa-angle-right"></i></span></span>',
        'type'         => 'list',
        'end_size'     => 3,
        'mid_size'     => 3
    ) ) );
    ?>
</nav>
