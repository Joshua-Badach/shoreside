<?php

$warrentyQuery = new WP_Query(array(
    'category_name'     => 'warranty policy',
    'order'             => 'DESC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));
?>

<div class="container">
    <section class="row">
        <div class="col-sm-12">
            <?php
            while ($warrentyQuery->have_posts()){
                $warrentyQuery->the_post();
                echo '<h2>' . get_the_title() . '</h2>';
                echo '<p>' . get_the_content() . '</p>';
            }
            wp_reset_postdata();
            ?>
        </div>
    </section>
</div>