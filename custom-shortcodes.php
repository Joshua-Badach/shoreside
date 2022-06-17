<?php

public function carouselContent(){
    while ($query->have_posts()){
        $query->the_post();
        }
        return ['<div class="sliderContent">' .
                the_post_thumbnail() .
                    '<div class="sliderText">' .
                    '<h2>' .
                        the_title() .
                    '</h2>' .
                    the_content() .
                    '<button onclick="location.href=\'<?php echo($post->post_name) ?>\' ">Read More</button>' .
                '</div>'
        ];
        wp_reset_postdata();
}
add_shortcode('carousel', $this, 'carouselContent');

