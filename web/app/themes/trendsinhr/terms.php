<?php
/**
 * Template Name: Termen
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php get_header(); ?>
<div class="page page--topics">
    <?php include('includes/parts/header-top.php'); ?>
    <?php include('includes/navigation/main-navigation.php'); ?>

    <div class="page--topics">
        <div class="page-header bg-color-bg pt-7 pt-lg-12">
            <div class="container">
                <div class="row">
                    <div class="container-content article-head">
                        <h1 class="display-2"><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="wave-bg grid-section grid-section--topics">
            <div class="container grid-section-label">Populair</div>
            <div class="container">
                <div class="cards-overview">

                    <?php
                    // get the terms of vakgebieden = thema's = topics
                    $tempimage = 'https://assets.driessengroep.nl/sampledata/trendsinhr/archivetopic.png';
                    $tags = get_terms(array(
                        'taxonomy' => 'vakgebieden',
                        'hide_empty' => false,
                        'number' => 8,
                    ));
                    if ($tags) {
                        foreach($tags as $tag) {
                            $img = get_field('topic_image',$tag);
                            if (!$img) { $img = $tempimage; }
                            $title = hyphenate_text( $tag->name, 14);
                            ?>
                            <div class="card-item card-item--topic">
                                <a class="card-item__content" href="<?php echo get_term_link( $tag ); ?>" title="<?php sprintf( __( "View all posts in %s" ), $tag->name ); ?>" style="background-image: url('<?php echo $img; ?>');">
                                    <div class="card-item__description">
                                        <div class="d-block d-md-none labels">
                                            <span class="label card-item__label">Thema</span>
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
            <div class="more-link__wrapper">
                <div class="more-link  more--topics"><a href="#alpha-index">Alle thema's</a></div>
            </div>
        </div>
    </div>

    <div id="alpha-index">
        <div class="container grid-section-label d-none d-md-block">Alle thema's</div>
        <div class="container mb-12">
            <div class="row">
                <div class="container-content">
                    <ul class="alpha-index">

                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'vakgebieden',
                            'exclude' => array(703, 2596, 712, 477, 709, 478, 708, 710, 685, 700),
                        ));
                        $terms = wp_list_sort($terms, 'name');

                        if (!empty($terms) && !is_wp_error($terms)):
                            $term_list = [];
                            foreach ($terms as $term) {
                                $first_letter = strtoupper($term->name[0]);
                                $term_list[$first_letter][] = $term;
                            }
                            unset($term);
                            ?>

                                <?php foreach ($term_list as $key => $value): ?>
                                    <ul>
                                        <li><?php echo $key; ?></li>
                                        <li>
                                            <ul>
                                            <?php foreach ($value as $term): ?>
                                                <?php
                                                $link = get_term_link($term);
                                                $title = $term->name;
                                                ?>
                                                <li>
                                                    <a href="<?php echo $link; ?>" title="<?php echo $title; ?>">
                                                        <?php echo $title; ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    </ul>
                                <?php endforeach; ?>

                        <?php endif; ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    wp_reset_query();
    get_footer();
    ?>
