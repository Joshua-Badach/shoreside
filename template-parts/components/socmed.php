<?php
global $post;
$slug = $post->post_name;
?>
<div class="container">
    <div class="row">
           <div class="col-12">
               <div class="followUs">
                <span>Follow Us</span>
                   <div id="facebookButton" class="socmed">
                       <a href="https://www.facebook.com/recpowersports/" target="_blank">
                           <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/facebook.svg' ?>" ></object>
                       </a>
                   </div>
            <div id="youtubeButton" class="socmed">
                <a href="https://www.youtube.com/channel/UCl8h_s4q3vnYPLc6tWwppgA" target="_blank">
                    <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/youtube.svg' ?>"></object>
                </a>
            </div>
            <div id="instaButton" class="socmed">
                <a href="https://www.instagram.com/recreationalpowersports/?hl=en" target="_blank">
                    <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/instagram.svg' ?>"></object>
                </a>
            </div>
                <span>@recreationalpowersports</span>
               </div>
        </div>
    </div>
</div>
<?php echo do_shortcode('[instagram-feed feed=1]'); ?>
