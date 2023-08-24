<?php

get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image"
    style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">All Services</h1>
    <div class="page-banner__intro">
      <p>Learn more about my services</p>
    </div>
  </div>
</div>
<div class="container container--narrow page-section">

<p>I am fully trained to provide <strong>Tension Release Exercises (TRE) sessions</strong>. <a href="https://sunnytre.local/benefits-of-tre/" data-type="URL" data-id="https://sunnytre.local/benefits-of-tre/">See here for the benefits of TRE.</a> In short TRE can be very useful technique to release the build up of stress held throughout the body through neurogenic tremors.</p>
<p>As many years as practicing meditator, I can offer<strong> hour-long masterclasses on deepening meditation techniques. </strong>If you&rsquo;ve always liked the idea of meditating but find it rather dull, or a bit of a chore, you might want a consultation. Imagine actually wanting to meditate without pressuring yourself!</p>
<p>My studying of NLP (Neuro-linguistic Programming) and other cognitive behavioural techniques has enabled me to create imaginative techniques which can be utilised to change the quality of your inner experience and enable emotional state regulation. <strong>If you need coaching through a particular difficulty, contact me for a consultation.</strong></p>
<p>See my contact page to reach me.</p>
  
<ul class="link-list min-list">
  
  <?php
  while (have_posts()) {
    the_post(); ?>
    <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
  <?php }
  echo paginate_links();
  ?>

</div>

<?php get_footer();?>