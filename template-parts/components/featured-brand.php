<?php
global $post;
$slug = $post->post_name;
$terms = get_terms([
    'slug'      => $slug,
    'taxonomy'  => 'pa_manufacturer',
    'hide_empty'=> false
]);
$name = wp_list_pluck($terms, 'name');
$description = wp_list_pluck($terms, 'description');

$image_slug = $slug.'-logo';
$image_id = get_page_by_title($image_slug, OBJECT, 'attachment');
$image = $image_id->guid;

$image_slug_featured = $slug.'-featured';
$featured_id = get_page_by_title($image_slug_featured, OBJECT, 'attachment');
$featured = $featured_id->guid;

$video = get_post_meta($post->ID, 'video', true);
$tagline = get_post_meta($post->ID, 'tagline', true);

echo '<div class="tagLine">
        <div class="container">
            <div class="row justify-content-end">        
                <h2 class="col-sm-3">' . $tagline . '</h2>
            </div>
        </div>
    </div>
        <section id="brandContent" class="container">
        <h3 class="hidden">' . $post->post_title . ' Featured Products</h3>';
echo do_shortcode('[products attribute="manufacturer"  terms="' . $slug . '" per_page="4" columns="4" meta_key="event_date" orderby="meta_value_num" on_sale="" order="DESC" operator="IN"]');

        echo '<div class="row">
            <p class="col-sm-9 description">' . $description[0] . '</p>';
        if ($featured != '') {
            echo '<img class="col-sm-3" src = "' . $featured . '" alt = "' . $post->post_title . ' featured image" >';
        }
        echo '</div>';
        if ($video != '') {
            echo '<div class="row">
            <iframe class="col-md-5 brandVideo" src="https://www.youtube.com/embed/' . $video . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>';
        }
    echo '</section>';
