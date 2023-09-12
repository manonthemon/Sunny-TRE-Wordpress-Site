<?php

get_header();

while (have_posts()) {
  the_post();
  pageBanner();
  ?>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('service'); ?>">
          <i class="fa fa-home" aria-hidden="true"></i> All Services </a><span class="metabox__main">
          <?php the_title(); ?>
        </span></p>
    </div>
    <div class="generic-content">
      <?php the_field('main_body_content'); ?>
    </div>

    <?php
    $today = date('Ymd');
    $homepageEvents = new WP_Query([
      'posts_per_page' => 2,
      'post_type' => 'event',
      'orderby' => 'meta_value_num',
      'meta_key' => 'event_date',
      'order' => 'ASC',
      'meta_query' => [
        [
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        ],
        [
          'key' => 'related_services',
          'compare' => 'LIKE',
          'value' => '"' . get_the_ID() . '"'
        ]
      ],
    ]);

    if ($homepageEvents->have_posts()) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium"> Upcoming ' . get_the_title() . ' Events </h2>';
      while ($homepageEvents->have_posts()) {
        $homepageEvents->the_post(); 
        get_template_part('template-parts/content' , 'event');
      }
    }
    ?>

  <?php }
get_footer();
?>