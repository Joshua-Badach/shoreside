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
//    $data = array();

    $categories = get_categories($args);

//    $last_categories = get_categories(
//        array(
//            'taxonomy' => 'product_cat',
//            'parent' => $categories->cat_ID
//        )
//    );?>
<div id="sidebar">
<?php
    echo '<p>Category: </p>';

    foreach ($categories as $cat) {
        echo '<a href="?product_cat=' . $cat->term_id . '">'.$cat->cat_name.'</a><br>';
    }
    echo '<hr>';
if ( $slug == 'showroom' ) {
    echo '<span>Condition: </span>' . '
        <label class="switch">
            <input type="checkbox" class="conditionInput" value="?product_cat=preowned ">
            <span class="slider round"></span>
        </label>
        <span class="condition">New</span>        
    <hr>';
}
echo '<span>On Sale: </span>' . '
        <label class="switch">
            <input type="checkbox" class="saleInput" value="?product_cat=on-sale ">
            <span class="slider round"></span>
        </label>
        <span class="on-sale">No</span>        
    <hr>';

echo    '<p>Price: </p>' .
        '<a href="?orderby=price">Low to High</a><br>
        <a href="?orderby=price-desc">High to Low</a><br><hr>';

echo '<p>Manufacturer: </p>';

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
foreach ($termCheck as $i => $aTerm){
    echo '<a href="?product_tag=' . $termCheck[$i] . '">' . $termName[$i] . '</a><br>';
}
    echo '<hr>';
?>
    <div class="clearButton">
        <button type="button" class="button-3d" id="clear">Clear</button>
    </div>
</div>
