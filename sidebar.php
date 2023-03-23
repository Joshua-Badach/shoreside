<?php
    global $post;
    $slug = $post->post_name;
    $id = get_term_by('slug', $slug, 'product_cat');
    $preOwnedObj = get_term_by('slug', 'preowned', 'product_cat');
    $termName = '';


    (isset($_REQUEST['product_cat'])) ? $parent = $_REQUEST['product_cat'] : $parent = $id->term_id;
    (isset($_REQUEST['term'])) ? $tagObj = $_REQUEST['term'] : $tagObj = '';

    $test = get_term_by('id', $parent, 'product_cat');

    $idObj = $_REQUEST['product_cat'] ?? $id->term_id;
    if (!isset($_REQUEST['term'])) {
        $slugObj = get_term($idObj, 'product_cat');
    } else {
        $slugObj = $tagObj;
    }

    $taxonomy           =           'product_cat';
    $hierarchical       =           1;
    $title              =           '';
    $empty              =           0;
    $limit              =           -1;
    $status             =           'publish';
    $orderObj           =           '';
    $orderByObj         =           '';
    $onSaleObj          =           '';

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $idObj              =           $_REQUEST['idObj'];
        $tagObj             =           $_REQUEST['tagObj'];
        $orderByObj         =           $_REQUEST['orderByObj'];
        $orderObj           =           $_REQUEST['orderObj'];
        $onSaleObj          =           $_REQUEST['onSaleObj'];
        $slug               =           $_REQUEST['slug'];
        $slugObj            =           $_REQUEST['slug'];
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
            echo '<a data-category="' . $cat->term_id . '" data-term="' . $tagObj . '" data-orderby="' . $orderByObj . '" data-order="' . $orderObj . '" data-sale="' . $onSaleObj . '" data-slug="' . $cat->slug . '">' . $cat->cat_name . '</a>';
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
    $attribute ='pa_manufacturer';

    $productQuery = wc_get_products($query_args);

//    Wow this got even more complicated than before...

    foreach ($productQuery as $product){
        $productAttribute = $product->get_attributes();
        if (isset($productAttribute)) {
            foreach ($productAttribute as $tax => $attr) {
                $productTerms = $attr->get_terms();
                if (isset($productTerms)) {
                    foreach ($productTerms as $i => $term) {
                        if ($term->taxonomy == $attribute) {
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
        }
    }

    if (!empty($termName)) {
        foreach ($termName as $i => $aTerm) {
            echo '<a data-category="'. $idObj . '" data-term="' . $termCheck[$i] . '" data-orderby="' . $orderByObj . '" data-order="' . $orderObj . '" data-sale="' . $onSaleObj . '" data-slug="' . $termSlug[$i] . '" > ' . $termName[$i] . '</a>';
        }
    }
    echo '</div>
</div>      

        <div id="showroomToggle">
        <div class="filterHeading">
            <p>Condition: </p>
        </div>
        <div class="switchContainer objectPadding">
            <span>New</span>
            <label class="switch">
                <input type="checkbox" name="condition" class="conditionInput" data-category="' . $preOwnedObj->term_id . '" data-term="' . $tagObj . '" data-orderby="' . $orderByObj . '" data-order="' . $orderObj . '" data-sale="' . $onSaleObj . '" data-slug="' . $preOwnedObj->slug .'"> 
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