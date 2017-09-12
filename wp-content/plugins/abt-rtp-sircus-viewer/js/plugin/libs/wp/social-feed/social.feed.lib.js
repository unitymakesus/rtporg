/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 7/7/14
 * Time: 4:18 PM
 * To change this template use File | Settings | File Templates.
 */
var SocialFeedLib = (function($,Responder) {

    /*
     * Init the library
     */
    function init(container, initSocialGrid) {
        initSocialGrid(true);

        if ($(window).width() >= 960) {
            initDesktopSocialExpand(container, initSocialGrid);
        } else {
            initMobileSocialExpand(container, initSocialGrid);
        }
    }



    /* Setup desktop social expand
     ------------------------------------------------------------------------ */
    function initDesktopSocialExpand(grid, initSocialGrid) {
        var toggle = grid.find('.expand');

        // Clear any active tiles
        grid.find('article.expanded').removeClass('expanded');

        // Options for tile when clicked
        grid.on('click', 'article .expand', function () {

            var container = $('.st-content'),
                articleW = $(this).parent().outerWidth(),
                articleH = $(this).parent().outerHeight(),
                articleTop = $(this).offset().top,
                expandedW = grid.find('article.expanded').outerWidth(),
                expandedH = expandedW,
                socialGrid =  $(this).parent().parent();
                sectionBottom = socialGrid.outerHeight() + socialGrid.offset().top,
                articleBottom = articleH + articleTop;


            /////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////

            if ($(window).width() >= 960) {
                var socialWidth = $('#social-grid-section').width(),
                      thisLeftPos = Math.round($(this).parent().position().left),
                      thisTopPos = Math.round($(this).parent().position().top),
                      additionalClass = ($(this).parent().hasClass('featured')) ? 'featured' : '';

                    if(articleBottom >= sectionBottom) {
                        thisTopPos = thisTopPos - articleH;
                    } else {
                        // Animate expanded tile to top of screen
                        container.scrollTo($(this).parent(), 1000, {
                            easing: 'easeInOutCubic'
                        });
                    }

                    if($(window).width() > 1280) {
                        positionLimit = 3/4;
                    } else {
                        positionLimit = 2/3;
                    }

                if(thisLeftPos >= Math.round(socialWidth * positionLimit)) {
                    $(this).parent().css({
                        top: thisTopPos,
                        right: 0
                    });
                } else {
                    $(this).parent().css({
                        top: thisTopPos,
                        left: thisLeftPos
                    })
                }

                $(this).parent().after('<div class="social-tile social-placeholder '+additionalClass+'">');

                // Is this expanded or not?
                if ($(this).parent().hasClass('expanded')) {

                    $(this).parent().removeClass('expanded');
                    $(this).parent().css({
                        'top': '',
                        'left': '',
                        'right': ''
                    });
                    $('.social-placeholder').remove();

                } else {

                    grid.find('article.expanded').removeClass('expanded').css({ 'top': '', 'left': '', 'right': '' }).next('.social-placeholder').remove();

                    $(this).parent().addClass('expanded');
                }
            }

            /////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////

           return false;
        });
    }

    /* Setup mobile social expand
     ------------------------------------------------------------------------ */
    function initMobileSocialExpand(grid, initSocialGrid) {

        var toggle = grid.find('.expand');

        // Clear any bindings
//        toggle.unbind('click');

        // Initialize plugin
        toggle.magnificPopup({
            type: 'inline',
            alignTop: true,
            fixedContentPos: true,
            disableOn: function () {
                if ($(window).width() >= 960) {
                    return false;
                }
                return true;
            },
            callbacks: {
                open: function () {
                    // Force fullscreen modal and equalize modal position
                    $('.mfp-wrap').css('overflow-y', 'hidden');
                    $('.mfp-content article').css({
                        'top': 0,
                        'left': 0,
                        'height': ''
                    });

                },
                close: function () {
                    // Reinitialize the grid
                    // initSocialGrid(true);
                }
            }
        });
    }


    /* Setup social tile aspect ratio
     ------------------------------------------------------------------------ */
    function initSocialTileAspectRatio(grid) {
        var article  = grid.find('article.social-tile'),
            articleW = article.not('.featured').not('.expanded').outerWidth();

        article.not('.featured').not('.expanded').each(function(e,i){

            if($(this).outerWidth() < articleW)
                articleW = $(this).outerWidth();

        });

        article.each(function () {
            $(this).css('height', articleW);
        });
    }

    /* Setup social grid
     ------------------------------------------------------------------------ */
   function initSocialGrid(grid, doaspect) {

       grid.isotope({
            layoutMode: 'masonry',
            itemSelector: 'article.social-tile',
            transitionDuration: 0,
            sortBy: 'original-order'
       });

   }

    return {
        init                      : init,
        initDesktopSocialExpand   : initDesktopSocialExpand,
        initMobileSocialExpand    : initMobileSocialExpand,
        initSocialTileAspectRatio : initSocialTileAspectRatio
    };
})(jQuery,Responder);