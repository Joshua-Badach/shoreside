<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<?php
global $wp;

$current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$site_name = get_bloginfo( 'name' );
$slug = $post->post_name;
$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

$field = 'slug';
$value = $slug;
$taxonomy = 'product';

$id = get_term_by($field, $value, $taxonomy);
?>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta property="fb:app_id" content="568883651374703" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_CA" />
    <?php
    if ( get_post_custom_values('description', $id) != '') {
        $image_id = get_page_by_title('rps-logo-share', OBJECT, 'attachment');
        $image = $image_id->guid;
        $description = get_post_custom_values('description', $id);
        $site_suffix = $post->post_title;
    } elseif ( get_term_by('slug', $slug, 'product_cat') != '' ) {
        if ($_REQUEST['product_cat'] != '' && $_REQUEST['term'] == '' ){
            $descId = get_term_by('id', $_REQUEST['product_cat'], 'product_cat');
        } elseif ( $_REQUEST['term'] != '' ) {
            $descId = get_term_by('term_id', $_REQUEST['term'], 'pa_manufacturer');
        } else {
            $descId = get_term_by('slug', $slug, 'product_cat');
        }
        $site_suffix = $descId->name;
        $description[0] = $descId->description;
        if (get_the_post_thumbnail() != ''){
            $image = get_the_post_thumbnail_url();
        } else {
            $image_id = get_page_by_title('rps-logo-share', OBJECT, 'attachment');
        }
    } elseif ( is_product() ) {
        $product = wc_get_product( get_the_id() );
        if ($product->get_image_id() != '') {
            $imageId = $product->get_image_id();
            $imageSrc = wp_get_attachment_image_src(get_post_thumbnail_id($image_id), 'small');
            $image = $imageSrc[0];
        } else {
            $image_id = get_page_by_title('rps-logo-share', OBJECT, 'attachment');
        }
        $site_suffix = $product->get_name();
        $description[] = $product->get_short_description();
    } else {
        if (get_the_post_thumbnail() != ''){
            $image = get_the_post_thumbnail_url();
        } else {
            $image_id = get_page_by_title('rps-logo-share', OBJECT, 'attachment');
            $image = $image_id->guid;
        }
        $site_suffix = get_the_title();
    }
    echo '<meta property="og:url" content="' . $current_url . '" />';
    echo '<meta property="og:title" content="' . $site_name . ' - ' . $site_suffix . '" />';
    echo '<meta property="og:description" content="' . filter_var($description[0], FILTER_SANITIZE_STRING) . '"/>';
    echo '<meta property="og:image" content="'. $image . '" />';
    wp_head();
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
