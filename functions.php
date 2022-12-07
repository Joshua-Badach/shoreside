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

        function add_theme_scripts(){
            wp_enqueue_style( 'bundle', get_template_directory_uri() . '/assets/dist/bundle.css', null, null, false );
            wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/dist/main.bundle.js', array('jquery'), null, true );
        }
        add_action( 'wp_enqueue_scripts', 'add_theme_scripts' ,0);

        function gutenburg_editor_assets() {
            wp_enqueue_style( 'bundle', get_template_directory_uri() . '/assets/dist/bundle.css', null, null, false );
            wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/dist/main.bundle.js', array('jquery'), null, true );
//            wp_enqueue_script(
//                'main-js-gutenburg',
//                plugins_url( '/assets/dist/main.bundle.js', dirname( __FILE__ ) ),
//                array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
//                true
//            );
//            wp_enqueue_style(
//                'main-css-gutenburg',
//                plugins_url( '/assets/dist/bundle.css', dirname( __FILE__ ) ),
//                array( 'wp-edit-blocks' )
//            );
        }
        add_editor_style( 'enqueue_block_editor_assets', 'gutenburg_editor_assets' );

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

        add_theme_support( 'align-wide' );


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

global $wp;
$current_url = home_url( add_query_arg( array(), $wp->request ) );
$site_name = get_bloginfo( 'name' );
$site_slug = $post->post_name;

//Shortcodes

function carousel_shortcode(){
    if ( is_home() || is_front_page() ){
        echo '<h2 class="col-sm-8">How Recreational Power Sports Does It Better</h2>';
    }
    if ( is_home() == false ){
        echo '<h2 class="hidden">';
        the_title();
        echo ' Offerings';
        echo '</h2>';
    }
    echo '<div class="carousel">';
        $the_page = sanitize_posT($GLOBALS['wp_the_query']->get_queried_object() );
        $slug = $the_page->post_name;

    function wp_loop_slider($query){
        while ($query->have_posts()){
            $query->the_post();
            echo ('<section class="sliderContent">');
            the_post_thumbnail('', array( 'loading' => 'lazy' ));
            ?><div class="sliderText">
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>
            </div><?php
            echo ('</section>');
        }
        wp_reset_postdata();
    }

    if (is_home() || is_front_page() == true ):
        $query = new WP_Query(array(
            'category_name'         => 'home-slider',
            'posts_per_page'        => 5
        ));
        wp_loop_slider($query);

    elseif (is_home() == false):
        $query = new WP_Query(array(
            'category_name'         => $slug.'-slider',
            'posts_per_page'        => 5
        ));
        wp_loop_slider($query);

    endif;

    echo '</div>';
}
add_shortcode('carousel', 'carousel_shortcode');

function promotional_content_shortcode(){
    $promotionQuery = new WP_Query(array(
        'category_name'     => 'promotions-text',
        'order'             => 'DESC',
        'post_status'       => 'publish',
        'posts_per_page'    => 1
    ));

    $promotionAdQuery = new WP_Query(array(
        'category_name'     =>      'promotions-ad',
        'order'             =>      'ASC',
        'post_status'       =>      'publish',
        'posts_per_page'    =>      -1
    ));

    echo '<section>
            <div class="container">
                <div class="row">';
                    while ($promotionQuery->have_posts()){
                        $promotionQuery->the_post();
                        $title = get_the_title();
                        $content = get_the_content();
                        echo '<h2 class="col-12">' . $title . '</h2>' .
                        '<p class="col-12">' . $content . '</p>';
                    }
                    wp_reset_postdata();
                echo'</div>
            </div>
            <div>
                <div class="row promotionRow row-cols-4">';
                while ($promotionAdQuery->have_posts()){
                    $promotionAdQuery->the_post();
                    $promotions = get_the_post_thumbnail();
                    echo '<p class="col promotions">' . $promotions . '</p>';
                }
                wp_reset_postdata();
            echo '</div>
            </div>
    </section>';
}
add_shortcode('promotion-content', 'promotional_content_shortcode');

function promotional_shortcode(){
    if ( is_home() == false ){
        echo '<h2 class="hidden">';
        the_title();
        echo ' Offerings';
        echo '</h2>';
    }
    echo '<div class="carousel">';

    function promotional_slider($query){
        while ($query->have_posts()){
            $query->the_post();
            echo ('<section class="sliderContent">');
            the_post_thumbnail('', array( 'loading' => 'lazy' ));
            ?><div class="sliderText">
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>
            </div><?php
            echo ('</section>');
        }
        wp_reset_postdata();
    }

    echo '</div>';
}
add_shortcode('promotion-carousel', 'promotional_shortcode');

