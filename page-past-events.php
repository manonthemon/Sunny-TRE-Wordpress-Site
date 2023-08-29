<?php

get_header();
$page_banner_args = [
  'title' => 'Past Events',
  'subtitle' => 'See our past events',
  'photo' => get_theme_file_uri('/images/library-hero.jpg'),
];

pageBanner($page_banner_args);
?>

<div class="container container--narrow page-section">
  <?php

$today = date('Ymd');
$pastEvents = new WP_Query([
    'paged' => get_query_var('paged', 1),
  'post_type' => 'event',
  'orderby' => 'meta_value_num',
  'meta_key' => 'event_date',
  'order' => 'ASC',
  'meta_query' => [
[
'key' => 'event_date',
'compare' => '<',
'value' => $today,
'type' => 'numeric'
]
  ],
]);

  while ($pastEvents->have_posts()) {
    $pastEvents->the_post();
    get_template_part('template-parts/content' , 'event');
 }
  echo paginate_links([
    'total' => $pastEvents->max_num_pages,
  ]);
  ?>
</div>

<?php get_footer();?>