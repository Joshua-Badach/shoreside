<?php

if ( is_home() || is_front_page() ){
    echo '<section class="carouselWrapper">';
    echo '<h2 class="col-sm-8">How Recreational Power Sports Does It Better</h2>';
    echo '<div class="mainCarousel">';
} else {
    echo '<section>';
    echo '<h2 class="hidden">' . get_the_title() . ' Offerings</h2>';
    echo '<div class="carousel">';
}

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

echo '</div>
</section>';