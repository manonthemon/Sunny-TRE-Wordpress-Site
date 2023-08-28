<?php
get_header(); 
pageBanner([
  'title' => "Upcoming Events",
  'subtitle' => "See all the upcoming events"
]);
?>

<div class="container container--narrow page-section">
  <?php
  while (have_posts()) {
    the_post(); ?>
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
          <?php echo wp_trim_words(get_the_content(), 20) ?> <a href="<?php the_permalink() ?>" class="nu gray">Read
            more</a>
        </p>
      </div>
    </div>
  <?php }
  echo paginate_links();
  ?>
  
<hr class='section-break'>
  <p>See what we were up to in the past. <a href='<?php echo site_url('/past-events') ?>'>Check out our past events archive</a>. </p>
</div>

<?php get_footer();?>