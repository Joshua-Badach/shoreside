<?php
if ( ! function_exists( 'rpsShoreside_setup') ):

    function rpsShoreside_setup(){
        load_theme_textdomain( 'rpsShoreside', get_template_directory() . '/languages');
//        require get_template_directory() . '/template-parts/components/ajax.php';
//        continue here
        include get_admin_url().'admin-ajax.php';

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


//Defer all of wordpress scripts
        function defer_wp_scripts( $url ) {
            if ( is_user_logged_in() ) return $url; // WP Admin exception
            if ( FALSE === strpos( $url, '.js' ) ) return $url;
            if ( strpos( $url, 'jquery.js' ) ) return $url;
            return str_replace( ' src', ' defer src', $url );
        }
        add_filter( 'script_loader_tag', 'defer_wp_scripts', 10 );

        function add_theme_scripts(){
            wp_register_style( 'bundle', get_template_directory_uri() . '/assets/dist/bundle.css', null, null, false );
            wp_register_script( 'main', get_template_directory_uri() . '/assets/dist/main.bundle.js', array('jquery'), null, true );
            wp_enqueue_script('main');
            wp_enqueue_style('bundle');
        }
        add_action( 'wp_enqueue_scripts', 'add_theme_scripts' ,0);

        add_filter( 'script_loader_tag', function ( $tag, $handle ) {
            if ( 'main' !== $handle ) {
                return $tag;
            }
//            return str_replace( ' src', ' defer src', $tag );
//            return str_replace( ' src', ' async src', $tag );
            return str_replace( ' src', ' async defer src', $tag );

        }, 10, 2 );

        add_filter( 'style_loader_tag', function ( $tag, $handle ) {
            if ( 'bundle' !== $handle ) {
                return $tag;
            }
            return str_replace( ' href', ' defer href', $tag );
//            return str_replace( ' href', ' async href', $tag );
//            return str_replace( ' href', ' async defer href', $tag );

        }, 10, 2 );

//        add_filter( 'style_loader_tag', function ( $tag, $handle ) {
//            if ( 'dashicons' !== $handle ) {
//                return $tag;
//            }
//            return str_replace( ' src', ' defer href', $tag );
////            return str_replace( ' href', ' async href', $tag );
////            return str_replace( ' src', ' async defer href', $tag );
//
//        }, 10, 2 );


        remove_action( 'wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles' );

//        removing excess scripts

        add_action( 'wp_enqueue_scripts', 'remove_block_css', 10 );
        function remove_block_css() {
            wp_dequeue_style( 'wp-block-library' ); // WordPress core
            wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
            wp_dequeue_style( 'wc-block-style' ); // WooCommerce
            wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
        }

        function isMobile() {
            return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
        }

        function shoreside_custom_menu(){
            register_nav_menu( 'shoreside_menu', __('Shoreside Menu'));
        }
        add_action('init', 'shoreside_custom_menu');

        add_theme_support( 'editor-styles' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );

        add_theme_support('wp-block-styles');

//        add_theme_support( 'align-wide' );


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
add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );

// remove width & height attributes from images

function remove_img_attr ($html)
{
    return preg_replace('/(width|height)="\d+"\s/', "", $html);
}

add_filter( 'post_thumbnail_html', 'remove_img_attr' );

add_action('wp_head', 'product_carousel');

global $wp;
$current_url = home_url( add_query_arg( array(), $wp->request ) );
$site_name = get_bloginfo( 'name' );
$site_slug = $post->post_name;

//Shortcodes

function carousel_shortcode(){
    include('template-parts/components/carousel.php');
}
add_shortcode('carousel', 'carousel_shortcode');

function promotion_content_shortcode(){
    include('template-parts/components/promotion-content.php');
}
add_shortcode('promotion-content', 'promotion_content_shortcode');

function split_shortcode( $atts = array(), $content = null ){
    global $post;
    $slug = $post->post_name;
    $form = get_post_custom_values('form', $slug);

    echo'<div class="container split">
        <section class="row">
            <h2 class="col-sm-12">' . get_the_title() . '</h2>
                <div class="col-sm-6">';
                echo $content;
            echo '</div>
            <div class="col-sm-6">
                ' . $form[0] . '
            </div>
        </section>
    </div>';
}
add_shortcode('split-content', 'split_shortcode');

