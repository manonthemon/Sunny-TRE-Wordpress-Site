<?php

get_header();
$page_banner_args = [
  'title' => 'Blog',
  'subtitle' => 'Latest posts from the world of TRE',
  'photo' => get_theme_file_uri('/images/library-hero.jpg'),
];

pageBanner($page_banner_args);
?>

<div class="container container--narrow page-section">
  <?php
  while (have_posts()) {
    the_post(); ?>
    <div class="post-item">
      <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?>
        </a> </h2>
      <div class="metabox">
        <p?>Posted by
          <?php the_author_posts_link(); ?> on
          <?php the_time('F Y'); ?> in
          <?php echo get_the_category_list(', '); ?>
          </p>
      </div>
      <div class="generic-content">
        <?php the_excerpt(); ?>  
        <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
      </div>
    </div>

  <?php }
  echo paginate_links();
  ?>

</div>
<?php get_footer();
?>