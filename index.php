<?php get_header();

    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_title( '<h1 class="col-md-4 offset-4">', '</h1>');
            the_content();
        endwhile;
    else:
        _e( 'Sorry, no pages matched your criteria.', 'textdomain');
    endif;

get_footer(); ?>