<?php
$pageID = get_queried_object_id();

if ( is_home() ){
    $query = new WP_Query(array( 'category_name' => 'slider+home'));
    return $query;
}
elseif ( $pageID == 43 ){
    $query = new WP_Query(array( 'category_name' => 'slider+showroom'));
    return $query;
}
elseif ($pageID == 66) {
    $query = new WP_Query(array( 'category_name' => 'slider+parts'));
    return $query;
}
elseif ($pageId == 68) {
    $query = new WP_Query(array( 'category_name' => 'slider+service'));
    return $query;
}
;

function carouselContent( $query, $content = null ){
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