function promotional_shortcode(){
    include('template-parts/components/promotion-carousel.php');
}
add_shortcode('promotion-carousel', 'promotional_shortcode');

function featured_brand_shortcode(){
    include('template-parts/components/featured-brand.php');
}
add_shortcode('featured-brand', 'featured_brand_shortcode');
function tester(){
// -==========- Declare vars -==========- //
//Set up db and input
$suppliers = [
    ['supplier'         =>          'kimpex',
    'server'            =>          'ftp.kimpex.com',
    'username'          =>          '7321004',
    'password'          =>          '$Tvf&V6Cey',
    'remote_file_path'  =>          'ftp://7321004@ftp.kimpex.com/'],

//    ['supplier'         =>          'test',
//    'server'            =>          'ftp.test.com',
//    'username'          =>          'user',
//    'password'          =>          'password',
//    'remote_file_path'  =>          ''],
];

//File Details
$local_file_path = '';

    foreach ($suppliers as $supplier) {
        echo $supplier['supplier'] . '<br>';
        echo $supplier['server'] . '<br>';
        echo $supplier['username'] . '<br>';
        echo $supplier['password'] . '<br><br>';
        $remote_file_path = "ftp://" . $supplier['username'] . "@" . $supplier["server"] . "/<br><br>";

        echo $remote_file_path;

//        $connection_id = ftp_connect($supplier['server']);
//
//        $connection_result = ftp_login($connection_id, $supplier['username'], $supplier['password']);
//
//        ftp_chdir($connection_id, dirname($remote_file_path));

//        Continue here
}

}
add_shortcode('tester', 'tester');

function brands_shortcode(){
    include('template-parts/components/brand-card.php');
}
add_shortcode('brands', 'brands_shortcode');

function brand_description_shortcode(){
    include('template-parts/components/brand-description.php');
}
add_shortcode('brand-description', 'brand_description_shortcode');

function hero_shortcode(){
    include('template-parts/components/heroVideo.php');
}
add_shortcode('hero', 'hero_shortcode', 1);

