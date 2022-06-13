<div class="carousel">
    <?php
    $pageID = get_queried_object_id();
    $home_query = new WP_Query( $args );

    if ($pageID == 0){
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                if ( in_category( '2' )):
                    echo ('<div> category worked </div>');
                else:
                    the_title();
                endif;
//                echo ('<h1> It Worked</h1>' . $pageID);
            } // end while
        } // end if
    }
    elseif ( $pageID == 1){
        echo ('<h1> This is page</h1>'. $pageID);
    }
    ?>
</div>