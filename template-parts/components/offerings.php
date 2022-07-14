<?php
global $post;
$slug = $post->post_name;
$id = $post->ID;
$idObj = 0;

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
//    var_dump($all_categories);

//    $categoryDescription = category_description($idObj);
    $term = get_term_by('id', $idObj, 'product_cat');
    echo '<section class="container"> 
        <div class="row">
        <h2 class="col-lg-12">What we offer</h2>';
    foreach ($all_categories as $cat) {
        if ($cat->category_parent == 0 && $cat->name != 'Uncategorized') {
//            $category_id = $cat->term_id;
            $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
            $image = wp_get_attachment_url( $thumbnail_id );
            echo '<a class="offset-lg-1 col-sm-3 categoryItems" href="' . '/' . $cat->slug . '/' . '">
            <img src="'. $image . '" width="150px" height="150px"><span>'
                . $cat->name .
                ' </span></a>';
        }
    }
    echo '</section>';
}

$term = get_term_by('id', 'product_cat');
product_gallery($idObj, $args);
?>
<!---->
<!--<div class="container">-->
<!--    <section class="row">-->
<!--        <h2 class="col-lg-12">What we offer</h2>-->
<!--        <div class="offset-lg-1 col-sm-3 categoryItems">-->
<!--            <a href="/showroom/">-->
<!--                <img src="--><?php //echo get_template_directory_uri() . '/assets/src/library/images/salesStock.jpg' ?><!--" alt="placeholder">-->
<!--                <br>-->
<!--                <span>Showroom</span>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="offset-lg-1 col-sm-3 categoryItems">-->
<!--            <a href="/parts-and-accessories/">-->
<!--                <img src="--><?php //echo get_template_directory_uri() . '/assets/src/library/images/partsStock.jpg' ?><!--" alt="placeholder">-->
<!--                <br>-->
<!--                <span>Parts</span>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="offset-lg-1 col-sm-3 categoryItems">-->
<!--            <a href="/service/">-->
<!--                <img src="--><?php //echo get_template_directory_uri() . '/assets/src/library/images/serviceStock.jpg' ?><!--" alt="placeholder">-->
<!--                <br>-->
<!--                <span>Service</span>-->
<!--            </a>-->
<!--        </div>-->
<!--    </section>-->
<!--    <section class="row">-->
<!--        <h2>Keyword placeholder header</h2>-->
<!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aspernatur delectus dignissimos maxime nobis numquam saepe tempore voluptatem. Assumenda autem distinctio error expedita laudantium maxime officiis praesentium quos repellat soluta.</p>-->
<!--        <button>Learn More</button>-->
<!--    </section>-->
<!--</div>-->