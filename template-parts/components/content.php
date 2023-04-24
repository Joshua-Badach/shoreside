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

($slug == 'mercury') ? ($orderby = 'menu_order') : ($orderby = 'name');
($slug == 'mercury') ? ($order = 'DESC') : ($order = 'ASC');

$image = '';
$image_alt ='';
$image_slug = $term->slug.'-logo';

function getLogo($image_slug, $term)
{
    $image_id = get_page_by_title($image_slug, 'OBJECT', 'attachment');
    $image_alt = get_post_meta(isset($image_id->ID), '_wp_attachment_image_alt', TRUE);
    $image = isset($image_id->guid);

    echo ($image != '')  ? ('<img class="logoBanner col-sm-3" alt="' . $image_alt . '" src="' . $image . '">') : '';
    echo ($image != '')  ? ('<h2 class="hide"  data-cat="' . $term->slug . '">' . $term->name . '</h2>') : ('<h2 id="categoryTitle" class="col-3"  data-cat="' . $term->slug . '">' . $term->name . '</h2>');
}
echo '<section id="contentTrigger" data-page="' . $idObjConst . '" data-slug="' . $slug .'">
    <div data-parent="' . $test->slug . '" class="container display">
        <div class="row">';
        getLogo($image_slug, $term);
        echo '<p class="col-sm-9 description">' . $term->description . '</p>
        </div>
    </div>

    <div id="mobileFilter">
        <a id="sidebarIcon" href="">
            <img width="30px" height="30px" src="' . get_template_directory_uri(). '/assets/src/library/images/menu-icon.svg"' . 'alt="Menu Icon">
        </a>
    </div>
    <div class="content">';
        get_sidebar();

    echo '<div class="container">';
            echo do_shortcode('[products category="' . $idObj . '" attribute="' . $attribute . '"  terms="' . $tagObj . '" per_page="-1" columns="5" orderby="'. $orderby . '" on_sale="" order="' . $order . '" operator="IN"]');
            echo '</div>
    </div>
</section>';