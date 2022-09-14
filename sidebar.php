<div id="sidebar">
<?php
    global $post;
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

    echo '<p>Category: </p>';

    foreach ($categories as $cat) {
        echo '<a href="?filters=product_cat[' . $cat->term_id . ']">'.$cat->cat_name.'</a><br>';
    }
    echo '<hr>';
//    var_dump($last_categories);

    echo '<p>Price: </p>' . '
    <form action="">
        <input type="radio" id="html" name="priceRange" value="HTML">
        <label for="html">0 - 100</label><br>
        <input type="radio" id="css" name="priceRange" value="CSS">
        <label for="css">100 - 500</label><br>
        <input type="radio" id="javascript" name="priceRange" value="JavaScript">
        <label for="javascript">500 - 1,000</label><br>
        <input type="radio" id="javascript" name="priceRange" value="JavaScript">
        <label for="javascript">1,000 - 10,000</label><br>
        <input type="radio" id="javascript" name="priceRange" value="JavaScript">
        <label for="javascript">10,000 and up</label><br>
    </form>
    <hr>';

    echo '<p>Manufacturer: </p>'

?>
    <button type="button" id="clear">Clear</button>

</div>