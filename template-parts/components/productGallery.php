<!--http://placekitten.com/200/200-->
<?php
global $post;
$slug = $post->post_name;
    if ($slug == 'showroom' ) {
        $category = get_category_by_slug('showroom');
        $children = get_term_children($category->term_id, $category->taxonomy);
    }
    else
//        print_r($slug);
        echo ('keep trying idiot' . $slug);
?>
<div class="container">
    <section class="row">
        <h2 class="col-sm-4"><?php echo $category->name ?></h2>
        <p class="col-sm-12"><?php echo $category->description ?></p>
    </section>
    <div class="row">
        <?php
//        print_r($category);
            print_r($children);
//        $query = new WP_Query(array( 'category_name' => 'showroom'));
//        while ($query->have_posts()){
//            $query->the_post();
//            echo $query;
//        }
//        wp_reset_postdata();
        ?>
        <div class="categoryCard col-sm-3">
            <a href="#">
                <img src="http://placekitten.com/200/200" alt="placeholder">
                <p>Category</p>
            </a>
        </div>
    </div>
</div>

