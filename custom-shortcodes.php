<?php
$slug = $post->post_name;

if ( is_home() ){
    $query = new WP_Query(array( 'category_name' => 'slider+home'));
    return $query;
}
elseif ( $slug == 'showroom' ){
    $query = new WP_Query(array( 'category_name' => 'slider+showroom'));
    return $query;
}
elseif ($slug == 'parts-and-accessories') {
    $query = new WP_Query(array( 'category_name' => 'slider+parts'));
    return $query;
}
elseif ($slug == 'service') {
    $query = new WP_Query(array( 'category_name' => 'slider+service'));
    return $query;
}
;

function carouselContent( $atts, $content = null ){
    while ($query->have_posts()){
        $query->the_post();
        }
        return ['<div class="sliderContent">' .
                the_post_thumbnail() .
                    '<div class="sliderText">' .
                    '<h2>' .
                        the_title() .
                    '</h2>' .
                    the_content() .
                    '<button onclick="location.href=\'<?php echo($post->post_name) ?>\' ">Read More</button>' .
                '</div>'
        ];
        wp_reset_postdata();
}
add_shortcode('carousel', 'carouselContent');

function shortcode_test_function($atts, $content = null) {
    $default = array(
        'link' => '#',
    );
    $a = shortcode_atts($default, $atts);
    $content = do_shortcode($content);
    return 'Follow us on <a href="'.($a['link']).'" style="color: blue">'.$content.'</a>';
}
add_shortcode('test_shortcode', 'shortcode_test_function');

function brands_shortcode(){
    return include('template-parts/components/brands.php');
}
add_shortcode('brands', 'brands_shortcode');

function carousel_shortcode(){
    return include('template-parts/components/carousel.php');
}
add_shortcode('carousel', 'carousel_shortcode');

function hero_shortcode(){
    return include('template-parts/components/heroVideo.php');
}
add_shortcode('hero', 'hero_shortcode');

function insta_shortcode(){
    return include('template-parts/components/instagram.php');
}
add_shortcode('instagram', 'insta_shortcode');

function quote_shortcode(){
    return include('template-parts/components/quote.php');
}
add_shortcode('quote', 'quote_shortcode');
