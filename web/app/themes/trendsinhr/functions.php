<?php
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set('Europe/Amsterdam');
setlocale(LC_ALL, 'nl_NL@euro', 'nl_NL');

// custom post types
get_template_part('includes/posttypes/posttypes.opleidingen');



/**
 * = Global vars
 */
function driessen_global_vars()
{
    global $driessen;
    $driessen = array(
        'random-number' => array_fill(1, 20, ""),
        'exclude-for-date' => array('publicaties', 'whitepapers'),
        'include-author' => array('nieuws', 'artikelen', 'video'),
        'include-structure' => array('publicaties', 'themas', 'whitepapers'),
        'assets-version' => get_option('version_resources'),
        'exclude-ids' => '',
        'posts_no_detail' => get_option('posts_no_detail'),
        'posts_no_detail_string' => implode(", ", get_option('posts_no_detail')),
    );
}

driessen_global_vars();

/**
 * = ACF version control files
 */
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/includes/acf-json';
    return $path;
}

function my_acf_json_load_point( $paths ) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/includes/acf-json';
    return $paths;
}

/**
 * = Register taxonomy
 */
function categories_init()
{
    register_taxonomy(
        'taxonomy_01',
        'post',
        array(
            'label' => __('Dossiers'),
            'rewrite' => array('hierarchical' => true, 'slug' => 'dossiers', 'with_front' => true),
            'query_var' => true,
            'hierarchical' => true,
            'show_in_nav_menus' => true
        )
    );
    register_taxonomy(
        'vakgebieden',
        'post',
        array(
            'label' => __('Thema\'s'),
            'rewrite' => array('hierarchical' => true, 'slug' => 'themas', 'with_front' => true),
            'query_var' => true,
            'hierarchical' => true,
            'show_in_nav_menus' => true
        )
    );
    register_taxonomy(
        'posttypes',
        'post',
        array(
            'label' => __('Berichttypes'),
            'rewrite' => false,
            //'rewrite' => array( 'hierarchical' => true, 'slug' => '%posttypes%', 'with_front' => FALSE  ),
            //'rewrite' => array( 'slug' => 'event', 'slug' => '%posttypes%', 'with_front' => false ),
            'hierarchical' => true,
            'show_in_nav_menus' => true
        )
    );
}

add_action('init', 'categories_init');


/**
 * = Remove tags support from posts
 */
function driessen_unregister_tags()
{
    unregister_taxonomy_for_object_type('post_tag', 'post');
    unregister_taxonomy_for_object_type('category', 'post');
}

add_action('init', 'driessen_unregister_tags');


/**
 * = Add options page ACF
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}



/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function driessen_excerpt_more($more)
{
    return '...';
}

add_filter('excerpt_more', 'driessen_excerpt_more');


/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function driessen_custom_excerpt_length($length)
{
    return 20;
}

add_filter('excerpt_length', 'driessen_custom_excerpt_length', 999);


/**
 * = Shortcodes
 */
add_shortcode("goud", "get_goud");
add_shortcode("columns", "get_columns");

function get_goud($atts, $content = null)
{
    return '<p class="goud">' . $content . '</p>';
}

function get_columns($atts, $content = null)
{
    extract(shortcode_atts(array(
        "aantal" => 'aantal'
    ), $atts));
    return '<div class="columns ' . $aantal . '">' . do_shortcode($content) . '</div>';
}


/**
 * = Custom styles for Tinymce
 */
