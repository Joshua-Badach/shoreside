<?php
if ( ! function_exists( 'rpsShoreside_setup') ):

    function rpsShoreside_setup(){
        load_theme_textdomain( 'rpsShoreside', get_template_directory() . '/languages');

    add_theme_support(
        'html5',
        array(
            'search-form',
            'gallery',
            'caption',
            'script',
            'style',
            'navigation-widgets',
        )
    );
//    $wp_customize->add_section('custom_css', array(
//       'title'  => __('Custom Css Test'),
//        'description'   =>__('Description for custom css'),
//        'panel' => '',
//        'priority' => 160,
//        'capability'    => 'edith+theme_option',
//        'theme_supports'    => '',
//    ));
//        tweak this more

    function shoreside_logo_setup() {
        $defaults = array(
            'height'                    =>400,
            'width'                     =>300,
            'flex-height'               =>true,
            'flex-width'                =>true,
            'header-text'               =>array( 'site-title', 'site-description' ),
            'unlink-homepage-logo'      =>true, );
        add_theme_support('custom-logo', $defaults);
    }
    add_action( 'after_setup_theme', 'shoreside_logo_setup' );

//    tweak this to handle hero video when appropriate
    function shoreside_header_setup(){
        $args = array(
            'default-image'             =>get_template_directory_uri() . 'assets/src/library/images/404background.jpg',
            'default-text-color'        =>'0069ad',
            'width'                     =>'1920',
            'height'                    =>'1440',
            'flex-width'                =>true,
            'flex-height'               =>true,
        );
        add_theme_support('shoreside-header', $args);
    }
    add_action('after_setup_theme', 'shoreside_header_setup');


    function add_theme_scripts(){
        wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/dist/main.bundle.js', false );
        wp_enqueue_style( 'bundle', get_template_directory_uri() . '/assets/dist/bundle.css', false );
    }
    add_action( 'wp_enqueue_scripts', 'add_theme_scripts');

    function shoreside_custom_menu(){
        register_nav_menu( 'shoreside_menu', __('Shoreside Menu'));
    }
    add_action('init', 'shoreside_custom_menu');

// tweak function later to add class col-lg-2 automatically

//    function add_class_on_nav($classes, $item, $args){
//        if(isset($args->add_li_class)) {
//            $classess[] = $args->add_li_class;
//        }
//        return $classes;
//    }
//    add_filter( 'nav_menu_css_class', 'add_class_on_nav', 1, 3 );

    add_theme_support( 'editor-styles' );

    add_theme_support( 'title-tag' );

//    custom menu setup
    function register_menu( $locations = array() ){
        global $_wp_registered_nav_menus;

        add_theme_support( 'menus' );

        foreach ( $locations as $key => $value ){
            if ( is_int( $key ) ) {
                _doing_it_wrong( __FUNCTION__, __( 'Nav menu locations must be strings.' ), '1.0.0' );
            }
        }
        $_wp_registered_nav_menus = array_merge( (array) $_wp_registered_nav_menus, $locations);
    }


    }
endif;

add_action( 'after_setup_theme', 'rpsShoreside_setup');