<?php

$image = get_the_post_thumbnail_url(get_the_ID(), 'full');

$mediacontent = get_field('media_url');

if (strpos(strtolower($mediacontent), 'spotify')) {
  $contentAV = "spotify";
}
if (strpos(strtolower($mediacontent), 'soundcloud')) {
  $contentAV = "soundcloud";
}
if (strpos(strtolower($mediacontent), 'youtube')) {
  $contentAV = "youtube";
}
if (strpos(strtolower($mediacontent), 'vimeo')) {
  $contentAV = "vimeo";
}
?>


<div class="page page--article page--article__av">

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


              <div class="row mb-7">
                <?php
                if ($contentAV == 'youtube' || $contentAV == 'vimeo') { ?>
                    <div class="container-article-media">
                      <?php the_field('media_url'); ?>
                    </div>
                <?php } else { ?>
                    <div class="container-article-media">
                        <div class="av-embed-container--podcast">
                          <?php the_field('media_url'); ?>
                        </div>
                    </div>
                <?php } ?>
              </div>


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