function brands_shortcode(){

//idObj is set to 0 because that is the top level boat category

    $idObj = 0;

    $taxonomy       = 'product_cat';
    $orderby        = 'name';
    $show_count     = 0;      // 1 for yes, 0 for no
    $pad_counts     = 0;      // 1 for yes, 0 for no
    $hierarchical   = 1;      // 1 for yes, 0 for no
    $title          = '';
    $empty          = 0;

    $args = array(
        'taxonomy'                  => $taxonomy,
        'orderby'                   => $orderby,
        'show_count'                => $show_count,
        'pad_counts'                => $pad_counts,
        'hierarchical'              => $hierarchical,
        'title_li'                  => $title,
        'hide_empty'                => $empty
    );

    function brand_loop($idObj, $args){
        $all_categories = get_categories( $args );
        $test = ['Avalon', 'MirroCraft', 'Mercury', 'Shorestation' ];
        echo '<section class="container"> 
                <div class="row brandSpan">
                <h2>Our Brands</h2>';
        foreach ($all_categories as $cat) {
            if ($cat->name === $test[0] ) {
                $url = 'https://www.avalonpontoons.com/';
                brand_cards($cat, $url);
            }
            if ($cat->name === $test[1] ) {
                $url = 'https://www.mirrocraft.com/';
                brand_cards($cat, $url);
            }
            if ($cat->name === $test[2] ) {
                $url = 'https://www.mercurymarine.com/en/ca/';
                brand_cards($cat, $url);
            }
            if ($cat->name === $test[3] ) {
                $url = 'https://www.mercurymarine.com/en/ca/';
                brand_cards($cat, $url);
            }
        }
        echo '</section>';
    }

    function brand_cards($cat, $url){
        $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        $content = $cat->description;
        $trimmed_content = wp_trim_words( $content, 75, '...' . '<p class="appended">[ read more ]</p>');

        echo '<section itemscope itemtype="https://schema.org/Brand" class="col-3">
            <a href="' . $cat->slug . '">
                <div class="brandCard brands">
                    <div class="brandImage">
                        <img itemprop="logo" src="'. $image . '" width="150px" height="150px">
                        <span hidden itemprop="url"> ' . $url . '</span>
                    </div>   
                    <div class="brandsContent">    
                        <h3 itemprop="name" class="hidden">' . $cat->name . '</h3>
                        <p itemprop="description">'; echo $trimmed_content . '</p> 
                    </div>
                </div>    
            </a>
    </section>';
    }

    brand_loop($idObj, $args);

}
add_shortcode('brands', 'brands_shortcode');

function brandContent_shortcode(){
    global $post;
    $slug = $post->post_name;

    $brandsQuery = new WP_Query(array(
        'category_name'     =>  $slug,
        'order'             => 'DESC',
        'post_status'       => ' publish',
        'posts_per_page'    => 1
    ));

    echo '<section class="container"> 
            <div class="row">';
    while ($brandsQuery->have_posts()){
        $brandsQuery->the_post(); ?>
        <h2 class="col-sm-3"><?php the_title() ?> </h2>
        </div>
        <div class="row">
            <p class="col-sm-12"> <?php the_content(); ?></p>
        </div>
        <?php
    }
    wp_reset_postdata();
    echo '</div>
      </section>';

}
add_shortcode('brand-content', 'brandContent_shortcode');


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

function promotions_shortcode(){
    echo do_shortcode('[instagram-feed feed=2]');
}
add_shortcode('socmed-promotions', 'promotions_shortcode');

function product_gallery_shortcode(){
    include('template-parts/components/productGallery.php');
}
add_shortcode('product-gallery', 'product_gallery_shortcode');

function quote_shortcode(){
    include('template-parts/components/quote.php');
}
add_shortcode('quote', 'quote_shortcode');

function banner_shortcode(){
    echo '<div class="bannerImage">';
    $featured = get_the_post_thumbnail( $post_id );
    echo $featured;
    echo'</div>';
}
add_shortcode('banner', 'banner_shortcode');

function banner_tall_shortcode(){
    echo '<div class="bannerImageTall">';
        $featured = get_the_post_thumbnail( $post_id );
        echo $featured;
    echo'</div>';
}
add_shortcode('banner-tall', 'banner_tall_shortcode');

