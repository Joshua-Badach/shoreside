<?php wp_footer();

$image_id = get_page_by_title('rps-logo', OBJECT, 'attachment');
$image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
$image = $image_id->guid;

echo'<footer>
            <meta itemprop="url" content="https://recreationalpowersports.com" />
            <meta itemprop="email" content="admin@recreationalpowersports.com" />
            <meta itemprop="logo" content="'. $image . '" />
            <meta itemprop="currenciesAccepted" content="CAD"/>
            <meta itemprop="paymentAccepted" content="Cash, Debit, VISA, MasterCard"/>
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
                    <p itemscope itemtype="https://schema.org/PostalAddress" itemprop="address">
                        <a class="location" href="https://maps.google.com/?q=Recreational+Power+Sports" target="_blank" rel="noopener">
                            <span itemprop="streetAddress">11204 154 Street NW</span>
                            <span itemprop="addressLocality">Edmonton</span>
                            <span itemprop="addressRegion">AB</span>
                            <span itemprop="postalCode">T5M 1X7</span>
                        </a>
                    </p>
                </div>
                <div class="col-lg-3">
                    <p><strong>Hours</strong></p>
                    <p>Monday to Friday: <span itemprop="openingHours" content="Mo-Fr 08:00-17:00">8:00am to 5:00pm</span></p>
                    <p>Saturday: <span itemprop="openingHours" content="Sa 10:00-14:00">10:00am to 2:00pm</span></p>
                    <p>Sundays and Holidays: <span>Closed</span></p>
                    <p class="specialNote"><strong>*Please note that we will be CLOSED on Saturday, March 18. Come check us out at the <a href="http://www.edmontonboatandsportshow.ca/" target="_blank">Edmonton Boat & Sportsmens Show</a> at the <a href="https://maps.google.com/?q=Edmonton+EXPO+Centre" target="_blank">Edmonton EXPO Centre</a> March 16th-19th!</strong></p>
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
            <a class="facebook" itemprop="sameAs" href="https://www.facebook.com/recpowersports/" target="_blank">
                <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/facebook.svg' ?>" ></object>
            </a>
        </div>
        <div id="youtubeIcon" class="socmed">
            <a class="youtube" itemprop="sameAs" href="https://www.youtube.com/@recreationalpowersports" target="_blank">
                <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/youtube.svg' ?>"></object>
            </a>
        </div>
        <div id="instaIcon" class="socmed">
            <a class="instagram" itemprop="sameAs" href="https://www.instagram.com/recreationalpowersports/?hl=en" target="_blank">
                <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/instagram.svg' ?>"></object>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <span class="col-lg-12">&copy; 2022 Recreational Power Sports</span>
</div>
<!--<script defer src='https://bit.ly/3wO0rkP' type='text/javascript'></script>-->

</footer>
</body>
</html>