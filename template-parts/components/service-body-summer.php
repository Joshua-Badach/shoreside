<?php

global $post;
$slug = $post->post_name;
$id = get_term_by('slug', $slug, 'product_cat');
$id1 = get_term_by('slug', 'marine-'.$slug, 'product_cat');
$id2 = get_term_by('slug', 'powersports-'.$slug, 'product_cat');

$idObj = $id->term_id;

$taxonomy       = 'product_cat';
$orderby        = 'name';
$show_count     = 0;      // 1 for yes, 0 for no
$pad_counts     = 0;      // 1 for yes, 0 for no
$hierarchical   = 1;      // 1 for yes, 0 for no
$title          = '';
$empty          = 0;
$parent         = '';

$marineArgs = array(
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
$powerArgs = array(
    'post_type'             => 'product',
    'post_status'           => 'publish',
    'posts_per_page'        => '5',
    'tax_query'             => array(
        array(
            'taxonomy'                  => $taxonomy,
            'terms'                     => $id2->term_id,
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


$marineQuery = new WC_Product_Query($marineArgs);
$powerQuery = new WC_Product_Query($powerArgs);
$marineProducts = $marineQuery->get_products();
$powerProducts = $powerQuery->get_products();

echo '<div class="row justify-content-around">
                <section class="col-lg-5 table">
                    <h2>Marine Services</h2>
                    <div class="row tableHeader">
                        <span class="col-8">Name</span><span class="col-4">Starting At</span>
                    </div>';
foreach ($marineProducts as $product){
    echo '<a class="row tableItem" itemscope itemtype="https://schema.org/ProductCollection" href="' . get_permalink( $product->id ) . '"> 
                            <span class="col-8" itemprop="name">' . $product->name . '</span>';
                            if ($product->price == 0){
                                echo '<span class="col-4"> - </span>';
                            } else {
                                echo '<span class="col-4">$ ' . round($product->price) . '</span>';
                            }
                        echo' </a>';
}
echo'</section>
                <section class="col-lg-5 table">
                    <h2>Powersports Services</h2>
                    <div class="row tableHeader">
                        <span class="col-8">Name</span><span class="col-4">Starting At</span>
                    </div>';
foreach ($powerProducts as $product){
    echo '<a class="row tableItem" itemscope itemtype="https://schema.org/ProductCollection" href="' . get_permalink( $product->id ) . '"> 
                            <span class="col-8" itemprop="name">' . $product->name . '</span>';
                            if ($product->price == 0){
                                echo '<span class="col-4"> - </span>';
                            } else {
                                echo '<span class="col-4">$ ' . round($product->price) . '</span>';
                            }
                        echo'</a>';
}
echo'</section>';