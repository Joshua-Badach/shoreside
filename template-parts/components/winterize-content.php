<?php

echo '<div  class="container mission">
            <div class="row">
                <div class="col-lg-12">';
echo '<h2>' . $term->name . '</h2>';
echo $categoryDescription;
echo '</div>
            </div>
            <div class="row">
                <div class="col-sm-12">';
while ($contactQuery->have_posts()){
    $contactQuery->the_post();
    $content = the_content();
    $content;
}
wp_reset_postdata();
echo '</div>
    </div>
    <div class="row">
        <span class="col-12"><strong>Prices include all parts, labor and shop supplies. GST not included.</strong></span><br><br>
    </div>
    <div class="row tableHeader">
        <span class="col-3">Name</span><span class="col-2">Price</span><span class="col-7">Description</span>
    </div>';
foreach ($products as $service) {
    $price = wc_get_product( $service )->get_price();

    echo '<a class="row tableItem" itemscope itemtype="https://schema.org/ProductCollection" href="' . get_permalink( $service->ID ) . '"> 
                    <span class="col-3" itemprop="name">' . $service->post_title . '</span>';
    if ($price == '' ) {
        echo '<span class="col-2" itemprop = "price" >' . $price .  '</span >';
    } else {
        echo '<span class="col-2" itemprop = "price" >$' . $price .  '</span >';
    }
    echo '<span class="col-7" itemprop="description">' . $service->post_excerpt . '</span>
                  </a>';
}
echo '</div>';