function wpb_mce_buttons_2($buttons)
{
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

add_filter('mce_buttons_2', 'wpb_mce_buttons_2');


/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats($init_array)
{

// Define the style_formats array

    $style_formats = array(
        /*
        * Each array child is a format with it's own settings
        * Notice that each array has title, block, classes, and wrapper arguments
        * Title is the label which will be visible in Formats menu
        * Block defines whether it is a span, div, selector, or inline style
        * Classes allows you to define CSS classes
        * Wrapper whether or not to add a new block-level element around any selected elements
        */

        array(
            'title' => 'Buttons',
            'items' => array(
                array('title' => 'Button', 'selector' => 'a', 'classes' => 'btn'),
                array(
                    'title' => 'Kleuren',
                    'items' => array(
                        array('title' => 'Themakleur', 'selector' => 'a.btn', 'classes' => 'btn-color-03'),
                        array('title' => 'Grijs', 'selector' => 'a.btn', 'classes' => 'btn-color-04'),
                    ),
                ),
            ),
        ),
        array(
            'title' => 'Paragraaf',
            'items' => array(
                array('title' => 'Lettertype themakleur', 'selector' => 'p', 'classes' => 'text-color-theme',),
            ),
        ),
        array(
            'title' => 'Tabelstijl',
            'items' => array(
                array('title' => 'Programma', 'selector' => 'table', 'classes' => 'program'),
                array('title' => 'Statistieken', 'selector' => 'table', 'classes' => 'statistics'),
            ),
        ),
        array(
            'title' => 'Opsomming',
            'items' => array(
                array('title' => 'Lijst met links', 'selector' => 'ul', 'classes' => 'list__links'),
                array('title' => 'Lijst met vinkjes', 'selector' => 'ul', 'classes' => 'list__checklist'),
            ),
        ),
        array(
            'title' => 'Blokken',
            'items' => array(
                array('title' => 'Call to action', 'block' => 'div', 'classes' => 'cta', 'wrapper' => 'true'),
                array('title' => 'Block met links', 'block' => 'div', 'classes' => 'block--links', 'wrapper' => 'true'),
            ),
        ),


    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode($style_formats);

    return $init_array;

}

// Attach callback to 'tiny_mce_before_init'
add_filter('tiny_mce_before_init', 'my_mce_before_init_insert_formats');


/**
 * Registers an editor stylesheet for the theme.
 */
function wpdocs_theme_add_editor_styles()
{
    add_editor_style('/styleguide/assets/dist/css/editor-style.min.css');
}

add_action('admin_init', 'wpdocs_theme_add_editor_styles');


/**
 * = Update version resources
 * By visiting the dashboard the version number for
 * the stylesheet en javascript scripts wil be updated
 */
function update_version_resources()
{
    if (get_option('version_resources') || get_option('version_resources') == '') {
        update_option('version_resources', date('YmdHi'));
    } else {
        add_option('version_resources', date('YmdHi'));
    }
}

add_action('load-index.php', 'update_version_resources', 1, 0);


/**
 * = Add custom number to end of assets
 */
function driessen_default_assets($assets)
{
    // version
    $assets->default_version = get_option('version_resources');
}

add_action("wp_default_scripts", "driessen_default_assets");
add_action("wp_default_styles", "driessen_default_assets");

include('includes/functions/colors.php');

/**
 * = Add custom assets css and js
 */
function trendsinhr_theme_name_scripts()
{

    // scripts
    wp_enqueue_script('scripts-vendors', get_template_directory_uri() . '/styleguide/assets/dist/js/vendors.min.js', array('jquery'), false, true);
    wp_enqueue_script('scripts-js', get_template_directory_uri() . '/styleguide/assets/dist/js/scripts.min.js', array('jquery'), false, true);

    // styles
    wp_enqueue_style('style-wp', get_template_directory_uri() . "/style.css");
    wp_enqueue_style('style-template', get_template_directory_uri() . "/styleguide/assets/dist/css/style.min.css");

}

add_action('wp_enqueue_scripts', 'trendsinhr_theme_name_scripts');

/**
 * = Add custom assets css and js to admin pages
 */
function driessen_admin_enqueue_scripts()
{
    wp_enqueue_script('wordpress_custom', get_template_directory_uri() . '/assets/src/scripts/wordpress.js', array('jquery'), false, true);
}

add_action('admin_enqueue_scripts', 'driessen_admin_enqueue_scripts');


/**
 * = Add admin custom assets css and js
 */
function load_admin_style()
{
    wp_enqueue_style('driessen_admin_css', get_template_directory_uri() . '/assets/dist/css/admin.min.css', false, '1.0.0');
    wp_enqueue_style('driessen_admin_css');
}

add_action('admin_enqueue_scripts', 'load_admin_style');


/**
 * = Removes posttypes in URL
 */
function driessen_rewrite_basic()
{
    global $wp_rewrite;
    //$wp_rewrite->use_verbose_page_rules = true;

    // overview vakgebieden
    add_rewrite_rule('whitepapers/?$', 'index.php?posttypes=whitepapers', 'top');
    add_rewrite_rule('publicaties/?$', 'index.php?posttypes=publicaties', 'top');


    // detail vakgebieden
    add_rewrite_rule('publicaties/([^/]+)/?$', 'index.php?name=$matches[1]', 'top');
    add_rewrite_rule('publicaties/([^/]+)/amp(/(.*))?/?$', 'index.php?name=$matches[1]&amp=$matches[3]', 'top');
    add_rewrite_rule('whitepapers/([^/]+)/?$', 'index.php?name=$matches[1]', 'top');
    add_rewrite_rule('whitepapers/([^/]+)/amp(/(.*))?/?$', 'index.php?name=$matches[1]&amp=$matches[3]', 'top');

    add_rewrite_rule('download/([^/]+)/?$', 'index.php?download=$matches[1]', 'top');

    // vakgebieden
    $vakgebieden = array('hrm', 'management', 'salarisadministratie');
    foreach ($vakgebieden as &$value) {
        add_rewrite_rule($value . '/([^/]+)/page/([0-9]+)/?$', 'index.php?taxonomy=vakgebieden&term=$matches[1]&paged=$matches[2]', 'top');
        add_rewrite_rule($value . '/page/([0-9]+)/?$', 'index.php?taxonomy=vakgebieden&term=' . $value . '&paged=$matches[1]', 'top');
        add_rewrite_rule($value . '/([^/]+)/?$', 'index.php?taxonomy=vakgebieden&term=$matches[1]', 'top');
        add_rewrite_rule($value . '/?$', 'index.php?taxonomy=vakgebieden&term=' . $value . '', 'top');
    }

    // author
    $wp_rewrite->author_base = 'auteur';
    $wp_rewrite->author_structure = '/' . $wp_rewrite->author_base . '/%author%';
}

add_action('init', 'driessen_rewrite_basic');


/**
 * = Set query vars
 */
function add_query_vars_filter($vars)
{
    $vars[] = "download";
    return $vars;
}

add_filter('query_vars', 'add_query_vars_filter');


/**
 * = Set template based on query vars
 */
function prefix_url_rewrite_templates()
{

    if (get_query_var('download')) {
        add_filter('template_include', function () {
            return get_template_directory() . '/page-download.php';
        });
    }
}

add_action('template_redirect', 'prefix_url_rewrite_templates');


/**
 * = Remove vakgebieden from url
 */
add_filter('term_link', 'term_link_filter', 10, 3);
function term_link_filter($url, $term, $taxonomy)
{

    $url = $url;
    if ($taxonomy == "vakgebieden") {
        $url = str_replace('vakgebieden/', '', $url);
        return $url;
    }
    return $url;
}


/**
 * = Replace postname with term + postname
 */
function theme_show_permalinks($post_link, $post)
{

    if (is_object($post) && $post->post_type == 'post') {

        $terms = wp_get_object_terms($post->ID, 'posttypes');
        if ($terms && in_array($terms[0]->slug, $GLOBALS['driessen']['include-structure'])) {
            return str_replace('%postname%', $terms[0]->slug . "/" . '%postname%', $post_link);
        }
    }
    return $post_link;
}

add_filter('pre_post_link', 'theme_show_permalinks', 10, 3);


/**
 * = Add custom columns to admin post overview
 */
add_filter('manage_post_posts_columns', 'columns_head', 10);
add_action('manage_post_posts_custom_column', 'columns_content', 10, 2);

function columns_head($defaults)
{
    $defaults['first_column'] = 'Thema en onderwerpen';
    $defaults['taxonomy_01'] = 'Dossiers';
    $defaults['berichttype'] = 'Berichttype';
    unset($defaults['categories'], $defaults['tags']);
    return $defaults;
}

function columns_content($column_name, $post_ID)
{
    if ($column_name == 'first_column') {
        $term_list = wp_get_post_terms($post_ID, 'vakgebieden');
        foreach ($term_list as $term_single) {
            echo $term_single->name . " "; //do something here
        }
    }
    if ($column_name == 'taxonomy_01') {
        $term_list = wp_get_post_terms($post_ID, 'taxonomy_01');
        foreach ($term_list as $term_single) {
            echo $term_single->name . " "; //do something here
        }
    }

    if ($column_name == 'berichttype') {
        $term_list = wp_get_post_terms($post_ID, 'posttypes');
        foreach ($term_list as $term_single) {
            echo $term_single->name; //do something here
        }
    }
}


/**
 * = Add custom post links (top) to admin post overview
 */
add_filter('views_edit-post', 'add_custom_post_links');
function add_custom_post_links($views)
{
    $views['artikel'] = sprintf(__('<a href="%s">Artikelen</a>'), admin_url('edit.php?posttypes=artikel'));
    $views['nieuws'] = sprintf(__('<a href="%s">Nieuws</a>'), admin_url('edit.php?posttypes=nieuws'));
    $views['thema'] = sprintf(__('<a href="%s">Themas</a>'), admin_url('edit.php?posttypes=thema'));
    $views['publicaties'] = sprintf(__('<a href="%s">Publicaties</a>'), admin_url('edit.php?posttypes=publicaties'));
    $views['whitepapers'] = sprintf(__('<a href="%s">Whitepapers</a>'), admin_url('edit.php?posttypes=whitepapers'));
    $views['interview'] = sprintf(__('<a href="%s">Interviews</a>'), admin_url('edit.php?posttypes=interview'));
    $views['video'] = sprintf(__('<a href="%s">Videos</a>'), admin_url('edit.php?posttypes=video'));
    return $views;

}


/**
 * = Main post query changes
 */
function wpse120407_pre_get_posts($query)
{

    // only main query and not admin
    if ($query->is_main_query() && !is_admin()) {

        $query->set('posts_per_page', 12);

        if (is_tax('posttypes', 'whitepapers') || is_tax('posttypes', 'themas') || is_tax('posttypes', 'publicaties')) {
            $query->set('posts_per_page', -1);
            return;
        }

        if (is_archive() && !is_paged() && !is_author()) {
            $query->set('posts_per_page', 12);
            $query->set('ignore_sticky_posts', 1);
        }

        if (is_archive()) {
            $query->set('posts_per_page', 8);
            $query->set('ignore_sticky_posts', 1);
        }

        if (is_author()) {
            $query->set('posts_per_page', 9);
            $query->set('ignore_sticky_posts', 1);
        }

    }

}

add_action('pre_get_posts', 'wpse120407_pre_get_posts', 10, 1);


/**
 * = Set email template
 */
function get_custom_mail($atts)
{

    $template = file_get_contents(dirname(__FILE__) . '/email/template-header.php');
    if (strpos($atts["subject"], 'INTERN') !== false) {
        $template .= file_get_contents(dirname(__FILE__) . '/email/template-clean.php');
    } else {
        $template .= file_get_contents(dirname(__FILE__) . '/email/template.php');
    }
    $template .= file_get_contents(dirname(__FILE__) . '/email/template-footer.php');

    // replace content
    $message = $atts["message"];
    $subject = $atts["subject"];
    $message = preg_replace('/\<http(.*)\>/', '<a href="http$1">http$1</a>', $message);
    $message = nl2br($message);
    $messageAll = str_replace("[content]", $message, $template);
    $messageAll = str_replace("[title]", $subject, $messageAll);
    $atts["message"] = $messageAll;

    // set headers
    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: Driessen Groep <info@driessengroep.nl>');
    $atts["headers"] = $headers;
    return $atts;
}

add_filter("wp_mail", "get_custom_mail");


function get_sections($atts, $content = null)
{
    extract(shortcode_atts(array(
        "id" => 'id',
        "titel" => 'titel'
    ), $atts));
    return '<div class="section" id="' . $id . '" titel="' . $titel . '">' . do_shortcode($content) . '</div>';
}

add_shortcode("section", "get_sections");


function get_subsections($atts, $content = null)
{
    extract(shortcode_atts(array(
        "id" => 'id'
    ), $atts));
    return '<div class="section" id="' . $id . '" titel="' . $titel . '">' . do_shortcode($content) . '</div>';
}

add_shortcode("subsection", "get_sections");

function get_blocklinks($atts, $content = null)
{
    extract(shortcode_atts(array(
        "id" => 'id'
    ), $atts));
    return '<div class="block--links">' . do_shortcode($content) . '</div>';
}

add_shortcode("block-links", "get_blocklinks");


function get_popup($atts, $content = null)
{
    extract(shortcode_atts(array(
        "timeout" => 10000,
        "formid" => 0,
        "cookie" => true,
        "cookietime" => 30
    ), $atts));
    $timeout = $timeout * 1000;
    return '<div class="form-popup white-popup-block mfp-hide" data-timeout="' . $timeout . '" data-cookie="' . $cookie . '" data-cookietime="' . $cookietime . '" >' . do_shortcode('[ninja_form id=' . $formid . ']') . '<button title="Close (Esc)" type="button" class="mfp-close">×</button></div>';
}

add_shortcode("formulierpopup", "get_popup");


function get_linkform($atts, $content = null)
{
    extract(shortcode_atts(array(
        "formid" => 0,
    ), $atts));
    return '<a class="popup-modal download" href="#modal' . $formid . '">' . do_shortcode($content) . '</a><div id="modal' . $formid . '" class="link-form white-popup-block mfp-hide">' . do_shortcode('[ninja_form id=' . $formid . ']') . '<button title="Close (Esc)" type="button" class="mfp-close">×</button></div>';
}

add_shortcode("linkform", "get_linkform");


/**
 * = Get children terms from parent
 */
function get_all_terms($term_id = NULL)
{
    $terms = new stdClass;
    if ($term_id) {
        $terms->id = $term_id;
    } else {
        $terms->id = get_queried_object()->term_id;
    }
    $terms->parent = get_ancestors($terms->id, 'vakgebieden');
    if ($terms->parent) {
        $terms->id = $terms->parent[0];
    }
    $terms = get_terms('vakgebieden', array('child_of' => $terms->id, 'orderby' => 'slug', 'order' => 'DESC'));
    return $terms;
}


/**
 * Custom template directory for our AMP pages
 */
function lc_custom_amp_templates()
{
    return get_template_directory() . '/amp-templates';
}

add_filter('amp_post_template_dir', 'lc_custom_amp_templates');


/**
 * Register AMP Menu
 *
 */
function ea_register_amp_menu()
{
    register_nav_menu('amp-header', 'AMP Header');
}

add_action('after_setup_theme', 'ea_register_amp_menu');

/**
 * Exclude posttypes AMP
 *
 */
add_filter('amp_post_status_default_enabled', function ($default, $post) {
    $termList = wp_get_post_terms($post->ID, 'posttypes', array("fields" => "all"));
    $exclude = array('publicaties', 'whitepapers', 'events');

    if (in_array($termList[0]->slug, $exclude)) {
        $default = false;
    }
    return $default;

}, 10, 2);

/**
 * fix to remove og:url - > og:url was added with domain name only after updating yoast
 *
 */
add_filter('wpseo_opengraph_url', '__return_false');


/***
 * Override outgoing e-mail messages if in development environment.
 * Send messages to pre-defined e-mail addresses for testing.
 */
if (strtolower(gethostname()) != 'web01') {
    add_filter('wp_mail', 'override_mail_recipient');

    function override_mail_recipient($args)
    {
        $to = $args['to'];
        $html = $args['html'];
        $subject = $args['subject'];
        $message = $args['message'];

        $subject = '[REROUTED] ' . $subject;
        $to = 'catchmail@driessen.onmicrosoft.com';

        $new_wp_mail = array('to' => $to, 'subject' => $subject, 'message' => $message, 'html' => $html, 'headers' => $args['headers'], 'attachments' => $args['attachments'],);
        return $new_wp_mail;
    }
}

add_filter('rest_endpoints', function ($endpoints) {
    if (isset($endpoints['/wp/v2/users'])) {
        unset($endpoints['/wp/v2/users']);
    }
    if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
        unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
});

function meks_disable_srcset($sources)
{
    return false;
}

add_filter('wp_calculate_image_srcset', 'meks_disable_srcset');


/**
 * = Set image sizes
 */
add_theme_support('post-thumbnails', array('post', 'page', 'opleiding'));

include('includes/functions/navigation.php');
include('includes/functions/loadmore.php');
include('includes/functions/content.php');
include('includes/functions/hyphenate.php');
include('includes/functions/readingtime.php');
include('includes/functions/insertposts.php');


function hyphenate_the_title( $title, $id = null ) {
  $title = str_replace("&#8217;","'", $title);
  $title = hyphenate_text($title, 14);
  return $title;
}
add_filter( 'the_title', 'hyphenate_the_title' );