function mission_shortcode( $atts = array(), $content = null ){
//    include('template-parts/components/mission.php');
    echo '<div class="container mission">
        <div class="row">
            <section class="col-lg-12">
                <h2>Our Mission</h2>';
                echo '<p itemprop="description">' . $content . '</p>';
            echo '</section>
        </div>
    </div>';
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

function promotions_shortcode(){
    echo do_shortcode('[instagram-feed feed=2]');
}
add_shortcode('socmed-promotions', 'promotions_shortcode');

function product_gallery_shortcode(){
    include('template-parts/components/productGallery.php');
}
add_shortcode('product-gallery', 'product_gallery_shortcode');

function news_banner_shortcode(){
    $image_id = get_page_by_title('news-banner', OBJECT, 'attachment');
    $image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
    $image = wp_get_attachment_image_src($image_id->ID, [1400, 300]);

    echo '<img loading="lazy" class="newsBanner"  src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" loading="lazy" alt="' . $image_alt . '">';

}
add_shortcode('news-banner', 'news_banner_shortcode');

function banner_shortcode(){
    include('template-parts/components/banner.php');
}
add_shortcode('banner', 'banner_shortcode');

function banner_tall_shortcode(){
    include('template-parts/components/banner-tall.php');
}
add_shortcode('banner-tall', 'banner_tall_shortcode');

function information_shortcode( $atts = array(), $content = null ){
    echo '<div class="divider1"></div>
        <div class="container">
            <section class="row">
                <h2 class="col-sm-12">Who we are…</h2>
                <div class="col-sm-12 information">';
                    echo $content;
                echo '</div>
            </section>
        </div>
    <div class="divider2"></div>';
    include('template-parts/components/information.php');
}
add_shortcode('information', 'information_shortcode');

function map_shortcode(){
    include('template-parts/components/map.php');
}
add_shortcode('map', 'map_shortcode');

function vision_shortcode( $atts = array(), $content = null ){
    echo '<div class="container">
        <section class="row justify-content-sm-center vision">
        <h2 class="col-12">Our Vision</h2>
        <p class="col-sm-8">';
            echo $content;
        echo '</p>
    </section>
</div>';
}
add_shortcode('vision', 'vision_shortcode');

function service_header_shortcode(){
    include('template-parts/components/service-header.php');
}
add_shortcode('service-header', 'service_header_shortcode');

function service_body_summer_shortcode(){
    include('template-parts/components/service-body-summer.php');
}
add_shortcode('service-body-summer', 'service_body_summer_shortcode');

function service_body_winter_shortcode(){
    include('template-parts/components/service-body-winter.php');
}
add_shortcode('service-body-winter', 'service_body_winter_shortcode');

function service_footer_shortcode(){
    include('template-parts/components/service-footer.php');
}
add_shortcode('service-footer', 'service_footer_shortcode');

//Ajax call
function load_product(){
    $productUrl       =           $_REQUEST['product'];
    $productId        =           url_to_postid($productUrl);

    echo do_shortcode('[product_page id="' . $productId . '"]');

    exit();
}
add_action('wp_ajax_load_product', 'load_product');
add_action('wp_ajax_nopriv_load_product', 'load_product');

function load_results() {

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $idObj              =           $_REQUEST['idObj'];
        $attribute          =           $_REQUEST['attribute'];
        $tagObj             =           $_REQUEST['tagObj'];
        $onSaleObj          =           $_REQUEST['onSaleObj'];
        $pageObj            =           $_REQUEST['pageObj'];
        $slug               =           $_REQUEST['slug'];


        if ($_REQUEST['attribute'] == '') {
            if ($_REQUEST['idObj'] != '') {
                $value = $slug;
                $field = 'slug';
                $taxonomy = 'product_cat';
            } else {
                $value = $idObj;
                $field = 'id';
                $taxonomy = 'product_cat';
            }
        }
        if ($tagObj != ''){
            $attribute = 'manufacturer';
            $value = $tagObj;
            $field = 'term_id';
            $taxonomy = 'pa_manufacturer';
        }
        $term = get_term_by($field, $value, $taxonomy);

        $image_slug = $term->slug.'-logo';
        $image_id = get_page_by_title($image_slug, OBJECT, 'attachment');
        $image = $image_id->guid;
    }

    $test = get_term_by('id', $idObj, 'product_cat');

    echo '<div data-parent="' . $test->slug . '" class="container display">
                <div class="row">';
                if ($image != ''){
                        echo '<img class="productLogo col-sm-3" alt="' . $slug . ' logo" src="' . $image . '">
                        <h2 class="hide" data-cat="' . $term->slug . '">' . $term->name . '</h2>';
                    } else {
                    echo '<h2 id="categoryTitle" class="col-3" data-cat="' . $term->slug . '">' . $term->name . '</h2>';
                }
                echo '<p class="col-sm-9 description">' . $term->description . '</p>
                </div>
            </div>
            <div id="mobileFilter">
                <a id="sidebarIcon" href="">
                    <img width="30px" height="30px" src="' . get_template_directory_uri(). '/assets/src/library/images/menu-icon.svg\' ?>" alt="Menu Icon">
                </a>
            </div>
            <div class="content">';
    get_sidebar();
    if($idObj == ''){ $idObj = $pageObj; }
    echo '<div class="container">';
    echo do_shortcode('[products category="' . $idObj . '" attribute="' . $attribute . '"  terms="' . $tagObj . '" per_page="-1" columns="5" on_sale="' . $onSaleObj . '" meta_key="event_date" orderby="meta_value_num" on_sale="" order="DESC" operator="IN"]');
    echo '</div>
        </div>';

    die();
}
add_action('wp_ajax_load_results', 'load_results');
add_action('wp_ajax_nopriv_load_results', 'load_results');

function content_shortcode(){
    include('template-parts/components/content.php');
}
add_shortcode('content', 'content_shortcode');

