<div class="carousel">
    <?php
    $pageID = get_queried_object_id();
    $the_page = sanitize_post( $GLOBALS['wp_the_query']->get_queried_object() );
    $slug = $the_page->post_name;

//    copy paste possible fail for testing. Move all this crap into a function after I understand how wordpress handles things a bit better.


//    check if page is home
    if (is_home() ):
//    query for catagories with both slider and home
    $query = new WP_Query(array( 'category_name' => 'slider+home'));
//  Move crap below into function rather than repeat, works for now...

//  Wordpress while loop if posts contain categories slider and home
    while ($query->have_posts()){
        $query->the_post();
//      grabbing wp global variable for posts to use the slug in the button
            echo ('<div class="sliderContent">');
                the_post_thumbnail();
                ?><div class="sliderText">
                    <h3><?php the_title(); ?></h3>
                    <?php the_content(); ?>
                    <button onclick="location.href='<?php echo($post->post_name) ?>' ">Read More</button>
                </div><?php
            echo ('</div>');
    }
//  reset query
    wp_reset_postdata();

    elseif ( $slug == 'showroom'):
        $query = new WP_Query(array( 'category_name' => 'slider+showroom'));

        while ($query->have_posts()){
            $query->the_post();
            echo ('<div class="sliderContent">');
            the_post_thumbnail();
            ?><div class="sliderText">
                <h3><?php the_title(); ?></h3>
                <?php the_content(); ?>
                <button onclick="location.href='<?php echo ($post->post_name) ?>' ">Read More</button>
            </div><?php
            echo ('</div>');
        }
        wp_reset_postdata();

    elseif ($slug == 'parts-and-accessories'):
        $query = new WP_Query(array( 'category_name' => 'slider+parts'));

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

    elseif ($slug == 'service'):
        $query = new WP_Query(array( 'category_name' => 'slider+service'));

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
    endif;
   ?>
</div>