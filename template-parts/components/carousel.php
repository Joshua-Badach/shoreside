<div class="carousel">
    <?php
    $pageID = get_queried_object_id();

//    $args = array(
//        'post_type' => 'post',
//        'category_name' => 'home-slider',
//        'posts_per_page' => 5,
//    );
//    $homeQuery = new WP_Query( $args );

    $query = new WP_Query(array( 'category_name' => 'home-slider'));

    while ($query->have_posts() && $pageID == 0){
        $query->the_post();

            ?><div class="col-sm-4 carouselItem"><?php
                the_title();
                the_content();
                the_post_thumbnail('full');

                ?></div><?php
    }

    wp_reset_postdata();
//
//    $args2 = array(
//        'post_type' => 'post',
//        'category_name' => 'part-slider',
//        'posts_per_page' => 5,
//    );
//    $partsQuery = new WP_Query( $args2 );
//    while ($partQuery->have_posts() && $pageID == $args->post_id ){
//    $partQuery->the_post();
//
//            ?><!--<div class="col-sm-4">--><?php
//                the_title();
//                the_content();
//                the_post_thumbnail('full');
//
//            ?><!--</div>--><?php
//    }
//
//    wp_reset_postdata();
//    $the_post_id = get_the_ID();
//    $article_terms = wp_get_post_terms( $the_post_id, ['category', 'post_tag']);
//    print_r( $article_terms);

//        if ( $pageID == 0 ) :
//            if ( $homeQuery->have_posts() ) { while ( $homeQuery->have_posts() ) { $homeQuery->the_post();
//
//        ?><!--<div class="col-sm-4">--><?php
//            the_title();
//            the_content();
//            the_post_thumbnail('full');
//
//            ?><!--</div>--><?php
//                } // end while
//            } // end if
//        endif;
//    ?>
</div>
