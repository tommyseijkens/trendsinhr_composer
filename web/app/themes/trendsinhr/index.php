<?php wp_reset_postdata(); ?>
<?php get_header(); ?>
    <div class="page page--home">

        <?php include('includes/parts/header-top.php'); ?>
        <?php include('includes/navigation/main-navigation.php'); ?>
        <?php include('includes/posts-list.php'); ?>
        <?php include('includes/events/events-list.php'); ?>
        <?php include('includes/overviews/overview-archives.php'); ?>
        <?php include('includes/overviews/overview-topics.php'); ?>

    </div>
<?php
wp_reset_query();
get_footer();
?>