<?php

get_header();
$page_banner_args = [
  'title' => 'Events',
  'subtitle' => 'See our upcoming events',
  'photo' => get_theme_file_uri('/images/library-hero.jpg'),
];

pageBanner($page_banner_args);
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