<?php
/**
 * Posts overview loop
 * Loop for retrieving posts
 * @category    Posts
 */

$spotlight_post = get_field('highlightedpost', 'option');
$feautured_posts = get_field('featured_posts','option');
$insert_feautured = true;
$args = array(
    'posts_per_page' => 7, /* 12 items minus highlight minus banner minus 3 featured posts = 7 */
    'post__not_in' => array($spotlight_post->ID, $feautured_posts[0], $feautured_posts[1], $feautured_posts[2]),
);
$main_query = new WP_Query($args);

if ($main_query->have_posts()):
    ?>
    <div class="grid-section grid-section--news mt-md-7">
        <div class="container grid-section-label d-none d-md-block">Nieuws</div>
        <div class="container">
            <div class="grid-overview">

                <?php
                /* display featured post on 1st position */
                $post = get_post($spotlight_post->ID);
                include('card.php');

                /* display cards, use loadmore hook to display 10 on first page, 12 on loadmore */
                while ($main_query->have_posts()): $main_query->the_post();
                    include('card.php');
                endwhile;

                /* display banner */
                include('cards/card-banner.php');
                ?>

            </div>
        </div>
        <div class="more-link__wrapper">
            <?php
            // don't display the button if there are not enough posts
            if ($main_query->max_num_pages > 1)
                echo '<div class="more-link grid-overview__more loadmore">Laad meer artikelen</div>'; // you can use <a> as well
            ?>
        </div>
    </div>

<?php else: ?>
    <div class="col-12">
        <p>Helaas zijn er geen resultaten gevonden.</p>
    </div>
<?php

endif;
$insert_feautured = false;

?>


