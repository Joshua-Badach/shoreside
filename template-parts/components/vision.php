<?php
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