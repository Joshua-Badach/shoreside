<?php
$image_id = get_page_by_title('quoteBanner', OBJECT, 'attachment');
$image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
$image = $image_id->guid;


echo '<div class="quote">
    <span><q>A man is never lost at sea</q> - Ernest Hemingway</span>
    <img src="' . $image . '" alt="' . $image_alt . '">
</div>';