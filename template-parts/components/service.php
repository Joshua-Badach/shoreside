<?php
global $post;
$slug = $post->post_name;
$id = get_term_by('slug', $slug, 'product_cat');
$idObj = $id->term_id;
$categoryDescription = category_description($idObj);
$term = get_term_by('id', $idObj, 'product_cat');

$serviceQuery = new WP_Query(array(
    'category_name'     => 'service',
    'order'             => 'DESC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));

?>

<div class="container mission">
    <div class="row">
        <div class="col-lg-12">
            <?php echo
            '<h2>' . $term->name . '</h2>';
            echo $categoryDescription . '</div>';
?>
        <div class="col-lg-12">
            <?php
            while ($serviceQuery->have_posts()){
                $serviceQuery->the_post();
                $content = get_the_content();
            }
            wp_reset_postdata();
            echo $content;
            ?>
        </div>
    </div>
</div>
