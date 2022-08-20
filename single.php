<?php get_header() ?>

<div class="container">
    <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                echo '<h2 class="col-6 mx-auto singleheading">' . get_the_title() . '</h2>';
                the_post();
                the_content();
            }
        }
    ?>
</div>

<?php get_footer() ?>
