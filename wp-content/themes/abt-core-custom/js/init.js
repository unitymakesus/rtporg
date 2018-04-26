(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 500);
      };
  }
    // smartresize
    jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');

// Throttling function from Underscore
// https://github.com/jashkenas/underscore/blob/master/underscore.js
function throttle(func, wait, options) {
  var context, args, result;
  var timeout = null;
  var previous = 0;
  if (!options) options = {};
  var later = function() {
    previous = options.leading === false ? 0 : Date.now();
    timeout = null;
    result = func.apply(context, args);
    if (!timeout) context = args = null;
  };
  return function() {
    var now = Date.now();
    if (!previous && options.leading === false) previous = now;
    var remaining = wait - (now - previous);
    context = this;
    args = arguments;
    if (remaining <= 0 || remaining > wait) {
      if (timeout) {
        clearTimeout(timeout);
        timeout = null;
      }
      previous = now;
      result = func.apply(context, args);
      if (!timeout) context = args = null;
    } else if (!timeout && options.trailing !== false) {
      timeout = setTimeout(later, remaining);
    }
    return result;
  };
};


(function ($) {

    "use strict";
    var theme_dir = "/wp-content/themes/abt-core-custom/";


/* =======================================================================================================
    Functions
======================================================================================================= */

    /* Setup preloader
    ------------------------------------------------------------------------ */
    function initPreloader() {
        $('.preloader').fadeOut();
    }

    /* Setup owl carousel
    ------------------------------------------------------------------------ */
    function initOwlCarousel() {
        $('.owl-carousel').owlCarousel({
            singleItem: true,
            navigation: true,
            addClassActive: true
        });
    }

    /* Setup responsive videos
    ------------------------------------------------------------------------ */
    function initResponsiveVideos() {
        var selector = $('body');

        if (selector.length > 0) {
            $('.social-tile').on('click', function() {
                //$(selector).fitVids();
            });
        }
    }

    /* Setup menu icons
    ------------------------------------------------------------------------ */
    function initMenuIcons() {
        var menu         = $('nav.primary'),
            icon_home    = theme_dir + "img/icons/i_home.svg",
            icon_about   = theme_dir + "img/icons/i_about-us.svg",
            icon_why     = theme_dir + "img/icons/i_why-rtp.svg",
            icon_map     = theme_dir + "img/icons/i_map.svg",
            icon_events  = theme_dir + "img/icons/i_events.svg",
            icon_blog    = theme_dir + "img/icons/i_blog.svg",
            icon_contact = theme_dir + "img/icons/i_contact-us.svg",
            menu_home    = menu.find('.m-home'),
            menu_about   = menu.find('.m-about'),
            menu_why     = menu.find('.m-why'),
            menu_map     = menu.find('.m-map'),
            menu_events  = menu.find('.m-events'),
            menu_blog    = menu.find('.m-blog'),
            menu_contact = menu.find('.m-contact');

        if (menu.length > 0) {
            if (menu_home.length > 0) {
                menu_home.find('> a').prepend('<img class="svg" src="' + icon_home + '" />');
            }
            if (menu_about.length > 0) {
                menu_about.find('> a').prepend('<img class="svg" src="' + icon_about + '" />');
            }
            if (menu_why.length > 0) {
                menu_why.find('> a').prepend('<img class="svg" src="' + icon_why + '" />');
            }
            if (menu_map.length > 0) {
                menu_map.find('> a').prepend('<img class="svg" src="' + icon_map + '" />');
            }
            if (menu_events.length > 0) {
                menu_events.find('> a').prepend('<img class="svg" src="' + icon_events + '" />');
            }
            if (menu_blog.length > 0) {
                menu_blog.find('> a').prepend('<img class="svg" src="' + icon_blog + '" />');
            }
            if (menu_contact.length > 0) {
                menu_contact.find('> a').prepend('<img class="svg" src="' + icon_contact + '" />');
            }
        }
    }

    /* Equalize contact tiles
    ------------------------------------------------------------------------ */
    function initEqualizeContactTiles() {
        var contact = $('.contact-list li'),
            title = contact.find('h4');

        if (contact.length > 1) {

            // Remove styles
            contact.removeAttr('style');
            title.removeAttr('style');

            // Apply heights
            contact.equalHeights();
            title.equalHeights();
        }
    }

    /* Equalize company tiles
    ------------------------------------------------------------------------ */
    function initEqualizeCompanyTiles() {
        var company = $('.company-list li'),
            title = company.find('h4');

        if (company.length > 1) {

            // Remove styles
            company.removeAttr('style');
            title.removeAttr('style');

            // Apply heights
            company.equalHeights();
            title.equalHeights();
        }
    }

    /* Assign classes to LIs to determine row
     ------------------------------------------------------------------------ */
    function getCoordinates(){
        var count = 0;
        var yCoord =[];
        var compare = yCoord[0];
        var rowCount = 0;

        //For resizing browser: remove current active and summary
        //resetGrid();

        // Determine Y-coordinate of each LI. Assign "row-X" to each LI - updating X for each new row
        $('#social-grid-section .social-tile').each(function(){
            yCoord[count] = Math.ceil($(this).position().top);
            if(yCoord[count] == compare){
                $(this).removeClass(function (index, css) {
                    return (css.match (/\brow-\S+/g) || []).join(' ');
                });
                $(this).addClass('row-'+rowCount);
            }
            else {
                compare = yCoord[count];
                rowCount++;
                $(this).removeClass(function (index, css) {
                    return (css.match (/\brow-\S+/g) || []).join(' ');
                });
                $(this).addClass('row-'+rowCount);
            }
            count++;
        });

    }

    /* Setup mobile accordion
    ------------------------------------------------------------------------ */
    function initMobileAccordion() {
        var menu          = $('nav.primary'),
            parent        = menu.find('.menu-item-has-children'),
            icon_expand   = theme_dir + "img/icons/i_expand.svg",
            icon_collapse = theme_dir + "img/icons/i_collapse.svg";

        if (menu.length > 0 && parent.length > 0) {

            // Hide the children
            parent.find('ul').hide();
            parent.each(function () {

                // Add icon
                $(this).find('> a').append('<img class="svg toggle expand" src="' + icon_expand + '" /><img class="svg toggle collapse" src="' + icon_collapse + '" />');
                inlineSVG();

                // Click event
                $(this).find('> a').click(function () {

                    // Set or remove active state
                    $(this).toggleClass('expanded');

                    // Open or close the children
                    $(this).parent().find('ul').slideToggle(250);

                    return false;
                });

            });
        }
    }

    /* Destroy mobile accordion
    ------------------------------------------------------------------------ */
    function destroyMobileAccordion() {
        var menu   = $('nav.primary'),
            parent = menu.find('.menu-item-has-children');

        if (menu.length > 0 && parent.length > 0) {

            // Show the children
            parent.find('ul').show();
            parent.each(function () {

                // Unbind click events
                $(this).find('> a').unbind('click');

                // Remove active state
                $(this).removeClass('active');

                // Remove icons
                $(this).find('.svg.toggle').remove();

            });
        }
    }

    /* Setup desktop menu hovers
    ------------------------------------------------------------------------ */
    function initDesktopMenuHover() {
        var home        = $('body.home'),
            menu        = $('nav.primary'),
            parent      = menu.find('.menu-item-has-children');
        if (menu.length > 0 && parent.length > 0) {

            // Adjust menu size via site search
            $('.st-menu .site-search input[type="search"]').focus(function () {

                // Expand menu when search is in focus
                $('body').removeClass('menu-minimized').addClass('menu-maximized');

            });
            $('.st-menu .site-search input[type="search"]').blur(function () {
                var size = $('body').attr('data-default-menu-size');

                // Collapse menu only if it defaulted as minimized
                if (size === "minimized") {
                    $('body').removeClass('menu-maximized').addClass('menu-minimized');
                }
            });

            // Display selected sub-panel
            $('nav.primary li.menu-item-has-children').hoverIntent({
                over: function () {
                    var id = $(this).attr('id');

                    // Minimize drawer
                    if ($('body.show-subpanel').length < 1) {
                        $('body').addClass('show-subpanel');
                    }

                    if ($('body.menu-maximized').length > 0) {
                        $('body').removeClass('menu-maximized').addClass('menu-minimized');
                    }

                    // Show selected sub panel
                    $('.sub-panel.' + id).addClass('active');
                },
                out: function () {
                    var default_size = $('body').attr('data-default-menu-size');

                    // Reset drawer
                    $('body').removeClass('show-subpanel');

                    // Reset menu
                    if (default_size === "minimized") {
                        $('body').removeClass('menu-maximized').addClass('menu-minimized');
                    } else {
                        $('body').removeClass('menu-minimized').addClass('menu-maximized');
                    }

                    // Hide sub panels
                    $('.sub-panel').removeClass('active');
                }
                // Interval
                //interval: 50
            });
        }
    }

    /* Destroy desktop menu hovers
    ------------------------------------------------------------------------ */
    function destroyDesktopMenuHover() {
        var menu_sections = $('.st-menu .logo, .st-menu .site-search, .st-menu .primary, .st-menu .social-media'),
            menu = $('nav.primary'),
            parent = menu.find('.menu-item-has-children');

        if (menu.length > 0 && parent.length > 0) {

            parent.unbind('mouseenter mouseleave');
            menu_sections.removeClass('collapsed');

        }
    }

    /* Setup submenu
    ------------------------------------------------------------------------ */
    function initSubmenu() {
        var menu = $('nav.primary'),
            parent = menu.find('.menu-item-has-children');

        if (menu.length > 0 && parent.length > 0) {
            parent.each(function () {

                var id = $(this).attr('id'),
                    title = $(this).find('> a > .label'),
                    desc = $(this).find('> a > .description'),
                    submenu = $(this).find('> ul');

                // Title, desc, menu
                submenu.wrap('<div class="sub-panel ' + id + '" data-id="' + id + '">');
                desc.prependTo('.sub-panel.' + id);
                title.clone().prependTo('.sub-panel.' + id).wrap('<h2>');

            });
        }
    }

    /* Setup social options toggle
    ------------------------------------------------------------------------ */
    function initSocialOptionsToggle() {
        var grid = $('.social-grid'),
            toggle = grid.find('.open-options'),
            article = grid.find('article');

        toggle.on('click', function () {
            $(this).closest('article').addClass('show-options');
        });

        article.on('mouseleave', function () {
            $(this).removeClass('show-options');
        });
    }


    /* Add body classes
    ------------------------------------------------------------------------ */
    // function initBodyClasses() {
    //     var body = $('body'),
    //         aside = $('.aside'),
    //         people = $('.people');
    //
    //     if (aside.length < 1) {
    //         body.addClass('layout-one-column');
    //     }
    //     if (people.length > 0) {
    //         body.addClass('archive-people');
    //     }
    // }

    /* Add menu classes
    ------------------------------------------------------------------------ */
    function initMenuClasses() {
        var menu = $('nav.primary');

        if ($('body.single-people').length) {
            menu.find('.m-about').addClass('active');
            menu.find('.m-about').find('li:contains(Staff)').addClass('active');
        }
        if ($('body.category, body.author, body.single-post').length) {
            menu.find('.m-blog').addClass('active');
        }
        if ($('body.single-program').length) {
            menu.find('.m-about').addClass('active');
            menu.find('.m-about').find('li:contains(Program)').addClass('active');
        }
        if ($('body.single-event').length) {
            menu.find('.m-events').addClass('active');
        }
        if ($('body.single-location').length) {
            menu.find('.m-map').addClass('active');
        }
    }

    /* Setup disqus comments
    ------------------------------------------------------------------------ */
    // function initDisqusComments() {
    //     var embed = $('#disqus_thread'),
    //         tiles = $('.social-tile.post'),
    //         disqus_apikey = 'x4yGxe2tyDjtLRnaAF0zDnlUMrjvpmMQ6fn820URcfNHpoVVQDPqCYmFrQxkSRA6',
    //         disqus_shortname = 'rtporg',
    //         urlArray = [];
    //
    //     if (embed.length > 0) {
    //         var dsq = document.createElement('script');
    //         dsq.type = 'text/javascript';
    //         dsq.async = true;
    //         dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
    //
    //         (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    //     }
    //     if (tiles.length > 0) {
    //         $('.likes').each(function () {
    //             var url = $(this).attr('data-disqus-url');
    //             urlArray.push('link:' + url);
    //         });
    //         $.ajax({
    //             type: 'GET',
    //             url: "https://disqus.com/api/3.0/threads/set.jsonp",
    //             data: {
    //                 api_key: disqus_apikey,
    //                 forum: disqus_shortname,
    //                 thread: urlArray
    //             },
    //             cache: false,
    //             dataType: 'jsonp',
    //             success: function (result) {
    //
    //                 for (var i in result.response) {
    //
    //                     var countText = " comments";
    //                     var count = result.response[i].posts;
    //
    //                     if (count == 1)
    //                         countText = " comment";
    //
    //                     $('div[data-disqus-url="' + result.response[i].link + '"]').html('<h4>' + count + countText + '</h4>');
    //
    //                 }
    //             }
    //         });
    //     }
    // }

    /* Setup tooltips
    ------------------------------------------------------------------------ */
    function initTooltips() {
        var mini_menu = $('body[data-default-menu-size="minimized"]'),
            home_item = mini_menu.find('.logo a'),
            menu_item = mini_menu.find('nav.primary > ul > li > a');

        // Default
        $('.tooltip').tooltipster({
            position: 'top',
            speed: 100
        });

        // Site Logo
        home_item.tooltipster({
            position: 'right',
            speed: 100
        });

        // Navigation Links
        menu_item.tooltipster({
            position: 'right',
            speed: 100
        });
    }

    /* Destroy tooltips
    ------------------------------------------------------------------------ */
    function destroyTooltips() {
        var mini_menu = $('body[data-default-menu-size="minimized"]'),
            home_item = mini_menu.find('.logo a'),
            menu_item = mini_menu.find('nav.primary > ul > li > a');

        // Destroy methods
        home_item.tooltipster('destroy');
        menu_item.tooltipster('destroy');
    }

    /* Setup Tag Filters
    ------------------------------------------------------------------------ */
    function initTagFilters() {
        var filter = $('#tag-filter'),
            toggle = filter.find('.toggle'),
            options = filter.find('.options'),
            option = options.find('li');

        if (filter.length) {
            options.hide();
            toggle.click(function () {
                options.slideToggle(100);
            });
            option.click(function () {
                options.slideUp(100);
            });
        }
    }

    /* Outdated Browser Callout
    ------------------------------------------------------------------------ */
    function initOutdatedBrowser() {
        outdatedBrowser({
            bgColor: '#2ebaa5',
            color: '#ffffff',
            lowerThan: 'transform',
            languagePath: theme_dir + '/outdatedbrowser/lang/en.html'
        });
    }

    /* Setup Magnific Popup
    ------------------------------------------------------------------------ */
    function initMagnificPopup() {
        $('.magnific-iframe').magnificPopup({
            type: 'iframe'
        });
    }


    /* =======================================================================================================
     Document Ready Scripts
     ======================================================================================================= */
    $(document).ready(function () {
        initBodyClasses();
        initMenuClasses();
        initMenuIcons();
        initResponsiveVideos();
        initSubmenu();
        initTagFilters();
        // initDisqusComments();
        initOutdatedBrowser();
        getCoordinates();
        initMagnificPopup();

        Responder.query("only screen and (max-width: 959px)", function () {
            destroyDesktopMenuHover();
            destroyTooltips();
        }, false);

        Responder.query("only screen and (max-width: 959px)", function () {
            initMobileAccordion();
        }, true);

        Responder.query("only screen and (min-width: 960px)", function () {
            destroyMobileAccordion();
        }, false);

        Responder.query("only screen and (min-width: 960px)", function () {
            initDesktopMenuHover();
            initTooltips();
        }, true);
    });

    $(window).load(function () {
        inlineSVG();

        if ($('body.home').length < 1) {
            initPreloader();
            initOwlCarousel();
            initSocialOptionsToggle();
            initEqualizeContactTiles();
            initEqualizeCompanyTiles();
        }

    });

    // regular resize, no delay
    $(window).resize(function() {
        // close any tiles that have been expanded
        $('article.expanded .expand').trigger('click');
    });

    // smart resize function with a debouncer
    $(window).smartresize(function () {
            if ($('body.home').length < 1) {
                initEqualizeContactTiles();
                initEqualizeCompanyTiles();
            }
            getCoordinates();
    });

})(jQuery);
