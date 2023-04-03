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
    'parent'                    => $idObj,
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

    echo '<section class="container offerings"> 
        <h2 class="col-lg-12">What we offer</h2>
        <div class="row justify-content-center">';
    foreach ($all_categories as $cat) {
        if ($cat->name != 'Uncategorized' && $cat->name != 'Preowned') {
            $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
            $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', TRUE);
            $image = wp_get_attachment_url( $thumbnail_id );
            echo '<section class="col-sm-4 categoryItems" ><a href="' . '/' . $cat->slug . '/' . '">
                <img loading="lazy" width="400" height="400" src="'. $image . '" alt="' . $thumbnail_alt . '">
                <h3>' . $cat->name . '</h3>
            </a></section>';
        }
    }
    echo '</section>';
}

$term = get_term_by('id', 'product_cat');
product_gallery($idObj, $args);

