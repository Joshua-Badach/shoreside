<?php get_header() ?>

<div class="container">
    <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
            the_post();

                the_title();
                the_content();

            }
        }
    ?>
<!--    <button href="#" class="modal-link">Open Modal</button>-->
</div>

single page returned
<?php get_footer() ?>
