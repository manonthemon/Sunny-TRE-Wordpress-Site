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
      <?php the_content(); ?>
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
        $homepageEvents->the_post(); ?>
        <div class="event-summary">
          <a class="event-summary__date t-center" href="<?php the_permalink() ?>">
            <span class="event-summary__month">
              <?php
              $eventDate = DateTime::createFromFormat('d/m/Y', get_field('event_date'));
              if ($eventDate) {
                echo $eventDate->format('M');
              }
              ?>
            </span>
            <span class="event-summary__day">
              <?php
              $eventDate = DateTime::createFromFormat('d/m/Y', get_field('event_date'));
              if ($eventDate) {
                echo $eventDate->format('d');
              }
              ?>
            </span>
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
            <p>
              <?php if (has_excerpt()) {
                echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 20);
              }
              ?> <a href="<?php the_permalink() ?>" class="nu gray">Learn more</a>
            </p>
          </div>
        </div>
      <?php }
    }
    ?>

  <?php }
get_footer();
?>