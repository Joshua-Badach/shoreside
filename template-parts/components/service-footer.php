<?php
global $post;
$slug = $post->post_name;
$id = get_term_by('slug', $slug, 'product_cat');

$idObj = $id->term_id;

$taxonomy       = 'product_cat';
$orderby        = 'name';
$show_count     = 0;      // 1 for yes, 0 for no
$pad_counts     = 0;      // 1 for yes, 0 for no
$hierarchical   = 1;      // 1 for yes, 0 for no
$title          = '';
$empty          = 0;
$parent         = '';


$categoryArgs = array(
    'parent'                    => $idObj,
    'taxonomy'                  => $taxonomy,
    'orderby'                   => $orderby,
    'show_count'                => $show_count,
    'pad_counts'                => $pad_counts,
    'hierarchical'              => $hierarchical,
    'title_li'                  => $title,
    'hide_empty'                => $empty
);

$categories = get_categories($categoryArgs);

echo '</div>
            <div class="row justify-content-around">';
foreach ($categories as $cat) {
    $catImageId = get_term_meta($cat->term_id, 'thumbnail_id', true);
    $catImage = wp_get_attachment_url($catImageId);
    echo '<div class="col-sm-3">
        <img width="300px" height="300px" src="' . $catImage . '" alt="' . $cat->name . ' Services">
    </div>';
}
echo '</div>
</section><!--serviceLayout end-->';