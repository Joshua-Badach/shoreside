<?php
global $post;
$slug               =           $post->post_name;
$id                 =           get_term_by('slug', $slug, 'product_cat');
$idObjConst         =           $id->term_id;
$tagObj             =           $_REQUEST['term'];
$parent             =           $_REQUEST['product_cat'];

if ($_GET['attribute'] == '') {
    if ($_GET['product_cat'] != '') {
        $idObj = $_REQUEST['product_cat'];
        $value = $idObj;
        $field = 'id';
        $taxonomy = 'product_cat';
    } else {
        $idObj = $id->term_id;
        $value = $idObj;
        $field = 'id';
        $taxonomy = 'product_cat';
    }
}

if ($tagObj != '') {
    $attribute = 'manufacturer';
    $value = $tagObj;
    $field = 'term_id';
    $taxonomy = 'pa_manufacturer';
}

$term = get_term_by($field, $value, $taxonomy);
$test = get_term_by('id', $parent, 'product_cat');

$image_slug = $term->slug.'-logo';
$image_id = get_page_by_title($image_slug, OBJECT, 'attachment');
$image = $image_id->guid;

echo '<section id="contentTrigger" data-page="' . $idObjConst . '" data-slug="' . $slug .'">
    <div data-parent="' . $test->slug . '" class="container display">
        <div class="row">';
            if ($image != ''){
            echo '<img class="logoBanner col-sm-3" alt="' . $slug . ' logo" src="' . $image . '">
            <h2 id="categoryTitle" class="col-12 hide"  data-cat="' . $term->slug . '">' . $term->name . '</h2>';
            } else {
            echo '<h2 id="categoryTitle" class="col-12"  data-cat="' . $term->slug . '">' . $term->name . '</h2>';
            }
            echo '<p class="col-12">' . $term->description . '</p>
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
            echo do_shortcode('[products category="' . $idObj . '" attribute="' . $attribute . '"  terms="' . $tagObj . '" per_page="-1" columns="5" meta_key="event_date" orderby="meta_value_num" on_sale="" order="DESC" operator="IN"]');
            echo '</div>
    </div>
</section>';