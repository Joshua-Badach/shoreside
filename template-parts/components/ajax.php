<?php

function load_results(){
    $paged = $_POST["page"]+1;
    global $post;
    $slug = $post->post_name;
    $id = get_term_by('slug', $slug, 'product_cat');
    $idObj = $id->term_id;

    $taxonomy       = 'product_cat';
    $orderby        = 'name';
    $show_count     = 0;      // 1 for yes, 0 for no
    $pad_counts     = 0;      // 1 for yes, 0 for no
    $hierarchical   = 1;      // 1 for yes, 0 for no
    $title          = '';
    $empty          = 0;

    $args = array(
        'taxonomy'                  => $taxonomy,
        'terms'                     => $idObj,
        'orderby'                   => $orderby,
        'show_count'                => $show_count,
        'pad_counts'                => $pad_counts,
        'hierarchical'              => $hierarchical,
        'title_li'                  => $title,
        'hide_empty'                => $empty,
        'paged'                     => $paged
    );
//finish this later, just happy it's firing
//    $loop = new WP_Query( $args );
//
//    while ($loop->have_posts() ) : $loop->the_post;
//
//    endwhile;

//    loop

    echo $paged;
    wp_reset_postdata();

    wp_die();
}

add_action( 'wp_ajax_load_results', 'load_results');
add_action( 'wp_ajax_nopriv_load_results', 'load_results');
