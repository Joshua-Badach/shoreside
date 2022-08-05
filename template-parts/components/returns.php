<?php

$returnQuery = new WP_Query(array(
    'category_name'     => 'return policy',
    'order'             => 'DESC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));
?>

<div class="container">
    <section class="row">
        <div class="col-sm-12">
            <?php
            while ($returnQuery->have_posts()){
                $returnQuery->the_post(); ?>
                <?php echo '<p>' . get_the_content() . '</p>' ?>
            <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </section>
</div>