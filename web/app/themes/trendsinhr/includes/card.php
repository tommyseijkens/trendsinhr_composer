<?php

// vakgebieden = thema's = topics
$terms_vakgebieden = get_the_terms(get_the_ID(), 'vakgebieden');
$terms_posttypes = wp_get_post_terms(get_the_ID(), 'posttypes', array("fields" => "all"));
$cardAdded = false;

if (($terms_posttypes[0]->name) == 'Artikel') {
    include('cards/card-article.php');
    $cardAdded = true;
}

if (($terms_posttypes[0]->name) == 'Column') {
    include('cards/card-column.php');
    $cardAdded = true;
}

if (($terms_posttypes[0]->name) == 'Interview') {
    include('cards/card-interview.php');
    $cardAdded = true;
}

if (($terms_posttypes[0]->name) == 'Whitepaper' || ($terms_posttypes[0]->name) == 'Whitepapers') {
    include('cards/card-whitepaper.php');
    $cardAdded = true;
}

// if posttype is not set, use article template as card
if (!$cardAdded) {
    include('cards/card-article.php');
}

?>