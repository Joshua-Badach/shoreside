<?php
echo '<div class="bannerImage">';
$featured = get_the_post_thumbnail( $post_id );
echo $featured;
echo'</div>';