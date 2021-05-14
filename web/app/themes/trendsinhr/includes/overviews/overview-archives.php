<div class="wave-bg grid-section grid-section--archives pt-12">
    <div class="container grid-section-label">
        <?php if (is_tax()) { echo 'Meer&nbsp;&nbsp;dossiers'; } else { echo 'Dossiers'; } ?>
    </div>
    <div class="container">
        <div class="cards-overview">
            <?php
            // get the terms of taxonomy_01 = Archives ~ Dossiers
            $tempimage = 'https://assets.driessengroep.nl/sampledata/trendsinhr/archivetopic.png';
            $tags = get_terms(array(
                'taxonomy' => 'taxonomy_01',  // Archives ~ Dossiers
                'hide_empty' => true,
                'number' => 4,
            ));
            if ($tags) {
                foreach($tags as $tag) {
                    $img = get_field('archive_image',$tag);
                    if (!$img) { $img = $tempimage; }
                    $title = hyphenate_text( $tag->name, 14);
                    ?>
                    <div class="card-item card-item--archive">
                        <a class="card-item__content" href="<?php echo get_term_link( $tag ); ?>" title="<?php sprintf( __( "View all posts in %s" ), $tag->name ); ?>" style="background-image: url('<?php echo $img; ?>');">
                            <div class="card-item__description">
                                <div class="d-block d-md-none labels">
                                    <span class="label card-item__label">Dossier</span>
                                </div>
                                <span class="card-item__title">
                                  <?php echo $title; ?>
                                </span>
                            </div>
                        </a>
                    </div>
                <?php }
            }
            ?>
        </div>
    </div>
    <div class="more-link__wrapper">
        <div class="more-link  more--topics"><a href="<?php echo get_site_url(); ?>/dossiers">Alle dossiers</a></div>
    </div>
</div>

