<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo get_option('blogname'); ?></title>
    <?php wp_head(); ?>
</head>
<body>
<?php get_template_part('template-parts/components/news') ?>
    <h1 class="bodyOutline">
        <?php
            echo (get_option('blogname') );
            ?>
    </h1>
    <header>
        <?php get_template_part( 'template-parts/components/nav' ); ?>
    </header>
