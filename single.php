<?php get_header() ?>
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
    <p>Single page returned</p>
</div>
<?php get_footer() ?>
