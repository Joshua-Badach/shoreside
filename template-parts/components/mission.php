<?php
$query = new WP_Query(array(
    'category_name'     => 'mission',
    'order'             => 'DESC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));

?>

<div class="container mission">
    <div class="row">
        <section class="col-lg-12">
            <h2>Our Mission</h2>
            <?php
                while ($query->have_posts()){
                    $query->the_post();
                    $content = get_the_content();
                }
                wp_reset_postdata();
                echo $content;
            ?>
        </section>
    </div>
</div>
