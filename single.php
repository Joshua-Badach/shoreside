<?php get_header() ?>
<div class="modal-wrapper">
    <div class="modal">
        <div class="close-modal">X</div>
        <div id="modal-content"></div>
    </div>
</div>
<div class="show-in-modal hide">
    <p>Modal content - find out why hide function has to be manually triggered. Seems like wordpress is preventing jquery</p>
</div>
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
    <button href="#" class="modal-link">Open Modal</button>
    <p>Single page returned</p>
</div>


<?php get_footer() ?>
