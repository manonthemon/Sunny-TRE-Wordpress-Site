<?php

get_header();

while (have_posts()) {

    the_post(); ?>
    <div class="page-banner">
        <div class="page-banner__bg-image"
            style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title">
                <?php the_title() ?>
            </h1>
            <div class="page-banner__intro">
                <p>!!!!!REPLACE WITH PHP in PAGE.PHP LATER!!!!!!!</p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">

        <div class="generic-content">
            <div class="grow group">

                <div class="one-third">
                    <?php the_post_thumbnail();?>
                </div>

                <div class="two-thirds">
                    <?php the_content();?>
                </div>
            </div>
        </div>

    </div>


<?php }

get_footer();

?>