function information_shortcode(){
    include('template-parts/components/information.php');
}
add_shortcode('information', 'information_shortcode');

function map_shortcode(){
    include('template-parts/components/map.php');
}
add_shortcode('map', 'map_shortcode');

function vision_shortcode(){
    $visionQuery = new WP_Query(array(
        'category_name'     => 'vision',
        'order'             => 'DESC',
        'post_status'       => 'publish',
        'posts_per_page'    => 1
    ));

    echo '<div class="container">
    <section class="row justify-content-sm-center vision">';
        while ($visionQuery->have_posts()){
        $visionQuery->the_post();
            echo '<h2 class="col-sm-4">' . get_the_title() . '</h2>';
            echo '<p class="offset-sm-1  col-sm-8">' .  get_the_content() . '</p>';
        }
        wp_reset_postdata();
    echo '</section>
</div>';
}
add_shortcode('vision', 'vision_shortcode');

function winterize_shortcode(){
    global $post;
    $slug = $post->post_name;

    $id = get_term_by('slug', $slug, 'product_cat');
    $idObj = $id->term_id;
    $categoryDescription = category_description($idObj);
    $term = get_term_by('id', $idObj, 'product_cat');
    $product = wc_get_product( $idObj );

    $contactQuery = new WP_Query(array(
        'category_name'     =>  'contact',
        'order'             => 'DESC',
        'post_status'       => ' publish',
        'posts_per_page'    => 1
    ));

    $taxonomy       = 'product_cat';
    $orderby        = 'ID';
    $show_count     = 0;      // 1 for yes, 0 for no
    $pad_counts     = 0;      // 1 for yes, 0 for no
    $hierarchical   = 1;      // 1 for yes, 0 for no
    $title          = '';
    $empty          = 0;

    $args = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'posts_per_page'        => '25',
        'tax_query'             => array(
            array(
                'taxonomy'                  => $taxonomy,
                'terms'                     => $idObj,
                'orderby'                   => $orderby,
                'order'                     => 'ASC',
                'show_count'                => $show_count,
                'pad_counts'                => $pad_counts,
                'hierarchical'              => $hierarchical,
                'title_li'                  => $title,
                'hide_empty'                => $empty
            ),
            array(
                'taxonomy'      => 'product_visibility',
                'field'         => 'slug',
                'terms'         => 'exclude-from-catalog',
                'operator'      => 'NOT IN'
            )
        )
    );

    $products = get_posts($args);
    echo '<div  class="container mission">
            <div class="row">
                <div class="col-lg-12">';
                    echo '<h2>' . $term->name . '</h2>';
                    echo $categoryDescription;
                echo '</div>
            </div>
            <div class="row">
                <div class="col-sm-12">';
                    while ($contactQuery->have_posts()){
                        $contactQuery->the_post();
                        $content = the_content();
                    $content;
    }
    wp_reset_postdata();
    echo '</div>
    </div>
    <div class="row">
        <span class="col-12"><strong>Prices include all parts, labor and shop supplies. GST not included.</strong></span><br><br>
    </div>
    <div class="row tableHeader">
        <span class="col-3">Name</span><span class="col-2">Price</span><span class="col-7">Description</span>
    </div>';
    foreach ($products as $service) {
        $price = wc_get_product( $service )->get_price();

        echo '<a class="row tableItem" itemscope itemtype="https://schema.org/ProductCollection" href="' . get_permalink( $service->ID ) . '"> 
                    <span class="col-3" itemprop="name">' . $service->post_title . '</span>
                        <span class="col-2" itemprop="price">' . $price .  '</span>
                        <span class="col-7" itemprop="description">' . $service->post_excerpt . '</span>
                  </a>';
    }
    echo '</div>';
}
add_shortcode('winterize-content', 'winterize_shortcode');

function service_shortcode(){
    global $post;
    $slug = $post->post_name;

    $id = get_term_by('slug', $slug, 'product_cat');
    $idObj = $id->term_id;
    $categoryDescription = category_description($idObj);
    $term = get_term_by('id', $idObj, 'product_cat');

    echo '<div  class="container">
            <div class="row">
                <div class="col-lg-6 serviceWriteup">';
                    echo '<h2>' . $term->name . '</h2>';
                    echo $categoryDescription .
                '</div>
                <div class="col-lg-6 serviceForm">
                    <script type="text/javascript" src="https://form.jotform.com/jsform/223384426868063"></script>
                </div>
            </div>
        </div>';
}
add_shortcode('service-content', 'service_shortcode');

