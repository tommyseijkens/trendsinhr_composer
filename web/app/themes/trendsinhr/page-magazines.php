<?php
/**
 * Template Name: Overzicht - Magazines
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
$i = 0;
?>

<?php
$term = get_queried_object();
$children = get_terms($term->taxonomy, array('parent' => $term->term_id, 'hide_empty' => false));
$termSlug = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
?>

<?php get_header(); ?>
<?php include('includes/parts/header-top.php'); ?>
<?php include('includes/navigation/main-navigation.php'); ?>

    <div class="page page--whitepaper">
        <?php wp_reset_query(); ?>

        <div class="page">

            <div class="container mt-7 mt-lg-12">
                <div class="row mb-3">
                    <div class="container-content d-flex flex-row">
                        <div class="labels">
                            <div class="label">Uitgave</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container-content the-page">
                        <h1 class="display-2"><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

            <?php wp_reset_query(); ?>

            <div class="page--whitepapers">
                <div class="container grid-section-label d-none d-md-block">Magazines</div>
                <div class="container">
                    <div class="list-overview list-overview--whitepapers">
                        <div class="row mt-7">
                            <div class="col-12 col-lg-8 col-xl-6 m-auto">
                                <div class="grid-overview">

                                    <?php while (have_posts()): the_post(); ?>
                                        <?php if (have_rows('magazine')):
                                            while (have_rows('magazine')) : the_row();
                                                $i++; ?>

                                                <?php if (get_sub_field('afbeelding')): ?>
                                                    <?php $image = get_sub_field('afbeelding'); ?>
                                                <?php endif; ?>

                                                <div class="card-item card-item--whitepaper">
                                                    <a class="card-item__content" href="<?php echo get_sub_field('link'); ?>">
                                                        <div class="card-item__background">
                                                            <div class="card-item__background--image" style="background-image: url('<?php echo $image['url']; ?>');"></div>
                                                        </div>
                                                        <div class="card-item__description">
                                                            <div class="labels">
                                                                <span class="label card-item__label">Magazine</span>
                                                            </div>
                                                            <span class="card-item__title"><?php the_sub_field('titel'); ?></span>
                                                            <p class="mb-0"><?php the_sub_field('omschrijving'); ?></p>
                                                        </div>
                                                    </a>
                                                </div>

                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    <?php endwhile; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="more-link__wrapper">
                    <?php
                    // don't display the button if there are not enough posts
                    if ($wp_query->max_num_pages > 1)
                        echo '<div class="more-link grid-overview__more loadmore">Laad meer magazines</div>'; // you can use <a> as well
                    ?>
                </div>
            </div>

        </div>
    </div>

        <?php
        wp_reset_query();
        get_footer();
        ?>










