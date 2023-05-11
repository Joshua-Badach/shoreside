<?php
/**
 * Additional Information tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/additional-information.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;
global $product;
$attributes = $product->get_attributes();

//Get all terms associated with post in woocommerce's taxonomy 'product_cat'
$terms = get_the_terms( $post->ID, 'product_cat' );

//Get an array of their IDs
$term_ids = wp_list_pluck($terms,'term_id');

//Get array of parents - 0 is not a parent
$parents = array_filter(wp_list_pluck($terms,'parent'));

//Get array of IDs of terms which are not parents.
$term_ids_not_parents = array_diff($term_ids,  $parents);

//Get corresponding term objects.
$terms_not_parents = array_intersect_key($terms,  $term_ids_not_parents);

//Extract the name of the category from the array and post it.
foreach($terms_not_parents as $term_not_parent)
$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional information', 'woocommerce' ) );

$partsObj = get_term_by('slug', 'parts-and-accessories', 'product_cat');

if ( $heading ) : ?>
	<h2><?php echo esc_html( $heading ); ?></h2>
<?php endif;

echo'<table class="woocommerce-product-attributes shop_attributes">
    <tbody>';
    echo '<tr class="woocommerce-product-attributes-item">
        <th>Vehicle Category</th>
        <td><p>' . $term_not_parent->name . '</p></td>
    </tr>';

foreach ($attributes as $attribute){
    $value = $product->get_attribute( $attribute['name'] );
    $label = wc_attribute_label( $attribute['name'] );

    if ($attribute['visible'] == true) {
        echo '<tr class="woocommerce-product-attributes-item">
            <th>' . $label . '</th> <td>' . $value . '</td>
        </tr>';
    }
}
echo'</tbody>
</table>';

