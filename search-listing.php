<?php get_header();
echo '<!--SEARCH-LISTING-->';
if(!defined('HIILITE_DIR')) define( 'HIILITE_DIR', get_template_directory(  ) );
include(HIILITE_DIR.'/hii-ddf/templates/search-listing.php');

get_footer(); ?>