<?php
global $post;

if ( is_home() || is_front_page() ){
    echo '<section class="carouselWrapper">
        <h2 class="hidden">Recreational Power Sports Special Offerings</h2>
        <div class="mainCarousel">';
} else {
    echo '<section>
        <h2 class="hidden">' . get_the_title() . ' Offerings</h2>
        <div class="mainCarousel">';
}

$the_page = sanitize_post($GLOBALS['wp_the_query']->get_queried_object() );
$slug = $the_page->post_name;

function wp_loop_slider($query){
    while ($query->have_posts()){
        global $post;
        $query->the_post();
        $title = get_the_title();
        $raw_content = get_the_content();
        $content = substr($raw_content, 0, 200);

        $link = get_post_meta($post->ID, 'link', true);
        $get_link_text = get_post_meta($post->ID, 'link-text', true);
        $link_text = ($get_link_text != '') ? ($get_link_text) : ('Read More');

        if ($content != '') {
            echo '<section class="sliderContent">';
            the_post_thumbnail('', array('loading' => 'lazy', 'width' => '1900', 'height' => '400'));
                echo '<div class="sliderText">
                    <h2>' . $title . '</h2>
                    <p>' . $content . '</p>';
                    echo ($link != '') ? ('<a href="' . $link . '">' . $link_text . '</a>') : ('');
                echo '</div>
            </section>';
        } else {
            echo '<section class="sliderContent">
                <h2 class="hidden">' . $title . '</h2>';
                the_post_thumbnail('', array('loading' => 'lazy'));
            echo '</section>';
        }
    }
    wp_reset_postdata();
}

if (is_home() || is_front_page()) {
    $query = new WP_Query(array(
        'category_name' => 'home-slider',
        'posts_per_page' => 5
    ));
    wp_loop_slider($query);
} elseif (!is_home()) {
    $query = new WP_Query(array(
        'category_name' => $slug . '-slider',
        'posts_per_page' => 5
    ));
    wp_loop_slider($query);
}
echo '</div>
</section>';