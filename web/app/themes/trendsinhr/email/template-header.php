



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no;address=no;email=no;date=no">
    <title></title>

    <link rel="stylesheet" href="https://use.typekit.net/.css">


    <!-- CSS Reset -->
    <style>


        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            color: #1d1d1d;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for iOS meddling in triggered links. */
        *[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
        }

        /* What it does: A work-around for Gmail meddling in triggered links. */
        .x-gmail-data-detectors,
        .x-gmail-data-detectors *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
        }

        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display:none !important;
        }

        /* What it does: Prevents underlining the button text in Windows 10 */
        .button-link {
            text-decoration: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */
        /* Thanks to Eric Lepetit @ericlepetitsf) for help troubleshooting */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
            .email-container {
                min-width: 375px !important;
            }
        }


        /* Basics */
        body {
            margin: 0;
            padding: 0;
            min-width: 100%;
            /*background-color: #ffffff;*/
            width: 100% !important;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
            font-family: roboto, arial, sans-serif;
            font-weight: normal;
            font-size: 16px;
            letter-spacing: initial;
            line-height: 23px;
        }
        .ReadMsgBody {
            width: 100%;
        }
        .ExternalClass {
            width: 100%;
        }
        .ExternalClass * {
            line-height: 100%;
        }


        body, table, td {
            font-family: roboto, arial, sans-serif !important;
        }

        table {
            border-spacing: 0;
            font-family: roboto, arial, sans-serif;
            color: #1d1d1d;
        }
        td {
            padding: 0;
            border-collapse: collapse;
        }
        table.altTable tr:nth-child(even) {
            background-color: #ffffff;
            border-collapse: seperate !important;
        }
        table.altTable td { padding: 10px; }

        table.altTable td p { padding: 0 !important; margin: 0 !important; }

        table.altTableAgenda td { padding: 5px 0 5px 0 !important; }

        img {
            border: 0;
        }

        .wrapper {
            width: 100% !important;
            table-layout: fixed;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        .webkit {
            max-width: 660px;
        }
        .outer {
            margin: 0 auto;
            width: 100%;
            max-width: 660px;
        }
        .inner {
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 0px;
            padding-bottom: 0px;
        }
        .contents {
            width: 100%;
        }
        p {
            margin: 0;
        }
        a {
            color: #9bbc97;
            text-decoration: underline;
        }
        a:hover {
            color: #9bbc97;
            text-decoration: underline;
        }
        a:visited {
            color: #9bbc97;
            text-decoration: underline;
        }
        a.tel,
        a.mailto,
        a.tel:hover,
        a.mailto:hover,
        a.tel:visited,
        a.mailto:visited
        {
            color: #1d1d1d;
            text-decoration: none;
        }

        .h1 {
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 18px;
        }
        .h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 12px;
        }
        .full-width-image img {
            width: 100%;
            max-width: 640px;
            height: auto;
        }

        /* One column layout */
        .one-column .contents {
            /* text-align: left; */
        }
        .one-column p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        /*Two column layout*/
        .two-column {
            text-align: center;
            font-size: 0;
        }
        .two-column .column {
            width: 100%;
            max-width: 330px;
            display: inline-block;
            vertical-align: top;
        }
        .two-column .contents {
            font-size: 14px;
            text-align: left;
        }
        .two-column img {
            width: 100%;
            max-width: 320px;
            height: auto;
        }
        .two-column .text {
            padding-top: 10px;
        }

        /*Three column layout*/
        .three-column {
            text-align: center;
            font-size: 0;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .three-column .column {
            width: 100%;
            max-width: 220px;
            display: inline-block;
            vertical-align: top;
        }
        .three-column img {
            width: 100%;
            max-width: 200px;
            height: auto;
        }
        .three-column .contents {
            font-size: 14px;
            text-align: center;
        }
        .three-column .text {
            padding-top: 10px;
        }

        /* Left sidebar layout */
        .left-sidebar {
            text-align: left;
            font-size: 0;
        }
        .left-sidebar .column {
            width: 100%;
            display: inline-block;
            vertical-align: top;
        }
        .left-sidebar .left {
            max-width: 160px;
        }
        .left-sidebar .right {
            max-width: 460px;
        }
        .left-sidebar .img {
            width: 100%;
            max-width: 130px;
            height: auto;
        }
        .left-sidebar .contents {
            font-size: 14px;
            text-align: left;
        }
        .left-sidebar a {
            color: #9bbc97;
        }

        /* Icon sidebar layout */
        .icon-sidebar {
            text-align: left;
            font-size: 0;
        }
        .icon-sidebar .column {
            width: 100%;
            display: inline-block;
            vertical-align: top;
        }
        .icon-sidebar .left {
            max-width: 55px;
        }
        .icon-sidebar .right {
            max-width: 550px;
        }
        .icon-sidebar .img {
            width: 100%;
            max-width: 35px;
            height: auto;
        }
        .icon-sidebar .contents {
            font-size: 14px;
            text-align: left;
        }
        .icon-sidebar a {
            color: #9bbc97;
        }

        /* Right sidebar layout */
        .right-sidebar {
            text-align: left;
            font-size: 0;
        }
        .right-sidebar .column {
            width: 100%;
            display: inline-block;
            vertical-align: top;
        }
        .right-sidebar .left {
            max-width: 160px;
        }
        .right-sidebar .right {
            max-width: 460px;
        }
        .right-sidebar .img {
            width: 100%;
            max-width: 130px;
            height: auto;
        }
        .right-sidebar .contents {
            font-size: 14px;
            text-align: left;
        }
        .right-sidebar a {
            color: #9bbc97;
        }


        .width100 { width: auto !important; }

        /*Media Queries*/
        @media screen and (max-width: 480px) {
            .two-column .column,
            .three-column .column {
                max-width: 100% !important;
            }
            .three-column .column {
                width: 220px !important;
            }
            .two-column img {
                width: 100% !important;
                max-width: 100% !important;
            }
            .three-column img {
                width: 100% !important;
                max-width: 100% !important;
            }
            .left-sidebar .right {
                max-width: 100%;
            }
            .right-sidebar .right {
                max-width: 100%;
            }
            .hide { display: none !important; overflow: hidden !important; width: 0 !important; height: 0 !important; mso-hide: all !important; }
            .width100 { width: 100% !important; }

            table.altTableAgenda td { display: block !important; }

        }

        @media screen and (min-width: 481px) and (max-width: 660px) {
            .three-column .column {
                max-width: 100% !important;
            }
            .two-column .column {
                max-width: 50% !important;
            }
            .hide { display: none !important; overflow: hidden !important; width: 0 !important; height: 0 !important; mso-hide: all !important; }
            .width100 { width: 100% !important; }
        }

        h1 {
            font-family: tiempos, times new roman, serif;
            font-weight: bold;
            font-size: calc(22px + 3px);
            letter-spacing: -.8px;
            line-height: 26px;
            color: #1d1d1d;
        }

        h2, h3, h4, h5, h6 {
            font-family: tiempos, times new roman, serif;
            font-weight: bold;
            font-size: 22px;
            letter-spacing: -.8px;
            line-height: 26px;
            color: #1d1d1d;
        }




        @font-face {
            font-family: 'tiempos';
            src: url('https://assets.driessengroep.nl/fonts/tiempos/webfonts/tiempos.otf') format('opentype');
            font-weight: 700;
            font-style: normal;
        }
        h1 {
            font-size: 21px !important;
            color: #1d1d1d !important;
            font-style: normal !important;
            font-weight: 700 !important;
        }

        h2, h3, h4, h5, h6 {
            font-size: 18px !important;
            color: #1d1d1d !important;
            font-style: normal !important;
            font-weight: 700 !important;
        }
        [style*='tiempos'] {
            text-rendering: geometricprecision; -webkit-font-smoothing: antialiased;
            text-shadow: 1px 1px 1px rgba(0,0,0,0.004);
            -moz-osx-font-smoothing: grayscale;
        }



        a[href^=tel]{ color: #9bbc97; text-decoration:none;}
        .linkColor, .linkColor * { color: #9bbc97 !important; text-decoration: none !important;}
        .titles { font-family: tiempos, times new roman, serif !important; }
        .nbHeadImgBgcolor { background-color: #1d1d1d; }

    </style>
    <!--[if (gte mso 9)|(IE)]>
    <style type="text/css">
        table {border-collapse: collapse;}
    </style>
    <![endif]-->

    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

</head>
<body>