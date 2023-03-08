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

    $name = array();
    $test = ['avalon', 'mirrocraft', 'mercury', 'shorestation', 'argo', 'radinn', 'sanger', 'montego-bay'];

    foreach (wc_get_products($query_args) as $product) {
        foreach ($product->get_attributes() as $tax => $attribute) {
            foreach ($attribute->get_terms() as $i => $term) {
                if ($term->taxonomy == 'pa_manufacturer') {
                    if ( in_array($term->slug, $test[$i] ) ) {
                        $name[] = $term->name;
                        $termName = array_unique($name, SORT_LOCALE_STRING);
                        asort($termName);
                    }
                }
            }
        }
    }

    $terms = get_categories($args);

//    Hash out a better way of doing this... Good enough for now

    echo '<section class="brandSpan">
    <h2 class="hidden">Our Brands</h2>';
        if (isMobile() == false){
            echo '<div class="brand-carousel">';
        } else {
            echo '<div class="brand-carousel-mobile">';
        }
    foreach ($terms as $term) {

        if ($term->slug === $test[0] ) {
            $url = 'avalonpontoons.com/';
            brand_cards($term, $url);
        }
        if ($term->slug === $test[1] ) {
            $url = 'mirrocraft.com/';
            brand_cards($term, $url);
        }
        if ($term->slug === $test[2] ) {
            $url = 'mercurymarine.com/en/ca/';
            brand_cards($term, $url);
        }
        if ($term->slug === $test[3] ) {
            $url = 'shorestation.com/';
            brand_cards($term, $url);
        }
        if ($term->slug === $test[4] ) {
            $url = 'argoxtv.com/ca/';
            brand_cards($term, $url);
        }
        if ($term->slug === $test[5] ) {
            $url = 'radinn.com/';
            brand_cards($term, $url);
        }
        if ($term->slug === $test[6] ) {
            $url = 'sangerboats.com/';
            brand_cards($term, $url);
        }
        if($term->slug == $test[7]) {
            $url = 'montegobaypontoons.com/';
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

    $content = $term->description;
    $trimmed_content = wp_trim_words( $content, 25, '...');


    echo '<section itemscope itemtype="https://schema.org/Brand">
        <h3 class="hidden" itemprop="name">' . $term->name . '</h3> 
        <a href="' . $term->slug . '">
            <div class="brands">
                <img loading="lazy" itemprop="logo" src="'. $image . '" alt="' . $image_alt . '">
                <meta itemprop="url" content="' . $url . '">
                <meta itemprop="description" content="' . $trimmed_content . '">
            </div>    
        </a>
        </section>';
    }
brand_loop($args);