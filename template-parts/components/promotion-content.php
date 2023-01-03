<?php
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