<?php

get_header();
$page_banner_args = [
  'title' => 'My Services',
  'subtitle' => 'How can I help you today?',
  'photo' => get_theme_file_uri('/images/bread.jpg'),
];

pageBanner($page_banner_args);
?>

<div class="container container--narrow page-section">

  <p>I am fully trained to provide <strong>Tension Release Exercises (TRE) sessions</strong>. <a
      href="https://sunnytre.local/benefits-of-tre/" data-type="URL"
      data-id="https://sunnytre.local/benefits-of-tre/">See here for the benefits of TRE.</a> In short TRE can be very
    useful technique to release the build up of stress held throughout the body through neurogenic tremors.</p>
  <p>As many years as practicing meditator, I can offer<strong> hour-long masterclasses on deepening meditation
      techniques. </strong>If you&rsquo;ve always liked the idea of meditating but find it rather dull, or a bit of a
    chore, you might want a consultation. Imagine actually wanting to meditate without pressuring yourself!</p>
  <p>My studying of NLP (Neuro-linguistic Programming) and other cognitive behavioural techniques has enabled me to
    create imaginative techniques which can be utilised to change the quality of your inner experience and enable
    emotional state regulation. <strong>If you need coaching through a particular difficulty, contact me for a
      consultation.</strong></p>
      <br>

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
</div>

<?php get_footer(); ?>