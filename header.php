<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!--    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>-->
<!--    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>-->
    <?php wp_head(); ?>
    <?php wp_title(); ?>
</head>
<body>
<?php get_template_part('template-parts/components/news') ?>
<h1 class="bodyOutline">Recreational Power Sports</h1>
<header>
    <?php get_template_part( 'template-parts/components/nav' ); ?>
</header>
