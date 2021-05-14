<?php
/**
 * Template Name: Nieuwsbrief
 *
 */
?>

<?php get_header(); ?>
<?php include('includes/parts/header-top.php'); ?>
<?php include('includes/navigation/main-navigation.php'); ?>

<div class="page page--newsletters">

    <div class="page">

        <div class="container my-7 my-lg-12">
            <div class="row">
                <div class="container-content the-page">
                    <h1 class="display-2"> <?php echo the_title(); ?></h1>
                    <?php echo the_content(); ?>
                </div>
            </div>
        </div>

    </div>

</div>

<?php
wp_reset_query();
get_footer();
?>




