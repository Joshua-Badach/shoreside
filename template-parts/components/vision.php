<?php
$visionQuery = new WP_Query(array(
    'category_name'     => 'vision',
    'order'             => 'DESC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));
?>
<div class="container">
    <section class="row justify-content-sm-center vision">
        <?php
        while ($visionQuery->have_posts()){
        $visionQuery->the_post(); ?>
            <h2 class="offset-sm-2 col-sm-8"><?php the_title() ?></h2>
            <?php
            echo '<p class="col-sm-8">' .  get_the_content() . '</p>';
        }
        wp_reset_postdata();
        ?>
    </section>
</div>