<?php

global $post;
$slug = $post->post_name;
$id = get_term_by('slug', $slug, 'product_cat');
$id1 = get_term_by('slug', 'winterize-'.$slug, 'product_cat');


$idObj = $id->term_id;

$taxonomy       = 'product_cat';
$orderby        = 'name';
$show_count     = 0;      // 1 for yes, 0 for no
$pad_counts     = 0;      // 1 for yes, 0 for no
$hierarchical   = 1;      // 1 for yes, 0 for no
$title          = '';
$empty          = 0;
$parent         = '';

$winterizeQuery = array(
    'post_type'             => 'product',
    'post_status'           => 'publish',
    'posts_per_page'        => '5',
    'tax_query'             => array(
        array(
            'taxonomy'                  => $taxonomy,
            'terms'                     => $id1->term_id,
            'orderby'                   => $orderby,
            'order'                     => 'DESC',
            'show_count'                => $show_count,
            'pad_counts'                => $pad_counts,
            'hierarchical'              => $hierarchical,
            'title_li'                  => $title,
            'hide_empty'                => $empty,
        ),
    )
);
$winterizeQuery = new WC_Product_Query($winterizeQuery);
$winterizeProducts = $winterizeQuery->get_products();

echo '<div class="row justify-content-around">
                <section class="col-lg-12 table">
                    <h2>Winterize Services</h2>
                    <div class="row tableHeader">
                        <span class="col-8">Name</span><span class="col-4">Starting At</span>
                    </div>';
                    foreach ($winterizeProducts as $product){
                        echo '<a class="row tableItem" itemscope itemtype="https://schema.org/ProductCollection" href="' . get_permalink( $product->id ) . '"> 
                            <span class="col-8" itemprop="name">' . $product->name . '</span>
                            <span class="col-4">$ ' . round($product->price) .  '</span>
                        </a>';
                    }
                echo'</section>';
