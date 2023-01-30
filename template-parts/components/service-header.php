<?php
global $post;
$slug = $post->post_name;

$id = get_term_by('slug', $slug, 'product_cat');
$idObj = $id->term_id;
$term = get_term_by('id', $idObj, 'product_cat');
$categoryDescription = category_description($idObj);

$image_slug = $term->slug.'-info';
$image_id = get_page_by_title($image_slug, OBJECT, 'attachment');
$image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
$infoImage = $image_id->guid;

$video = get_post_custom_values('video', $slug);

echo '<section class="container serviceLayout">
    <h2>' . $term->name . '</h2>
        <div class="row">
            <div class="col-lg-6">';
                echo $categoryDescription . '
                <img class="serviceInfo" src="'. $infoImage .'" alt="' . $image_alt . '">';
                    if ($video[0] != '') {
                        echo '<iframe class="serviceVideo" name="productVideo" scrolling="no" frameborder="1" src="https://www.youtube.com/embed/' . $video[0] . '" marginwidth="0px" allowfullscreen=""></iframe>';
                    }
            echo '</div>
    <section class="col-lg-6">
        <h2>Contact Us To Book</h2>
        <script type="text/javascript" src="https://form.jotform.com/jsform/223384426868063"></script>
    </section>
</div>';

