<?php
global $post;
$slug = $post->post_name;
$id = $post->ID;

$taxonomy       = 'product_cat';
$orderby        = 'name';
$show_count     = 0;      // 1 for yes, 0 for no
$pad_counts     = 0;      // 1 for yes, 0 for no
$hierarchical   = 1;      // 1 for yes, 0 for no
$title          = '';
$empty          = 0;

$args = array(
    'taxonomy'                  => $taxonomy,
    'orderby'                   => $orderby,
    'show_count'                => $show_count,
    'pad_counts'                => $pad_counts,
    'hierarchical'              => $hierarchical,
    'title_li'                  => $title,
    'hide_empty'                => $empty
);

function product_gallery($idObj, $args){
    $all_categories = get_categories( $args );
    $categoryDescription = category_description($idObj);
    $term = get_term_by('id', $idObj, 'product_cat');
    echo '<section class="container"> 
        <div class="row">
        <h2>' . $term->name . '</h2>';
    echo $categoryDescription . '</div>
        <div class="row">';
    foreach ($all_categories as $cat) {
        if ($cat->category_parent == $idObj) {
//            $category_id = $cat->term_id;
            $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
            $image = wp_get_attachment_url( $thumbnail_id );
            echo '<a class="col-sm-3 categoryItems" href="' . get_term_link($cat->slug, 'product_cat') . '">
            <img src="'. $image . '" width="150px" height="150px"><p>'
                . $cat->name .
                ' </p></a>';
        }
    }
    echo '</section>';
}

$term = get_term_by('id', 'product_cat');
if ($slug == 'parts-and-accessories'):
    $idObj = 38;
//live category id remove hardcode later
//$idObj = 22;
    product_gallery($idObj, $args);
elseif ($slug = 'showroom'):
    $idObj = 54;
//live category id remove hardcode later
//$idObj = 38;
    product_gallery($idObj, $args);
endif;

//do a check again for subcategory pages. Need to hash out why I can't pull the category id, I don't want to hard code it

//        pull subcategories
//
//        $args2 = array(
//            'taxonomy'     => $taxonomy,
//            'child_of'     => 38,
//            'parent'       => $category_id,
//            'orderby'      => $orderby,
//            'show_count'   => $show_count,
//            'pad_counts'   => $pad_counts,
//            'hierarchical' => $hierarchical,
//            'title_li'     => $title,
//            'hide_empty'   => $empty
//        );
//        $sub_cats = get_categories( $args2 );
//        if($sub_cats) {
//            foreach($sub_cats as $sub_category) {
//                echo  '<br/><a href="'. get_term_link($sub_category->slug, 'product_cat') .'">'. $sub_category->name .'</a>';
//            }
//        }
//    }
//    elseif ($cat->category_parent == 54) {
//        $category_id = $cat->term_id;
//        echo '<br /><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';
//
//        $args2 = array(
//            'taxonomy'     => $taxonomy,
//            'child_of'     => 38,
//            'parent'       => $category_id,
//            'orderby'      => $orderby,
//            'show_count'   => $show_count,
//            'pad_counts'   => $pad_counts,
//            'hierarchical' => $hierarchical,
//            'title_li'     => $title,
//            'hide_empty'   => $empty
//        );
//        $sub_cats = get_categories( $args2 );
//        if($sub_cats) {
//            foreach($sub_cats as $sub_category) {
//                echo  '<br/><a href="'. get_term_link($sub_category->slug, 'product_cat') .'">'. $sub_category->name .'</a>';
//            }
//        }
//    }
//}
