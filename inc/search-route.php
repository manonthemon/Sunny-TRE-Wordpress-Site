<?php
add_action('rest_api_init', 'sunnyRegisterSearch');

function sunnyRegisterSearch() {
    register_rest_route('sunny/v1', 'search', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'sunnySearchResults'
    ]);
}
function sunnySearchResults(){
   $services = new WP_Query([
    'post_type' => 'service',
   ]);

   $servicesResults = [];

while($services->have_posts()) {
    $services->the_post();
    array_push($servicesResults, [
        'title'=> get_the_title(),
        'permalink' => get_the_permalink(),
    ]);
}

   return $servicesResults;
}
?>

