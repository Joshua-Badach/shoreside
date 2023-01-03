<?php
if ( is_home() == false ){
    echo '<h2 class="hidden">';
    the_title();
    echo ' Offerings';
    echo '</h2>';
}
echo '<div class="carousel">';

function promotional_slider($query){
    while ($query->have_posts()){
        $query->the_post();
        echo ('<section class="sliderContent">');
        the_post_thumbnail('', array( 'loading' => 'lazy' ));
        ?><div class="sliderText">
        <h2><?php the_title(); ?></h2>
        <?php the_content(); ?>
        </div><?php
        echo ('</section>');
    }
    wp_reset_postdata();
}

echo '</div>';