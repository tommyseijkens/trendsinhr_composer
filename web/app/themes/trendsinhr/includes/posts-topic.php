<?php

if ($wp_query->have_posts()): ?>
    <div class="page--topic">
        <div class="container grid-section-label d-none d-md-block">Artikelen</div>
        <div class="container">
            <div class="list-overview">
                <div class="row mt-7">
                    <div class="col-12 col-lg-8 col-xl-6 m-auto">
                        <div class="grid-overview">
                            <?php
                            while ($wp_query->have_posts()): $wp_query->the_post();
                                include('card.php');
                            endwhile;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="more-link__wrapper">
            <?php
            // don't display the button if there are not enough posts
            if ($wp_query->max_num_pages > 1)
                echo '<div class="more-link grid-overview__more loadmore">Laad meer artikelen</div>'; // you can use <a> as well
            ?>
        </div>
    </div>

<?php else: ?>
    <div class="more-link__wrapper">Geen artikelen gevonden.</div>
<?php endif; ?>
