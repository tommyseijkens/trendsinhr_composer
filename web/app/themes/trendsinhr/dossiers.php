<?php
/**
 * Template Name: Dossiers
 *
 * @package WordPress
 * @subpackage Trends in HR
 */
?>

<?php get_header(); ?>
<div class="page page--archives">
    <?php include('includes/parts/header-top.php'); ?>
    <?php include('includes/navigation/main-navigation.php'); ?>

    <div class="page-header bg-color-bg pt-7 pt-lg-12">
        <div class="container">
            <div class="row">
                <div class="container-content article-head">
                    <h1 class="display-2"><?php the_title(); ?></h1>
                    <p><?php the_content(); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="wave-bg grid-section grid-section--archives">
        <div class="container grid-section-label">Alle dossiers</div>
        <div class="container">
            <div class="cards-overview">

                <?php
                // get the terms of taxonomy_01 = Archives ~ Dossiers
                $tempimage = 'https://assets.driessengroep.nl/sampledata/trendsinhr/archivetopic.png';
                $tags = get_terms(array(
                    'taxonomy' => 'taxonomy_01',  // Archives ~ Dossiers
                    'hide_empty' => true,
                    'number' => 100,
                ));
                if ($tags) {
                    foreach($tags as $tag) {
                        $img = get_field('archive_image',$tag);
                        if (!$img) { $img = $tempimage; }
                        $title = hyphenate_text( $tag->name, 14);
                        ?>
                        <div class="card-item card-item--archive">
                            <a class="card-item__content" href="<?php echo get_term_link( $tag ); ?>" title="<?php sprintf( __( "View all posts in %s" ), $tag->name ); ?>"  style="background-image: url('<?php echo $img; ?>');">
                                <div class="card-item__description">
                                    <div class="d-block d-md-none labels">
                                        <span class="label card-item__label">Dossier</span>
                                    </div>
                                    <span class="card-item__title"><?php echo $title; ?></span>
                                </div>
                            </a>
                        </div>
                    <?php }
                }
                ?>

            </div>
        </div>
    </div>

</div>

<?php
wp_reset_query();
get_footer();
?>
