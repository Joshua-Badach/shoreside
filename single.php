<?php
global $post;
$banner = get_the_post_thumbnail($post->ID);
$fallback = get_page_by_title('rps-logo-share', 'OBJECT', 'attachment');
$image_alt = get_post_meta($fallback->ID, '_wp_attachment_image_alt', TRUE);
$image = $fallback->guid;

get_header();
        if ( have_posts() ) {
            while ( have_posts() ) {
                if( in_category('Careers')){
                    echo '<div class="bannerImage">';
                        echo ( get_the_post_thumbnail() )? ($banner) : ('<img src="'. $image . '" alt="' . $image_alt . '">');
                    echo '</div>';
                    echo '<div class="container postContainer">
                    <div class="row">';
                    $jobUrl = get_permalink( $post->ID );
                    $jobName = get_the_title( $post->ID );

                    echo '<section class="col-sm-6">';
                        echo'<h2>' . $jobName . '</h2>';
                        the_post();
                        the_content();
                    echo '</section>';
                    echo'<div class="col-sm-6">
                        <h3>Apply for ' . $jobName . ' with Rec Power</h3>'; ?>
                        <script type="text/javascript" src="https://form.jotform.com/jsform/230734498938067?jobName=' . $jobName . '&jobUrl=' . $jobUrl .'"></script>
                    <?php echo'</div>';
                } else {
                    echo '<div class="container postContainer">';
                    the_post();
                    the_content();
                    echo '</div>';
                }
            }
        }
        echo '</div>
    </div>';
get_footer();
