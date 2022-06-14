
<div class="carousel">
    <?php if ( have_posts() ) { while ( have_posts() ) { the_post();

    $pageID = get_queried_object_id();
    $home_query = new WP_Query( $args );

    if ( $pageID == 1 ) :
    ?><div class="tester"><?php

        the_title();
        the_content();
        the_post_thumbnail();

        ?></div><?php
    else:
//        change to elsif later
        echo ('<div>not the category you\'re looking for</div>');
    endif;

//    <img src="http://placekitten.com/1920/1080" alt="placeholder">
//    <img src="http://placekitten.com/1920/1081" alt="placeholder">
//    <img src="http://placekitten.com/1920/1082" alt="placeholder">
//    <img src="http://placekitten.com/1920/1083" alt="placeholder">
//    <img src="http://placekitten.com/1920/1084" alt="placeholder">
} // end while
    } // end if
    ?>
</div>
