<?php
get_header();
$slug = $post->post_name;

echo '<div id="loading" style="display: none"></div>';

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