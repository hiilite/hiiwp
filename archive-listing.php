<?php get_header();
echo '<!--SEARCH-LISTING-->';
if(!defined('HIILITE_DIR')) define( 'HIILITE_DIR', dirname( __FILE__ ) );
include(HIILITE_DIR.'/addons/hii-ddf/templates/search-listing.php');

get_footer(); ?>