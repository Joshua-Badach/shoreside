<?php

$infoQuery = new WP_Query(array(
    'category_name'     => 'introduction',
    'order'             => 'DESC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));
$staffQuery = new WP_Query(array(
    'category_name'     => 'information',
    'order'             => 'DESC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));
$crewQuery = new WP_Query(array(
    'category_name'     => 'crew',
    'order'             => 'ASC',
    'post_status'       => ' publish',
    'posts_per_page'    => 3
));
?>

<div class="divider1"></div>
<div class="container">
    <section class="row">
        <div class="col-sm-12">
            <?php
            while ($infoQuery->have_posts()){
                $infoQuery->the_post(); ?>
                <h2><?php the_title(); ?> </h2>
                <p class="information"> <?php the_content(); ?></p>
            <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </section>
</div>
<div class="divider2"></div>

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
    <?php
    while ($staffQuery->have_posts()){
        $staffQuery->the_post();
        echo '<div class="col-sm-12 staff">';
            the_post_thumbnail();
        ?>
        <?php echo '</div>';
    }
    wp_reset_postdata();
    ?>
    </section>
</div>