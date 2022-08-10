<?php wp_footer() ?>
        <footer>
            <div class="row">
                <span class="col-lg-3">
                    <a href="<?php echo site_url() ?>">
                        <img class="logo" src="<?php echo get_template_directory_uri() . '/assets/src/library/images/logo.png' ?>" alt="Recreational Power Sports Logo">
                    </a>
                </span>
                <div class="col-lg-2">
                    <p>NAVIGATION</p>
                    <ul>
                        <li class="mobileShow"><a href="<?php echo site_url() ?>">Home</a></li>
                        <li><a href="/showroom/">Showroom</a></li>
                        <li><a href="/parts/">Parts & Accessories</a></li>
                        <li><a href="/service/">Service</a></li>
                        <li><a href="/about/">About Us</a></li>
                        <li><a href="/contact/">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <p>HOURS</p>
                    <p>Weekdays: 8:00Am to 5:00pm <br>
                    Saturday: 10:00Am to 2:00pm <br>
                    Sunday: Closed</p>
                    <p><a class="location"  href="https://maps.google.com/?q=Recreational+Power+Sports" target="_blank" rel="noopener">11204 154 Street NW Edmonton, AB T5M 1X7</a></p>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <p>SUBSCRIBE TO OUR NEWSLETTER</p>
                    <p>Subscribe to our newsletter to see exciting new offers, products promotions, and keep up with the REC Power team</p>
                    <button onclick="location.href='#'">I'd Like to Register</button>
                </div>
            </div>
            <div class="row">
                <span class="col-lg-4 offset-lg-4">
                    <div id="facebookIcon" class="socmed">
                        <a href="https://www.facebook.com/recpowersports/" target="_blank">
                            <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/facebook.svg' ?>" ></object>
                        </a>
                    </div>
                    <div id="youtubeIcon" class="socmed">
                        <a href="https://www.youtube.com/channel/UCl8h_s4q3vnYPLc6tWwppgA" target="_blank">
                            <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/youtube.svg' ?>"></object>
                        </a>
                    </div>
                    <div id="instaIcon" class="socmed">
                        <a href="https://www.instagram.com/recreationalpowersports/?hl=en" target="_blank">
                            <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/instagram.svg' ?>"></object>
                        </a>
                    </div>
<!--                    <div id="tiktokIcon" class="socmed">-->
<!--                        <a href="https://www.tiktok.com/@recreationalpowersports" target="_blank">-->
<!--                            <object data="--><?php //echo get_template_directory_uri() . '/assets/src/library/images/tiktok.svg' ?><!--"></object>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </span>-->
<!--            </div>-->
            <div class="row">
                <span class="col-lg-12">&copy; 2022 Recreational Power Sports</span>
            </div>
            <script>
//remove that bloody branding on jotform
              var $ = jQuery.noConflict();

              jQuery(document).ready(function(jQuery) {

                "use strict";

                $('iframe').contents().find("head").append($("<style type='text/css'>  div.formFooter{ display:none !important; } .jf-branding{ display: none !important; } div.form-footer{ display: none !important; } </style>"));

              });

            </script>
        </footer>
    </body>
</html>