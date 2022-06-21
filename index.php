<?php get_header();

    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content(); ?>
        <p>index returned</p>
        <?php
        endwhile;
    else:
        _e( 'Sorry, no pages matched your criteria.', 'textdomain');
    endif;

get_footer(); ?>