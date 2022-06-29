<?php get_header() ?>
<div class="modal-wrapper">
    <div class="modal">
        <div class="close-modal">X</div>
        <div class="modal-content">
<!--            modal content?  -->
        </div>
    </div><!-- Modal End -->
    <div id="modal-wrapper">
        <!--    link for the modal opening, add the .modal-link class to link-->
    </div>
    <div class="show-in-modal hide">
        <p>Modal content</p>
    </div>
</div>
<!--<div class="modal" tabindex="-1" role="dialog">-->
<!--    <div class="modal-dialog" role="document">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title">Modal title</h5>-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                    <span aria-hidden="true">&times;</span>-->
<!--                </button>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <p>Modal body text goes here.</p>-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-primary">Save changes</button>-->
<!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
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
