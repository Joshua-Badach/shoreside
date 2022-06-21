<!--http://placekitten.com/200/200-->
<?php $category = get_category_by_slug('showroom'); ?>
<div class="container">
    <section class="row">
        <h2 class="col-sm-4"><?php echo $category->name ?></h2>
        <p class="col-sm-12"><?php echo $category->description ?></p>
    </section>
    <div class="row">
        <?php
            print_r($category);
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

