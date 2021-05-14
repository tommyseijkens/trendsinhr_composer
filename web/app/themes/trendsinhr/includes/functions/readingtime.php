<?php
/**
 * Calculate reading time.
 */
function read_time($content)
{
    $word = str_word_count(strip_tags($content));
    $minutes = ceil($word / 200);
    return $minutes;
}
?>