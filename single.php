<?php
global $post;

get_header();

    echo '<div class="container">
        <div class="row">';
        if ( have_posts() ) {
            while ( have_posts() ) {
                if( in_category('Careers')){
                    $jobUrl = get_permalink( $post->ID );
                    $jobName = get_the_title( $post->ID );

                    echo '<div class="col-sm-6">';
                        the_post();
                        the_content();
                    echo '</div>';
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
