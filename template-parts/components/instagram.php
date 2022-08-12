<?php
global $post;
$slug = $post->post_name;
?>
<div class="container">
    <div class="row">
        <p class="col-12 followUs">
            <span>Follow Us</span> <img src=<?php echo get_template_directory_uri() . '/assets/src/library/images/instagram.png' . ' width="50" height="50" alt="Instagram icon"> ' ?> <a href="https://www.instagram.com/recreationalpowersports/?hl=en" target="_blank"><span>@recreationalpowersports</span></a>
        </p>
    </div>
</div>
<?php echo do_shortcode('[instagram-feed feed=1]'); ?>
