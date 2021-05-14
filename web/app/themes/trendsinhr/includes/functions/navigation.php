<?php
/***
 * Override normal wp_nav_menu output and replace with custom output.
 */
class Publications_Menu extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {

        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $class_names = 'nav-pubs__item ';
        $class_names .= implode(" ", $classes);;

        $output .= sprintf("<a class='" . $class_names . "' href='%s'%s><span class='nav-pubs__item--span'>%s</span></a>\n",
            home_url($item->url),
            '',
            $item->title
        );
    }
}

/**
 * Make menulinks relative.
 */
function wpd_nav_menu_link_atts( $atts, $item, $args, $depth ){
    if( '/' == substr( $atts['href'], 0, 1 ) ){
        $atts['href'] = get_site_url() . $atts['href'];
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'wpd_nav_menu_link_atts', 20, 4 );

?>