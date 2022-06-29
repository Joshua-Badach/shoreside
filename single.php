<?php get_header() ?>
<div class="modal-wrapper">
    <div class="modal container">
        <div class="close-modal">X</div>
        <div id="modal-content"></div>
    </div>
</div>
<div class="show-in-modal hide">
    <div class="row">
        <img src="http://placekitten.com/400/600" class="col-sm-6" alt="">
        <p class="col-sm-12">Modal content - hackey fix for the jQuery, modal not closing otherwise. I have no idea why my test worked but I'll take the win</p>
    </div>
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
