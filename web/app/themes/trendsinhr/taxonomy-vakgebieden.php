<?php
$term = get_queried_object();
$children = get_terms($term->taxonomy, array('parent' => $term->term_id, 'hide_empty' => false));
$termSlug = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
?>

<?php get_header(); ?>
<?php include('includes/parts/header-top.php'); ?>
<?php include('includes/navigation/main-navigation.php'); ?>

<div class="page page--topic">
    <?php wp_reset_query(); ?>

    <div class="page">

        <div class="container mt-7 mt-lg-12">
            <div class="row mb-3">
                <div class="container-content d-flex flex-row">
                    <div class="labels">
                        <div class="label">Thema</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container-content the-page">
                    <h1 class="display-2"><?php single_term_title(); ?></h1>
                    <?php echo term_description(); ?>
                </div>
            </div>
        </div>

        <?php wp_reset_query(); ?>

        <?php include('includes/posts-topic.php'); ?>
        <?php //include('includes/overviews/overview-topics.php'); ?>
        <?php include('includes/overviews/related-topics.php'); ?>

    </div>

    <?php
    wp_reset_query();
    get_footer();
    ?>




