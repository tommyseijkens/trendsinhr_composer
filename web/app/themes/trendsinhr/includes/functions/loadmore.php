<?php
/**
 * Load more articles AJAX routine
 */
function load_more_scripts()
{
    global $wp_query;
    wp_register_script('loadmore', false, array('jquery'), true, true );

    // now the most interesting part
    // we have to pass parameters to loadmore.js script but we can get the parameters values only in PHP
    // you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
    wp_localize_script('loadmore', 'loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
        'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
        'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages
    ));
    wp_enqueue_script('loadmore');
}
add_action('wp_enqueue_scripts', 'load_more_scripts');

function loadmore_avoid_double()
{
    $feautured_posts = get_field('featured_posts', 'option');

    // check how many articles were originally on the first page but were replaced on first load
    $args = array(
        'posts_per_page' => 10,
        'post__not_in' => array($spotlight_post->ID),
        'no_found_rows' => true,
        'paged' => false,
    );

    $check_query = new WP_Query($args);

    $doubleposts = 0;
    while ($check_query->have_posts()): $check_query->the_post();
        $currentID = get_the_ID();
        if (in_array($currentID, $feautured_posts)) {
            $doubleposts++;
        }
    endwhile;
    return $doubleposts;
}


function loadmore_ajax_handler()
{
    $doubleposts = loadmore_avoid_double();
    $spotlight_post = get_field('highlightedpost', 'option');
    $feautured_posts = get_field('featured_posts','option');
    $args = json_decode(stripslashes($_POST['query']), true);
    $args['paged'] = $_POST['page'] + 1; /* load the next page */
    $args['post_status'] = 'publish';
    /* number of items to load on loadmore */
    $args['posts_per_page'] = 12;
    if ($args['paged'] == 2) {
        /* offset items on first loadmore */
        $args['offset'] = 7 + $doubleposts;
    } else {
        $args['offset'] = (7 + $doubleposts) + (($args['paged']-2) * $args['posts_per_page']);
    }
    $args['post__not_in'] = array($spotlight_post->ID, $feautured_posts[0], $feautured_posts[1], $feautured_posts[2]);

    query_posts($args);

    if (have_posts()) :
        while (have_posts()): the_post();
            get_template_part('includes/card');
        endwhile;
    endif;
    die;
}
add_action('wp_ajax_loadmore', 'loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'loadmore_ajax_handler'); // wp_ajax_nopriv_{action}
?>