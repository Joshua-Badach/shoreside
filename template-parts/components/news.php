<?php
$query = new WP_Query(array(
        'category_name'     => 'news',
        'order'             => 'DESC',
        'post_status'       => ' publish',
        'posts_per_page'    => 1
));

?>
<div class="news">
    <p><?php
            while ($query->have_posts()){
                $query->the_post();
                $content = get_the_content();
                $trimmed_content = wp_trim_words( $content, 200, '<a href="'. get_permalink() .'">...</a>');
            }
            wp_reset_postdata();
            echo $trimmed_content;
        ?>
    </p>
</div>
