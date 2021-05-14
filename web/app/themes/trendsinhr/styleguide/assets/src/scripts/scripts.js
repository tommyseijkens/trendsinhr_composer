(function ($) {

// =============================
// = Document Ready
// =============================
    $(document).ready(function () {
        popup();
        body = $('body');
        navigationScrollInit();
        navigationScroll();
        if ($('.cards-row').length) {
            cardsrowScrollInit();
            cardsrowScroll();
        }
        iframe();
        table();
        externallinks();
        aos();
        searchbar();
        blocklinks();
    });

    /**
     * On window load do...
     */
    $(window).on("load", function () {
        checkThemeColor();
        scrollTo();
        if ($('form').length) {
            addFormSubmitAttemptedTriggers();
        }
    });

    /**
     * On window scroll do...
     */
    $(window).scroll(function () {

    });

    /**
     * On window resize do...
     */
    $(window).resize(function () {

        navigationScrollInit();

    });


    /**
     * Magnific popup
     */
    function popup() {
        $('.open-modal').on('click', function (e) {
            e.preventDefault()
            $('#dynamicModal').modal({show: true})
        })
        // Popups.
        $('.-modalpopup').magnificPopup({
            type: 'inline',
            fixedContentPos: true,
            fixedBgPos: true,
            preloader: false,
            modal: true
        });
        $(document).on('click', '.popup-modal-dismiss', function (e) {
            e.preventDefault();
            $.magnificPopup.close();
        });
    }

    /**
     * Get URL parameters
     */
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    /**
     * Open publications submenu
     */
    $('.nav-pubs-trigger').hover(
        function () {
            $('.nav-pubs').addClass('active');
        },
        function () {
            $('.nav-pubs').removeClass('active');
        });

    /**
     * Set themecolor
     */
    function checkThemeColor() {
        var themeColor = getUrlParameter('themeColor');
        if (themeColor) {
            setThemeColor('#' + themeColor);
        }
    }

    function setThemeColor(color) {
        document.documentElement.style.setProperty('--themecolor', color);
        document.documentElement.style.setProperty('--themecolor-dark', LightenColor(color, -20));
    }

    function LightenColor(color, percent) {
        var num = parseInt(color.replace("#", ""), 16),
            amt = Math.round(2.55 * percent),
            R = (num >> 16) + amt,
            B = (num >> 8 & 0x00FF) + amt,
            G = (num & 0x0000FF) + amt;
        return "#" + (0x1000000 + (R < 255 ? R < 1 ? 0 : R : 255) * 0x10000 + (B < 255 ? B < 1 ? 0 : B : 255) * 0x100 + (G < 255 ? G < 1 ? 0 : G : 255)).toString(16).slice(1);
    };


    /**
     * Main navigation scrollbar
     */
    function navigationScrollInit() {
        navMainWrapper = $('.nav-main__wrapper');
        navMainLeft = $('.nav-main__scroller-left');
        navMainRight = $('.nav-main__scroller-right')
        containerWidth = $('.container').innerWidth();
        widthOfLastItem = $('.nav-main__wrapper ul:last-of-type li:last-of-type').outerWidth();
    }

    function navigationScroll() {

        $('.nav-main__scroller-right').click(function () {
            var currentScrollPosition = $('.nav-main__wrapper').scrollLeft();
            navMainWrapper.animate({scrollLeft: currentScrollPosition + 200}, 400, function () {
            });
        });

        navMainLeft.click(function () {
            var currentScrollPosition = navMainWrapper.scrollLeft();
            navMainWrapper.animate({scrollLeft: currentScrollPosition - 200}, 400, function () {
            });
        });

        navMainWrapper.scroll(function () {
            position = $('.nav-main__wrapper ul:last-of-type li:last-of-type').position().left;
            if (navMainWrapper.scrollLeft() > 0) {
                navMainLeft.addClass('active');
            }
            if (navMainWrapper.scrollLeft() == 0) {
                navMainLeft.removeClass('active');
            }
            if (position <= (containerWidth - widthOfLastItem)) {
                navMainRight.removeClass('active');
            } else {
                navMainRight.addClass('active');
            }
        });

    }


    /**
     * Cards-row scroller
     */
    function cardsrowScrollInit() {
        cardsrowMainWrapper = $('.cards-row');
        cardsrowMainLeft = $('.cards-row__navigator-left');
        cardsrowMainRight = $('.cards-row__navigator-right')
        cardsrowcontainerWidth = $('.cards-row').innerWidth();
        cardsrowwidthOfLastItem = $('.cards-row .card-item:last-child').outerWidth();
    }

    function cardsrowScroll() {

        cardsrowMainRight.click(function () {
            var currentScrollPosition = cardsrowMainWrapper.scrollLeft();
            cardsrowMainWrapper.animate({scrollLeft: currentScrollPosition + 400}, 400, function () {
            });
        });

        cardsrowMainLeft.click(function () {
            var currentScrollPosition = cardsrowMainWrapper.scrollLeft();
            cardsrowMainWrapper.animate({scrollLeft: currentScrollPosition - 400}, 400, function () {
            });
        });

        cardsrowMainWrapper.scroll(function () {
            cardsrowScrollPosition = $('.cards-row .card-item:last-child').position().left;
            if (cardsrowMainWrapper.scrollLeft() > 0) {
                cardsrowMainLeft.addClass('active');
            }
            if (cardsrowMainWrapper.scrollLeft() == 0) {
                cardsrowMainLeft.removeClass('active');
            }
            if (cardsrowScrollPosition <= (cardsrowcontainerWidth - cardsrowwidthOfLastItem)) {
                cardsrowMainRight.removeClass('active');
            } else {
                cardsrowMainRight.addClass('active');
            }
        });

    }


    /**
     * Iframe responsive.
     */
    function iframe() {
        if ($('iframe').length > 0) {
            // Youtube wrap embed-container responsive.
            $('iframe[src*="youtube"],iframe[src*="youtu.be"],iframe[src*="vimeo"]').each(function () {
                if (!$(this).parent().parent().hasClass('embed-responsive') &&
                    !$(this).parent().hasClass('embed-responsive') &&
                    !$(this).parents().hasClass('mijn-driessen-video')) {
                    $(this).addClass('embed-responsive-item')
                    $(this).wrap('<div class="embed-responsive embed-responsive-16by9"></div>')
                }
            })

        }
    }

    /**
     * Table responsive.
     */
    function table() {
        if ($('table').length > 0) {
            // Youtube wrap embed-container responsive.
            $('table').each(function () {
                $(this).wrap('<div class="table-responsive"></div>')
            })

        }
    }

    /**
     * Open external links on new tab or window.
     */
    function externallinks() {
        $('a[href^="http"]').not('a[href*="' + window.location.host + '"]').attr('target', '_blank')
    }

    /**
     * AOS.
     */
    function aos() {
        AOS.init({
            // Global settings:
            disable: false,
            startEvent: 'DOMContentLoaded',
            initClassName: 'aos-init',
            animatedClassName: 'aos-animate',
            useClassNames: false,
            disableMutationObserver: false,
            debounceDelay: 50,
            throttleDelay: 99,
            offset: 120,
            delay: 100,
            duration: 1000,
            easing: 'ease',
            once: true,
            mirror: false,
            anchorPlacement: 'top-bottom',
        })
    }


    /**
     * Scroll to anchor.
     */
    function scrollTo() {

        // Add class to all anchors.
        $('a:not([href])[id]').addClass('anchor');

        // Animate and create hash.
        $('a').not('.popup-modal').on('click', function (event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function () {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    }


    /**
     * Add asterisk to required fields (add to input)
     */
    function requiredInput() {
        $("input:required").after('<div class="requiredInput">*</div>');
    }

    /**
     * Adds class to form if submit is attempted so required fields can be marked
     */
    function addFormSubmitAttemptedTriggers() {
        var formEls = document.querySelectorAll('form');
        for (var i = 0; i < formEls.length; i++) {
            function addSubmitAttemptedTrigger(formEl) {
                var submitButtonEl = formEl.querySelector('button[type=submit]');
                if (submitButtonEl) {
                    submitButtonEl.addEventListener('click', function () {
                        formEl.classList.add('submit-attempted');
                    });
                }
            }

            addSubmitAttemptedTrigger(formEls[i]);
        }
    }


    /**
     * Search
     */
    function searchbar() {

        $('.icon-search').click(
            function () {
                if ($('.searchbar').hasClass('searchbar-open')) {
                    $('.searchbar').removeClass('searchbar-open');
                } else {
                    $('.searchbar').addClass('searchbar-open');
                    $('.sf-input-text').focus();
                }
            });

        if ($('.search-results-filters').length) {
            fold($('.search-results-filters .searchandfilter h4'));
        }

    }


    /**
     * Foldout universal
     */
    function fold(item) {

        var open = "Meer informatie";
        var close = "Sluiten";

        $(item).click(function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                if ($(this).prev().hasClass('fold__content')) {
                    $(this).prev().slideUp();
                    $(this).html(open);
                } else {
                    $(this).next().slideUp();
                }

            } else {

                $(item).next().slideUp();
                $(item).removeClass('active');

                $(this).addClass('active');


                if ($(this).prev().hasClass('fold__content')) {
                    $(this).prev().slideDown();
                    $(this).html(close);
                } else {
                    $(this, '.active').next().slideDown();
                }
            }
        });
    }

    /**
     * Set links in block--links to class list__links
     */
    function blocklinks() {
        if($('.block--links > ul').length) {

            $( ".block--links" ).each(function( index ) {
                $( '.block--links > ul > li > p > a' ).parent().parent().parent().addClass('list__links');
                $( '.block--links > ul > li > a' ).parent().parent().parent().addClass('list__links');
            });
        }
    }

}(jQuery));



