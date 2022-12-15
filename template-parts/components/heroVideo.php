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
            <h2 class="home-heading"><?php echo get_option('blogdescription'); ?></h2>
        </section>
    </div>
</div>


