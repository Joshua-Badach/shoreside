<?php
get_header();
$slug = $post->post_name;

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