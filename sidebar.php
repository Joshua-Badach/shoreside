<?php
    global $post;
    $slug = $post->post_name;
    $id = get_term_by('slug', $slug, 'product_cat');
    $preOwnedObj = get_term_by('slug', 'pre-owned', 'product_cat');

    $taxonomy           =           'product_cat';
    $hierarchical       =           1;      // 1 for yes, 0 for no
    $title              =           '';
    $empty              =           0;
    $limit              =           -1;
    $status             =           'publish';

    $tagObj             =           '';
    $orderByObj         =           '';
    $onSaleObj          =           '';


if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $idObj              =           $_REQUEST['idObj'];
        $attribute          =           $_REQUEST['attribute'];
        $tagObj             =           $_REQUEST['tagObj'];
        $orderByOjb         =           $_REQUEST['orderByObj'];
        $orderObj           =           $_REQUEST['orderObj'];
        $onSaleObj          =           $_REQUEST['onSaleObj'];
        $slug               =           $_REQUEST['slug'];
    } else {
        $idObj              =           $id->term_id;
        $attribute          =           '';
        $tagObj             =           '';
        $orderByOjb         =           '';
        $orderObj           =           '';
        $onSaleObj          =           '';

}

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
        'show_option_none'              => '',
        'hide_empty'                    => $empty,
//        'parent'                        => $slug,
        'taxonomy'                      => $taxonomy,
        'category'                      => $slug,
    );

    $categories = get_categories($args);

    ?>

<div id="sidebarContainer">
    <div id="sidebarHeader"><p>Filters</p></div>
    <div id="sidebar">

    <?php
    echo '<div id="categoryTab">
        <div class="filterHeading">
            <a class="showCategories"><p>Category: <img width="10px" height="10px" src="' . get_template_directory_uri(). '/assets/src/library/images/arrow-icon.png\' ?>" alt="Menu Arrow"></p></a>
    </div>
    <div id="categories">';
    foreach ($categories as $cat) {
        if ( $cat->category_count == 0 ) {
            continue;
        } else {
            echo '<a data-category="' . $cat->term_id . '" data-slug="' . $cat->cat_name . '">' . $cat->cat_name . '</a>';
        }
    }

    echo '</div>
    </div>';

    echo '<div id="attributeTab">
        <div class="filterHeading">
        <a class="showAttributes"><p>Manufacturer: <img width="10px" height="10px" src="' . get_template_directory_uri(). '/assets/src/library/images/arrow-icon.png\' ?>" alt="Menu Arrow"></p></a>
    </div>
<div id="attributes">';

    $unique = array();
    $name = array();

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
    foreach ($termCheck as $i => $aTerm) {
        echo '<a data-category="';
                if ($_REQUEST['idObj'] == '' ) {
                    echo $idObj;
                } else {
                    echo $_REQUEST['idObj'];
                }
                echo'" data-slug="' . $termName[$i] . '" data-attribute="manufacturer" data-term="' . $termCheck[$i] .
             '">' . $termName[$i] . '</a>';
    }
    echo '</div>
</div>
        <div class="filterHeading">
            <p>Price: </p>
        </div>
        <div id="prices" class="objectPadding">
            <a id="asc" data-category="' . $_REQUEST['idObj'] . '" data-attribute="' . $_REQUEST['attribute'] . '" data-term="' . $_REQUEST['tagObj'] . '" data-orderby="price">Low to High</a>
            <a id="desc" data-category="' . $_REQUEST['idObj'] . '" data-attribute="' . $_REQUEST['attribute'] . '" data-term="' . $_REQUEST['tagObj'] . '" data-orderby="price-desc">High to Low</a>
        </div>';

    echo '<div id="showroomToggle">
        <div class="filterHeading">
            <p>Condition: </p>
        </div>' .
        '<div class="switchContainer objectPadding">
            <span>New</span>
            <label class="switch">
                <input type="checkbox" name="condition" class="conditionInput" data-category="' . $preOwnedObj->slug .'" data-slug="' . $preOwnedObj->slug .'" data-sale="' . $_REQUEST['onSaleObj'] . '" data-attribute="' . $_REQUEST['attribute'] . '" data-term="' . $_REQUEST['tagObj'] . '">
                <span class="slider round"></span>
            </label>
            <span>Used</span>
        </div>
    </div>';
echo '<div class="filterHeading">
        <p>On Sale: </p>
      </div>
      <div class="switchContainer objectPadding">
        <span>No</span>
        <label class="switch">
            <input type="checkbox" name="sale" class="saleInput" data-category="'; if ($_REQUEST['idObj'] == '') { echo $idObj; } else { echo $_REQUEST['idObj']; } echo '" data-slug="' . $_REQUEST['slug'] . '" data-sale="true" data-attribute="' . $_REQUEST['attribute'] . '" data-term="' . $_REQUEST['tagObj'] . '">
            <span class="slider round"></span>
        </label>
        <span class="test" data-category="">Yes</span>
        </div>';

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {

            echo '<hr>
            <div class="clearButton">
                <button type="button" class="button-3d" id="clear">Clear</button>
            </div>
            ';
    }
?>
    </div>
</div>