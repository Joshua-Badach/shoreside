<!--http://placekitten.com/200/200-->
<?php
global $post;
$slug = $post->post_name;
    if ($slug == 'showroom' ) {
        $category = get_category_by_slug('showroom');
    }
    elseif ($slug == 'parts-and-accessories'){
        $category = get_category_by_slug('parts-and-accessories');
    }
?>
<!--change the categories...-->
<div class="modal-wrapper">
    <div class="modal">
        <div class="close-modal">
            <div class="modal-content">
<!--                Modal content-->
            </div>
        </div>
    </div>
</div><!-- Modal End -->

<div class="container">
    <section class="row">
        <h2 class="col-sm-6"><?php echo $category->name ?></h2>
        <p class="col-sm-12"><?php echo $category->description ?></p>
    </section>
    <div class="row">
        <?php
        $categories = get_term_children($category->term_id, $category->taxonomy);
        foreach($categories as $category) {
                $cat = get_term($category, 'category');
                echo '<div class="col-sm-3 categoryCard"><p>' . $cat->name . '</p></div>';
            } ?>
   </div>
</div>

