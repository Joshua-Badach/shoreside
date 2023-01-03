<?php
echo '<div class="bannerImageTall">';
$featured = get_the_post_thumbnail( $post_id );
echo $featured;
echo'</div>';