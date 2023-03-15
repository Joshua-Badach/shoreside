<?php
global $post;
$banner = get_the_post_thumbnail($post->ID);
$fallback = get_page_by_title('rps-logo-share', OBJECT, 'attachment');
$image_alt = get_post_meta($fallback->ID, '_wp_attachment_image_alt', TRUE);
$image = $fallback->guid;


get_header();
echo '<div class="bannerImage">';
    echo ( get_the_post_thumbnail() )? ($banner) : ('<img src="'. $image . '" alt="' . $image_alt . '">');
echo '</div>';
        if ( have_posts() ) {
            while ( have_posts() ) {
                echo '<div class="container postContainer">
                    <div class="row">';
                if( in_category('Careers')){
                    $jobUrl = get_permalink( $post->ID );
                    $jobName = get_the_title( $post->ID );

                    echo '<section class="col-sm-6">';
                        echo'<h2>' . $jobName . '</h2>';
                        the_post();
                        the_content();
                    echo '</section>';
                    echo'<div class="col-sm-6">
                        <script type="text/javascript" src="https://form.jotform.com/jsform/230734498938067?jobName=' . $jobName . '&jobUrl=' . $jobUrl .'"></script>
                    </div>';
                } else {
                    the_post();
                    the_content();
                }
            }
        }
        echo '</div>
    </div>';
get_footer();
