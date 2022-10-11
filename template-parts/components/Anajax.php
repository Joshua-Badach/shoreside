<?php


function load_results()
{
    global $post;
//    global $category;
    $slug = $post->post_name;
    $id = get_term_by('slug', $slug, 'product_cat');
    $idObj = $id->term_id;
//    $idObj = get_the_terms($post->ID, 'taxonomy');
//    $idObj = 240;
    $offset = $_POST['offset'];

    $post_type = array('product');
    $post_status = array('publish');
    $columns = '5';
//    $orderby        = $_GET['orderby'];
//    $tag            = $_GET['tag_ID'];
//    $category = $_POST[$idObj];
//    $attribute      = $_GET['product_attributes'];
    $taxonomy = 'product_cat';
//    $paged          = $_POST["page"]+1;
//    $orderby        = 'name';
//    $show_count     = 0;      // 1 for yes, 0 for no
//    $pad_counts     = 0;      // 1 for yes, 0 for no
//    $hierarchical   = 1;      // 1 for yes, 0 for no
//    $title          = '';
//    $empty          = 0;

//    $args = array(
//        'post_type'                 => $post_type,
//        'post_status'               => $post_status,
//        'category'                  => $category,
//        'paged'                     => $paged,
//        'taxonomy'                  => $taxonomy,
//        'terms'                     => $idObj,
//        'orderby'                   => $orderby,
//        'show_count'                => $show_count,
//        'pad_counts'                => $pad_counts,
//        'hierarchical'              => $hierarchical,
//        'title_li'                  => $title,
//        'hide_empty'                => $empty,
//        'paged'                     => $paged
//    );
    $args = array(
        'post_type' => $post_type,
        'post_status' => $post_status,
        'posts_per_page' => '1',
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'terms' => $idObj,
//                'orderby'                   => $orderby,
                'order' => 'ASC',
//                'show_count'                => $show_count,
//                'pad_counts'                => $pad_counts,
//                'hierarchical'              => $hierarchical,
//                'title_li'                  => $title,
//                'hide_empty'                => $empty
            ),
        ),
    );
    $loop = new WP_Query($args);
//    var_dump($slug);
}
//
//    while ($loop->have_posts() ) : $loop->the_post;
////        var_dump($loop);
//
//        echo 'new posts ';
//    endwhile;
//
//
//    wp_reset_postdata();
////
//    wp_die();
//}
//
//function ajax_next_posts() {
//    global $wpdb;
//    // Build query
//    $args = array(
//        'post_type' =>  'product'
//    );
//// Get offset
//    if( !empty( $_POST['post_offset'] ) ) {
//
//        $offset = $_POST['post_offset'];
//        $args['offset'] = $offset;
//
//        // Also have to set posts_per_page, otherwise offset is ignored
//        $args['posts_per_page'] = 12;
//    }
//
//// Get posts per page
//    if( !empty( $_POST['posts_per_page'] ) ) {
//        // Also have to set posts_per_page, otherwise offset is ignored
//        $args['posts_per_page'] = $_POST['posts_per_page'];
//    }
//
//// Set tax query if on cat page
//    if( !empty( $_POST['product_cat'] ) ){
//        $args['tax_query'] = array(
//            'taxonomy'          =>  'product_cat',
//            'terms'             =>  array( (int)$_POST['product_cat'] ),
//            'field'             =>  'id',
//            'operator'          =>  'IN',
//            'include_children'  =>  1
//        );
//    }
//
//    $count_results = '0';
//
//    $ajax_query = new WP_Query( $args );
//
//// Results found
//    if ( $ajax_query->have_posts() ) {
//        $count_results = $ajax_query->found_posts;
//
//        // Start "saving" results' HTML
//        $results_html = '';
//        ob_start();
//
//        while( $ajax_query->have_posts() ) {
//            $ajax_query->the_post();
//            echo wc_get_template_part( 'content', 'product' );
//        }
//
//        // "Save" results' HTML as variable
//        $results_html = ob_get_clean();
//    }
//
//// Build ajax response
//    $response = array();
//
//// 1. value is HTML of new posts and 2. is total count of posts
//    global $wpdb;
//    array_push ( $response, $results_html, $count_results, $wpdb->last_query );
//    echo json_encode( $response );
//
//// Always use die() in the end of ajax functions
//    die();
//}

add_action( 'wp_ajax_load_results', 'load_results');
add_action( 'wp_ajax_nopriv_load_results', 'load_results');
