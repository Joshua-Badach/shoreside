<?php
get_header();
$slug = $post->post_name;
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
echo 'index returned';
get_footer();
?>