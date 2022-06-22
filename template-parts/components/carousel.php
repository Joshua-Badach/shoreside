<div class="carousel">
    <?php
        $pageID = get_queried_object_id();
        $the_page = sanitize_posT($GLOBALS['wp_the_query']->get_queried_object() );
        $slug = $the_page->post_name;

//        add a check for text, display image only if no text present
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

    if (is_home() == true ):
        $query = new WP_Query(array( 'category_name' => 'slider+home-slider'));

        wp_loop_slider($query, $post);

    elseif (is_home() == false):
        $query = new WP_Query(array( 'category_name' => $slug.'-slider' ));
        wp_loop_slider($query, $post);

    endif;
   ?>
</div>