<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1, minimum-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NGGHZ7K');</script>
    <!-- End Google Tag Manager -->

    <meta name="wp" data-id="<?php echo $post->ID; ?>">
    <meta name="theme-color" content="#800C16">
    <meta name="msapplication-navbutton-color" content="#800C16">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/styleguide//assets/dist/img/favicon.ico"
          type="image/vnd.microsoft.icon">
    <link href="<?php echo get_template_directory_uri(); ?>/styleguide//assets/dist/img/device/apple-touch-icon.png"
          rel="apple-touch-icon"/>
    <link href="<?php echo get_template_directory_uri(); ?>/styleguide//assets/dist/img/device/icon-hires.png" rel="icon"
          sizes="192x192"/>
    <link href="<?php echo get_template_directory_uri(); ?>/styleguide//assets/dist/img/device/icon-normal.png" rel="icon"
          sizes="128x128"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NGGHZ7K"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

