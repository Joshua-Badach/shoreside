<?php
global $post;
$slug = $post->post_name;

//    can tell I'm getting tired of making changes...

$id = get_term_by('slug', $slug, 'product_cat');
$id1 = get_term_by('slug', 'marine-'.$slug, 'product_cat');
$id2 = get_term_by('slug', 'powersports-'.$slug, 'product_cat');
$idObj = $id->term_id;
$categoryDescription = category_description($idObj);
$term = get_term_by('id', $idObj, 'product_cat');
//    foreach the images, $slug-featured-$i
$image_slug = $term->slug.'-info';
$image_id = get_page_by_title($image_slug, OBJECT, 'attachment');
$infoImage = $image_id->guid;

$video = get_post_custom_values('video', $slug);


$taxonomy       = 'product_cat';
$orderby        = 'name';
$show_count     = 0;      // 1 for yes, 0 for no
$pad_counts     = 0;      // 1 for yes, 0 for no
$hierarchical   = 1;      // 1 for yes, 0 for no
$title          = '';
$empty          = 0;
$parent         = '';

//    Code looks like crap, but works. Want to refine this a little in the future time permitting

$args1 = array(
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
$args2 = array(
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

$marineQuery = new WC_Product_Query($args1);
$powerQuery = new WC_Product_Query($args2);
$marineProducts = $marineQuery->get_products();
$powerProducts = $powerQuery->get_products();
echo '<section class="container serviceLayout">
            <h2>' . $term->name . '</h2>
            <div class="row">
                <div class="col-lg-6">';
                echo $categoryDescription . '
                    <img class="serviceInfo" src="'. $infoImage .'" alt="Services We Offer">
                </div>
                <section class="col-lg-6">
                <h2>Contact Us To Book</h2>
                    <script type="text/javascript" src="https://form.jotform.com/jsform/223384426868063"></script>
                </section>
            </div>';
echo '<div class="row justify-content-around">
                <section class="col-lg-5 table">
                    <h2>Marine Services</h2>
                    <div class="row tableHeader">
                        <span class="col-8">Name</span><span class="col-4">Starting At</span>
                    </div>';
foreach ($marineProducts as $product){
    echo '<a class="row tableItem" itemscope itemtype="https://schema.org/ProductCollection" href="' . get_permalink( $product->id ) . '"> 
                        <span class="col-8" itemprop="name">' . $product->name . '</span>
                        <span class="col-4" itemprop="price">$ ' . round($product->price) .  '</span>
                        </a>';
}
echo'</section>
                <section class="col-lg-5 table">
                    <h2>Powersports Services</h2>
                    <div class="row tableHeader">
                        <span class="col-8">Name</span><span class="col-4">Starting At</span>
                    </div>';
foreach ($powerProducts as $product){
    echo '<a class="row tableItem" itemscope itemtype="https://schema.org/ProductCollection" href="' . get_permalink( $product->id ) . '"> 
                            <span class="col-8" itemprop="name">' . $product->name . '</span>
                            <span class="col-4" itemprop="price">$ ' . round($product->price) .  '</span>
                        </a>';
}
echo'</section>
            </div>
            <div class="row justify-content-around">
                <img class="col-3" src="https://placekitten.com/g/300/300" alt="Services We Offer">          
                <img class="col-3" src="https://placekitten.com/g/300/300" alt="Services We Offer">          
                <img class="col-3" src="https://placekitten.com/g/300/300" alt="Services We Offer">          
            </div>
            <div class="row">
                <iframe class="productVideo col-lg-6" name="productVideo" scrolling="no" frameborder="1" src="https://www.youtube.com/embed/' . $video[0] . '" marginwidth="0px" allowfullscreen=""></iframe>
            </div>
    </section>';