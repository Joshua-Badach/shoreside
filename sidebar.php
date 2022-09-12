<?php
global $wp;
$url = home_url( $wp->request );
$checkFor = 'parts-and-accessories';

?>
<div id="sidebar">
<?php
//        price filter, on every sidebar
        echo '<p>Price: </p>';
        echo do_shortcode("[br_filter_single filter_id=4041]");
        echo '<hr>';

    if (strpos($url, $checkFor) == true){
        echo '<p>Category: </p>';
        echo do_shortcode("[br_filter_single filter_id=4049]");
        echo '<hr>';
    }
?>

</div>