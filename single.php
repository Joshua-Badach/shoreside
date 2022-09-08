<?php get_header();

global $wp;
$url = home_url( $wp->request );
$checkFor = 'product-category';
//Referring to sidebar.php
//get_sidebar();
//Referring to the functions sidebar code
//dynamic_sidebar('product-widget-area');

if ( strpos($url, $checkFor) == true){
    get_sidebar();
    echo '<div class="container content">';
} else {
    echo '<div class="container">';
  }
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

get_footer();
