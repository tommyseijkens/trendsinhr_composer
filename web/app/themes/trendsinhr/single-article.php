<?php

$image = get_the_post_thumbnail_url(get_the_ID(), 'full');

?>



<div class="page page--article">

    <div class="article">
        <div class="container mt-7 mt-lg-12">

            <div class="row mb-3">
                <div class="container-content d-flex flex-row">
                    <?php include('includes/parts/labels.php'); ?>
                </div>
            </div>

            <div class="row">
                <div class="container-content the-content article-head">
                    <h1 class="display-2"><?php echo the_title(); ?></h1>
                    <?php echo get_first_paragraph(); ?>
                </div>
            </div>

            <?php
            $illustration = get_field('illustration');
            $color = getThemeColor();
            if ($illustration) {
                ?>
                <div class="row mb-7">
                    <div class="container-article-media article-illustration">
                        <div class="article-image__container <?php echo $color; ?>" style="background-image: url('<?php echo $image; ?>');"></div>
                    </div>
                </div>
            <?php } else {
                if (get_the_post_thumbnail_url(get_the_ID(), 'full')) { ?>
                <div class="row mb-7">
                    <div class="container-article-media article-image">
                        <div class="article-image__container" style="background-image: url('<?php echo $image; ?>');"></div>
                    </div>
                </div>
            <?php }
            } ?>


            <div class="row">
                <div class="container-content">
                    <?php echo strip_first_paragraph(); ?>
                </div>
            </div>

            <div class="row mb-7">
                <div class="container-content">
                    <?php include('includes/post-share.php'); ?>
                </div>
            </div>

            <?php include('includes/post-author.php'); ?>

        </div>
    </div>

</div>