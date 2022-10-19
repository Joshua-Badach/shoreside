<?php get_header();

//global $wp;
//$url = home_url( $wp->request );
//$checkFor = 'product-category';

//if (strpos($url, $checkFor) == true){
////    get_sidebar();
//    echo '<div class="container content">';
//} else {
//    echo '<div class="container">';
//  }
// Temp for gallery push
//May remove this entirely because of how I'm handling index
    echo '<div class="container">';

    if ( have_posts() ) {
        while ( have_posts() ) {
            if ( strpos($url, $checkFor) == true) {
                echo '<h2 class="col-6 mx-auto singleheading">' . get_the_title() . '</h2>';
            }
            the_post();
            the_content();
        }
    }
    echo '</div>';
//echo 'Single page';
get_footer();
