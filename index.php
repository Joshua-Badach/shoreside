<?php
global $post;
get_header();
$slug = $post->post_name;

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
get_footer();