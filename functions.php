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

        function featured_image_support() {
            add_theme_support( 'post-thumbnails' );
        }
        add_action( 'after_setup_theme', 'featured_image_support' );

        add_theme_support('post-thumbnails');

        function add_theme_scripts(){
            wp_enqueue_script( 'slick', "//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js", array('jquery'), null, true);
            wp_enqueue_style( 'bundle', get_template_directory_uri() . '/assets/dist/bundle.css', null, null, false );
            wp_enqueue_style( 'slick', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css', null, null, false);
            wp_enqueue_style( 'slick-theme', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css', null, null, false);
            wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/dist/main.bundle.js', array('jquery'), null, false );
            wp_enqueue_script('app', get_template_directory_uri() . '/assets/src/js/app.js', null, null, true);
        }
        add_action( 'wp_enqueue_scripts', 'add_theme_scripts');

        function shoreside_custom_menu(){
            register_nav_menu( 'shoreside_menu', __('Shoreside Menu'));
        }
        add_action('init', 'shoreside_custom_menu');

        add_theme_support( 'editor-styles' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );

        add_theme_support('wp-block-styles');

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

add_filter( 'woocommerce_is_purchasable', '__return_false');

function add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');


//Shortcodes

function carousel_shortcode(){
    include('template-parts/components/carousel.php');
}
add_shortcode('carousel', 'carousel_shortcode');

function brands_shortcode(){
    include('template-parts/components/brands.php');
}
add_shortcode('brands', 'brands_shortcode');

function hero_shortcode(){
    include('template-parts/components/heroVideo.php');
}
add_shortcode('hero', 'hero_shortcode', 1);

function mission_shortcode(){
    include('template-parts/components/mission.php');
}
add_shortcode('mission', 'mission_shortcode');

function offering_shortcode(){
    include('template-parts/components/offerings.php');
}
add_shortcode('offerings', 'offering_shortcode');

function socmed_shortcode(){
    include('template-parts/components/socmed.php');
}
add_shortcode('socmed', 'socmed_shortcode');

function product_gallery_shortcode(){
    include('template-parts/components/productGallery.php');
}
add_shortcode('product-gallery', 'product_gallery_shortcode');

function quote_shortcode(){
    include('template-parts/components/quote.php');
}
add_shortcode('quote', 'quote_shortcode');

function banner_shortcode(){
    include('template-parts/components/bannerImage.php');
}
add_shortcode('banner', 'banner_shortcode');

function information_shortcode(){
    include('template-parts/components/information.php');
}
add_shortcode('information', 'information_shortcode');

function map_shortcode(){
    include('template-parts/components/map.php');
}
add_shortcode('map', 'map_shortcode');

function vision_shortcode(){
    include('template-parts/components/vision.php');
}
add_shortcode('vision', 'vision_shortcode');

function brandContent_shortcode(){
    include('template-parts/components/brandContent.php');
}
add_shortcode('brand-content', 'brandContent_shortcode');

function instagram_shortcode(){
    include('template-parts/components/instagram.php');
}
add_shortcode('instagram', 'instagram_shortcode');

function service_shortcode(){
    include('template-parts/components/service.php');
}
add_shortcode('service-content', 'service_shortcode');

function catalog_shortcode(){
    include('template-parts/components/catalogs.php');
}
add_shortcode('catalog', 'catalog_shortcode');

//Woocommerce code

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 8);

// remove product meta
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// remove  rating  stars
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

//remove add to cart
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 20);


add_filter('woocommerce_product_tabs', 'woo_new_product_tab');
function woo_new_product_tab($tabs) {
    if ( has_term('parts-and-accessories', 'product_cat')) {
        $tabs['return_policy'] = array(
            'title' => __('Return Policy', 'woocommerce'),
            'priority' => 50,
            'callback' => 'woo_new_product_tab_one_content'
        );
        $tabs['warranty_policy'] = array(
            'title' => __('Warranty', 'woocommerce'),
            'id' => 'warranty',
            'priority' => 50,
            'callback' => 'woo_new_product_tab_two_content'
        );
        return $tabs;
    } else {
        return $tabs;
    }
}

