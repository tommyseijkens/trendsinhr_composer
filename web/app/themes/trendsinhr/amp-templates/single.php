<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string($this->get('html_tag_attributes')); ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <title><?php the_title(); ?> | Trends in HR</title>
  <?php do_action('amp_post_template_head', $this); ?>

    <link rel='stylesheet' id='style-wp-css'
          href='<?php echo get_site_url() . '/wp-content/themes/trendsinhr/styleguide/assets/dist/css/style.min.css' ?>'
          type='text/css' media='all'/>
    <link rel="shortcut icon" href="https://www.trendsinhr.nl/wp-content/themes/trendsinhr/styleguide//assets/dist/img/favicon.ico"
          type="image/vnd.microsoft.icon">
</head>

<body class="single single-post <?php echo esc_attr($this->get('body_class')); ?>">
<amp-analytics config="https://www.googletagmanager.com/amp.json?id=GTM-MP3DPMW&gtm.url=SOURCE_URL"
               data-credentials="include"></amp-analytics>

<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="container-content">
                <div class="amp-header">
                    <div>
                        <a href="<?php echo get_site_url(); ?>" target="_self" class="header-top__logo"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border-bottom w-100 pt-3"></div>
    <div class="container">
        <div class="row">
            <div class="container-content">
                <div class="amp-menu">
                    <div class="amp-hamburger__icon">
                        <div>&#9776;</div>
                    </div>
                    <nav class="amp-nav">
                      <?php
                      wp_nav_menu(['menu' => 'Mobiel', 'container' => 'false', 'depth' => 1]);
                      ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$image = get_the_post_thumbnail_url(get_the_ID(), 'full');
$color = getThemeColor();
$illustration = get_field('illustration');
if ($illustration) {
  $color = getThemeColor();
}
$term_list = wp_get_post_terms(get_the_ID(), 'posttypes', ["fields" => "all"]);
$posttypeName = $term_list[0]->name;

if ($posttypeName == 'Video' || $posttypeName == 'Podcast') {
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
}
?>

<div class="page page--article page--article__amp">

    <div class="article">
        <div class="container mt-7 mt-lg-12">

            <div class="row mb-3">
                <div class="container-content d-flex flex-row">
                  <?php include(dirname(__FILE__) . '/../includes/parts/labels.php'); ?>
                </div>
            </div>

            <div class="row">
                <div class="container-content article-head">
                    <h1 class="display-2"><?php echo the_title(); ?></h1>
                  <?php echo get_first_paragraph(); ?>
                </div>
            </div>

          <?php if ($posttypeName != 'Video' && $posttypeName != 'Podcast') {
            if ($illustration) {
              ?>
                <div class="row mb-7">
                    <div class="container-content article-illustration">
                        <div class="article-image__container <?php echo $color; ?>"
                             style="background-image: url('<?php echo $image; ?>');"></div>
                    </div>
                </div>
            <?php }
            else {
              if (get_the_post_thumbnail_url(get_the_ID(), 'full')) { ?>
                  <div class="row mb-7">
                      <div class="container-content article-image">
                          <div class="article-image__container"
                               style="background-image: url('<?php echo $image; ?>');"></div>
                      </div>
                  </div>
              <?php }
            }

          }
          else { ?>
                <div class="row mb-7">
                  <?php
                  if ($contentAV == 'youtube' || $contentAV == 'vimeo') { ?>
                      <div class="container-content">
                        <?php the_field('media_url'); ?>
                      </div>
                  <?php } else { ?>
                      <div class="container-content">
                          <div class="av-embed-container--podcast">
                            <?php the_field('media_url'); ?>
                          </div>
                      </div>
                  <?php } ?>
                </div>
            <?php } ?>

            <div class="row">
                <div class="container-content">
                  <?php echo strip_first_paragraph(); ?>
                </div>
            </div>

          <?php include(dirname(__FILE__) . '/../includes/post-author.php'); ?>

        </div>
    </div>


    <!-- RELATED -->

  <?php include(dirname(__FILE__) . '/../includes/post-related-amp.php'); ?>

    <div class="container p-5">
        <div class="row">
            <div class="col-12 col-lg-8 col-xl-6 m-auto p-0">
                <div>Trends in HR is een initiatief van <a target="_blank" href="https://www.driessengroep.nl">Driessen Groep</a></div>
            </div>
        </div>
    </div>

</div>

</body>

</html>
