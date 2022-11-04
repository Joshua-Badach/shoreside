<?php
get_header();
$slug = $post->post_name;

echo '<div id="loading" style="display: none"></div>';
//global $wp;
//$url = home_url( $wp->request );
//$partsCheck = 'parts-and-accessories';
//
//if (strpos($url, $partsCheck) == true){
//    get_sidebar();
//    echo '<div class="container content">';
//} else {
//    echo '<div class="container">';
//}
if ($slug != 'search') {
    echo '<div class="modal" style="display: none">
        <div id="modalBackground" class="container">
            <div id="modalContent"></div>
        </div>    
    </div>';

    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_content();
        }
    }
} elseif ($slug == 'search') {
// may handle this differently... probably...
    get_product_search_form();

}
//if ($slug == 'showroom' || $slug == 'parts-and-accessories'){
//echo '<div class="container">
//        <div class="row loadMore">
//            <button class="button-3d load_results" data-page="1" data-url="'; echo admin_url("admin-ajax.php") . '">Load more</button>
//        </div>
//    </div>';
//}
//echo 'index returned';
get_footer();