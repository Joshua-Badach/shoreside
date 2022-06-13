<div class="carousel">
    <?php
    $pageID = get_queried_object_id();
    $home_query = new WP_Query( $args );

    if ($pageID == 0){
        echo ('<h1> It Worked</h1>');
    }
    elseif ( $pageID == 1){
        echo ('<h1> This is page</h1>'. $pageID);
    }
    ?>
</div>