<?php
global $post;
$slug = $post->post_name;
$id = get_term_by('slug', $slug, 'product_cat');
$idObj = $id->term_id;

echo '<div class="container"> 
                <div class="row">
                    <p class="col-sm-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac efficitur sem. Proin et tortor ut sapien feugiat mollis at sed tortor. Phasellus vitae felis faucibus, venenatis turpis in, pellentesque dui. Donec vestibulum tellus ut nibh luctus congue non quis massa. Pellentesque turpis massa, pellentesque porta feugiat eu, commodo a urna. Donec dapibus lorem in cursus luctus. Vestibulum ultricies turpis non ex cursus, nec accumsan arcu consequat. Suspendisse potenti. Suspendisse potenti. Fusce sodales, quam et imperdiet volutpat, est enim ornare tortor, eget porta magna risus varius tortor. Morbi sagittis at lacus rhoncus sollicitudin. Vestibulum et quam mauris. Phasellus ultricies et ex ut mollis.</p>
                    <img class="col-sm-4" src="http://placekitten.com/150/150" alt="Placeholder">
                </div>
      </div>';
?>