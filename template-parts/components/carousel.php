<div class="carousel">
    <?php
        $pageID = get_queried_object_id();
        $the_page = sanitize_post( $GLOBALS['wp_the_query']->get_queried_object() );
        $slug = $the_page->post_name;

        function wp_loop_slider($query, $post){
            while ($query->have_posts()){
            $query->the_post();
                echo ('<div class="sliderContent">');
                the_post_thumbnail();
                ?><div class="sliderText">
                <h3><?php the_title(); ?></h3>
                <?php the_content(); ?>
                <button onclick="location.href='<?php echo($post->post_name) ?>' ">Read More</button>
                </div><?php
                echo ('</div>');
        }
        wp_reset_postdata();
    }

//    clean up below

    if (is_home() ):
    $query = new WP_Query(array( 'category_name' => 'slider+home'));

    wp_loop_slider($query, $post);

    elseif ( $slug == 'showroom'):
        $query = new WP_Query(array( 'category_name' => 'slider+showroom-2'));

        wp_loop_slider($query, $post);

    elseif ($slug == 'parts-and-accessories'):
        $query = new WP_Query(array( 'category_name' => 'slider+parts'));

        wp_loop_slider($query, $post);

    elseif ($slug == 'service'):
        $query = new WP_Query(array( 'category_name' => 'slider+service'));

        wp_loop_slider($query, $post);

    endif;
   ?>
</div>