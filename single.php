<?php get_header() ?>
<div class="container">
    <div class="modal-wrapper">
        <div class="modal">
            <div class="close-modal">X</div>
            <div class="modal-content"></div>
        </div><!-- Modal End -->
        <div id="modal-wrapper">
            <!--    link for the modal opening, add the .modal-link class to link-->
        </div>
        <div class="show-in-modal hide">
            It worked
        </div>

    </div>
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
