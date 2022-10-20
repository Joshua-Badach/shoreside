<?php
    global $post;
    $slug = $post->post_name;
    $id = get_term_by('slug', $slug, 'product_cat');
    $preOwnedObj = get_term_by('slug', 'pre-owned', 'product_cat');

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $idObj              =           $_REQUEST['idObj'];
        $attribute          =           $_REQUEST['attribute'];
        $tagObj             =           $_REQUEST['tagObj'];
        $orderByOjb         =           $_REQUEST['orderByObj'];
        $orderObj           =           $_REQUEST['orderObj'];
        $onSaleObj          =           $_REQUEST['onSaleObj'];
    } else {
        $idObj              =           $id->term_id;
        $attribute          =           '';
        $tagObj             =           '';
        $orderByOjb         =           '';
        $orderObj           =           '';
        $onSaleObj          =           '';
    }

        $taxonomy           =           'product_cat';
        $hierarchical       =           1;      // 1 for yes, 0 for no
        $title              =           '';
        $empty              =           0;
        $limit              =           -1;
        $status             =           'publish';

        $tagObj             =           '';
        $orderByObj         =           '';
        $onSaleObj          =           '';

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
    echo '<div id="categoryTab">
        <div class="filterHeading">
            <a class="showCategories"><p>Category: <img width="10px" height="10px" src="' . get_template_directory_uri(). '/assets/src/library/images/arrow-icon.png\' ?>" alt="Menu Arrow"></p></a>
    </div>
    <div id="categories">';
    foreach ($categories as $cat) {
        echo '<a data-category="' . $cat->term_id . '" >' . $cat->cat_name . '</a>';
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
//Tweak this for contextual attribute return based on current products
    foreach ($termCheck as $i => $aTerm) {
        echo '<a data-category="' . $idObj . '" data-attribute="manufacturer" data-term="' . $termCheck[$i] . '">' . $termName[$i] . '</a>';
    }
    echo '</div>
</div>
        <div class="filterHeading">
            <p>Price: </p>
        </div>
        <div id="prices" class="objectPadding">
            <a id="asc" data-category="' . $idObj . '" data-orderby="price">Low to High</a>
            <a id="desc" data-category="' . $idObj . '" data-orderby="price-desc">High to Low</a>
        </div>';

    echo '<div id="showroomToggle">
        <div class="filterHeading">
            <p>Condition: </p>
        </div>' .
        '<div class="switchContainer objectPadding">
            <span>New</span>
            <label class="switch">
                <input type="checkbox" name="condition" class="conditionInput" data-category="' . $preOwnedObj->slug .'">
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
            <input type="checkbox" name="sale" class="saleInput" data-category="' . $idObj . '" data-sale="true" data-term="' . $tagObj . '">
            <span class="slider round"></span>
        </label>
        <span>Yes</span>
        </div>';
?>
        <div class="clearButton">
            <button type="button" class="button-3d" id="clear">Clear</button>
        </div>
    </div>
</div>