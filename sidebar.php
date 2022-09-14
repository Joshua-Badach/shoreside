<div id="sidebar">
<?php
    global $post;
    global $product;
    $slug = $post->post_name;

    $id = get_term_by('slug', $slug, 'product_cat');
    $idObj = $id->term_id;


    $taxonomy       = 'product_cat';
    $orderby        = 'ID';
    $show_count     = 0;      // 1 for yes, 0 for no
    $pad_counts     = 0;      // 1 for yes, 0 for no
    $hierarchical   = 1;      // 1 for yes, 0 for no
    $title          = '';
    $empty          = 0;

    $args = array(
        'hierarchical'                  => $hierarchical,
        'show_option_none'              => '',
        'hide_empty'                    => $empty,
        'parent'                        => $idObj,
        'taxonomy'                      => $taxonomy,
    );

    $categories = get_categories($args);

    $last_categories = get_categories(
        array(
            'taxonomy' => 'product_cat',
            'parent' => $categories->cat_ID
        )
    );

    $manufacturers = 'pa_manufacturer';
//    $manufacturer = explode(',', $product->get_attributes($manufacturers));

    if ( $slug == 'showroom' ) {
        echo '<p>Condition: </p>' . '
        <span>New</span>
        <label class="switch">
            <input type="checkbox">
            <span class="slider"></span>
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

    echo '<p>Price: </p>' . '
    <form action="">
        <input type="radio" id="toOneHundred" name="priceRange" value="toOneHundred">
        <label for="toOneHundred">0 - $100</label><br>
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

    echo '<p>Manufacturer: </p>' . '
    <p>Iterate crap here</p>' .
//    var_dump($manufacturer);
    '<hr>';

?>
    <button type="button" id="clear">Clear</button>

</div>