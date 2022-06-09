<?php wp_footer() ?>
        <footer>
            <div class="row">
                <span class="col-lg-3">
                    <a href="./">
                        <img class="logo" src="<?php echo get_template_directory_uri() . '/assets/src/library/images/logo.png' ?>" alt="Recreational Power Sports Logo">
                    </a>
                </span>
                <div class="col-lg-2">
                    <p>NAVIGATION</p>
                    <ul>
                        <li><a href="#">Showroom</a></li>
                        <li><a href="#">Parts & Accessories</a></li>
                        <li><a href="#">Service</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <p>HOURS</p>
                    <p>Weekdays: 8:00Am to 5:00pm
                    Saturday: 10:00Am to 2:00pm
                    Sunday: Closed</p>
                    <p>11204 154 Street NW <br>
                        Edmonton, AB T5M 1X7</p>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <p>SUBSCRIBE TO OUR NEWSLETTER</p>
                    <p>Subscribe to our newsletter to see exciting new offers, products promotions, and keep up with the REC Power team</p>
                    <a href="#" class="button">I'd Like to Register</a>
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
                    <div id="tiktokIcon" class="socmed">
                        <a href="https://www.tiktok.com/@recreationalpowersports" target="_blank">
                            <object data="<?php echo get_template_directory_uri() . '/assets/src/library/images/tiktok.svg' ?>"></object>
                        </a>
                    </div>
                </span>
            </div>
            <div class="row">
                <span class="col-lg-12">&copy; 2022 Recreational Power Sports</span>
            </div>
        </footer>
        <script>
            var nav = responsiveNav(".nav-collapse");

            var toggle = document.getElementById("toggle");
            toggle.addEventListener("click", function (e) {
              e.preventDefault();
              nav.toggle();
            }, false);
        </script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
    </body>
</html>