<?php get_header(); ?>
<?php include('includes/parts/header-top.php'); ?>

<?php include('includes/navigation/main-navigation.php'); ?>
<?php while (have_posts()) {
    the_post();

    $term_list = wp_get_post_terms($post->ID, 'posttypes', array("fields" => "all"));
    $posttypeName = $term_list[0]->name;

    ?>

    <?php if ($posttypeName == 'Artikel') : include('single-article.php'); endif; ?>
    <?php if ($posttypeName == 'Interview') : include('single-article.php'); endif; ?>
    <?php if ($posttypeName == 'Column') : include('single-column.php'); endif; ?>
    <?php if ($posttypeName == 'Whitepapers') : include('single-whitepaper.php'); $nosubscriber = true; endif; ?>
    <?php if ($posttypeName == 'Publicaties') : include('single-publicatie.php'); endif; ?>
    <?php if ($posttypeName == 'Video') : include('single-av.php'); endif; ?>
    <?php if ($posttypeName == 'Podcast') : include('single-av.php'); endif; ?>

    <?php if ($posttypeName == '') {  ?>
        <div class="row my-12">
            <div class="container-content">
                <div class="alert alert-warning" role="alert">
                    <h1 class="display-3 pt-7">Probleem voorbeeldweergave</h1>
                    <p>Er is nog geen berichttype geselecteerd, hierdoor kan er geen correcte voorbeeldweergave worden getoond. Selecteer een berichttype en probeer het opnieuw.</p>
                </div>
            </div>
        </div>
        <?php } ?>

<?php } ?>

<?php if ($posttypeName <> 'Whitepapers') : include('includes/post-related.php'); endif; ?>


<?php
wp_reset_query();
get_footer();
?>