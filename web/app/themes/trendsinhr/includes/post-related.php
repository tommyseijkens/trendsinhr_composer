
<?php wp_reset_query();

// create new stdClass Objects
$related = new stdClass;
$related->selected = new stdClass;
$related->selected->query = new stdClass;
$related->tags = new stdClass;
$related->exclude = new stdClass;
$related->tags->query = new stdClass;
$results = new stdClass;

$related->exclude = get_option('posts_no_detail');
array_push($related->exclude, get_the_ID());

// selected id's from post
$related->selected->ids = get_field('lees_ook', false, false);
$related->selected->query = new WP_Query(array(
    'posts_per_page' => 3,
    'post__in' => $related->selected->ids,
    'post_status' => 'any',
    'order' => 'DESC',
    'orderby' => 'date',
    'post__not_in' => $related->exclude,
));

// get related tags
$related->tags->ids = wp_get_post_terms($post->ID, 'vakgebieden', array('fields' => 'ids'));
$related->tags->ids = array_diff($related->tags->ids, [478, 479, 477]);

$related->tags->query = new WP_Query(array(
    'post__not_in' => array($post->ID),
    'posts_per_page' => 3 - $related->selected->query->post_count,
    'order' => 'DESC',
    'orderby' => 'date',
    'post__not_in' => $related->exclude,
    'tax_query' => array(
        array(
            'taxonomy' => 'vakgebieden',
            'field' => 'term_id',
            'terms' => $related->tags->ids,
        ),
    ),
));

// when three selected items disable tags query
if ($related->selected->query->post_count == 3 && $related->selected->ids) {
    $results->posts = $related->selected->query->posts;
} elseif (!$related->selected->ids) {
    $results->posts = $related->tags->query->posts;
} else {
    $results->posts = array_merge($related->selected->query->posts, $related->tags->query->posts);
}

// get all id's
$related->postids = array();
foreach ($results->posts as $item) {
    array_push($related->postids, $item->ID);
}
$related->uniqueposts = array_unique($related->postids);

// new query with id filter
$my_query = new WP_Query(array(
    'posts_per_page' => 4,
    'post__in' => $related->uniqueposts,
    'order' => 'DESC',
    'orderby' => 'date',
    'post__not_in' => $related->exclude,
));

?>

<div class="wave-bg grid-section grid-section--recommended pt-12">
    <div class="container grid-section-label">Aanbevolen</div>
    <div class="container">
        <div class="cards-overview">
            <?php if ($my_query->have_posts()) {
                while ($my_query->have_posts()) {
                    $my_query->the_post();
                    $terms_posttypes = wp_get_post_terms($post->ID, 'posttypes', array("fields" => "all"));
                    include('card.php');
                }
            } ?>
        </div>
    </div>
    <div class="more-link__wrapper"></div>
</div>

<?php wp_reset_query(); ?>

