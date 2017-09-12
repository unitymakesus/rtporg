(function ($) {

    "use strict";
    var theme_dir = "/wp-content/themes/abt-core-custom/";

    /* Setup fullscreen backgrounds
    ------------------------------------------------------------------------ */
    function initFullscreenBackgrounds() {
        var selector = $('.page-template-page-why-rtp-php, .page-template-page-our-mission-php, .page-template-page-about-us-php'),
            section = selector.find('.featured-banner'),
            window_height = $(window).height();

        if (section.length > 0) {
            section.css('height', window_height);
        }
    }

    /* Destroy fullscreen backgrounds
    ------------------------------------------------------------------------ */
    function destroyFullscreenBackgrounds() {
        var selector = $('.page-template-page-why-rtp-php, .page-template-page-our-mission-php, .page-template-page-about-us-php, .page-template-page-full-background-php'),
            section = selector.find('.featured-banner');

        if (section.length > 0) {
            section.css('height', '');
        }
    }

    /* Setup scroll pagination
    ------------------------------------------------------------------------ */
    function initScrollPagination() {
        var page = $('.page-template-page-why-rtp-php, .page-template-page-our-mission-php, .page-template-page-about-us-php'),
            container = $(document),
            indicator = $('#scroll-indicator'),
            label = indicator.find('span'),
            link = $('.pagination-vertical a'),
            midpoint = $(window).height() / 2;

        if (page.length > 0) {

            // Setup scroll pagination
            $('.pagination-vertical a:first-child').addClass('active');

            link.click(function () {
                var target = $($(this).attr('href'));

                link.removeClass('active');
                $(this).addClass('active');
                container.scrollTo(target, 1000, {
                    easing: 'easeInOutCubic'
                });
                return false;
            });

            // Make scroll indicator active by default
            indicator.addClass('active');

            // Setup scroll indicator and active pagination
            container.on('scroll', throttle(function () {

                var first_section = $('.featured-banner').first()[0].getBoundingClientRect().top,
                    last_section = $('.featured-banner').last()[0].getBoundingClientRect().top;

                // Pagination flagging
                $('section.featured-banner').each(function () {
                  var offset = $(this)[0].getBoundingClientRect().top;

                  if (offset <= midpoint) {
                      var id = $(this).attr('id');

                      $('.pagination-vertical a').removeClass('active');
                      $('.pagination-vertical a[href="#' + id + '"]').addClass('active');
                  }

                });

                // Scroll indicator
                if (first_section < 0 && last_section > 1) {
                    indicator.removeClass('active');
                } else {
                    indicator.addClass('active');
                }
                if (last_section < 1) {
                    label.text('Back to Top');
                    indicator.addClass('to-top');
                } else {
                    label.text('Scroll Down');
                    indicator.removeClass('to-top');
                }

            }, 100));

            $('#scroll-indicator.active .group').click(function () {
                var target_link = $('.pagination-vertical a.active + a');

                if ($(this).parent().hasClass('to-top')) {
                    container.scrollTo(0, 3000, {
                        easing: 'easeInOutQuart'
                    });
                } else {
                    target_link.trigger('click');
                }
            });

        }

    }

    /* Destroy Why RTP pagination
    ------------------------------------------------------------------------ */
    function destroyScrollPagination() {
        var page = $('.page-template-page-why-rtp-php, .page-template-page-our-mission-php, .page-template-page-about-us-php'),
            link = $('.pagination-vertical a');

        if (page.length > 0) {
            link.unbind('click');
        }
    }

    /* Setup Service Categories Toggle
    ------------------------------------------------------------------------ */
    function initServiceCategoriesToggle() {
        var serviceSwitcher = $('#service-switcher');

        if (serviceSwitcher.length > 0) {
            serviceSwitcher.find('li').hover(
                function () {
                    var trigger = $(this).attr('data-trigger');

                    $(this).addClass('is-active');
                    $('.service-category__' + trigger).addClass('is-active');
                },
                function () {
                    $(this).removeClass('is-active');
                    $('.service-category').removeClass('is-active');
                }
            );
        }
    }

    /* Setup University Toggles
    ------------------------------------------------------------------------ */
    function initUniversityToggles() {
        var section = $('#section-education'),
            universities = section.find('.universities');

        if (section.length) {
            universities.find('li').hover(
                function () {
                    var ref = $(this).attr('data-ref');

                    $('.' + ref).addClass('active');
                },
                function () {
                    $('.university-scene').removeClass('active');
                }
            );
        }
    }

    /* Setup Metro Toggles
    ------------------------------------------------------------------------ */
    function initMetroToggles() {
        var section = $('#section-metro'),
            locations = section.find('.metro-locations');

        if (section.length) {
            locations.find('li').hover(
                function () {
                    var ref = $(this).attr('data-ref');

                    $('.' + ref).addClass('active');
                },
                function () {
                    $('.metro-scene').removeClass('active');
                }
            );
        }
    }

    /* Setup Scroll Functions for Why RTP
    ------------------------------------------------------------------------ */
    function initPageScrollActions() {
        var container = $(document),
            page = $('.page-template-page-why-rtp-php, .page-template-page-our-mission-php, .page-template-page-about-us-php'),
            logo = page.find('#section-foundation .rtp-brand'),
            sectors = page.find('#section-diversity .sectors'),
            midpoint = $(window).height() / 2;

        if (page.length) {

            // Animate first section
            page.find('.content section:eq(0)').addClass('animate-section');

            // Convergence
            container.on('scroll', throttle(function () {
                page.find('.content section').each(function () {
                    var offset = $(this)[0].getBoundingClientRect().top;

                    if ( offset <= midpoint ) {
                        $(this).addClass('animate-section');
                    }
                    if ( offset <= midpoint && $(this).is('#section-diversity')) {
                        sectors.addClass('animate-sectors');
                    }
                    if ( offset <= midpoint && $(this).is('#section-education')) {
                        sectors.addClass('charts-animated');
                    }
                });
            }, 100));

        }

    }

    /* Setup Inverted Pagination
    ------------------------------------------------------------------------ */
    function initInvertPagination() {
        var container = $(window),
            page = $('.page-template-page-about-us-php'),
            midpoint = $(window).height() / 2;

        if (page.length) {

            $('.pagination-vertical').addClass('inverted');

            container.on('scroll', throttle(function () {
                // page.find('.content section').each(function () {
                //     var offset = $(this).offset().top;

                //     if ( $(this).is('.theme-frosty') ) {
                //         $('.pagination-vertical').addClass('inverted');
                //     }
                //     else {
                //         $('.pagination-vertical').removeClass('inverted');
                //     }
                // });

                //Vertical Pagination
                if ($('.section-intro.theme-frosty').visible(true) === true) {
                    $('.pagination-vertical').addClass('inverted');
                } else if ($('.section-our-home.theme-frosty').visible(true) === true) {
                    $('.pagination-vertical').addClass('inverted');
                } else if ($('.section-potential.theme-frosty').visible(true) === true) {
                    $('.pagination-vertical').addClass('inverted');
                } else if ($('.section-generosity.theme-frosty').visible(true) === true) {
                    $('.pagination-vertical').addClass('inverted');
                } else {
                    $('.pagination-vertical').removeClass('inverted');
                }

            }, 100));

        }
    }

    /* Setup Expertise Areas
    ------------------------------------------------------------------------ */
    function initExpertiseAreas() {
        var areas = $('.fields-expertise');

        if (areas.length) {

            var toggleSlide = function () {
                $(".fields-expertise li.active").removeClass()
                    .next().add(".fields-expertise li:first").last().addClass("active");
            };
            setInterval(toggleSlide, 4000);

        }
    }

    /* Setup Create Line
    ------------------------------------------------------------------------ */
    function createLine (x1,y1, x2,y2, target){
        var length = Math.sqrt((x1-x2)*(x1-x2) + (y1-y2)*(y1-y2)),
            angle  = Math.atan2(y2 - y1, x2 - x1) * 180 / Math.PI,
            transform = 'rotate('+angle+'deg)';

        var line = $('<div>')
            .appendTo($(target))
            .addClass('line')
            .css({
                'position': 'absolute',
                'transform': transform
            })
            .width(length)
            .offset({left: x1, top: y1});

        return line;
    }

    $(document).ready(function () {

        Responder.query("only screen and (min-width: 960px)", function () {
            initUniversityToggles();
            initServiceCategoriesToggle();
            initMetroToggles();
            initExpertiseAreas();
            //initInvertPagination();
        }, true);

    });

    $(window).load(function () {

        initScrollPagination();

        Responder.query("only screen and (max-width: 959px)", function () {
            destroyFullscreenBackgrounds();
            destroyScrollPagination();
        }, false);

        Responder.query("only screen and (min-width: 960px)", function () {
            initPageScrollActions();
        }, true);

        Responder.query("only screen and (min-width: 960px) and (min-height: 960px)", function () {
            initFullscreenBackgrounds();
        }, true);

    });

    $(window).resize(function () {

        Responder.query("only screen and (max-width: 959px)", function () {
            destroyFullscreenBackgrounds();
        }, false);

        Responder.query("only screen and (min-width: 960px)", function () {
            initFullscreenBackgrounds();
        }, true);

    });

})(jQuery);
