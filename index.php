<?php
get_header();

if ( is_front_page() ) {
    require 'first-page.php';
}
else if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        get_template_part( 'content', get_post_format() );
    }
}

get_footer();
