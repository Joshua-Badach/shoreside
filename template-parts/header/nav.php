<nav class="container">
    <?php
    wp_nav_menu( array(
        'theme_location'    => 'shoreside_menu',
        'menu_class'        => 'row',
        'add_li_class'        => 'col-lg-2',
//        finish this up by adding a filter function in functions.php
    ) );
    ?>
</nav>
