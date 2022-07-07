<?php
$query = new WP_Query(array(
        'category_name'     => 'news',
        'order'             => 'DESC',
        'post_status'       => ' publish',
        'posts_per_page'    => 1
));
function news($query){
    while ($query->have_posts()){
        $query->the_post();
        the_content();
    }
    wp_reset_postdata();
}
?>
<div class="news">
    <p><?php news($query); ?></p>
</div>
