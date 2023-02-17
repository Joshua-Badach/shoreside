<?php
    global $post;
    $slug = $post->post_name;
    $id = get_term_by('slug', $slug, 'product_cat');
    $preOwnedObj = get_term_by('slug', 'preowned', 'product_cat');
    $parent = $_REQUEST['product_cat'];
    $test = get_term_by('id', $parent, 'product_cat');

    if ($_REQUEST['product_cat'] != ''){
        $idObj = $_REQUEST['product_cat'];
    } else {
        $idObj = $id->term_id;
    }
    if ($_REQUEST['term'] != ''){
        $tagObj = $_REQUEST['term'];
        $slugObj = $tagObj;
    } else {
        $tagObj = $_REQUEST['tagObj'];
        $slugObj = get_term($idObj, 'product_cat');
    }
//    if ($idObj = ''){$idObj = $_REQUEST['page'];}

    $taxonomy           =           'product_cat';
    $hierarchical       =           1;      // 1 for yes, 0 for no
    $title              =           '';
    $empty              =           0;
    $limit              =           -1;
    $status             =           'publish';

    $orderByObj         =           '';
    $onSaleObj          =           '';

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $idObj              =           $_REQUEST['idObj'];
        $attribute          =           $_REQUEST['attribute'];
        $tagObj             =           $_REQUEST['tagObj'];
        $orderByObj         =           $_REQUEST['orderByObj'];
        $orderObj           =           $_REQUEST['orderObj'];
        $onSaleObj          =           $_REQUEST['onSaleObj'];
        $slug               =           $_REQUEST['slug'];
        $slugObj            =           $_REQUEST['slug'];
    } else {
        $attribute          =           '';
        $tagObj             =           '';
        $orderByObj         =           '';
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
        'category'                      => $slug,
    );

    $query_args = array(
        'status'                        => $status,
        'limit'                         => $limit,
        'hierarchical'                  => $hierarchical,
        'show_option_none'              => '',
        'hide_empty'                    => $empty,
//        'parent'                        => $slug,
        'taxonomy'                      => $taxonomy,
        'category'                      => $slugObj,
        'orderby'                       => $orderByObj,
        'order'                         => $orderObj,
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
        if ( $cat->category_count == 0) {
            continue;
        } else {
            echo '<a data-category="' . $cat->term_id . '" data-attribute="' . $_REQUEST['attribute'] . '" data-term="' . $_REQUEST['tagObj'] . '" data-orderby="' . $_REQUEST['orderByObj'] . '" data-order="' . $_REQUEST['orderObj'] . '" data-sale="' . $_REQUEST['onSaleObj'] . '" data-slug="' . $cat->slug . '">' . $cat->cat_name . '</a>';
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
            foreach ($attribute->get_terms() as $i => $term) {
                if ($term->taxonomy == 'pa_manufacturer') {
                    $unique[] = $term->term_id;
                    $name[] = $term->name;
                    $termSlug[] = $term->slug;
                    $termCheck = array_unique($unique);
                    $termName = array_unique($name, SORT_LOCALE_STRING);
                    asort($termName);
                }
            }
        }
    }

    foreach ($termName as $i => $aTerm) {
        echo '<a data-category="'. $_REQUEST['idObj'] . '" data-attribute="' . $_REQUEST['attribute'] . '" data-term="' . $termCheck[$i] . '" data-orderby="' . $_REQUEST['orderByObj'] . '" data-order="' . $_REQUEST['orderObj'] . '" data-sale="' . $_REQUEST['onSaleObj'] . '" data-slug="' . $termSlug[$i] . '" > ' . $termName[$i] . '</a>';
    }
//    Maybe request check for product_cat then swap out if needed?
    echo '</div>
</div>      

        <div id="showroomToggle">
        <div class="filterHeading">
            <p>Condition: </p>
        </div>
        <div class="switchContainer objectPadding">
            <span>New</span>
            <label class="switch">
                <input type="checkbox" name="condition" class="conditionInput" data-category="' . $preOwnedObj->term_id . '" data-attribute="' . $_REQUEST['attribute'] . '" data-term="' . $_REQUEST['tagObj'] . '" data-orderby="' . $_REQUEST['orderByObj'] . '" data-order="' . $_REQUEST['orderObj'] . '" data-sale="' . $_REQUEST['onSaleObj'] . '" data-slug="' . $preOwnedObj->slug .'"> 
                <span class="slider round"></span>
            </label>
            <span>Used</span>
        </div>
    </div>
 
        <div class="clearButton">
            <button type="button" data-category="" class="button-3d" id="clear">Clear</button>
        </div>';

?>
    </div>
</div>