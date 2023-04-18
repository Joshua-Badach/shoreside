<?php
global $post;


get_header();
$slug = $post->post_name;

if ($slug != 'search') {
    if(isset($_REQUEST['product_cat']) != ''){
        $term = get_term_by('id', $_REQUEST['product_cat'], 'product_cat');
        $term_id = $term->term_id;
        $cat_video = implode(get_term_meta($term_id, 'cat_video', false));

        if ($cat_video != '') {
            echo '<div id="shelf">
                <div id="videoTab"></div>
                <div id="videoSlider" style="display: none"></div>
            </div>';
        }
    }
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