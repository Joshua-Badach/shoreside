<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<?php
global $wp;
$current_url = home_url( add_query_arg( array(), $wp->request ) );
$site_name = get_bloginfo( 'name' );
$slug = $post->post_name;
//$id = get_term_by('slug', $slug, 'product_cat');
//$idObj = $id->term_id;
$site_suffix = ucwords(str_replace('-', ' ', $slug));
$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
$description = get_post_custom_values('description', $id);

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

    if ($description[0] != ''){
        $image_id = get_page_by_title('rps-logo-share', OBJECT, 'attachment');
        $image = $image_id->guid;
        echo '<meta property="og:description" content="' . $description[0] . '"/>';
        echo '<meta property="og:image" content="'. $image . '" />';
    }
//    if ($image[0] == ''){
//        $image_id = get_page_by_title('rps-logo-share', OBJECT, 'attachment');
//        $image[0] = $image_id->guid;
//    }
    var_dump($id);
//        $term = get_term_by($field, $idObj, $taxonomy);
//        $description = $term->description;
//        $trim = explode('. ', $description);
    echo '<meta property="og:description" content="' . $trim[0] . '"/>
    <meta property="og:image" content="'. $image[0] . '" />';
    wp_head(); ?>
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
