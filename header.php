<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
    <?php wp_title(); ?>
</head>
<body>
<?php get_template_part('template-parts/components/news') ?>
    <div class="carousel">
        <header>
            <?php get_template_part( 'template-parts/components/nav' ); ?>
        </header>
    </div>