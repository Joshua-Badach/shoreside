<?php
global $post;


get_header();
$slug = $post->post_name;

if ($slug != 'search') {
    if($slug == 'showroom' || $slug =='parts-and-accessories') {
        echo '<div id="shelf">';
        (isset($_REQUEST['product_cat']) != '') ? ($term = get_term_by('id', $_REQUEST['product_cat'], 'product_cat')) : ($term = get_term_by('slug', $slug, 'product_cat'));
        $term_id = $term->term_id;
        $cat_video = implode(get_term_meta($term_id, 'cat_video', false));
        if($cat_video != ''){
            echo '<div id="videoTab"><img src="' . get_template_directory_uri() . '/assets/src/library/images/play-button.webp' . '" alt="Video Icon"></div>
                <div id="videoSlider" style="display: none">
                    <iframe width="100%" height="100%"
                        src="https://www.youtube.com/embed/' . $cat_video . '">
                    </iframe>
                </div>';
        }
        echo '</div>';
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