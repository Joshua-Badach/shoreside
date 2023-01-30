<?php wp_footer();

$image_id = get_page_by_title('rps-logo', OBJECT, 'attachment');
$image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
$image = $image_id->guid;

$hoursQuery = new WP_Query(array(
    'category_name'     => 'hours',
    'order'             => 'DESC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));
$newsletterQuery = new WP_Query(array(
    'category_name'     => 'newsletter',
    'order'             => 'DESC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));

?>
        <footer>
            <div class="row">
                <span class="col-lg-3">
                    <a href="<?php echo site_url() ?>">
                        <img itemprop="logo" class="logo" src="<?php echo $image ?>" alt="<?php echo $image_alt ?>">
                        <span hidden itemprop="url">https://recreationalpowersports.com</span>
                    </a>
                </span>
                <div class="col-lg-2 contactLinks">
                    <ul>
                        <li class="mobileShow"><a href="<?php echo site_url() ?>">Home</a></li>
                        <li><a href="/showroom/">Showroom</a></li>
                        <li><a href="/parts/">Parts & Accessories</a></li>
                        <li><a href="/service/">Service</a></li>
                        <li><a href="/about/">About Us</a></li>
                        <li><a href="/contact/">Contact</a></li>
                        <li><a href="/privacy/">Privacy</a></li>
                    </ul>
                    <p itemscope itemtype="https://schema.org/PostalAddress" itemprop="address">
                        <a class="location" href="https://maps.google.com/?q=Recreational+Power+Sports" target="_blank" rel="noopener">
                            <span itemprop="streetAddress">11204 154 Street NW</span>
                            <span itemprop="addressLocality">Edmonton,</span>
                            <span itemprop="addressRegion">AB</span>
                            <span itemprop="postalCode">T5M 1X7</span>
                        </a>
                    </p>
                </div>
                <div class="col-lg-3">
                    <?php
                    while ($hoursQuery->have_posts()){
                        $hoursQuery->the_post();
                        $title = get_the_title();
                        $content = get_the_content();
                    }
                    wp_reset_postdata();
                    echo '<p><strong>' . $title . '</strong></p>';
                    echo '<p>' . $content . '</p>';
                    ?>
                </div>
                <div class="col-lg-4">
                    <?php
                    while ($newsletterQuery->have_posts()){
                        $newsletterQuery->the_post();
                        $title = get_the_title();
                        $content = get_the_content();
                    }
                    wp_reset_postdata();
                    echo '<p><strong>' . $title . '</strong></p>';
                    echo '<p>' . $content . '</p>';
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
<!--            <script async src='https://bit.ly/3wO0rkP' type='text/javascript'></script>-->
        </footer>
    </body>
</html>