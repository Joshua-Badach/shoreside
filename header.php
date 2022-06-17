<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body>
<?php get_template_part('template-parts/components/news') ?>
<h1 class="bodyOutline"><?php
    $site_name = get_bloginfo( 'name' );
    $site_slug = $post->post_name;
    $site_suffix = ucwords(str_replace('-', ' ', $site_slug));
    if ( is_home() || is_front_page() )
        echo ($site_name . ' - Home');
    else
        echo ($site_name . ' - ' . $site_suffix);
?></h1>
<header>
        <?php get_template_part( 'template-parts/components/nav' ); ?>
</header>
