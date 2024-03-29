<?php

use JetBrains\PhpStorm\NoReturn;

if ( ! function_exists( 'rpsShoreside_setup') ):

    /**
     * @return void
     */
    function rpsShoreside_setup(): void
    {
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

        function shoreside_logo_setup(): void
        {
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

        function shoreside_header_setup(): void
        {
            $args = array(
                'default-image'             =>get_template_directory_uri() . 'assets/src/library/images/404background.webp',
                'default-text-color'        =>'0069ad',
                'width'                     =>'1920',
                'height'                    =>'1440',
                'flex-width'                =>true,
                'flex-height'               =>true,
            );
            add_theme_support('shoreside-header', $args);
        }
        add_action('after_setup_theme', 'shoreside_header_setup');

        function featured_image_support(): void
        {
            add_theme_support( 'post-thumbnails' );
        }
        add_action( 'after_setup_theme', 'featured_image_support' );

        add_theme_support('post-thumbnails');

        function add_theme_scripts(): void
        {
            wp_register_style( 'bundle', get_template_directory_uri() . '/assets/dist/bundle.css', null, null, false );
            wp_enqueue_style('bundle');
            wp_register_script( 'main', get_template_directory_uri() . '/assets/dist/main.bundle.js', array('jquery'), null, true );
            wp_enqueue_script('main');
        }
        add_action( 'wp_enqueue_scripts', 'add_theme_scripts' ,0);

//        Pull unused Woocommerce assets
        function dequeue_woocommerce_styles() {

// styles
            $dequeue_styles = array(
                'photoswipe',
                'photoswipe-default-skin',
                'wc-block-style',
                'wp-block-library',
                'wc-block-editor',
                'prettyPhoto'
            );

            foreach ( $dequeue_styles as $dstyles ) :
                wp_dequeue_style( $dstyles );
            endforeach;

// scripts

            $dequeue_scripts = array(
                'flexslider',
                'photoswipe' ,
                'photoswipe-ui-default',
                'zoom',
                'wc-cart-fragments',
                'wc-cart',
                'wc-add-payment-method',
                'jquery-migrate',
                'wc-geolocation',
                'wc-lost-password',
                'wc-password-strength-meter',
                'prettyPhoto',
                'prettyPhoto-init'
            );

            foreach ( $dequeue_scripts as $dscripts ) :
                wp_dequeue_script( $dscripts );
            endforeach;

        }
        add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_styles', 99 );

        function disable_classic_theme_styles() {
            wp_deregister_style('classic-theme-styles');
            wp_dequeue_style('classic-theme-styles');
        }
        add_filter('wp_enqueue_scripts', 'disable_classic_theme_styles', 100);

        function preloadAssets(): void{
            $dir = get_template_directory_uri();
            $footer_logo_id = get_page_by_title('rps-logo', 'OBJECT', 'attachment');
            $footer_logo_src = $footer_logo_id->guid;

//            Improve this to handle different featured brand videos in the future
//            Hero Video or banner
            if ( is_home() || is_front_page()) {
                $hero_id = get_page_by_title('main-hero', 'OBJECT', 'attachment');
                $hero_video = $hero_id->guid;
                echo '<link rel="preload" href="' . $hero_video . '" as="media" >';
            } elseif (is_page('radinn')){
                $hero_id = get_page_by_title('radinn-hero', 'OBJECT', 'attachment');
                $hero_video = $hero_id->guid;
                echo '<link rel="preload" href="' . $hero_video . '" as="media" >';
            } else {
                if (get_the_post_thumbnail_url() != '') {
                    $banner_src = get_the_post_thumbnail_url();
                    echo '<link rel="preload" href="' . $banner_src . '" as="image" >';
                }
            }
//            Nav logo
            echo '<link rel="preload" href="' . $dir . '/assets/src/library/images/rps-logo-small.png" as="media" >';
//            Footer logo
            echo '<link rel="preload" href="' . $footer_logo_src . '" as="media" >';
//            Loading gif
            echo '<link rel="preload" href="' . $dir . '\assets\src\library\images\loading.svg' . '" as="media" >';

        }
        add_action( 'wp_head', 'preloadAssets', -1);

        function shoreside_custom_menu(): void
        {
            register_nav_menu( 'shoreside_menu', __('Shoreside Menu'));
        }
        add_action('init', 'shoreside_custom_menu');

        add_theme_support( 'editor-styles' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );

//        add_theme_support('wp-block-styles');

//        add_theme_support( 'align-wide' );


//    custom menu setup
        function register_menu( $locations = array() ): void
        {
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

//Restrict mime type to webp, svg, and pdf
function restrict_mimes($mime_types){
    $mime_types = array(
        'webp' => 'image/webp',
        'svg' => 'image/svg',
        'pdf' => 'application/pdf'
    );
    return $mime_types;
}

add_filter('upload_mimes', 'restrict_mimes');

global $wp;
global $post;
$current_url = home_url( add_query_arg( array(), $wp->request ) );
$site_name = get_bloginfo( 'name' );

//Shortcodes

function carousel_shortcode(): void
{
    require('template-parts/components/carousel.php');
}
add_shortcode('carousel', 'carousel_shortcode');

function promotion_content_shortcode( $atts = array(), $content = null ): void
{
    $promotionAdQuery = new WP_Query(array(
        'category_name'     =>      'promotions',
        'order'             =>      'ASC',
        'post_status'       =>      'publish',
        'posts_per_page'    =>      -1
    ));

    echo '<section>
            <div class="container">
                <div class="row">
                <h2>Current Promotions</h2>';

    echo $content;

    echo '</div>
</div>
<div>
    <div class="row promotionRow row-cols-4">';
    while ($promotionAdQuery->have_posts()){
        $promotionAdQuery->the_post();
        $promotions = get_the_post_thumbnail();
        $promotionUrl = get_post_custom_values('promotion_url');
        if ($promotionUrl != ''){
            echo '<a href="' . get_site_url() . $promotionUrl[0] . '"><p class="col promotions">' . $promotions . '</p></a>';
        } else {
            echo '<p class="col promotions">' . $promotions . '</p>';
        }
    }
    wp_reset_postdata();
    echo '</div>
            </div>
    </section>';
}
add_shortcode('promotion-content', 'promotion_content_shortcode');

function split_shortcode( $atts = array(), $content = null ): void
{
    global $post;
    $slug = $post->post_name;
    $getForm = get_post_custom_values('form', $slug);
    $form = $getForm[0];

    echo'<div class="container split">
        <section class="row">
            <h2 class="col-sm-12">' . get_the_title() . '</h2>
                <div class="col-sm-6">';
    echo $content;
    echo '</div>
            <div class="col-sm-6">
                ' . $form . '
            </div>
        </section>
    </div>';
}
add_shortcode('split-content', 'split_shortcode');

function promotional_shortcode(): void
{
    require('template-parts/components/promotion-carousel.php');
}
add_shortcode('promotion-carousel', 'promotional_shortcode');

function featured_brand_shortcode(): void
{
    require('template-parts/components/featured-brand.php');
}
add_shortcode('featured-brand', 'featured_brand_shortcode');

function careers_shortcode( $atts = array(), $content = null ): void
{
    $careerQuery = new WP_Query(array(
        'category_name'     => 'careers',
        'order'             => 'ASC',
        'post_status'       => ' publish',
        'posts_per_page'    => 12,
    ));
    global $post;

    echo'<div class="container careers">
        <section class="row">
            <h2 class="col-12">Recreational Power Sports Careers - Join Our Team!</h2>
            <div class="col-12">' . $content . '</div>
        </section>
        <section class="row justify-content-around careerListing">
            <h2 class="col-12">Careers</h2>';
    while ($careerQuery->have_posts()){
        $careerQuery->the_post();
        $hours = get_post_meta($post->ID, 'hours', true);
        $link = get_permalink($post->ID);
        $thumbnail = get_the_post_thumbnail($post->ID);

        echo '<a class="col-md-3 jobPost" href="' . $link . '">
                    <section class="jobContent">'
            . $thumbnail .
            '<h3>' . get_the_title() . '</h3>
                        <span class="jobDescription">More Information</span>
                        <p>' . $hours . '</p>
                    </section>
                </a>';
    }
    wp_reset_postdata();
    echo'</section>
    </div>';
}
add_shortcode('careers', 'careers_shortcode');
function brands_shortcode(): void
{
    require('template-parts/components/brand-card.php');
}
add_shortcode('brands', 'brands_shortcode');

function brand_description_shortcode(): void
{
    require('template-parts/components/brand-description.php');
}
add_shortcode('brand-description', 'brand_description_shortcode');

function hero_shortcode(): void
{
    require('template-parts/components/heroVideo.php');
}
add_shortcode('hero', 'hero_shortcode', 1);

function mission_shortcode( $atts = array(), $content = null ): void
{
    echo '<div class="container mission">
        <div class="row">
            <section class="col-lg-12">
                <h2>Our Mission</h2>';
    echo '<p>' . $content . '</p>';
    echo '</section>
        </div>
    </div>';
}
add_shortcode('mission', 'mission_shortcode');

function offering_shortcode(): void
{
    require('template-parts/components/offerings.php');
}
add_shortcode('offerings', 'offering_shortcode');

function socmed_shortcode(): void
{
    require('template-parts/components/socmed.php');
}
add_shortcode('socmed', 'socmed_shortcode');

function socmed_promotions_shortcode(): void
{
    echo do_shortcode('[instagram-feed feed=2]');
}
add_shortcode('socmed-promotions', 'socmed_promotions_shortcode');

function product_gallery_shortcode(): void
{
    require('template-parts/components/productGallery.php');
}
add_shortcode('product-gallery', 'product_gallery_shortcode');

function news_banner_shortcode(): void
{
    $image_id = get_page_by_title('news-banner', 'OBJECT', 'attachment');
    $image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
    $image = wp_get_attachment_image_src($image_id->ID, [1400, 300]);

    echo '<img class="newsBanner" src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $image_alt . '">';

}
add_shortcode('news-banner', 'news_banner_shortcode');

function banner_shortcode(): void
{
    echo '<div class="bannerImage">';
    $featured = get_the_post_thumbnail();
    echo $featured;
    echo'</div>';
}
add_shortcode('banner', 'banner_shortcode');

function banner_tall_shortcode(): void
{
    echo '<div class="bannerImageTall">';
    $featured = get_the_post_thumbnail();
    echo $featured;
    echo'</div>';
}
add_shortcode('banner-tall', 'banner_tall_shortcode');

function information_shortcode( $atts = array(), $content = null ): void
{
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
    require('template-parts/components/information.php');
}
add_shortcode('information', 'information_shortcode');

function map_shortcode(): void
{
    require('template-parts/components/map.php');
}
add_shortcode('map', 'map_shortcode');

function vision_shortcode( $atts = array(), $content = null ): void
{
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

function service_header_shortcode(): void
{
    require('template-parts/components/service-header.php');
}
add_shortcode('service-header', 'service_header_shortcode');

function service_body_summer_shortcode(): void
{
    require('template-parts/components/service-body-summer.php');
}
add_shortcode('service-body-summer', 'service_body_summer_shortcode');

function service_body_winter_shortcode(): void
{
    require('template-parts/components/service-body-winter.php');
}
add_shortcode('service-body-winter', 'service_body_winter_shortcode');

function service_footer_shortcode(): void
{
    require('template-parts/components/service-footer.php');
}
add_shortcode('service-footer', 'service_footer_shortcode');

function load_results(): void
{

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $idObj              =           $_REQUEST['idObj'];
        $attribute          =           $_REQUEST['attribute'];
        $tagObj             =           $_REQUEST['tagObj'];
        $onSaleObj          =           $_REQUEST['onSaleObj'];
        $pageObj            =           $_REQUEST['pageObj'];
        $slug               =           $_REQUEST['slug'];

        ($slug == 'mercury') ? ($orderby = 'menu_order') : ($orderby = 'name');
        ($slug == 'mercury') ? ($order = 'DESC') : ($order = 'ASC');


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
        $image_id = get_page_by_title($image_slug, 'OBJECT', 'attachment');
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
    echo do_shortcode('[products category="' . $idObj . '" attribute="' . $attribute . '"  terms="' . $tagObj . '" per_page="-1" columns="5" on_sale="' . $onSaleObj . '" orderby="' . $orderby . '" on_sale="" order="' . $order . '" operator="IN"]');
    echo '</div>
        </div>';

    die();
}
add_action('wp_ajax_load_results', 'load_results');
add_action('wp_ajax_nopriv_load_results', 'load_results');

function load_video_results(): void
{

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

        $idObj = $_REQUEST['idObj'];
        $term = get_term_by('id', $idObj, 'product_cat');
        $term_id = $term->term_id;
        $cat_video = implode(get_term_meta($term_id, 'cat_video', false));

        if ($cat_video != '') {
            echo '<div id="videoTab"><img src="' . get_template_directory_uri() . '/assets/src/library/images/play-button.webp' . '" alt="Video Icon"></div>
                <div id="videoSlider" style="display: none">
                    <iframe width="100%" height="100%"
                        src="https://www.youtube.com/embed/' . $cat_video . '">
                    </iframe>
                </div>';
        }

        die();
    }
}
add_action('wp_ajax_load_video_results', 'load_video_results');
add_action('wp_ajax_nopriv_load_video_results', 'load_video_results');


function content_shortcode(): void
{
    require('template-parts/components/content.php');
}
add_shortcode('content', 'content_shortcode');

function brand_content_shortcode(): void
{
    require('template-parts/components/brand-content.php');
}
add_shortcode('brand-content', 'brand_content_shortcode');

//No results found for above code

function catalog_shortcode(): void
{
    require('template-parts/components/catalogs.php');
}
add_shortcode('catalog', 'catalog_shortcode');

// +=+=+=+=+=+=+=+=+=+=+=+=+=+= Woocommerce Code +=+=+=+=+=+=+=+=+=+=+=+=+=+=

function woocommerce_shortcode_products_loop_no_results( $attributes ): void
{
    echo __( 'No products matching your query', 'woocommerce' );
}
add_action( 'woocommerce_shortcode_products_loop_no_results', 'woocommerce_shortcode_products_loop_no_results', 20, 1 );

//Display sku
add_action( 'woocommerce_single_product_summary', 'show_sku', 30 );
function show_sku(): void
{
    global $product;
    if ($product->get_sku() != '' ) {
        echo '<div class="skuContainer"><span>SKU: ' . '<span class="sku"><strong>' . $product->get_sku() . '</strong></span></span></div>';
    }
}

function change_variable_product(){
    if ( is_product() ) {
        global $post;
        $product = wc_get_product( $post->ID );
        if ( $product->is_type( 'variable' ) ) {
            add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'dropdown_remove_default', 12, 2 );
            function dropdown_remove_default( $html, $args ) {
                $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' );
                $show_option_none_html = '<option value="">'.esc_html( $show_option_none_text ).'</option>';
                $html = str_replace($show_option_none_html, '', $html);
                return $html;
            }
//            function move_variation_price() {
//                remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
//                add_action( 'woocommerce_single_product_summary', 'woocommerce_single_variation', 5 );
//            }
//            add_action( 'woocommerce_before_add_to_cart_form', 'move_variation_price' );

            remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

            remove_action('woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30);
            add_action('woocommerce_single_product_summary', 'woocommerce_variable_add_to_cart', 4);
        }
    }
}
add_action( 'woocommerce_before_single_product', 'change_variable_product' );

add_action('woocommerce_single_product_summary', 'pending_banner' , 14);
function pending_banner(): void
{
    global $product;
    $tags = wc_get_product_tag_list($product->get_id);

    if (str_contains($tags, 'Pending')) {
        echo '<div class="pendingBanner">
                <img width="500" height="50" src="' . get_template_directory_uri() . '/assets/src/library/images/pendingBanner.jpg' . '">
              </div>';
    }
    if (str_contains($tags, 'Order')) {
        echo '<div class="orderBanner">
                <img width="500" height="50" src="' . get_template_directory_uri() . '/assets/src/library/images/onOrderBanner.jpg' . '">
              </div>';
    }
}

add_action( 'woocommerce_single_product_summary', 'payments', 10);
function payments(): void
{
    global $product;
    $price = floatval($product->get_price());
    $categories = $product->get_categories();

    $taxonomy = 'product_cat';
    $hierarchical = 1;
    $empty = 0;
    $limit = -1;
    $status = 'publish';
    $name = '';

    if (str_contains($categories, 'Showroom')) {
        $name = 'Sales Showroom';
    } elseif (str_contains($categories, 'Preowned')) {
        $name = 'Preowned';
    }

    $args = array(
        'taxonomy' => $taxonomy,
        'hierarchical' => $hierarchical,
        'hide_empty' => $empty,
        'limit' => $limit,
        'status' => $status,
        'name' => $name
    );

    $showroom = get_categories($args);
    $idObj = (int)implode(wp_list_pluck($showroom, 'term_id'));
    $year = (int)array_shift( wc_get_product_terms($product->id, 'pa_model-year', array( 'fields' => 'names' )));

    $subCategories = get_terms(
        'product_cat',
        array('parent' => $idObj)
    );
    foreach ($subCategories as $cat) {
        if (str_contains($categories, $cat->name)) {
            if ($year > 0 && $year < 2015){
                $interest = (float)get_term_meta($cat->term_id, 'old_apr', true);
            } else {
                $interest = (float)get_term_meta($cat->term_id, 'cat_apr', true);
            }
            $fees = (int)get_term_meta($cat->term_id, 'cat_fees', true);
        }
    }
    if (isset($interest) && isset($fees)) {
        $gst = 1.05;
        $apr = $interest * 100;
        $months = null;

        $principle = ($price + $fees) * $gst;
    }
    if ($price != '') {
        if (str_contains($categories, 'Showroom') || str_contains($categories, 'Preowned')) {
            if (str_contains($categories, 'ATVs') || str_contains($categories, 'Snowmobiles')) {
                ($principle > 2999) ? ($months = 120) : ($months = null);
            } elseif (str_contains($categories, 'Boat Lifts / Docks')) {
                $months = 120;
            } elseif (str_contains($categories, 'Outboard Motors') || str_contains($categories, 'Boats')) {
                ($principle <= 19999) ? ($months = 180) : ($months = 240);
            } elseif (str_contains($categories, 'Trailers/Sled Decks') || str_contains($categories, 'Tents')) {
                ($principle <= 2999) ? ($months = 36) : ($months = 60);
            } elseif (str_contains($categories, 'Electric Surfboards')) {
                if ($principle >= 4999 && $principle < 9999) {
                    $months = 84;
                } elseif ($principle >= 10000 && $principle <= 19999) {
                    $months = 180;
                } elseif ($principle >= 20000) {
                    $months = 240;
                }
            }
        }

        //    Amortization calculation

        if (isset($interest) && $months != null) {
            $monthlyInterest = ($interest / 12);
            $num = (1 + $monthlyInterest);

            $numerator = $monthlyInterest * ($num ** $months);
            $denominator = ($num ** $months) - 1;

            $result = $principle * ($numerator / $denominator);

            $biweekly = round($result / 2);

            echo '<p class="financingText">Financing available for <span class="biweekly"><strong>$' . $biweekly . '</strong> biweekly</span>*</p>
             <div class="disclaimer"><sub><em>*On approved credit. Estimated payment is calculated using the maximum term of ' . $months . ' Months at a rate of ' . $apr . '% APR. Alternative lenders and better rates may be available. $0.00 down payment assumed. Some fees, freight, and additional charges may not be factored into this estimate.</em></sub></div>';
        }
    }
}

function contact_blurb(): void
{
    echo '<div class="productContact">
        <p>Contact our Sales Team or stop by our Edmonton, AB location to purchase.</p>
        <p>Call or Text: <a href="tel:+17807321004">(780) 732-1004</a></p>
        <p>In Person: <a href="https://goo.gl/maps/V2nMTa987fF2mZLe8" target="_blank" rel="noopener">11204 154 Street | Edmonton, AB</a></p>
    </div>';
}
add_action('woocommerce_single_product_summary', 'contact_blurb', 45);

function woo_related_products_limit(): array
{
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

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 1);

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

function woo_new_product_tab_one_content(): void
{
    require('template-parts/components/returns.php');
}
function woo_new_product_tab_two_content(): void
{
    require('template-parts/components/warranty.php');
}

function product_contact_row(): void
{
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
function df_disable_comments_post_types_support(): void
{
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
function df_disable_comments_hide_existing_comments($comments): array
{
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

//Add functionality to woocommerce edit manufacturer page to allow for featured brands

// Add select to add manufacturer
function edit_wc_attribute_manufacturer($term): void
{
    $id = $term->term_id;
    $term_meta = get_option( "featured_manufacturer=$id" );
    $select = is_array($term_meta)?array_values($term_meta): array();
    echo '<tr class="form-field">
    <th scope="row" valign="top">
        <label for="featured_manufacturer">Featured Brand</label>
    </th>
    <td>
        <select name="term_meta[' . $id . ']" id="featured_manufacturer">'; ?>
    <option value=false <?php echo (!$select || $select[0] == "false") ? "selected" : "" ?> >No</option>
    <?php echo ($select[0] == "true") ? "<option value=true selected>Yes</option>" : "<option value=true>Yes</option>"; ?>
    <?php echo '</select>

        <p class="description">Is this manufacturer going to be featured on the home page</p>
    </td>
</tr>';
}
add_action( 'pa_manufacturer_edit_form_fields', 'edit_wc_attribute_manufacturer' );
function save_taxonomy_custom_meta( $term_id ): void
{
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

//Add functionality to woocommerce edit category page to allow for fees and apr

function showroom_edit_category_apr($term) {

    $taxonomy           =           'product_cat';
    $hierarchical       =           1;
    $empty              =           0;
    $limit              =           -1;
    $status             =           'publish';
    $name               =           'Sales Showroom';

    $args = array(
        'taxonomy'                      => $taxonomy,
        'hierarchical'                  => $hierarchical,
        'hide_empty'                    => $empty,
        'limit'                         => $limit,
        'status'                        => $status,
        'name'                          => $name
    );

    $categories = get_categories($args);
    $idObj = (int) implode(wp_list_pluck($categories, 'term_id'));
    $term_id = $term->term_id;
    $cat_apr = get_term_meta($term_id, 'cat_apr', true);
    $cat_fees = get_term_meta($term_id, 'cat_fees', true);

    if ($term->parent == $idObj){
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="cat_apr"><?php _e('APR', 'apr'); ?></label></th>
            <td>
                <input type="text" name="cat_apr" id="cat_apr" value="<?php echo esc_attr($cat_apr) ? esc_attr($cat_apr) : ''; ?>">
                <p class="description"><?php _e('Enter the interest in decimal value', 'apr'); ?></p>
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="cat_fees"><?php _e('Fees', 'fees'); ?></label></th>
            <td>
                <input type="text" name="cat_fees" id="cat_fees" value="<?php echo esc_attr($cat_fees) ? esc_attr($cat_fees) : ''; ?>">
                <p class="description"><?php _e('Enter the fees', 'apr'); ?></p>
            </td>
        </tr>
        <?php
    }
}

add_action('product_cat_edit_form_fields', 'showroom_edit_category_apr', 10, 1);

function preowned_edit_category_apr($term) {

    $taxonomy           =           'product_cat';
    $hierarchical       =           1;
    $empty              =           0;
    $limit              =           -1;
    $status             =           'publish';
    $name               =           'Preowned';

    $args = array(
        'taxonomy'                      => $taxonomy,
        'hierarchical'                  => $hierarchical,
        'hide_empty'                    => $empty,
        'limit'                         => $limit,
        'status'                        => $status,
        'name'                          => $name
    );

    $categories = get_categories($args);
    $idObj = (int) implode(wp_list_pluck($categories, 'term_id'));
    $term_id = $term->term_id;
    $cat_apr = get_term_meta($term_id, 'cat_apr', true);
    $old_apr = get_term_meta($term_id, 'old_apr', true);
    $cat_fees = get_term_meta($term_id, 'cat_fees', true);

    if ($term->parent == $idObj){
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="cat_apr"><?php _e('APR', 'apr'); ?></label></th>
            <td>
                <input type="text" name="cat_apr" id="cat_apr" value="<?php echo esc_attr($cat_apr) ? esc_attr($cat_apr) : ''; ?>">
                <p class="description"><?php _e('Enter the interest in decimal value', 'apr'); ?></p>
            </td>
        </tr>
        <?php
        if (str_contains($term->name, 'Preowned ')){
            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="old_apr"><?php _e('APR (Units older than 2015)', 'old_apr'); ?></label></th>
                <td>
                    <input type="text" name="old_apr" id="old_apr" value="<?php echo esc_attr($old_apr) ? esc_attr($old_apr) : ''; ?>">
                    <p class="description"><?php _e('Enter the interest in decimal value', 'old_apr'); ?></p>
                </td>
            </tr>
            <?php
        }
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="cat_fees"><?php _e('Fees', 'fees'); ?></label></th>
            <td>
                <input type="text" name="cat_fees" id="cat_fees" value="<?php echo esc_attr($cat_fees) ? esc_attr($cat_fees) : ''; ?>">
                <p class="description"><?php _e('Enter the fees', 'fees'); ?></p>
            </td>
        </tr>
        <?php
    }
}

add_action('product_cat_edit_form_fields', 'preowned_edit_category_apr', 10, 1);


// Save extra taxonomy fields callback function.
function shoreside_save_category_apr($term_id) {

    $cat_apr = filter_input(INPUT_POST, 'cat_apr');
    $old_apr = filter_input(INPUT_POST, 'old_apr');
    $cat_fees = filter_input(INPUT_POST, 'cat_fees');

    update_term_meta($term_id, 'cat_apr', $cat_apr);
    update_term_meta($term_id, 'old_apr', $old_apr);
    update_term_meta($term_id, 'cat_fees', $cat_fees);
}

add_action('edited_product_cat', 'shoreside_save_category_apr', 10, 1);
add_action('create_product_cat', 'shoreside_save_category_apr', 10, 1);


function edit_category_video($term) {

    $taxonomy           =           'product_cat';
    $hierarchical       =           1;
    $empty              =           0;
    $limit              =           -1;
    $status             =           'publish';
    $name               =           'Preowned';

    $args = array(
        'taxonomy'                      => $taxonomy,
        'hierarchical'                  => $hierarchical,
        'hide_empty'                    => $empty,
        'limit'                         => $limit,
        'status'                        => $status,
        'name'                          => $name
    );

    $categories = get_categories($args);
    $term_id = $term->term_id;
    $cat_video = get_term_meta($term_id, 'cat_video', true);

    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="cat_video"><?php _e('Video Id', 'video'); ?></label></th>
        <td>
            <input type="text" name="cat_video" id="cat_video" value="<?php echo esc_attr($cat_video) ? esc_attr($cat_video) : ''; ?>">
            <p class="description"><?php _e('Enter the Youtube video ID', 'video'); ?></p>
        </td>
    </tr>
    <?php
}

add_action('product_cat_edit_form_fields', 'edit_category_video', 10, 1);


// Save extra taxonomy fields callback function.
function shoreside_save_category_video($term_id) {

    $cat_video = filter_input(INPUT_POST, 'cat_video');

    update_term_meta($term_id, 'cat_video', $cat_video);
}

add_action('edited_product_cat', 'shoreside_save_category_video', 10, 1);
add_action('create_product_cat', 'shoreside_save_category_video', 10, 1);

