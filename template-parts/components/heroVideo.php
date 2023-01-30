<?php
global $post;

if (is_home() || is_front_page()) {
    if (isMobile()) {
        echo '<div class="heroVideo">';
        $featured = get_the_post_thumbnail($post_id);
        echo $featured;
        echo '</div>';
    } else {
        echo '<div class="heroVideo">
            <video autoplay loop muted>
                <source src="/wp-content/uploads/hero.mp4">
            </video>
        </div>';
    };
    echo '<div class="container">
    <div class="row">
        <section class="col-12 home-block">
            <h2 class="home-heading">' . get_option('blogdescription') . '</h2>
        </section>
    </div>
</div>';
} else {
    $slug               =           $post->post_name;

    $hero_slug          =           $slug.'-hero';
    $hero_id            =           get_page_by_title($hero_slug, OBJECT, 'attachment');
    $hero_video         =           $hero_id->guid;

    $image_slug         =           $slug.'-logo';
    $logo_id            =           get_page_by_title($image_slug, OBJECT, 'attachment');
    $logo_alt           =           get_post_meta($logo_id->ID, '_wp_attachment_image_alt', TRUE);
    $logo_image         =           $logo_id->guid;
    echo '<div class="heroVideo">
            <video autoplay loop muted>
                <source src="' . $hero_video . '">
            </video>
            <div class="container featuredBrandLogo">
                <div class="row">
                    <img class="col-sm-3 featured-logo" alt="' . $logo_alt . '" src="' . $logo_image . '">
                </div>
            </div>
        </div>';
}

