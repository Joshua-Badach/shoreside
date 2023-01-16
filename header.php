<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<?php
global $wp;

$current_url = home_url( add_query_arg( array(), $wp->request ) );
$site_name = get_bloginfo( 'name' );
$slug = $post->post_name;
$site_suffix = ucwords(str_replace('-', ' ', $slug));
$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

$field = 'slug';
$value = $slug;
$taxonomy = 'product';

$id = get_term_by($field, $value, $taxonomy);

// First check for custom value description

?>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta property="fb:app_id" content="568883651374703" />
    <meta property="og:title" content="<?php echo $site_name . ' - ' . $site_suffix ?>" />
    <meta property="og:url" content="<?php echo $current_url ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_CA" />
    <?php

    if ( get_post_custom_values('description', $id) != '') {
        $image_id = get_page_by_title('rps-logo-share', OBJECT, 'attachment');
        $image = $image_id->guid;
        $description = get_post_custom_values('description', $id);

    } elseif ( get_term_by('slug', $slug, 'product_cat') != '' ) {
        $catId = get_term_by('slug', $slug, 'product_cat');
        $description[0] = $catId->description;
        $image = get_the_post_thumbnail_url();

    } elseif ( is_product() ) {
        $product = wc_get_product( get_the_id() );
        $imageId = $product->get_image_id();
        $imageSrc = wp_get_attachment_image_src( get_post_thumbnail_id($image_id), 'small');
        $image = $imageSrc[0];
        $description[] = $product->get_short_description();
    }

    echo '<meta property="og:description" content="' . filter_var($description[0], FILTER_SANITIZE_STRING) . '"/>';
    echo '<meta property="og:image" content="'. $image . '" />';
    wp_head();
//    var_dump($catId);
    ?>
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
