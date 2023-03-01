<?php
$image_id = get_page_by_title('news-banner', OBJECT, 'attachment');
$image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
$image = wp_get_attachment_image_src($image_id->ID, [1400, 300]);

echo '<img loading="lazy" class="newsBanner"  src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" loading="lazy" alt="' . $image_alt . '">';