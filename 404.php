<?php
get_header()
?>
<div class="errorPage">
    <img src="<?php echo get_template_directory_uri() . '/assets/src/library/images/404background.webp' ?>" alt="">
    <div class="container">
        <div class="row">
            <div class="offset-lg-7 col-lg-5">
                <h1 class="errorHeading">404</h1>
                <p>Lost at sea? <a href="<?php echo site_url() ?>">Let's get you back on board</a>!</p>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();