function load_product(){
    $productUrl       =           $_REQUEST['product'];
    $productId        =           url_to_postid($productUrl);
//    $postType         =           'product';

//    $args = array(
//            'p'                 =>         $productId,
//            'post_type'         =>         $postType,
//    );
//
//    $query = new WP_Query($args);

//
//    do_action( 'woocommerce_before_main_content' );
//
//        while ($query->have_posts()) : $query->the_post();
//            wc_get_template_part( 'content', 'single-product' );
//        endwhile;
//
//    do_action( 'woocommerce_after_main_content' );


//    $content_post     =           get_post($productId);
//    $content          =           $content_post->post_content;
//    $content          =           str_replace(']]>', ']]&gt;', $content);

//    $output           =           "";
//    $output           .=          get_the_post_thumbnail( $productId, 'medium' );
//    $output           .=          $content;

//    is_product($productId);

//    var_dump($query);
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
        $orderByObj         =           $_REQUEST['orderByObj'];
        $orderObj           =           $_REQUEST['orderObj'];
        $onSaleObj          =           $_REQUEST['onSaleObj'];
        $pageObj            =           $_REQUEST['pageObj'];
        $slug               =           $_REQUEST['slug'];

        if ($_REQUEST['idObj'] != ''){
            $term = get_term_by('slug', $slug, 'product_cat');
            $categoryDescription = category_description($term);
        } else {
            $term = get_term_by('id', $idObj, 'product_cat');
            $categoryDescription = category_description($term);
        }
    }

    echo '<div class="container display">
                <div class="row">
                    <h2 id="categoryTitle" data-cat="' . $term->slug . '">' . $term->name . '</h2>
                    ' . $categoryDescription . '
                </div>
            </div>
            <div id="mobileFilter">
                <a id="sidebarIcon" href="">
                    <img width="30px" height="30px" src="' . get_template_directory_uri(). '/assets/src/library/images/menu-icon.svg\' ?>" alt="Menu Icon">
                </a>
            </div>
            <div class="content">';
    get_sidebar();
    echo '<div class="container">';
    echo do_shortcode('[products category="' . $idObj . '" attribute="' . $attribute . '"  terms="' . $tagObj . '" per_page="-1" columns="5" orderby="' . $orderByOjb . '" order="' . $orderObj . '" on_sale="' . $onSaleObj . '" operator="IN"]');
    echo '</div>
        </div>';

    die();
}
add_action('wp_ajax_load_results', 'load_results');
add_action('wp_ajax_nopriv_load_results', 'load_results');

function content_shortcode(){
    global $post;
    $slug = $post->post_name;
    $id = get_term_by('slug', $slug, 'product_cat');
    $idObjConst = $id->term_id;

    if ($_GET['product_cat'] != ''){
        $idObj = $_REQUEST['product_cat'];
    } else {
        $idObj = $id->term_id;
    }

    $term = get_term_by('id', $idObj, 'product_cat');
    $categoryDescription = category_description($term);

    echo '<section id="contentTrigger" data-page="' . $idObjConst . '" data-slug="' . $slug .'">
            <div class="container display">
                <div class="row">
                    <h2 id="categoryTitle" data-cat="' . $term->slug . '">' . $term->name . '</h2>
                    ' . $categoryDescription . '
                </div>
            </div>
            <div id="mobileFilter">
                <a id="sidebarIcon" href="">
                    <img width="30px" height="30px" src="' . get_template_directory_uri(). '/assets/src/library/images/menu-icon.svg\' ?>" alt="Menu Icon">
                </a>
            </div>
            <div class="content">';
                get_sidebar();
                echo '<div class="container">';
                    echo do_shortcode('[products category="' . $idObj . '" attribute=""  terms="" per_page="-1" columns="5" orderby="meta_value_num" on_sale="" order="" operator="IN"]');
                echo '</div>
            </div>
    </section>';
}
add_shortcode('content', 'content_shortcode');

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
add_action( 'woocommerce_single_product_summary', 'show_sku', 20 );
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
                <img src="' . get_template_directory_uri() . '/assets/src/library/images/pendingBanner.jpg' . '">
              </div>';
    }
    if ( str_contains($tags, 'Order') == true ) {
        echo '<div class="orderBanner">
                <img src="' . get_template_directory_uri() . '/assets/src/library/images/onOrderBanner.jpg' . '">
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
        if (str_contains($categories, 'Boats') || str_contains($categories, 'Outboards') || str_contains($categories, 'Electric Surfboards')){
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

    }
}

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
    $tabs['product_inquiry'] = array(
        'title' => __('Product Inquiry', 'woocommerce'),
        'priority' => 1,
        'callback' => 'woo_new_product_tab_three_content'
    );
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

