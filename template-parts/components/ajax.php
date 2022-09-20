<?php

function load_results(){
    $paged = $_POST["page"];
    echo $paged;
    wp_die();
}

add_action( 'wp_ajax_load_results', 'load_results');
add_action( 'wp_ajax_nopriv_load_results', 'load_results');
