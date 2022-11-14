<?php
if(isMobile()){ ?>
    <div class="heroVideo">
        <?php
            $featured = get_the_post_thumbnail( $post_id );
            echo $featured;
        ?>
    </div>
<?php
}
else { ?>
        <div class="heroVideo">
            <video autoplay loop muted>
                <source src="<?php echo '/wp-content/uploads/hero.mp4'?> ">
            </video>
        </div>
<?php
}
?>
<div class="container">
    <div class="row">
        <section class="col-8 home-block">
            <img itemprop="logo" src="<?php echo get_template_directory_uri() . '/assets/src/library/images/logo.png' ?>" alt="Recreational Power Sports Logo" alt="Recreational Power Sports Logo">
            <span hidden itemprop="url">https://recreationalpowersports.com</span>
            <h2 class="home-heading"><?php echo get_option('blogdescription'); ?></h2>
        </section>
    </div>
</div>


