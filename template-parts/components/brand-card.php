<?php
global $post;
$slug = $post->post_name;

$taxonomy       = 'pa_manufacturer';
$orderby        = 'name';
$show_count     = 0;
$pad_counts     = 0;
$hierarchical   = 1;
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


function brand_loop($args){
    $taxonomy           =           'product_cat';
    $hierarchical       =           1;
    $empty              =           0;
    $limit              =           -1;
    $status             =           'publish';


    $query_args = array(
        'status'                        => $status,
        'limit'                         => $limit,
        'hierarchical'                  => $hierarchical,
        'show_option_none'              => '',
        'hide_empty'                    => $empty,
        'taxonomy'                      => $taxonomy,
    );

    $unique = array();
    $name = array();
    $test = ['avalon', 'mirrocraft', 'mercury', 'shorestation', 'argo', 'radinn'];

    foreach (wc_get_products($query_args) as $product) {
        foreach ($product->get_attributes() as $tax => $attribute) {
            foreach ($attribute->get_terms() as $i => $term) {
                if ($term->taxonomy == 'pa_manufacturer') {
                    if ( in_array($term->slug, $test[$i] ) ) {
                        $unique[] = $term->term_id;
                        $name[] = $term->name;
                        $termSlug[] = $term->slug;
                        $termCheck = array_unique($unique);
                        $termName = array_unique($name, SORT_LOCALE_STRING);
                        asort($termName);
                    }
                }
            }
        }
    }

    $terms = get_categories($args);

    echo '<section id="brandSection" class="container">
    <h2 class="hidden">Our Brands</h2>';
        if (isMobile() == false){
            echo '<div class="row brandSpan justify-content-center">';
        } else {
            echo '<div class="row brandSpan brand-carousel">';
        }
    foreach ($terms as $term) {
        if ($term->slug === $test[0] ) {
            $url = 'https://www.avalonpontoons.com/';
            brand_cards($term, $url);
        }
        if ($term->slug === $test[1] ) {
            $url = 'https://www.mirrocraft.com/';
            brand_cards($term, $url);
        }
        if ($term->slug === $test[2] ) {
            $url = 'https://www.mercurymarine.com/en/ca/';
            brand_cards($term, $url);
        }
        if ($term->slug === $test[3] ) {
            $url = 'https://www.mercurymarine.com/en/ca/';
            brand_cards($term, $url);
        }
        if ($term->slug === $test[4] ) {
            $url = 'https://www.argo.com/en/ca/';
            brand_cards($term, $url);
        }
        if ($term->slug === $test[5] ) {
            $url = 'https://www.https://www.radinn.com/';
            brand_cards($term, $url);
        }
    }
    echo '</section>';
}

function brand_cards($term, $url){
    $image_slug = $term->slug.'-logo';
    $image_id = get_page_by_title($image_slug, OBJECT, 'attachment');
    $image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
    $image = $image_id->guid;

    if (isMobile() == false){
        $content = $term->description;
        $trimmed_content = wp_trim_words( $content, 25, '...');
        echo '<section itemscope itemtype="https://schema.org/Brand" class="col-2">
            <a href="' . $term->slug . '">
                <div class="brandCard brands">
                    <div class="brandImage">
                        <img itemprop="logo" src="'. $image . '" alt="' . $image_alt . '">
                        <span hidden itemprop="url"> ' . $url . '</span>
                    </div>   
                    <div class="brandsContent">    
                        <h3 itemprop="name" class="hidden">' . $term->name . '</h3>
                        <p itemprop="description">'; echo $trimmed_content . '</p>
                    </div>
                    <p class="appended">Read More</p> 
                </div>    
            </a>
        </section>';
    } else {
        echo '<section itemscope itemtype="https://schema.org/Brand" class="col-4">
            <a href="' . $term->slug . '">
                <div class="brandCard">
                    <div class="brandImage">
                        <img itemprop="logo" src="'. $image . '">
                        <span hidden itemprop="url"> ' . $url . '</span>
                    </div>   
                    <h3 itemprop="name" class="hidden">' . $term->name . '</h3>
                </div>    
            </a>
        </section>';
    }
}
brand_loop($args);