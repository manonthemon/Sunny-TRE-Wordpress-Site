<?php

get_header();

while (have_posts()) {
    the_post();
    pageBanner();
    ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Events Home </a><span class="metabox__main">
                    <?php the_title(); ?>
                </span></p>
        </div>
        <div class="generic-content">
            <?php the_content(); ?>
        </div>

        <?php
        $relatedServices = get_field('related_services');

        if ($relatedServices) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--small"> Related Service(s)</h2>';
            echo '<ul class="link-list min-list">';
            foreach ($relatedServices as $service) { ?>
                <li><a href="<?php echo get_the_permalink($service) ?>"><?php echo get_the_title($service); ?></a></li>
            <?php }
            echo '</ul>';
        }
        ?>
    </div>
<?php }
get_footer();
?>