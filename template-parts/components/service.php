<?php
global $post;
$slug = $post->post_name;

$id = get_term_by('slug', $slug, 'product_cat');
$idObj = $id->term_id;
$categoryDescription = category_description($idObj);
$term = get_term_by('id', $idObj, 'product_cat');
$product = wc_get_product( $idObj );

$taxonomy       = 'product_cat';
$orderby        = 'ID';
$show_count     = 0;      // 1 for yes, 0 for no
$pad_counts     = 0;      // 1 for yes, 0 for no
$hierarchical   = 1;      // 1 for yes, 0 for no
$title          = '';
$empty          = 0;

//May need this later, unsure how I want to handle the content, may want to do it differently, like parts and showroom

//$serviceQuery = new WP_Query(array(
//    'category_name'     => 'service',
//    'order'             => 'ASC',
//    'post_status'       => ' publish',
//    'posts_per_page'    => 1
//));

$args = array(
    'post_type'             => 'product',
    'post_status'           => 'publish',
    'posts_per_page'        => '25',
    'tax_query'             => array(
        array(
            'taxonomy'                  => $taxonomy,
            'terms'                     => $idObj,
            'orderby'                   => $orderby,
            'order'                     => 'ASC',
            'show_count'                => $show_count,
            'pad_counts'                => $pad_counts,
            'hierarchical'              => $hierarchical,
            'title_li'                  => $title,
            'hide_empty'                => $empty
        ),
        array(
            'taxonomy'      => 'product_visibility',
            'field'         => 'slug',
            'terms'         => 'exclude-from-catalog',
            'operator'      => 'NOT IN'
        )
    )
);

$products = get_posts($args);

?>

<div class="container mission">
    <div class="row">
        <div class="col-lg-12">
            <?php

            echo
                '<h2>' . $term->name . '</h2>';
            echo $categoryDescription . '</div>'; ?>
        </div>
        <div class="row">
            <span class="col-12">Prices include all parts, labor and shop supplies. <strong>GST not included.</strong></span><br><br>

        </div>
        <div class="row tableHeader">
            <span class="col-3">Name</span><span class="col-2">Price</span><span class="col-7">Description</span>
        </div>
        <?php
        foreach ($products as $service) {
            $price = wc_get_product( $service )->get_price();

            echo '<a class="row tableItem" href="' . get_permalink( $service->ID ) . '"> <span class="col-3">' . $service->post_title . '</span><span class="col-2">' . $price .  '</span><span class="col-7">' . $service->post_excerpt . '</span></a>';
        } ?>
    </div>
</div>
</div>
