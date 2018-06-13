(function ($) {

    "use strict";
    var theme_dir = "/wp-content/themes/abt-core-custom/";

    // Frontier Menu
    function initFrontierMenu() {
        var menu = $('#frontier-menu');

        menu.find('ul').hide();
        menu.find('h2').click(function() {
            menu.toggleClass('active');
            menu.find('ul').slideToggle(250);
        });
    }
    function resetFrontierMenu() {
        var menu = $('#frontier-menu');

        menu.removeClass('active');
        menu.find('ul').removeAttr('style');
        menu.find('h2').unbind('click');
    }

    // Equalize person tiles
    function initEqualizePersonTiles() {
        var people = $('.vcard'),
            name = people.find('.fn');

        if (people.length > 1) {
            people.removeAttr('style').equalHeights();
            name.removeAttr('style').equalHeights();
        }
    }
    function resetEqualizePersonTiles() {
        var people = $('.vcard'),
            name = people.find('.fn');

        if (people.length > 1) {
            people.removeAttr('style');
            name.removeAttr('style');
        }
    }

    $(document).ready(function () {

        Responder.query("only screen and (max-width: 639px)", function () {
            initFrontierMenu();
        }, true);
        Responder.query("only screen and (min-width: 640px)", function () {
            resetFrontierMenu();
        }, false);

    });

    $(window).load(function () {
        Responder.query("only screen and (max-width: 639px)", function () {
            resetEqualizePersonTiles();
        }, false);
        Responder.query("only screen and (min-width: 640px)", function () {
            initEqualizePersonTiles();
        }, true);
    });

    $(window).resize(function () {
        Responder.query("only screen and (min-width: 640px)", function () {
            initEqualizePersonTiles();
        }, true);
    });

})(jQuery);
