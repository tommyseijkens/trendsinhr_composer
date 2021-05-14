<?php

$wp_query = new WP_Query( array( 'posttypes' => 'publicaties', 'posts_per_page' => -1 ) );

if ($wp_query->have_posts()): ?>
    <div class="page--whitepapers">
        <div class="container grid-section-label d-none d-md-block">Publicaties</div>
        <div class="container">
            <div class="list-overview list-overview--whitepapers">
                <div class="row mt-7">
                    <div class="col-12 col-lg-8 col-xl-6 m-auto">
                        <div class="grid-overview">
                            <?php
                            while ($wp_query->have_posts()): $wp_query->the_post();
                                $image = get_field('afbeelding_overzicht');
                                ?>

                                <div class="card-item card-item--whitepaper">
                                    <a class="card-item__content" href="<?php echo get_the_permalink(); ?>">
                                        <div class="card-item__background">
                                            <div class="card-item__background--image"
                                                 style="background-image: url('<?php echo $image['url']; ?>');"></div>
                                        </div>
                                        <div class="card-item__description">
                                            <div class="labels">
                                                <span class="label card-item__label">Publicatie</span>
                                            </div>
                                            <span class="card-item__title"><?php the_title(); ?></span>
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </a>
                                </div>

                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>
    <div class="more-link__wrapper">Geen publicaties gevonden.</div>
<?php endif; ?>
