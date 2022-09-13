<div id="sidebar">
<?php
    echo '<p>Category: </p>' .
    do_shortcode("[br_filter_single filter_id=4049]") .
    '<hr>';

    echo '<p>Price: </p>' .
    do_shortcode("[br_filter_single filter_id=4041]") .
    '<hr>';

    echo '<p>Attributes: </p>';
//    if (strpos($url, $checkFor) == true){

//        echo '<hr>';
//    }
?>

</div>