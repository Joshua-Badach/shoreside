<?php
$crewQuery = new WP_Query(array(
    'category_name'     => 'crew',
    'order'             => 'ASC',
    'post_status'       => ' publish',
    'posts_per_page'    => -1
));
?>
<div class="container">
    <section class="row crewSpan">
        <h2 class="offset-sm-8 col-sm-4">The RecPower Crew</h2>
        <?php
        while ($crewQuery->have_posts()){
            $crewQuery->the_post();
            echo '<section class="col-sm crew">';
            the_post_thumbnail('medium');
            ?>
            <h2><?php the_title(); ?> </h2>
            <p> <?php the_content(); ?></p>
            <?php echo '</section>';
        }
        wp_reset_postdata();
        ?>
    </section>
</div>