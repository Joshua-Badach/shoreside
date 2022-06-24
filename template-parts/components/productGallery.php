<?php
//$the_page = sanitize_posT($GLOBALS['wp_the_query']->get_queried_object() );
global $post;
$slug = $post->post_name;
var_dump($slug);

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
$all_categories = get_categories( $args );
$idObj = 38;
$categoryDescription = category_description($idObj);
$term = get_term_by('id', $idObj, 'product_cat');

echo '<section class="container"> 
        <div class="row">
        <h2>' . $term->name . '</h2>';
        echo $categoryDescription . '</div>
        <div class="row">';
foreach ($all_categories as $cat) {
    if ($cat->category_parent == $idObj) {
        $category_id = $cat->term_id;
        $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        echo '<a class="col-sm-3 categoryItems" href="' . get_term_link($cat->slug, 'product_cat') . '">
            <img src="'. $image . '" width="150px" height="150px"><p>'
                . $cat->name .
            ' </p></a>';
    }
}
echo '</section>';

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
?>
<!--move this crap into it's own file-->
<div class="modal-wrapper">
    <div class="modal">
        <div class="close-modal">
            <div class="modal-content">
<!--                Modal content-->
            </div>
        </div>
    </div>
</div><!-- Modal End -->
<div class="container">
    <section class="row">
<!--        <h2 class="col-sm-6">--><?php //echo $category->name ?><!--</h2>-->
<!--        <p class="col-sm-12">--><?php //echo $category->description ?><!--</p>-->
    </section>
    <div class="row">
<!--        --><?php
//        var_dump($category);
//        $categories = get_term_children($category->term_id, $category->taxonomy);
//        foreach($categories as $category) {
//                $cat = get_term($category, 'category');
//                echo '<div class="col-sm-3 categoryCard"><p>' . $cat->name . '</p></div>';
//            }
//        ?>
   </div>
</div>

