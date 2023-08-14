<?php 

function sunny_files() {
    wp_enqueue_style('sunny_main_styles' , get_stylesheet_uri());
}

add_action('wp_enqueue_scripts' , 'sunny_files');

