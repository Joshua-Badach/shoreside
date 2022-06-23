<?php
global $post;

$taxonomy     = 'product_cat';
$orderby      = 'name';
$show_count   = 0;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no
$title        = '';
$empty        = 0;

$args = array(
    'taxonomy'     => $taxonomy,
    'orderby'      => $orderby,
    'show_count'   => $show_count,
    'pad_counts'   => $pad_counts,
    'hierarchical' => $hierarchical,
    'title_li'     => $title,
    'hide_empty'   => $empty
);
$all_categories = get_categories( $args );
foreach ($all_categories as $cat) {
    if($cat->category_parent == 38) {
        $category_id = $cat->term_id;
        echo '<br /><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';

        $args2 = array(
            'taxonomy'     => $taxonomy,
            'child_of'     => 38,
            'parent'       => $category_id,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $sub_cats = get_categories( $args2 );
        if($sub_cats) {
            foreach($sub_cats as $sub_category) {
                echo  '<br/><a href="'. get_term_link($sub_category->slug, 'product_cat') .'">'. $sub_category->name .'</a>';
            }
        }
    }
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
}

//$args = array(
//    'post_type'     =>      'product',
//    'post_status'   =>      'publish',
//    'tax_query'     =>      array(
//        array(
//            'taxonomy'  =>  'product_cat',
//            'field'     =>  'term_id',
//            'terms'     =>  array('40'),
//            'operator'  =>  'IN',
//        )
//    )
//);
//$slug = $post->post_name;
//    if ($slug == 'showroom' ) {
////        $category = new WP_Query(array('category name'));
////        $category = get_category_by_slug('slider');
//    }
//    elseif ($slug == 'parts-and-accessories'){
////        $category = get_category_by_slug('parts-accessories');
//    }
//?>
<!--Troubleshoot why this is not pulling woocommerce cats-->


<div class="modal-wrapper">
    <div class="modal">
        <div class="close-modal">
            <div class="modal-content">
<!--                Modal content-->
            </div>
        </div>
    </div>
</div><!-- Modal End -->
<!--Move modal code into own file-->
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

