<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<?php
global $wp;
$current_url = home_url( add_query_arg( array(), $wp->request ) );
$site_name = get_bloginfo( 'name' );
$site_slug = $post->post_name;
$site_suffix = ucwords(str_replace('-', ' ', $site_slug));
$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

?>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!--Remove this a week after major pushes-->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

<!--    <meta property="fb:app_id" content="568883651374703" />-->
<!--    <meta property="og:title" content="--><?php //echo $site_name . ' - ' . $site_suffix ?><!--" />-->
<!--    <meta property="og:url" content="--><?php //echo $current_url ?><!--" />-->
<!--    <meta property="og:type" content="website" />-->
<!--    <meta property="og:description" content="--><?php //echo $current_url ?><!--" />-->
<!--    <meta property="og:image" content="--><?php //echo $featured ?><!--" />-->


    <?php
    if ( get_post_type() === 'page' ){

    }
    if ( get_post_type() === 'post' ){

    }
    ?>
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
