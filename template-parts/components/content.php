<?php
global $post;
$slug               =           $post->post_name;
$id                 =           get_term_by('slug', $slug, 'product_cat');
$idObjConst         =           $id->term_id;
$attribute          =           '';

(isset($_REQUEST['product_cat'])) ? $parent = $_REQUEST['product_cat'] : $parent = $id->term_id;
(isset($_REQUEST['term'])) ? $tagObj = $_REQUEST['term'] : $tagObj = '';

if ($parent != '') {
    $idObj = $_REQUEST['product_cat'] ?? $id->term_id;
    $value = $idObj;
    $field = 'id';
    $taxonomy = 'product_cat';
}
if ($tagObj != '') {
    $idObj = '';
    $attribute = 'manufacturer';
    $value = $tagObj;
    $field = 'term_id';
    $taxonomy = 'pa_manufacturer';
}

$term = get_term_by($field, $value, $taxonomy);
$test = get_term_by('id', $parent, 'product_cat');


$image = '';
$image_alt ='';
$image_slug = $term->slug.'-logo';

function getLogo($image_slug, $term)
{
    $image_id = get_page_by_title($image_slug, 'OBJECT', 'attachment');
    $image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
    $image = $image_id->guid;

    echo '<img class="logoBanner col-sm-3" alt="' . $image_alt . '" src="' . $image . '">
            <h2 class="hide"  data-cat="' . $term->slug . '">' . $term->name . '</h2>';

}


//$logo_id = get_page_by_title('logo', 'OBJECT', 'attachment');
//$logo_image = $logo_id->guid;

echo '<section id="contentTrigger" data-page="' . $idObjConst . '" data-slug="' . $slug .'">
    <div data-parent="' . $test->slug . '" class="container display">
        <div class="row">';
    if ($image_slug != 'showroom-logo' && $image_slug != 'parts-and-accessories-logo' && $image_slug != 'preowned-logo') {
        getLogo($image_slug, $term);
    } else {
        echo '<h2 id="categoryTitle" class="col-3"  data-cat="' . $term->slug . '">' . $term->name . '</h2>';
    }
        echo '<p class="col-sm-9 description">' . $term->description . '</p>
        </div>
    </div>
    <div id="mobileFilter">
        <a id="sidebarIcon" href="">
            <img width="30px" height="30px" src="' . get_template_directory_uri(). '/assets/src/library/images/menu-icon.svg"' . 'alt="Menu Icon">
        </a>
    </div>
    <div class="content">';
//        get_sidebar();

    echo '<div itemscope itemtype="https://schema.org/ItemList" class="container">';
            echo do_shortcode('[products category="' . $idObj . '" attribute="' . $attribute . '"  terms="' . $tagObj . '" per_page="-1" columns="5" meta_key="event_date" orderby="meta_value_num" on_sale="" order="DESC" operator="IN"]');
            echo '</div>
    </div>
</section>';