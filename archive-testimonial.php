<?php
get_header();
pageBanner([
  'title' => 'Testimonials',
  'subtitle' => 'See what my clients have to say'
]);
?>

<div class="container container--narrow page-section">



<p>There are many people who have had amazing experiences with TRE. In my personal experience, I have seen clients experience profound insights and tension releases from practising TRE. The ability of TRE to work on healing on so many different levels, the effects can be noticeable and profound.&nbsp;</p>
<p>For a compilation of testimonials of TRE as a healing practise, <a href="https://traumaprevention.com/testimonials/">please click here</a> to read what others worldwide have experienced through using TRE.&nbsp;</p>
<p>Below are some comments from my clients.</p>
<hr />
<p>&nbsp;</p>

<?php
  echo '<ul class="professor-cards">';
  while (have_posts()) {
    the_post(); ?>
    <li class="professor-card__list-item">
      <a class="professor-card" href="<?php the_permalink(); ?>">
        <img class="professor-card__image" src="<?php the_post_thumbnail_url('serviceLandscape'); ?>">
        <span class="professor-card__name">
          <?php the_title(); ?>
        </span>
      </a>
    </li>

  <?php }
  echo '</ul>';
  echo paginate_links();
  ?>


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