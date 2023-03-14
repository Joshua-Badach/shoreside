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

    $terms = get_categories($args);

    echo '<section class="brandSpan">
    <h2 class="hidden">Our Brands</h2>
    <div class="brand-carousel">';
    foreach ($terms as $term) {
        $tester = get_option( "featured_manufacturer=$term->term_id");

        if(in_array("true", $tester) ) {
            brand_cards($term);
        }
    }
    echo '</section>';
}

function brand_cards($term){
    $image_slug = $term->slug.'-logo';
    $image_id = get_page_by_title($image_slug, OBJECT, 'attachment');
    $image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
    $image = $image_id->guid;

    $content = $term->description;
    $trimmed_content = wp_trim_words( $content, 25, '...');


    echo '<section itemscope class="tile" itemtype="https://schema.org/Brand">
        <h3 class="hidden" itemprop="name">' . $term->name . '</h3> 
        <a href="' . $term->slug . '">
            <div class="brands">
                <img loading="lazy" itemprop="logo" src="'. $image . '" alt="' . $image_alt . '">
                <meta itemprop="description" content="' . $trimmed_content . '">
            </div>    
        </a>
        </section>';
    }
brand_loop($args);