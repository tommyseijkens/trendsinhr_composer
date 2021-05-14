<?php
/**
 * Template Name: Events
 *
 */
?>

<?php get_header(); ?>
<?php include('includes/parts/header-top.php'); ?>
<?php include('includes/navigation/main-navigation.php'); ?>

<div class="page page--events">

    <div class="page">

        <div class="container mt-7 mt-lg-12">
            <div class="row">
                <div class="container-content the-page">
                    <h1 class="display-2">Events</h1>
                    <?php echo the_content(); ?>
                </div>
            </div>
        </div>

        <div class="page--events">
            <div class="mb-12 mt-7">
                <?php echo do_shortcode('[upnext_events]'); ?>
            </div>
        </div>

    </div>

</div>

<?php
wp_reset_query();
get_footer();
?>




