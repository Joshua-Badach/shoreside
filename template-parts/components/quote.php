<?php
$image_id = get_page_by_title('quoteBanner', OBJECT, 'attachment');
$image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
$image = wp_get_attachment_image_src($image_id->ID, [1400, 300]);

echo '<div class="quote">
    <span><q>A man is never lost at sea</q> - Ernest Hemingway</span>
    <img loading="lazy"  src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" loading="lazy" alt="' . $image_alt . '">
</div>';