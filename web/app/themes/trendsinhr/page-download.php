<?php
/**
 * Template Name: Downloads
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */


$my_postid = 17697;//This is page id or post id
$content_post = get_post($my_postid);
$download = get_query_var('download');
$dir = '';
$name = '';

if (strpos($download, 'publicatie') !== FALSE) {
    $dir = 'publicaties';
    $name = 'publicatie';
} else {
    if (strpos($download, 'whitepaper') !== FALSE) {
        $dir = 'whitepapers';
        $name = 'whitepaper';
    }
}

?>

<?php get_header(); ?>
<?php include('includes/parts/header-top.php'); ?>
<?php include('includes/navigation/main-navigation.php'); ?>

<div class="page page--whitepapers">
    <?php wp_reset_query(); ?>

    <div class="page mb-12">

        <div class="container mt-7 mt-lg-12">
            <div class="row mb-3">
                <div class="container-content d-flex flex-row">
                    <div class="labels">
                        <div class="label">Download</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container-content the-page">
                    <h1 class="display-2">Whitepaper</h1>
                    <p>Hartelijk dank voor je aanvraag. De link naar de aanvraag ontvang je per e-mail, maar je kunt de aanvraag ook hieronder downloaden.</p>
                    <p>Mocht je nog vragen of opmerkingen hebben, neem dat gerust contact met ons op.</p>
                        <?php if (get_query_var('download') != ""): ?>
                        <a class="btn btn-color-03" target="_blank" href="https://content.driessen.nl/files/<?php echo $dir; ?>/<?php echo get_query_var('download'); ?>.pdf">Download <?php echo $name; ?></a>
                    <?php endif; ?>
                    <h2 class="pt-7">Bekijk ook onze andere whitepapers</h2>
                </div>
            </div>
        </div>

        <?php wp_reset_query(); ?>

        <?php include('includes/posts-whitepapers.php'); ?>

    </div>

    <?php
    wp_reset_query();
    get_footer();
    ?>



