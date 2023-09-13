<div class="post-item">
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
              <?php  if (has_excerpt()) {
              echo wp_trim_words(get_the_excerpt(), 55); // Limit excerpt to 20 words
            } else {
              echo wp_trim_words(get_the_content(), 55); // If no excerpt, limit content to 20 words
            }
              ?> 
              <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">View event &raquo;</a></p>
            </p>
          </div>
        </div>
          </div>