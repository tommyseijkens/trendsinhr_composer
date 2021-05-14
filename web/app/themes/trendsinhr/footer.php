<footer>

    <?php
    global $template;
    global $nosubscriber;
    $templateName = basename($template);
    if (
        $templateName != 'page.php' &&
        $templateName != 'terms.php' &&
        $templateName != 'page-magazines.php' &&
        $templateName != 'taxonomy-posttypes-publicaties.php' &&
        $templateName != 'taxonomy-posttypes-whitepapers.php' &&
        $templateName != 'single-event.php' &&
        $templateName != 'events.php' &&
        !$nosubscriber
    ) {
        ?>
        <div class="footer-cta mb-12">
            <div class="container">
                <div class="row">

                    <div class="container-cta form-tripolis">
                        <div class="footer-cta__title"><?php echo get_field('subscribe_title','option'); ?></div>
                        <?php echo get_field('subscribe_text','option'); ?>
                        <form method="POST" id="newsletter" class="form-tripolis__form">
                            <div class="form-tripolis__group">
                                <input type="hidden" id="style" name="style" value="driessengroep">
                                <input type="hidden" id="subscribeTo" name="subscribeTo" value="trendsinhr">
                                <div class="form-tripolis__controls">
                                    <input type="email" placeholder="Je e-mailadres" id="email" name="email" value=""
                                           class="text form-tripolis__email">
                                    <input type="submit" value="Inschrijven" class="button form-tripolis__submit" id="fastlane">
                                </div>
                                <span class="allow_contact_by_email">
                                    <input type="email" placeholder="Ter verificatie nogmaals je e-mailadres" id="subscribeEmail"
                                        value="" name="subscribeEmail" autocomplete="off">
                                     <input type="checkbox" class="allow_contact_by_email" name="allow_contact_by_email"
                                        value="AllowEmail" autocomplete="off">
                                 </span>
                            </div>
                        </form>
                        <p id="result"></p>
                        <div class="alert rounded p-5 form-tripolis__message form-tripolis__message--warning">Er is
                            helaas iets mis gegaan het versturen van het formulier. Probeer nogmaals.
                        </div>
                        <div class="alert rounded p-5 form-tripolis__message form-tripolis__message--success">Bedankt! We
                            hebben je een mail gestuurd om je inschrijving te bevestigen.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="w-100 my-12"></div>
    <?php } ?>

    <div class="footer-nav">
        <div class="container">
            <div class="col border-top"></div>
            <div class="row py-11">
                <div class="d-none d-xl-block col-4 footer-nav__about">
                    <div class="footer-nav__title">Trends in HR</div>
                    <?php echo get_field('about_text', 'option'); ?>
                </div>
                <div class="d-none d-lg-block col-lg-4 col-xl-2 offset-xl-1 footer-nav__quicklinks">
                    <div class="footer-nav__title">Snel naar</div>
                    <?php wp_nav_menu(array('menu' => 'Snel naar', 'container' => false )); ?>
                </div>
                <div class="d-none d-lg-block col-lg-4 col-xl-2 footer-nav__subscribe">
                    <div class="footer-nav__title">Abonneren</div>
                    <?php wp_nav_menu(array('menu' => 'Abonneren', 'container' => false )); ?>
                </div>
                <div class="col-12 col-lg-4 col-xl-3 text-center text-lg-left footer-nav__social">
                    <ul class="nav d-flex justify-content-center justify-content-lg-start">
                        <li class="nav-item">
                            <a href="https://www.linkedin.com/company/trends-in-hr/" class="nav-link" target="_blank"></a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.facebook.com/trendsinhr" class="nav-link" target="_blank"></a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.instagram.com/trendsinhr/" class="nav-link" target="_blank"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex d-lg-block justify-content-center justify-content-lg-start">
        <div class="d-inline-block border-left border-right">
            <a href="https://www.driessengroep.nl" class="footer-branding"></a>
        </div>
    </div>
    <div class="footer-legal bg-color-01 py-7">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="d-none d-lg-inline-block footer-legal__copyright">
                    <a href="https://www.driessengroep.nl">&copy; <?php echo date('Y'); ?> Driessen Groep</a>
                </div>
                <div class="col footer-legal__privacy d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-lg-end">
                    <?php wp_nav_menu(array('menu' => 'Footerlinks', 'container' => false )); ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
