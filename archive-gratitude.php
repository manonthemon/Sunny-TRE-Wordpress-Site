<?php

get_header();
$page_banner_args = [
  'title' => 'Gratitude Journal',
  'subtitle' => 'What are you thankful for today?',
  'photo' => get_theme_file_uri('/images/apples.jpg'),
];

pageBanner($page_banner_args);
?>

<div class="container container--narrow page-section">

<p>Have you ever considered the effects of starting a gratitude practice for yourself? It can have many benefits, cognitively , 
enhancing your mood and even physically on the body. I have written my experiences and the new science behind these practices and 
will be adding more pages as I uncover more about this simple, yet effective way of enhancing our life experiences. Enjoy, and thanks for reading!</p>
<hr />
<p>&nbsp;</p>

  <?php
  while (have_posts()) {
    the_post(); ?>
    <div class="post-item">
      <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?>
        </a> </h2>
      <div class="metabox">
        <p><?php the_time('F Y'); ?></p>
      </div>

<div class="generic-content">
  <?php the_excerpt(); ?>
    <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
  </div>
</div>

  <?php } echo paginate_links();?>
</div>

<?php get_footer(); ?>