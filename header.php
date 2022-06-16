<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
<!--    --><?php //wp_title(); ?>
<!--    derp... fix this later-->
</head>
<body>
<?php $page_slug = get_post_field('post_name', $post_id )?>
<?php get_template_part('template-parts/components/news') ?>
<h1 class="bodyOutline">Recreational Power Sports
    <?php if ($pagename == '')
        echo(' Home');
    else ($pagename != '' );
        $titleAmend = str_replace('-', ' ', $pagename);
        echo (ucwords($titleAmend))
    ?>
</h1>
<header>
    <?php get_template_part( 'template-parts/components/nav' ); ?>
</header>
