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
} else {

    get_product_search_form();

}

get_footer();
?>