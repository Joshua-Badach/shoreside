<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<?php
global $wp;
$current_url = home_url( add_query_arg( array(), $wp->request ) );
$site_name = get_bloginfo( 'name' );
$slug = $post->post_name;
$id = get_term_by('slug', $slug, 'product_cat');
$site_suffix = ucwords(str_replace('-', ' ', $slug));
$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

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
        if (is_home()|| is_front_page()){
            $description            =           get_post_custom_values('description', $site_slug);
            $image_id               =           get_page_by_title('rps-logo-share', OBJECT, 'attachment');
            $image                  =           $image_id->guid;
        }  else {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
            if ($_REQUEST['term'] == '') {
                if ($_REQUEST['product_cat'] != '') {
                    $idObj = $_REQUEST['product_cat'];
                    $field = 'id';
                    $taxonomy = 'product_cat';
                } else {
                    $idObj = $id->term_id;
                    $field = 'id';
                    $taxonomy = 'product_cat';
                }
            } elseif($_REQUEST['term'] != '') {
                $idObj = $_REQUEST['term'];
                $field = 'term_id';
                $taxonomy = 'pa_manufacturer';
            }

        }

    $term = get_term_by($field, $idObj, $taxonomy);
    $description = $term->description;
    echo '<meta property="og:description" content="' . $description[0] . '"/>
            <meta property="og:image" content="'. $image . '" />';
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
<?php var_dump($term);