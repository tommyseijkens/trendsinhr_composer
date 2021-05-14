<?php get_header(); ?>
    <div class="page page--search">
      <?php include('includes/parts/header-top.php'); ?>
      <?php include('includes/navigation/main-navigation.php'); ?>

      <?php if (have_posts()) { ?>

          <div class="container">
              <div class="row container__search">
                  <div class="col-12 col-lg-4 search-results-filters">
                    <?php echo do_shortcode('[searchandfilter id="13219"]'); ?>
                  </div>
                  <div class="col-12 col-lg-8 col-xl-6 search-results-content">
                      <div class="list-overview">
                          <div class="row mt-7">
                              <div class="col-12">
                                  <div class="grid-overview">
                                    <?php
                                    while (have_posts()): the_post();
                                      include('includes/card.php');
                                    endwhile;
                                    ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

            <?php if (get_the_posts_pagination()): ?>
                <div class="row">
                    <div class="col">
                      <?php the_posts_pagination([
                        'mid_size' => 4,
                        'prev_text' => __('', 'textdomain'),
                        'next_text' => __('', 'textdomain'),
                      ]); ?>
                    </div>
                </div>
            <?php endif; ?>

          </div>

      <?php } else { ?>

          <div class="container my-7">
              <div class="row text-center">
                  <div class="col">
                  <h1 class=""><?php echo get_field('search_noresults_title', 'option'); ?></h1>
                  <p><?php echo get_field('search_noresults_text', 'option'); ?></p>
                  </div>
              </div>
          </div>

      <?php } ?>

    </div>

<?php
wp_reset_query();
get_footer();
?>