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
    the_post(); 
    get_template_part('template-parts/content' , 'event');

 }
  echo paginate_links();
  ?>
  
<hr class='section-break'>
  <p>See what we were up to in the past. <a href='<?php echo site_url('/past-events') ?>'>Check out our past events archive</a>. </p>
</div>

<?php get_footer();?>