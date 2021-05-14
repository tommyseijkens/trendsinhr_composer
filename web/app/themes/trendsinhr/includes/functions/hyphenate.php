<?php

/**
* Calculates length words in  strings.
*
*/
function long_word($sentence, $length) {
$words = explode(' ', $sentence);
foreach ($words as $key => $value) {
if (strlen($value) > $length) {
return TRUE;
}
}
return FALSE;
}

/**
* Hyphenate text.
*
* Add hyphens to long words width a
* length greater then 14.
*
* php-typography is included in the composer.json
* https://github.com/mundschenk-at/php-typography
*
*/
function hyphenate_text($text, $length) {
if (long_word($text, $length)) {
$settings = new \PHP_Typography\Settings();
$settings->set_hyphenation( true );
$settings->set_hyphenation_language( 'nl' );
$settings->set_min_length_hyphenation(14);
$settings->set_min_before_hyphenation(8);
$settings->set_min_after_hyphenation(4);
$settings->set_dewidow(false);
$typo = new \PHP_Typography\PHP_Typography();
$text = $typo->process( $text, $settings );
}
return $text;
}

?>