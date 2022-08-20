<?php get_header();

global $wp;
$url = home_url( $wp->request );
$checkFor = 'product-category';
?>

<div class="container">
    <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                if ( strpos($url, $checkFor) == true) {
                    echo '<h2 class="col-6 mx-auto singleheading">' . get_the_title() . '</h2>';
                }
                the_post();
                the_content();
            }
        }
    ?>
</div>

<?php get_footer() ?>