function brand_content_shortcode(){
    include('template-parts/components/brand-content.php');
}
add_shortcode('brand-content', 'brand_content_shortcode');

//No results found for above code
function woocommerce_shortcode_products_loop_no_results( $attributes ) {
    echo __( 'No products matching your query', 'woocommerce' );
}
add_action( 'woocommerce_shortcode_products_loop_no_results', 'woocommerce_shortcode_products_loop_no_results', 20, 1 );

function catalog_shortcode(){
    include('template-parts/components/catalogs.php');
}
add_shortcode('catalog', 'catalog_shortcode');

//Woocommerce code

//Display sku
add_action( 'woocommerce_single_product_summary', 'show_sku', 21 );
function show_sku(){
    global $product;
    if ($product->get_sku() != '' ) {
        echo '<div class="skuContainer"><span>SKU: ' . '<span class="sku"><strong>' . $product->get_sku() . '</strong></span></span></div>';
    }
}

add_action('woocommerce_single_product_summary', 'pending_banner' , 14);
function pending_banner(){
    global $product;
    $tags = wc_get_product_tag_list($product->get_id);

    if ( str_contains($tags, 'Pending') == true ) {
        echo '<div class="pendingBanner">
                <img width="500" height="50" src="' . get_template_directory_uri() . '/assets/src/library/images/pendingBanner.jpg' . '">
              </div>';
    }
    if ( str_contains($tags, 'Order') == true ) {
        echo '<div class="orderBanner">
                <img width="500" height="50" src="' . get_template_directory_uri() . '/assets/src/library/images/onOrderBanner.jpg' . '">
              </div>';
    }
}

add_action( 'woocommerce_single_product_summary', 'payments', 10);
function payments(){
    global $product;
    $price = $product->get_price();
    $categories = $product->get_categories();

    $gst = 1.05;
    if (str_contains($categories, 'Trailers')) {
        $fees = 400.00;
    } else {
        $fees = 750.00;
    }
    $principle =  number_format((float)(($price * $gst) + $fees), 2, '.', '');

    function financeCalc($months, $principle, $interest, $apr){
        if ($months != '') {

            $monthlyInterest = round($interest / 12 , 5);

            $result = ($principle * ($monthlyInterest * (1+$monthlyInterest)**$months)) / ((1+$monthlyInterest)**$months-1);

            //            /1.09, result is off by 9% I don't understand the discrepancy between their financial calculator and the formula given to me. Either I'm missing something in the code or financit is doing something slightly different than the given formula.

            $correction = $result / 1.09;

            $biweekly = round($correction / 2);

            echo '<p class="financingText">Financing available for <span class="biweekly"><strong>$' . $biweekly . '</strong> biweekly</span>*</p>
             <div class="disclaimer"><sub><em>*On approved credit. Estimated payment is calculated using the maximum term of ' . $months . ' Months at a rate of ' . $apr . '% APR. Alternative lenders and better rates may be available. $0.00 down payment assumed. Some fees, freight, and additional charges may not be factored into this estimate.</em></sub></div>';
        }
    }

    if ($price != '' && str_contains($categories, 'Showroom') == true) {
        if (str_contains($categories, 'Boats') || str_contains($categories, 'Outboard Motors') || str_contains($categories, 'Electric Surfboards')){
            if ($principle > 3000) {
                if ($principle > 3000 && $principle < 4999) {
                    $months = 36;
                } elseif ($principle > 5000 && $principle < 9999) {
                    $months = 84;
                } elseif ($principle > 10000 && $principle < 19999) {
                    $months = 180;
                } elseif ($principle > 20000) {
                    $months = 240;
                }
                $interest = 0.1099;
                $apr = '10.99';
                financeCalc($months, $principle, $interest, $apr);
            }
        } elseif (str_contains($categories, 'Snowmobile') || str_contains($categories, 'ATV')) {
            if ($principle > 3000) {
                if ($principle > 3000 && $principle < 7499) {
                    $months = 84;
                } elseif ($principle > 7500 && $principle < 19999) {
                    $months = 120;
                } elseif ($principle > 20000) {
                    $months = 120;
                }
                $interest = 0.1099;
                $apr = '10.99';
                financeCalc($months, $principle, $interest, $apr);
            }
        } elseif (str_contains($categories, 'Trailers') || str_contains($categories, 'Tents')) {
            if ($principle > 500) {
                if ($principle > 500 && $principle < 2999) {
                    $months = 36;
                } elseif ($principle > 3000) {
                    $months = 60;
                }
                $interest = 0.1499;
                $apr = '14.99';
                financeCalc($months, $principle, $interest, $apr);
            }
        }

    } elseif ($price != '' && str_contains($categories, 'Preowned') == true) {
        if ($principle > 3000) {
            if ($principle > 3000 && $principle < 4999) {
                $months = 36;
            } elseif ($principle > 5000 && $principle < 9999) {
                $months = 84;
            } elseif ($principle > 10000 && $principle < 19999) {
                $months = 180;
            } elseif ($principle > 20000) {
                $months = 240;
            }
            $interest = 0.1099;
            $apr = '10.99';
            financeCalc($months, $principle, $interest, $apr);
        }
    }
}

