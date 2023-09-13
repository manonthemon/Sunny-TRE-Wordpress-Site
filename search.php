<?php

get_header();
$page_banner_args = [
  'title' => 'Search Results',
  'subtitle' => 'You searched for &ldquo;' . esc_html(get_search_query(false)).'&rdquo;',
  'photo' => get_theme_file_uri('/images/library-hero.jpg'),
];

pageBanner($page_banner_args);
?>

<div class="container container--narrow page-section">
  <?php
  if(have_posts()) {
    while (have_posts()) {
        the_post(); 
        get_template_part('template-parts/content', get_post_type() );
}
      echo paginate_links();

  } else {
echo '<h2 class="headline headline--small-plus">Sorry, no results found. Keep searching!</h2>';
}
?>



<?php
get_search_form();
  ?>

</div>
<?php get_footer();
?>