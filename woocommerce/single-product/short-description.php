<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
$product = wc_get_product($post);
$video = $product->get_attribute( 'Video' );
$ad = $product->get_attribute( 'Ad' );

$manufacturer = array_shift( wc_get_product_terms( $product->id, 'pa_manufacturer', array( 'fields' => 'names' ) ) );
$image_slug = $manufacturer.'-logo';
$image_id = get_page_by_title($image_slug, OBJECT, 'attachment');
$image = $image_id->guid;


function get_attachment_url_by_slug( $slug )
{
    $args = array(
        'post_type' => 'attachment',
        'name' => sanitize_title($slug),
        'posts_per_page' => 1,
        'post_status' => 'inherit',
    );
    $_head = get_posts($args);
    $header = $_head ? array_pop($_head) : null;
    return $header ? wp_get_attachment_url($header->ID) : '';
}
$header_url = get_attachment_url_by_slug($ad);

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
if ( ! $short_description ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description">
	<?php
    echo $short_description;
    if ($video != '') {
        echo '<iframe class="productVideo" name="productVideo" scrolling="no" frameborder="1" src="https://www.youtube.com/embed/' . $video . '" marginwidth="0px" allowfullscreen></iframe>
';
    }
    if ( $ad != '' ){
        echo '<img class="productBanner" src="' . $header_url . '">';
    }
    if ($image != ''){
        echo '<img width="200" height="50" class="logoBanner" src="' . $image . '">';
    }
?>
</div>
