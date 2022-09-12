<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */
defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
    return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
        'woocommerce-product-gallery--columns-' . absint( $columns ),
        'images',
    )
);
?>

<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;"><div id="lightbox"></div>
    <figure class="carousel-product portrait woocommerce-product-gallery__wrapper" data-scale="2">
        <?php
        if ( $post_thumbnail_id ) {
            $attachment_ids  = $product->get_gallery_image_ids();
            $image_urls      = array();
            $image_id        = $product->get_image_id();
            if ( $image_id ) {
                $image_url = wp_get_attachment_image_url( $image_id, 'full' );

                $image_urls[ 0 ] = $image_url;
            }

            foreach ( $attachment_ids as $attachment_id ) {
                $image_urls[] = wp_get_attachment_url( $attachment_id );
            }

            foreach ( $image_urls as $image_src_url ) {
                echo '<img class="portrait-item" src="' . $image_src_url . '">';
            }
//            product image lightbox
//			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
        } else {
            $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
            $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
            $html .= '</div>';
        }
//        call lightbox
//        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

        //        if ( $attachment_ids && $product->get_image_id() ) {
        //            foreach ( $attachment_ids as $attachment_id ) {
        //                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
        //            }
        //        }
//        		do_action( 'woocommerce_product_thumbnails' );
        ?>
    </figure>
    <?php
    echo '<div class="carousel-product-nav thumbnails">';
    if ( $attachment_ids && $product->get_image_id() ) {
        $image_urls[] = wp_get_attachment_url( $attachment_id );
        foreach ( $image_urls as $image_url ) {
            echo '<img src="' . $image_url . '">';
        }
    }
    echo '</div>';
    ?>
</div>
