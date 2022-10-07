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
        'hierarchical'                  => $hierarchical,
//        'parent'                        => $idObj,
        'hide_empty'                    => $empty,
        'category'                      => array( $slug ),
    );

    $categories = get_categories($args);

    ?>
<div id="sidebarContainer">
    <div id="sidebarHeader"><p>Filters</p></div>
    <div id="sidebar">

    <?php
    echo '<div class="filterHeading">
        <p>Category: <a href="" class="showCategories"><img width="10px" height="10px" src="' . get_template_directory_uri(). '/assets/src/library/images/arrow-icon.png\' ?>" alt="Menu Arrow"></a></p>
    </div>
    <div id="categories">';

    foreach ($categories as $cat) {
        echo '<a href="?product_cat=' . $cat->term_id . '">'.$cat->cat_name.'</a>';
    }

    echo '</div>';

    echo '<div class="filterHeading">
        <p>Manufacturer: <a href="" class="showAttributes"><img width="10px" height="10px" src="' . get_template_directory_uri(). '/assets/src/library/images/arrow-icon.png\' ?>" alt="Menu Arrow"></a></p>
    </div>
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
        echo '<a href="?product_tag=' . $termCheck[$i] . '">' . $termName[$i] . '</a>';
    }
    echo '</div>
        <div class="filterHeading">
            <p>Price: </p>
        </div>
        <div id="prices" class="objectPadding">
            <a href="?orderby=price">Low to High</a>
            <a href="?orderby=price-desc">High to Low</a>
        </div>';


    if ( $slug == 'showroom' ) {
    echo '<div class="filterHeading">
            <p>Condition: </p>
        </div>' .
        '<div class="switchContainer objectPadding">
            <label class="switch">
            <input type="checkbox" name="condition" class="conditionInput" value="?product_cat=pre-owned ">
            <span class="slider round"></span>
        </label>
        <span class="condition">New</span></div>';
}
echo '<div class="filterHeading">
        <p>On Sale: </p>
      </div>' . '<div class="switchContainer objectPadding">
        <label class="switch">
            <input type="checkbox" name="sale" class="saleInput" value="?on_sale=sale ">
            <span class="slider round"></span>
        </label>
        <span class="on_sale">No</span></div>';
?>
<!--    <div class="submitButton">-->
<!--        <button type="button" class="button-3d" id="submit">Filter</button>-->
<!--    </div>-->
        <div class="clearButton">
            <button type="button" class="button-3d" id="clear">Clear</button>
        </div>
    </div>
</div>