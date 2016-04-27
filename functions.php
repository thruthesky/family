<?php

add_action( 'wp_enqueue_scripts', function() {
    $td = get_template_directory_uri();
    wp_enqueue_style( 'style',              $td . '/style.css' );
    wp_enqueue_style( 'base',               $td . '/css/base.css' );
    wp_enqueue_style( 'content',             $td . '/css/content.css' );
    wp_enqueue_style( 'module',              $td . '/css/module.css' );
    wp_enqueue_style( 'header',             $td . '/css/header.css' );
    wp_enqueue_style( 'sidebar',            $td . '/css/sidebar.css' );
    wp_enqueue_style( 'footer',             $td . '/css/footer.css' );
    wp_enqueue_style( 'state',              $td . '/css/state.css' );
    wp_enqueue_style( 'theme',              $td . '/css/theme.css' );
    wp_enqueue_style( 'layout',             $td . '/css/layout.css' );
    wp_enqueue_script( 'header',             $td . '/js/header.js', array('jquery') );
    wp_enqueue_script( 'theme',             $td . '/js/theme.js', array('jquery') );
});


add_action('after_setup_theme', function () {
    if ( function_exists('remove_admin_bar') ) remove_admin_bar(true);
    //load_theme_textdomain('x5', get_template_directory());
});

function register_my_menu() {
    register_nav_menu('family-header-menu',__( 'Family Header Menu', 'family' ));
}
add_action( 'init', 'register_my_menu' );


class Walker_Family_Header_Menu extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $output .= sprintf( "\n<a href='%s'>%s</a>\n",
            $item->url,
            $item->title
        );
    }
}

function get_header_sub_menu() {
    $header_menu = wp_nav_menu( array(
        'theme_location' => 'family-header-menu',
        'items_wrap' => '%3$s',
        'container' => '',
        'walker'  => new Walker_Family_Header_Menu(),
        'echo' => false,
    ) );
    if ( empty($header_menu) ) {
        $header_menu .= "<a class='' href=''>Home</a>";
        $header_menu .= "<a class='' href=''>About</a>";
        $header_menu .= "<a class='' href=''>Forum</a>";
        $header_menu .= "<a class='' href=''>Contact</a>";
    }
    return $header_menu;
}

function family_widget_init() {
    register_sidebar( array(
        'name'          => 'Family right sidebar',
        'id'            => 'family_right',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'family_widget_init' );
