<?php
global $post;
$slug = $post->post_name;
//hardcoded to retrieve top level categories
$idObj = 0;

$taxonomy       = 'product_cat';
$orderby        = 'name';
$show_count     = 0;      // 1 for yes, 0 for no
$pad_counts     = 0;      // 1 for yes, 0 for no
$hierarchical   = 1;      // 1 for yes, 0 for no
$title          = '';
$empty          = 0;

$args = array(
    'taxonomy'                  => $taxonomy,
    'orderby'                   => $orderby,
    'show_count'                => $show_count,
    'pad_counts'                => $pad_counts,
    'hierarchical'              => $hierarchical,
    'title_li'                  => $title,
    'hide_empty'                => $empty
);
function product_gallery($idObj, $args){
    $all_categories = get_categories( $args );

    echo '<section class="container"> 
        <h2 class="col-lg-12">What we offer</h2>
        <div class="row justify-content-center">';
    foreach ($all_categories as $cat) {
        if ($cat->category_parent == 0 && $cat->name != 'Uncategorized' && $cat->name != 'Preowned') {
            $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
            $image = wp_get_attachment_url( $thumbnail_id );
            echo '<a class="col-4 categoryItems" href="' . '/' . $cat->slug . '/' . '">
            <img src="'. $image . '" width="150px" height="150px"><span>'
                . $cat->name .
                ' </span></a>';
        }
    }
    echo '</section>';
}

$term = get_term_by('id', 'product_cat');
product_gallery($idObj, $args);

