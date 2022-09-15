<div id="sidebar">
<?php
    global $post;
    $slug = $post->post_name;

    $id = get_term_by('slug', $slug, 'product_cat');
    $idObj = $id->term_id;


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

    $data = array();

    $categories = get_categories($args);

    $last_categories = get_categories(
        array(
            'taxonomy' => 'product_cat',
            'parent' => $categories->cat_ID
        )
    );

    if ( $slug == 'showroom' ) {
        echo '<p>Condition: </p>' . '
        <span>New</span>
        <label class="switch">
            <input type="checkbox">
            <span class="slider round"></span>
        </label>
        <span>Used</span>        
    <hr>';
    }
    echo '<p>Category: </p>';

    foreach ($categories as $cat) {
        echo '<a href="?filters=product_cat[' . $cat->term_id . ']">'.$cat->cat_name.'</a><br>';
    }
    echo '<hr>';
//    var_dump($last_categories);
//Change this from form radio to links, or not... I'm not sure
    echo '<p>Price: </p>' . '
    <form action="">
        <input type="radio" id="toOneHundred" name="priceRange" value="toOneHundred">
        <label for="toOneHundred">$0 - $100</label><br>
        <input type="radio" id="toFiveHundred" name="priceRange" value="toFiveHundred">
        <label for="toFiveHundred">$100 - $500</label><br>
        <input type="radio" id="toOneThousand" name="priceRange" value="toOneThousand">
        <label for="toOneThousand">$500 - $1,000</label><br>
        <input type="radio" id="toTenThousand" name="priceRange" value="toTenThousand">
        <label for="toTenThousand">$1,000 - $10,000</label><br>
        <input type="radio" id="aboveTenThousand" name="priceRange" value="aboveTenThousand">
        <label for="aboveTenThousand">+ $10,000</label><br>
    </form>
    <hr>';

echo '<p>Manufacturer: </p>';

    foreach( wc_get_products($query_args) as $product ){
        foreach( $product->get_attributes() as $tax => $attribute ){
//            $attribute_name = wc_attribute_label( $tax );
//            $attribute_name = get_taxonomy( $tax )->labels->singular_name;

            foreach ( $attribute->get_terms() as $term ){
                if ($term->taxonomy == 'pa_manufacturer') {
                    echo '<a href="?filters=product_cat['. $term->term_id . ']">' . $term->name. '</a><br>';
//                $data[$tax][$term->term_id] = $term->name;
                }
//            // Or with the product attribute label name instead:
//             $data[$attribute_name][$term->term_id] = $term->name;
            }
//            echo $attribute_name . '<br>';
        }
}
//echo $slug . '<br>

//    foreach($data['']) {
//
//    }
//    var_dump($data);
    echo '<hr>';

?>
    <button type="button" id="clear">Clear</button>

</div>