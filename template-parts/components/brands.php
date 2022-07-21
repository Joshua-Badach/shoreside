<?php

//idObj is set to 0 because that is the top level boat category

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

function brand_loop($idObj, $args){
    $all_categories = get_categories( $args );
    $test = ['Avalon', 'MirroCraft', 'Mercury', 'Shorestation' ];
    echo '<section class="container"> 
                <div class="row brandSpan">
                <h2>Our Brands</h2>';
                foreach ($all_categories as $cat) {
                    if ($cat->name === $test[0] ) {
                        brand_cards($cat);
                        }
                    if ($cat->name === $test[1] ) {
                        brand_cards($cat);
                    }
                    if ($cat->name === $test[2] ) {
                        brand_cards($cat);
                    }
                    if ($cat->name === $test[3] ) {
                        brand_cards($cat);
                    }
                }
                echo '</section>';
}

function brand_cards($cat){
    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
    $image = wp_get_attachment_url( $thumbnail_id );
    $content = $cat->description;
    $trimmed_content = wp_trim_words( $content, 100, '<a href="'. get_permalink() .'">...[ read more ]</a>');

    echo '<section class="col-3">
            <a href="/' . $cat->slug . '/">
                <div class="brandCard brands">
                    <div class="brandImage">
                        <img src="'. $image . '" width="150px" height="150px">
                    </div>   
                    <div class="brandsContent">    
                        <h3>' . $cat->name . '</h3>
                        <p>'; echo $trimmed_content . '</p> 
                    </div>
                </div>    
            </a>
    </section>';
}

brand_loop($idObj, $args);

?>