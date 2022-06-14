<?php
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        ?>
<div class="carousel">
    <?php
    $pageID = get_queried_object_id();
    $home_query = new WP_Query( $args );

    if ( $pageID == 0 ) :
        echo ('category '. $pageID);
    elseif ( $pageID == 1):
        echo ('not the category you\'re looking for');
    endif;

    ?>
<!--    <img src="http://placekitten.com/1920/1080" alt="placeholder">-->
<!--    <img src="http://placekitten.com/1920/1081" alt="placeholder">-->
<!--    <img src="http://placekitten.com/1920/1082" alt="placeholder">-->
<!--    <img src="http://placekitten.com/1920/1083" alt="placeholder">-->
<!--    <img src="http://placekitten.com/1920/1084" alt="placeholder">-->

</div>
<?php } // end while
    } // end if
    ?>