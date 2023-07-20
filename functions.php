<?php
function university_files()
{
    wp_enqueue_script('main-university_js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime() , true); //Remember to change microtimeI()//
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri(), NULL, microtime()); //Remember to remove microtimeI()//
}

add_action('wp_enqueue_scripts', 'university_files');

// This adds title tags to pages
function university_features() {
    add_theme_support('title-tag');
}
add_action( 'after_setup_theme' , 'university_features');