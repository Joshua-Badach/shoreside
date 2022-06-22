<?php

function brands_shortcode(){
    return include('template-parts/components/brands.php');
}
add_shortcode('brands', 'brands_shortcode');

function carousel_shortcode(){
    ob_start();
    $carousel = include_once('template-parts/components/carousel.php');
    return $carousel;
}
add_shortcode('carousel', 'carousel_shortcode');

function hero_shortcode(){
    return include('template-parts/components/heroVideo.php');
}
add_shortcode('hero', 'hero_shortcode');

function insta_shortcode(){
    return include('template-parts/components/instagram.php');
}
add_shortcode('instagram', 'insta_shortcode');

function product_gallery_shortcode(){
    $gallery = include('template-parts/components/productGallery.php');
    return $gallery;
}
add_shortcode('product-gallery', 'product_gallery_shortcode');

function quote_shortcode(){
    return include('template-parts/components/quote.php');
}
add_shortcode('quote', 'quote_shortcode');
