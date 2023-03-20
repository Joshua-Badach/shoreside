<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<?php
global $post;

$current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$site_name = get_bloginfo( 'name' );
$slug = $post->post_name;

    //Get image for share meta
    if (get_post_thumbnail_id($post->ID)) {
        $featured = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
        $image = $featured[0];
    } else {
        $featured = get_page_by_title('rps-logo-share', 'OBJECT', 'attachment');
        $image = $featured->guid;
    }
//Get description for share meta
    //Wordpress custom value
    if ( get_post_custom_values('description', $post->ID) != '') {
        $desc = get_post_custom_values('description', $post->ID);
        $description = $desc[0];
        $site_suffix = $post->post_title;
    } //Woocommerce products
    elseif ( is_product() ) {
        $product = wc_get_product( get_the_id() );
        $description = $product->get_short_description();
        $site_suffix = $product->get_name();
    } //Woocommerce categories and attributes
    elseif ( get_term_by('slug', $slug, 'product_cat') != '' ) {
        if (isset($_REQUEST['product_cat'])){
            $descId = get_term_by('id', $_REQUEST['product_cat'], 'product_cat');
        } elseif ( isset($_REQUEST['term'])) {
            $descId = get_term_by('term_id', $_REQUEST['term'], 'pa_manufacturer');
        } else {
            $descId = get_term_by('slug', $slug, 'product_cat');
        }
        $site_suffix = $descId->name;
        $description = $descId->description;
    } //Fallback
    else {
        $site_suffix = $post->post_title;
        $description = "Let our team of experts help meet all of your power sports needs.";
    }?>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo (is_array($description)) ? (implode($description)) : (strip_tags($description)) ?>"/>
<?php
    echo '<meta property="fb:app_id" content="568883651374703" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_CA" />
    <meta property="og:url" content="' . $current_url . '" />
    <meta property="og:title" content="' . $site_name . ' - ' . str_replace('"', "", $site_suffix) . '" />
    <meta property="og:image" content="'. $image . '" />'; ?>
    <meta property="og:description" content="<?php echo (is_array($description)) ? (implode($description)) : (strip_tags($description)) ?>"/>

<?php wp_head(); ?>

</head>

<body itemscope itemtype="https://schema.org/Store">
<?php get_template_part('template-parts/components/news') ?>
<h1 class="bodyOutline"><?php
    if ( is_home() || is_front_page() )
        echo ('<span itemprop="name">' . $site_name . '</span>' . ' - Home');
    else
        echo ('<span itemprop="name">' . $site_name . '</span>' . ' - ' . $site_suffix);
    ?></h1>
<header>
    <?php get_template_part( 'template-parts/components/nav' ); ?>
</header>
