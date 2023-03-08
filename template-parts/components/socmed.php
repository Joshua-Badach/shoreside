<?php
echo '<section class="our-socials">';
?>
<div class="container socials">
    <div class="row">
           <div class="col-12">
               <h2>Our Socials</h2>
               <div class="followUs">
                <span>Follow Us</span>
                   <div id="facebookButton" class="socmed">
                       <a class="facebook" href="https://www.facebook.com/recpowersports/" target="_blank">
                           <object alt="Facebook Icon" data="<?php echo get_template_directory_uri() . '/assets/src/library/images/facebook.svg' ?>" ></object>
                       </a>
                   </div>
            <div id="youtubeButton" class="socmed">
                <a class="youtube" href="https://www.youtube.com/@recreationalpowersports" target="_blank">
                    <object alt="Youtube Icon" data="<?php echo get_template_directory_uri() . '/assets/src/library/images/youtube.svg' ?>"></object>
                </a>
            </div>
            <div id="instaButton" class="socmed">
                <a class="instagram" href="https://www.instagram.com/recreationalpowersports/?hl=en" target="_blank">
                    <object alt="Instagram Icon" data="<?php echo get_template_directory_uri() . '/assets/src/library/images/instagram.svg' ?>"></object>
                </a>
            </div>
                <span>@recreationalpowersports</span>
               </div>
        </div>
    </div>
</div>
<?php echo do_shortcode('[instagram-feed feed=1]');

echo '</section>';
?>
