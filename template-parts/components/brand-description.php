<?php
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