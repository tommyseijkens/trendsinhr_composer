<?php
/**
 * Get first <p> of content (intro)
 */
function get_first_paragraph()
{
    $str = wpautop(get_the_content());
    $str = substr($str, 0, strpos($str, '</p>') + 4);
    $str = strip_tags($str, '<a><strong><em>');
    return '<p>' . $str . '</p>';
}

/**
 * Strip first <p> of content (intro)
 */
function strip_first_paragraph()
{
    $str = wpautop(get_the_content());
    // execute shortcodes
    $str = apply_filters('the_content', $str);
    $str = preg_replace('~<p>.*?</p>~s', '', $str, 1);
    return $str;
}

?>