function contact_blurb(){
    $contactQuery = new WP_Query(array(
        'category_name'     => 'contact',
        'order'             => 'DESC',
        'post_status'       => ' publish',
        'posts_per_page'    => 1
    ));
    while ($contactQuery->have_posts()){
        $contactQuery->the_post();
        $content = get_the_content();
    }
    wp_reset_postdata();
    echo '<div class="productContact">' . $content . '</div>';
}
add_action('woocommerce_single_product_summary', 'contact_blurb', 45);

function woo_related_products_limit() {
    global $product;

    $args['posts_per_page'] = 5;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'related_products_args', 20 );
function related_products_args( $args ) {
    $args['posts_per_page'] = 5; // 4 related products
    $args['columns'] = 5; // arranged in 2 columns
    return $args;
}

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 8);

// remove product meta
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// remove  rating  stars
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

//remove add to cart
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 20);

//Woocommerce custom tabs for product page
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
    }
    return $tabs;
}

function woo_new_product_tab_one_content() {
    include('template-parts/components/returns.php');
}
function woo_new_product_tab_two_content() {
    include('template-parts/components/warranty.php');
}

function product_contact_row(){
    global $post;
    $product = wc_get_product($post);
    $shop = $product->get_attribute( 'Shop' );

    if ( $shop != '' ){
        echo '<div class="productButtons">
        <a href="' . $shop . '" target="_blank">
            <button class="button-3d">Shop</button>
        </a>
    </div>';
    }
}
add_action('woocommerce_single_product_summary', 'product_contact_row', 50);

//remove woocommerce default filtering, need to unhook all of the filtering stuff or the format breaks alltogether
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

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

//Add functionality to woocommerce edit manufacturer page to allow for featured brands

// Add select to add manufacturer
    function edit_wc_attribute_manufacturer($term) {
        $id = $term->term_id;
        $term_meta = get_option( "featured_manufacturer=$id" );
         $select = array_values($term_meta);?>
<tr class="form-field">
    <th scope="row" valign="top">
        <label for="featured_manufacturer">Featured Brand</label>
    </th>
    <td>
        <select name="term_meta[<?php echo $id ?>]" id="featured_manufacturer">
            <option value=false <?php if($select[0] == "false") echo "selected" ?> >No</option>
            <option value=true <?php if($select[0] == "true") echo "selected" ?> >Yes</option>
        </select>

        <p class="description">Is this manufacturer going to be featured on the home page</p>
    </td>
</tr>
        <?php
    }
    add_action( 'pa_manufacturer_edit_form_fields', 'edit_wc_attribute_manufacturer' );
    function save_taxonomy_custom_meta( $term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $id = $term_id;
            $term_meta = get_option( "featured_manufacturer=$id" );
            $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "featured_manufacturer=$id", $term_meta, false );
        }
    }
    add_action( 'edited_pa_manufacturer', 'save_taxonomy_custom_meta');
    add_action( 'create_pa_manufacturer', 'save_taxonomy_custom_meta');