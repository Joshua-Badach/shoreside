<div class="carousel">
    <?php
    $pageID = get_queried_object_id();

//    fix this later
//    $query = '';
//
//     public function carouselContent($query){
//         while ($query->have_posts()){
//             $query->the_post();
//             ?><!--<div class="col-sm-4">--><?php
//                the_title();
//                the_content();
//                the_post_thumbnail('full');
//             ?><!--</div>--><?php
//         }
//         wp_reset_postdata();
//     }

    if ($pageID == 0):
    $query = new WP_Query(array( 'category_name' => 'home-slider'));


    while ($query->have_posts()){
        $query->the_post();
            echo ('<div class="sliderContent">');
                ?><div class="sliderText">
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </div><?php
            the_post_thumbnail();
            echo ('</div>');
    }

    wp_reset_postdata();

    elseif ($pageID == 43):
    $query = new WP_Query(array( 'category_name' => 'showroom-slider'));

    while ($query->have_posts()){
    $query->the_post();

        ?><div class="col-sm-4"><?php
            the_title();
            the_content();
            the_post_thumbnail('full');

        ?></div><?php
    }

    wp_reset_postdata();

    elseif ($pageID == 66):
        $query = new WP_Query(array( 'category_name' => 'parts-slider'));

        while ($query->have_posts()){
            $query->the_post();

            ?><div class="col-sm-4"><?php
            the_title();
            the_content();
            the_post_thumbnail('full');

            ?></div><?php
        }

        wp_reset_postdata();

        elseif ($pageID == 68):
        $query = new WP_Query(array( 'category_name' => 'service-slider'));

            while ($query->have_posts()){
            $query->the_post();

            ?><div class="col-sm-4"><?php
                the_title();
                the_content();
                the_post_thumbnail('full');

            ?></div><?php
        }

        wp_reset_postdata();
    endif;
   ?>
</div>
