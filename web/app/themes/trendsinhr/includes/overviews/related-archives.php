<div class="wave-bg grid-section grid-section--archives pt-12">
    <div class="container grid-section-label">
        <?php if (is_tax()) { echo 'Meer&nbsp;&nbsp;dossiers'; } else { echo 'Dossiers'; } ?>
    </div>
    <div class="container">
        <div class="cards-overview">
            <?php
            /* first load four selected related items */

            $tempimage = 'https://assets.driessengroep.nl/sampledata/trendsinhr/archivetopic.png';
            $current_tag_id = get_queried_object()->term_id;
            $tagids[] = $current_tag_id;
            $theterm = get_queried_object();
            $tags = get_field('related_archives', $theterm);
            $i = 0;
            if ($tags) {
                foreach($tags as $tag) {
                    $i++;
                    if ($i > 4) { break; }
                    $tagids[$i] = $tag->term_id;
                    $img = get_field('archive_image',$tag);
                    if (!$img) { $img = $tempimage; }
                    ?>
                    <div class="card-item card-item--archive">
                        <a class="card-item__content" href="<?php echo get_term_link( $tag ); ?>" title="<?php sprintf( __( "View all posts in %s" ), $tag->name ); ?>" style="background-image: url('<?php echo $img; ?>');">
                            <div class="card-item__description">
                                <span class="card-item__title"><?php echo $tag->name; ?></span>
                            </div>
                        </a>
                    </div>
                <?php  }
            }
            ?>


            <?php
            /* add cards to max of 4 items */

            // get the terms of taxonomy_01 = Archives ~ Dossiers
            $tags = get_terms(array(
                'taxonomy' => 'taxonomy_01',  // Archives ~ Dossiers
                'hide_empty' => true,
                'number' => (4 - $i),
                'exclude' => $tagids,
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
        <div class="more-link  more--topics"><a href="<?php echo get_site_url(); ?>/dossiers">Alle dossiers</a></div>
    </div>
</div>

