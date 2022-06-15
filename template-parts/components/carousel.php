<!-- wp:template-part {"slug":"carousel"} /-->
<div class="carousel">
    <?php
    $pageID = get_queried_object_id();
//    get the page id to check what posts to pull

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

//    check if page id is 0, home
    if ($pageID == 0):
//    query for catagories with both slider and home
    $query = new WP_Query(array( 'category_name' => 'slider+home'));

//  Wordpress while loop if posts contain categories slider and home
    while ($query->have_posts()){
        $query->the_post();
        global $post;
//      grabbing wp global variable for posts to use the slug in the button
            echo ('<div class="sliderContent">');
                the_post_thumbnail();
                ?><div class="sliderText">
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                    <button onclick="location.href='<?php echo($post->post_name) ?>' ">Read More</button>
                </div><?php
            echo ('</div>');
    }
//  reset query
    wp_reset_postdata();

    elseif ($pageID == 43):
    $query = new WP_Query(array( 'category_name' => 'slider+showroom'));

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
        $query = new WP_Query(array( 'category_name' => 'slider+parts'));

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
        $query = new WP_Query(array( 'category_name' => 'slider+service'));

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
