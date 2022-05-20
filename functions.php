<?php

if ( ! function_exists( 'rpsShoreside_setup') ):

    function rpsShoreside_setup(){
        load_theme_textdomain( 'rpsShoreside', get_template_directory() . '/languages');

        register_nav_menus( array(
            'primary'   => __( 'Primary Menu', 'rpsShoreside' ),
            'secondary' => __( 'Secondary Menu', 'rpsShoreside')

        ) );
//    add_theme_support( 'title-tag' );
//    add_theme_support(
//        'html5',
//        array(
//            'search-form',
//            'comment-form',
//            'comment-list',
//            'gallery',
//            'caption',
//            'script',
//            'style',
//            'navigation-widgets',
//        )
//    );
//    add_theme_support( 'editor-styles' );
    function shoreside_logo_setup() {
        $defaults = array(
            'height'                  =>400,
            'width'                   =>300,
            'flex-height'             =>true,
            'flex-width'              =>true,
            'header-text'             =>array( 'site-title', 'site-description' ),
           'unlink-homepage-logo'    =>true, );
        add_theme_support('custom-logo', $defaults);
    }
    add_action( 'after_setup_theme', 'shoreside_logo_setup' );


    function add_theme_scripts(){
        wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/dist/main.bundle.js', false );
        wp_enqueue_style( 'bundle', get_template_directory_uri() . '/assets/dist/bundle.css', false );
    }
    add_action( 'wp_enqueue_scripts', 'add_theme_scripts');

}
endif;

add_action( 'after_setup_theme', 'rpsShoreside_setup');