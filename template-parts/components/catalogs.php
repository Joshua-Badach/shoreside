<?php

$catalogQuery = new WP_Query(array(
    'category_name'     => 'catalogs',
    'order'             => 'ASC',
    'post_status'       => ' publish',
    'posts_per_page'    => 20
));
$catalogDescriptionQuery = new WP_Query(array(
    'category_name'     => 'catalog content',
    'order'             => 'ASC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));

?>
<div class="container">
    <div class="row">
        <?php
        while ($catalogDescriptionQuery->have_posts()){
            $catalogDescriptionQuery->the_post();
            echo '<h2 class="col-12">' . get_the_title() . '</h2>';
            echo '<p class="col-12">' . get_the_content() . '</p>';
        }
        wp_reset_postdata();
        ?>
    </div>
    <div class="row">
        <?php
        while ($catalogQuery->have_posts()){
            $catalogQuery->the_post();
            echo '<a href="' . get_the_content() . '" class="col-sm-3 catalog">';
                the_post_thumbnail('medium');
                echo '<h2>' . get_the_title() . '</h2>';
            echo '</a>';
        }
        wp_reset_postdata();
        ?>
    </div>
    <div class="row">
        <div class="col-12">
            <script type="text/javascript" src="https://form.jotform.com/jsform/222146149714050"></script>
        </div>
    </div>
</div>