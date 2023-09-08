<?php


add_action('rest_api_init', 'sunnyRegisterSearch');

function sunnyRegisterSearch() {
    register_rest_route('sunny/v1', 'search', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'sunnySearchResults'
    ]);
}

function sunnySearchResults(){
    return 'Wow, a route!';
}
?>