function woo_new_product_tab_one_content() {
    include('template-parts/components/returns.php');
}
function woo_new_product_tab_two_content() {
    include('template-parts/components/warranty.php');
}

//add_filter( 'woocommerce_catalog_orderby', 'shoreside_add_custom_sorting_options');
//function shoreside_add_custom_sorting_options($options){
//    $options[ 'new' ] = 'New';
//    $options[ 'used' ] = 'Used';
//
//    return $options;
//}
//add_filter( 'woocommerce_get_catalog_ordering_args', 'shoreside_custom_product_sorting' );
//function shoreside_custom_product_sorting( $args ) {
//
//    // Sort alphabetically
//    if ( isset( $_GET[ 'orderby' ] ) && 'title' === $_GET[ 'orderby' ] ) {
//        $args[ 'orderby' ] = 'title';
//        $args[ 'order' ] = 'asc';
//    }
//
//    // Show products in stock first
//    if( isset( $_GET[ 'orderby' ] ) && 'in-stock' === $_GET[ 'orderby' ] ) {
//        $args[ 'meta_key' ] = '_stock_status';
//        $args[ 'orderby' ] = array( 'meta_value' => 'ASC' );
//    }
//
//    return $args;
//}

//add_theme_support( 'wc-product-gallery-zoom' );
//add_theme_support( 'wc-product-gallery-lightbox' );

//custom ordering
//function woocommerce_catalog_ordering() {
//    if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
//        return;
//    }
//    $show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
//    $catalog_orderby_options = apply_filters(
//        'woocommerce_catalog_orderby',
//        array(
//            'menu_order'    => __( '---', 'woocommerce' ),
//            'pre-owned'     => __( 'Pre Owned', 'woocommerce'),
//            'price'         => __( 'Price: low to high', 'woocommerce' ),
//            'price-desc'    => __( 'Price: high to low', 'woocommerce' ),
//        )
//    );
//
//    $default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
//    // phpcs:disable WordPress.Security.NonceVerification.Recommended
//    $orderby = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby;
//    // phpcs:enable WordPress.Security.NonceVerification.Recommended
//
//    if ( wc_get_loop_prop( 'is_search' ) ) {
//        $catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'woocommerce' ) ), $catalog_orderby_options );
//
//        unset( $catalog_orderby_options['menu_order'] );
//    }
//
//    if ( ! $show_default_orderby ) {
//        unset( $catalog_orderby_options['menu_order'] );
//    }
//
//    if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
//        $orderby = current( array_keys( $catalog_orderby_options ) );
//    }
//
//    wc_get_template(
//        'loop/orderby.php',
//        array(
//            'catalog_orderby_options' => $catalog_orderby_options,
//            'orderby'                 => $orderby,
//            'show_default_orderby'    => $show_default_orderby,
//        )
//    );
//}

// First, this will disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
//test for git
add_action('admin_init', 'df_disable_comments_post_types_support');

// Then close any comments open comments on the front-end just in case
function df_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Finally, hide any existing comments that are on the site.
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

//product buttons/jotform code
function product_contact_row(){
    $product = get_page_by_title( 'Product Title', OBJECT, 'product' );
    $productUrl = get_permalink( $product->ID );
    $productName = get_the_title( $product->ID );
    echo '<a href="tel:7807321004">
            <button class="callButton button-3d">Call Us</button>
        </a>
        <a href="#header-28">
            <button class="emailButton button-3d">Email Us</button>
        </a>';
    if ( has_term( 'Sales Showroom', 'product_cat')){
        echo'<a href="/financing/">
            <button class="financeButton button-3d">Financing</button>
        </a>';
    }
    echo '<br><br>
        <div class="contactForm">
            <script type="text/javascript" src="https://form.jotform.com/jsform/222166143744251?productName=' .$productName.'&productUrl='.$productUrl.'"></script>
        </div>';
}
add_action('woocommerce_single_product_summary', 'product_contact_row', 50);