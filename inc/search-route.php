<?php
add_action('rest_api_init', 'sunnyRegisterSearch');

function sunnyRegisterSearch() {
    register_rest_route('sunny/v1', 'search', [
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'sunnySearchResults'
    ]);
}
function sunnySearchResults($data){
   $mainQuery = new WP_Query([
    'post_type' => ['post', 'page', 'service', 'testimonial' , 'event'],
    's' => sanitize_text_field($data['term'])
   ]);

   $results = [
    'generalInfo' => [],
    'services' => [],
    'testimonials' =>  [],
    'events' => []
   ];

while($mainQuery->have_posts()) {
    $mainQuery->the_post();

if(get_post_type() == 'post' OR get_post_type() == 'page') {
    array_push($results['generalInfo'], [
        'title'=> get_the_title(),
        'permalink' => get_the_permalink(),
        'postType' => get_post_type(),
        'authorName' => get_the_author(),
    ]);
}

if(get_post_type() == 'service') {
    array_push($results['services'], [
        'title'=> get_the_title(),
        'permalink' => get_the_permalink(),
    ]);
}

if(get_post_type() == 'testimonial') {
    array_push($results['testimonials'], [
        'title'=> get_the_title(),
        'permalink' => get_the_permalink(),
    ]);
}

if(get_post_type() == 'event') {
    array_push($results['events'], [
        'title'=> get_the_title(),
        'permalink' => get_the_permalink(),
    ]);
}
}

   return $results;
}
?>

