<?php
//global $post;
$slug = $post->post_name;
$idObj = $id->term_id;

$brandsQuery = new WP_Query(array(
    'category_name'     => 'brands-'.$slug,
    'order'             => 'DESC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));

echo '<section class="container"> 
            <div class="row">';
                while ($brandsQuery->have_posts()){
                    $brandsQuery->the_post(); ?>
                        <h2 class="col-sm-3 offset-sm-9"><?php the_title(); ?> </h2>
            </div>
            <div class="row">
                <p class="col-sm-12"> <?php the_content(); ?></p>
            </div>
                <?php
                }
                wp_reset_postdata();
                echo '</div>
      </section>';

//                var_dump($brandsQuery);
?>