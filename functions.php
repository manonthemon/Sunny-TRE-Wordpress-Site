<?php 

function pageBanner($args = array()) {
    
    // Provide default values for 'title' and 'subtitle' if they are missing in $args
    $title = isset($args['title']) ? $args['title'] : get_the_title();
    $subtitle = isset($args['subtitle']) ? $args['subtitle'] : get_field('page_banner_subtitle');
    
    // Provide a default photo URL if 'photo' is missing in $args and custom field is not set
    if (isset($args['photo'])) {
        $photo_url = $args['photo'];
    } elseif (get_field('page_banner_background_image')) {
        $photo_url = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
        $photo_url = get_theme_file_uri('/images/ocean.jpg');
    }

    // Output the HTML
    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image"
             style="background-image: url(<?php echo $photo_url; ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title">
                <?php echo $title; ?>
            </h1>
            <div class="page-banner__intro">
                <p><?php echo $subtitle; ?></p>
            </div>
        </div>
    </div>
    <?php
    // End HTML output
}

function sunny_files() {
    wp_enqueue_script('main_sunny_js' , get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true );
    wp_enqueue_style('google_fonts' , '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font_awesome' , '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('sunny_main_styles' , get_stylesheet_uri(), NULL, microtime());
}

add_action('wp_enqueue_scripts' , 'sunny_files');

function sunny_features () {
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerMenuLocationOne', 'Footer Menu Location One');
    register_nav_menu('footerMenuLocationTwo', 'Footer Menu Location Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('serviceLandscape', 400, 260, true);
    add_image_size('servicePortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
    add_image_size('postFeatured', 800, 600, true);

}
add_action( 'after_setup_theme', 'sunny_features');

function sunny_adjust_queries($query) {

    if (!is_admin() AND is_post_type_archive ('service') AND $query-> is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', '-1');
    }

    if (!is_admin() AND is_post_type_archive ('event') AND $query-> is_main_query()) {
    $today = date('Ymd');
    $query->set('meta_key' , 'event_date',);
    $query->set('orderby' , 'meta_value_num',);
    $query->set('order' , 'ASC',);
    $query->set('meta_query' , [
        [
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        ]
                ],);
}
};
add_action('pre_get_posts', 'sunny_adjust_queries');

