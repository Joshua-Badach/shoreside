<?php
global $post;
$slug = $post->post_name;

?>
<div class="container">
    <div class="row">
        <h2 class="col-sm-12">Visit us at</h2>
        <iframe class="col-sm-12 map"
                id="rpsMap"
                style="border:0"
                loading="lazy"
                allowfullscreen
                src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ0dKXf1YhoFMRSg5spSCQn28&key=AIzaSyD2c-3OrJeOvpSUXnsfIam_R3HnD7xAwuw">
        </iframe>
    </div>
</div>