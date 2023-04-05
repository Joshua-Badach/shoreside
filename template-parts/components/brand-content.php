<?php
global $post;
$slug = $post->post_name;
$terms = get_terms([
    'slug'      => $slug,
    'taxonomy'  => 'pa_manufacturer',
    'hide_empty'=> false
]);
($slug == 'mercury') ? ($orderby = 'menu_order') : ($orderby = 'name');
($slug == 'mercury') ? ($order = 'DESC') : ($order = 'ASC');

$name = wp_list_pluck($terms, 'name');
$description = wp_list_pluck($terms, 'description');

$image_slug = $slug.'-logo';
$image_id = get_page_by_title($image_slug, 'OBJECT', 'attachment');
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
    echo '<div itemscope itemtype="https://schema.org/ItemList"  class="container">';
    echo do_shortcode('[products attribute="manufacturer"  terms="' . $name[0] . '" per_page="-1" columns="5"  orderby="' . $orderby . '" on_sale="" order="'. $order . '" operator="IN"]');
    echo '</div>
            </div>
    </section>';