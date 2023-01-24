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
//    odd way of going about it but I'll take it.can't seem to get a consistent way of handling the manufacturers..

    echo '<section id="contentTrigger">
            <div class="container display">
                <div class="row">';
    if ($image != '') {
        echo '<img class="logoBanner col-sm-3" alt="' . $slug . ' logo" src="' . $image . '">
                        <h2 class="hide">' . $name[0] . '</h2>';
    } else {
        echo '<h2 id="categoryTitle" class="col-3">' . $name[0] . '</h2>';
    }
    echo '<p class="col-sm-9 description">' . $description[0] . '</p>
                </div>
            </div>
            <div id="mobileFilter"></div>
            <div class="content">';
    echo '<div class="container">';
    echo do_shortcode('[products attribute="manufacturer"  terms="' . $slug . '" per_page="-1" columns="5" meta_key="event_date" orderby="meta_value_num" on_sale="" order="DESC" operator="IN"]');
    echo '</div>
            </div>
    </section>';