<?php
/**
 * @file index.php
 */

/**
 * index.php 를 페이징 한다. 다만 footer 에서는 js / css 를 compile 하는 등 할 일이 많기 때문에 그냥 둔다.
 */
$pid = 'index2';
$data = get_transient($pid);
if ( $data === false ) {
    ob_start();
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
    $data = ob_get_clean();
    set_transient( $pid, $data, 3600 );
}
echo $data;

get_footer();

/*

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
*/