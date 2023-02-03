<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;
global $product;
$tags = wc_get_product_tag_list($product->get_id);
$sale_price = get_post_meta( $product->id, '_price', true);
$regular_price = get_post_meta( $product->id, '_regular_price', true);

//var_dump($tags);

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

//do a check later
$manufacturer = array_shift( wc_get_product_terms( $product->id, 'pa_manufacturer', array( 'fields' => 'names' ) ) );
$sku = $product->get_sku();

?>
<li itemprop="itemListElement" itemscope itemtype="https://schema.org/Product" <?php wc_product_class( 'modal-link ', $product ); ?> >
	<?php
    if ( str_contains($tags, 'Pending') == true ){
        echo '<span class="pending">Pending</span>';
    }
    if ( str_contains($tags, 'Order') == true ){
        echo '<span class="onOrder">On Order</span>';
    }
    if ( !empty( $regular_price ) && !empty( $sale_price ) && $regular_price > $sale_price ) {
        echo '<span class="onsale">On Sale</span>';
    }
    echo '<meta itemprop="url" content="'. get_the_permalink() . '" />
    <meta itemprop="brand" content="'. $manufacturer . '" />
    <meta itemprop="sku" content="'. $sku . '" />
    <meta itemprop="manufacturer" content="' . $manufacturer . '">';

	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
//	do_action( 'woocommerce_before_shop_loop_item_title' );

//    echo the_post_thumbnail('thumbnail', array( 'itemscope' => null , 'itemprop' => 'image', 'itemtype' => 'http://schema.org/ImageObject'));
    echo '<div itemscope itemprop="image" itemtype="http://schema.org/ImageObject"><img class="attachment-thumbnail size-thumbnail wp-post-image" src="' . get_the_post_thumbnail_url() . '"><meta itemprop="url" content="' . get_the_post_thumbnail_url() . '"/></div>';

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
//	do_action( 'woocommerce_shop_loop_item_title' );
    echo '<h4 itemprop="name" class="shoreside-product-title ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h4>';

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
