(function ($) {

  "use strict";

  var container = $(document),
      stem_menu = $('#stem-menu'),
      stem_menu_ul = $('#stem-menu ul'),
      stem_links = [];


  // Frontier Menu
  function initSTEMMenu() {
    stem_menu_ul.hide();
    stem_menu.find('h2').click(function() {
      stem_menu.toggleClass('active');
      stem_menu_ul.slideToggle(250);
    });
    stem_menu_ul.append($('#donate-button'));
  }
  function resetSTEMMenu() {
    stem_menu.removeClass('active');
    stem_menu_ul.removeAttr('style');
    stem_menu.find('h2').unbind('click');
    stem_menu_ul.after($('#donate-button'));
  }

  $(document).ready(function () {
    // Mobile
    Responder.query("only screen and (max-width: 639px)", function () {
      initSTEMMenu();
    }, true);
    Responder.query("only screen and (min-width: 640px)", function () {
      resetSTEMMenu();
    }, false);

    // Tablet
    Responder.query("only screen and (min-width: 641px) and (max-width: 959px)", function () {
      stem_menu.siblings('.follow').append($('#donate-button'));
    }, true);
    Responder.query("only screen and (min-width: 960px)", function () {
      stem_menu.siblings('.follow').after($('#donate-button'));
    }, false);
  });


  // Put each of the menu links into array
  stem_menu_ul.children('li:not(:first-child)').each(function() {
    var anchor = $(this).children('a'),
        target = $(anchor.attr('href'));
    stem_links.push(anchor.attr('href'));

    // Scroll to target section on click
    anchor.on('click', function(e) {
      e.preventDefault();
      container.scrollTo(target, 1000, {
          easing: 'easeInOutQuart'
      });
    });
  });

  // Init menu active class
  stem_menu_ul.children('li:first-child').removeClass('current-menu-item').addClass('active');

  // Active tracking on scroll
  container.on('scroll', throttle(function () {
    stem_links.forEach(function(item) {

      var offset = $('a' + item)[0].getBoundingClientRect().top;

      if (offset <= 64) {
        stem_menu_ul.find('a[href="' + item + '"]').parent('li').addClass('active').siblings().removeClass('active');
      }
    });

    var window_scroll = container.scrollTop();

    // Make first item active at top of page
    if (window_scroll <= 1) {
      stem_menu_ul.children('li:first-child').addClass('active').siblings().removeClass('active');
    }
  }, 100));

})(jQuery);
