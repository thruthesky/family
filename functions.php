<?php

add_action( 'wp_enqueue_scripts', function() {
    $td = get_template_directory_uri();
    wp_enqueue_style( 'style',              $td . '/style.css' );
    wp_enqueue_style( 'base',               $td . '/css/base.css' );
    wp_enqueue_style( 'layout',             $td . '/css/layout.css' );
    wp_enqueue_style( 'module',              $td . '/css/module.css' );
    wp_enqueue_style( 'header',             $td . '/css/header.css' );
    wp_enqueue_style( 'sidebar',            $td . '/css/sidebar.css' );
    wp_enqueue_style( 'footer',             $td . '/css/footer.css' );
    wp_enqueue_style( 'state',              $td . '/css/state.css' );
    wp_enqueue_style( 'theme',              $td . '/css/theme.css' );
    wp_enqueue_script( 'header',             $td . '/js/header.js', array('jquery') );
    wp_enqueue_script( 'theme',             $td . '/js/theme.js', array('jquery') );
});


add_action('after_setup_theme', function () {
    if ( function_exists('remove_admin_bar') ) remove_admin_bar(true);
    //load_theme_textdomain('x5', get_template_directory());
});

function register_my_menu() {
    register_nav_menu('header-menu',__( 'Header Menu', 'family' ));
}
add_action( 'init', 'register_my_menu' );
