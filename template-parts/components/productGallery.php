<?php
global $post;
$slug = $post->post_name;
$id = get_term_by('slug', $slug, 'product_cat');
$idObj = $id->term_id;
$term = get_term_by('id', $idObj, 'product_cat');
$test = ['Avalon', 'Mercury', 'MirroCraft', 'Shorestation'];

$taxonomy       = 'product_cat';
$orderby        = 'name';
$show_count     = 0;      // 1 for yes, 0 for no
$pad_counts     = 0;      // 1 for yes, 0 for no
$hierarchical   = 1;      // 1 for yes, 0 for no
$title          = '';
$empty          = 0;

$args = array(
    'taxonomy'                  => $taxonomy,
    'terms'                     => $idObj,
    'orderby'                   => $orderby,
    'show_count'                => $show_count,
    'pad_counts'                => $pad_counts,
    'hierarchical'              => $hierarchical,
    'title_li'                  => $title,
    'hide_empty'                => $empty
);

function product_gallery($idObj, $args, $term){
    $all_categories = get_categories( $args );
    $categoryDescription = category_description($idObj);

    echo '<section class="container"> 
        <div class="row">
        <h2>' . $term->name . '</h2>';
    echo $categoryDescription . '</div>
        <div class="row">';
    foreach ($all_categories as $cat) {
        if ($cat->category_parent == $idObj && $cat->name != 'Uncategorized') {
            $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
            $image = wp_get_attachment_url( $thumbnail_id );
            echo '<a class="col-3 categoryItems" href="' . get_term_link($cat->slug, 'product_cat') . '">
            <img src="'. $image . '" width="150px" height="150px"><span>'
                . $cat->name .
                ' </span></a>';
        }
    }
    echo '</section>';
}


if ($term->name == $test[0]) {
    $product_term_ids = array(258);

    $product_term_args = array(
        'taxonomy' => 'product_cat',
        'include' => $product_term_ids,
        'orderby' => 'include'
    );
    $product_terms = get_terms($product_term_args);

    $product_term_slugs = [];
    foreach ($product_terms as $product_term) {
        $product_term_slugs[] = $product_term->slug;
    }

    $product_args = array(
        'post_status' => 'publish',
        'limit' => -1,
        'category' => $product_term_slugs,
        //more options according to wc_get_products() docs
    );
    $products = wc_get_products($product_args);

    foreach ($products as $product) {
        $product_id = $product->get_id();
        $product_type = $product->get_type();
        $product_title = $product->get_title();
        $product_permalink = $product->get_permalink();
        $product_regular_price = $product->get_regular_price();
        $product_sale_price = $product->get_sale_price();
        $product_short_desc = $product->get_short_description();
        $product_categories = $product->get_categories();

    }
}

if ($term->name == $test[1]){
    product_gallery($idObj, $args, $term);
}
if ($term->name == $test[2]){
    product_gallery($idObj, $args, $term);
}
if ($term->name == $test[3]){
    product_gallery($idObj, $args, $term);
}

