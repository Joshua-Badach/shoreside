<?php get_header() ?>
single.php page returned
<div class="container">
    <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
            the_post();

                the_title();
                the_content();

            } // end while
        } // end if
    ?>
</div>
<?php get_footer() ?>
