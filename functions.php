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

    function featured_image_support() {
        add_theme_support( 'post-thumbnails' );
    }
    add_action( 'after_setup_theme', 'featured_image_support' );

    add_theme_support('post-thumbnails');

    function add_theme_scripts(){
//        wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array('jquery'), null, true);
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


function insert_fb_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
    echo '<meta property="fb:app_id" content="568883651374703" />';
    echo '<meta property="og:title" content="' . get_the_title() . '"/>';
    echo '<meta property="og:type" content="website"/>';
    echo '<meta property="og:url" content="' . get_permalink() . '"/>';
    echo '<meta property="og:site_name" content="recreationalpowersports.com"/>';
    if(!has_post_thumbnail( $post->ID )) {
        $default_image="http://example.com/image.jpg"; //replace this with a default image on your server or an image in your media library
        echo '<meta property="og:image" content="' . $default_image . '"/>';
    }
    else{
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
    }
    echo "
";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

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

function insta_shortcode(){
    include('template-parts/components/instagram.php');
}
add_shortcode('instagram', 'insta_shortcode');

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
add_shortcode('brand-content', 'brandContent_shortcode');function instagram_shortcode(){
    include('template-parts/components/instagram.php');
}
add_shortcode('instagram', 'instagram_shortcode');

//Woocommerce code

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 8);

// remove product meta
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// remove  rating  stars
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

//remove add to cart
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 20);

add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
    $tabs['return_policy'] = array(
        'title' 	=> __( 'Return Policy', 'woocommerce' ),
        'priority' 	=> 50,
        'callback' 	=> 'woo_new_product_tab_one_content'
    );
    $tabs['warranty_policy'] = array(
        'title'     => __( 'Warranty', 'woocommerce'),
        'priority'  => 50,
        'callback'  => 'woo_new_product_tab_two_content'
    );
//    $tabs['product_form'] = array(
//        'title'     => __( 'Email', 'woocommerce'),
//        'priority'  => 40,
//        'callback'  => 'woo_new_product_tab_three_content'
//    );
    return $tabs;
}
function woo_new_product_tab_one_content() {
    include('template-parts/components/returns.php');
}
function woo_new_product_tab_two_content() {
    include('template-parts/components/warranty.php');
}
// Add a custom product note after add to cart button in single product pages
add_action('woocommerce_after_add_to_cart_button', 'custom_product_note', 10 );
function custom_product_note() {

    echo '<br><div>';

    woocommerce_form_field('product_note', array(
        'type' => 'textarea',
        'class' => array( 'my-field-class form-row-wide') ,
        'label' => __('Product note') ,
        'placeholder' => __('Add your note here, please…') ,
        'required' => false,
    ) , '');

    echo '</div>';
}

// Add customer note to cart item data
add_filter( 'woocommerce_add_cart_item_data', 'add_product_note_to_cart_item_data', 20, 2 );
function add_product_note_to_cart_item_data( $cart_item_data, $product_id ){
    if( isset($_POST['product_note']) && ! empty($_POST['product_note']) ){
        $product_note = sanitize_textarea_field( $_POST['product_note'] );
        $cart_item_data['product_note'] = $product_note;
    }
    return $cart_item_data;
}
//product buttons/jotform code
function product_contact_row(){
    $product = get_page_by_title( 'Product Title', OBJECT, 'product' );
    $productUrl = get_permalink( $product->ID );
    $productName = get_the_title( $product->ID );
    echo '<a href="tel:7807321004">
            <button class="callButton">Call Us</button>
        </a>
        <button class="emailButton">Email Us</button>';
        if ( has_term( 'Sales Showroom', 'product_cat')){
            echo'<a href="/financing/">
            <button class="financeButton">Financing</button>
        </a>';
        }
    echo '<br><br>
        <div class="contactForm">
            <script type="text/javascript" src="https://form.jotform.com/jsform/222166143744251?productName=' .$productName.'&productUrl='.$productUrl.'"></script>
        </div>';
}
add_action('woocommerce_single_product_summary', 'product_contact_row', 50);