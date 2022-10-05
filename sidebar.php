<?php
    global $post;
    $slug = $post->post_name;

    $id = get_term_by('slug', $slug, 'product_cat');
    if ($_GET['product_cat'] == '') {
        $idObj = $id->term_id;
    }
    else {
        $idObj = $_GET['product_cat'];
    }


    $taxonomy       = 'product_cat';
    $hierarchical   = 1;      // 1 for yes, 0 for no
    $title          = '';
    $empty          = 0;
    $limit          = -1;
    $status         ='publish';

    $args = array(
        'status'                        => $status,
        'limit'                         => $limit,
        'hierarchical'                  => $hierarchical,
        'show_option_none'              => '',
        'hide_empty'                    => $empty,
        'parent'                        => $idObj,
        'taxonomy'                      => $taxonomy,
    );

    $query_args = array(
        'status'                        => $status,
        'limit'                         => $limit,
//        'parent'                        => $idObj,
        'category'                      => array( $slug ),
    );

    $categories = get_categories($args);

    ?>
<div id="sidebarContainer">
    <a id="sidebarIcon" href="">
        <object width="30px" height="30px" data="<?php echo get_template_directory_uri().'/assets/src/library/images/menu-icon.svg' ?>" alt="Menu Icon"></object>
    </a>
    <div id="sidebar">

    <?php
    echo '<p>Category: </p>
    <a href="" class="showCategories">Show More</a>
    <div id="categories">';

    foreach ($categories as $cat) {
        echo '<a href="?product_cat=' . $cat->term_id . '">'.$cat->cat_name.'</a><br>';
    }

    echo '<hr></div>';
if ( $slug == 'showroom' ) {
    echo '<span>Condition: </span>' . '<br><br>
        <label class="switch">
            <input type="checkbox" name="condition" class="conditionInput" value="?product_cat=pre-owned ">
            <span class="slider round"></span>
        </label>
        <span class="condition">New</span>        
    <hr>';
}
echo '<span>On Sale: </span>' . '<br><br>
        <label class="switch">
            <input type="checkbox" name="sale" class="saleInput" value="?on_sale=sale ">
            <span class="slider round"></span>
        </label>
        <span class="on_sale">No</span>        
    <hr>';

echo    '<p>Price: </p>' .
        '<a href="?orderby=price">Low to High</a><br>
        <a href="?orderby=price-desc">High to Low</a><br><hr>';

echo '<p>Manufacturer: </p>
<a href="" class="showAttributes">Show More</a>
<div id="attributes">';

$unique = array();
$name = array();

//function getAttributes($query_args){
    foreach (wc_get_products($query_args) as $product) {
        foreach ($product->get_attributes() as $tax => $attribute) {
            foreach ($attribute->get_terms() as $term) {
                if ($term->taxonomy == 'pa_manufacturer') {
                    $unique[] = $term->term_id;
                    $termCheck = array_unique($unique);
                    $name[] = $term->name;
                    $termName = array_unique($name, SORT_LOCALE_STRING);
                }
            }
        }
    }
//}

foreach ($termCheck as $i => $aTerm) {
    echo '<a href="?product_tag=' . $termCheck[$i] . '">' . $termName[$i] . '</a><br>';
}
    echo '</div><hr>';
?>
<!--    <div class="submitButton">-->
<!--        <button type="button" class="button-3d" id="submit">Filter</button>-->
<!--    </div>-->
    <div class="clearButton">
        <button type="button" class="button-3d" id="clear">Clear</button>
    </div>
    </div>
</div>