function woo_new_product_tab_three_content(){
    $product = get_page_by_title( 'Product Title', OBJECT, 'product' );
    $productUrl = get_permalink( $product->ID );
    $productName = get_the_title( $product->ID );
    echo '<div class="contactForm">

    <iframe
      id="JotFormIFrame-222166143744251"
      title="Product Form"
      onload="window.parent.scrollTo(0,0)"
      allowtransparency="true"
      allowfullscreen="true"
      allow="geolocation; microphone; camera"
      src="https://form.jotform.com/222166143744251?productName=' . $productName . '&productUrl=' . $productUrl .'"
      frameborder="0"
      style="
      min-width: 100%;
      border:none;"
      scrolling="no"
    >
    </iframe>
    <script type="text/javascript">
      var ifr = document.getElementById("JotFormIFrame-222166143744251");
      if (ifr) {
        var src = ifr.src;
        var iframeParams = [];
        if (window.location.href && window.location.href.indexOf("?") > -1) {
          iframeParams = iframeParams.concat(window.location.href.substr(window.location.href.indexOf("?") + 1).split(\'&\'));
        }
        if (src && src.indexOf("?") > -1) {
          iframeParams = iframeParams.concat(src.substr(src.indexOf("?") + 1).split("&"));
          src = src.substr(0, src.indexOf("?"))
        }
        iframeParams.push("isIframeEmbed=1");
        ifr.src = src + "?" + iframeParams.join(\'&\');
      }
      window.handleIFrameMessage = function(e) {
        if (typeof e.data === \'object\') { return; }
        var args = e.data.split(":");
        if (args.length > 2) { iframe = document.getElementById("JotFormIFrame-" + args[(args.length - 1)]); } else { iframe = document.getElementById("JotFormIFrame"); }
        if (!iframe) { return; }
        switch (args[0]) {
          case "scrollIntoView":
            iframe.scrollIntoView();
            break;
          case "setHeight":
            iframe.style.height = args[1] + "px";
            break;
          case "collapseErrorPage":
            if (iframe.clientHeight > window.innerHeight) {
              iframe.style.height = window.innerHeight + "px";
            }
            break;
          case "reloadPage":
            window.location.reload();
            break;
          case "loadScript":
            if( !window.isPermitted(e.origin, [\'jotform.com\', \'jotform.pro\']) ) { break; }
            var src = args[1];
            if (args.length > 3) {
                src = args[1] + \':\' + args[2];
            }
            var script = document.createElement(\'script\');
            script.src = src;
            script.type = \'text/javascript\';
            document.body.appendChild(script);
            break;
          case "exitFullscreen":
            if      (window.document.exitFullscreen)        window.document.exitFullscreen();
            else if (window.document.mozCancelFullScreen)   window.document.mozCancelFullScreen();
            else if (window.document.mozCancelFullscreen)   window.document.mozCancelFullScreen();
            else if (window.document.webkitExitFullscreen)  window.document.webkitExitFullscreen();
            else if (window.document.msExitFullscreen)      window.document.msExitFullscreen();
            break;
        }
        var isJotForm = (e.origin.indexOf("jotform") > -1) ? true : false;
        if(isJotForm && "contentWindow" in iframe && "postMessage" in iframe.contentWindow) {
          var urls = {"docurl":encodeURIComponent(document.URL),"referrer":encodeURIComponent(document.referrer)};
          iframe.contentWindow.postMessage(JSON.stringify({"type":"urls","value":urls}), "*");
        }
      };
      window.isPermitted = function(originUrl, whitelisted_domains) {
        var url = document.createElement(\'a\');
        url.href = originUrl;
        var hostname = url.hostname;
        var result = false;
        if( typeof hostname !== \'undefined\' ) {
          whitelisted_domains.forEach(function(element) {
              if( hostname.slice((-1 * element.length - 1)) === \'.\'.concat(element) ||  hostname === element ) {
                  result = true;
              }
          });
          return result;
        }
      };
      if (window.addEventListener) {
        window.addEventListener("message", handleIFrameMessage, false);
      } else if (window.attachEvent) {
        window.attachEvent("onmessage", handleIFrameMessage);
      }
      </script>
        </div>';
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