<?php

/**
 * Insert highlighted items in query on specific position
 */
function insert_post($posts)
{
    global $feautured_posts;
    global $insert_feautured;
    $feautured_post_1 = $feautured_posts[0];
    $feautured_post_2 = $feautured_posts[1];
    $feautured_post_3 = $feautured_posts[2];
    if (is_main_query() && is_home() && 0 == get_query_var('paged') && $insert_feautured == true) {

        $insert_at = 1; /* is 3rd item */
        $post_insert = new WP_Query(array('p' => $feautured_post_1, 'suppress_filters' => true));
        array_splice($posts, $insert_at, 0, $post_insert->posts);

        $insert_at = 4; /* is 6th item */
        $post_insert = new WP_Query(array('p' => $feautured_post_2, 'suppress_filters' => true));
        array_splice($posts, $insert_at, 0, $post_insert->posts);

        $insert_at = 13; /* is 11th item */
        $post_insert = new WP_Query(array('p' => $feautured_post_3, 'suppress_filters' => true));
        array_splice($posts, $insert_at, 0, $post_insert->posts);

    }
    return $posts;
}

add_filter('posts_results', 'insert_post');

?>