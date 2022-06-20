<?php get_header(); ?>
<div class="container">
<?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
            the_title( '<h2>', '</h1>');
        endwhile;
    else:
        _e( 'Sorry, no pages matched your criteria.', 'textdomain');
    endif;
?>
</div>
<?php get_footer(); ?>