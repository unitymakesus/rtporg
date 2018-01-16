$(document).ready(function($) {

  function initNewMenu() {

    $container = $('#site-navigation'),
    $container.attr( 'aria-expanded', 'false' ),
    $homeBody = $('body.home');

    $menuToggle = $('.menu-toggle-btn');

    // Primary menu toggle
    $menuToggle.on('click', function(e){
      if($container.hasClass('menu-open')) {
        $container.removeClass('menu-open');
        $homeBody.removeClass('menu-open');
        $menuToggle.attr( 'aria-expanded', 'false' );
        $menuToggle.html('<span>Menu</span>');
        $container.attr( 'aria-expanded', 'false' );
      }
      else {
        $container.addClass('menu-open');
        $homeBody.addClass('menu-open');
        $menuToggle.attr( 'aria-expanded', 'true' );
        $menuToggle.html('<span>Close</span>');
        $container.attr( 'aria-expanded', 'true' );

        // stagger in #primary-menu .menu-item
        staggerFromToAnim('#primary-menu > li', .5, '-10%', '0%', '0', '0', 0, 1, '#primary-menu', 'onEnter', .25, .15, 0);
      }
    });

    // Sub menu toggle
    $siteMenu = $('.site-menu');
    $siteMenu.on('click', '.menu-item-has-children > a', function(e){
      e.preventDefault();
      if($(this).parent().hasClass('menu-item-selected')) {
        $(this).parent().removeClass('menu-item-selected')
        $siteMenu.removeClass('site-menu-sub-open');
      }
      else {
        $('.menu-item-selected').removeClass('menu-item-selected')
        $(this).parent().addClass('menu-item-selected');
        $siteMenu.addClass('site-menu-sub-open');

        staggerFromToAnim('#primary-menu .menu-item-selected > .sub-menu > li', .5, '+10%', '0%', '0', '0', 0, 1, '#primary-menu', 'onEnter', .25, .15, 0);
      }

    });

    // Move footer nav inside main menu container
    $('#menu-footer').remove().find('.menu-item').appendTo('#primary-menu');
  }

  function initHomePageVideoButton() {$('.popup-youtube').magnificPopup({
      disableOn: 700,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,

      fixedContentPos: false
  });}

  /* Headroom
  ------------------------------------------------------------------------ */
  function initHeadRoom() {
    if ($('#masthead.headroom').length) {
      // grab an element
      var myElement = document.querySelector("#masthead");
      // construct an instance of Headroom, passing the element
      headroom  = new Headroom(myElement);
      // initialise
      headroom.init();
    }
  }

  // Lazy load images a la David Walsh
  // https://davidwalsh.name/lazyload-image-fade
  function walshLoad(noscript) {
    if (!noscript.hasClass('gtm')) {
      var img = new Image();
      img.setAttribute('data-src', '');
      noscript.before(img);
      img.onload = function() {
        img.removeAttribute('data-src');
      };
      img.src = noscript.attr('data-src');
      img.alt = noscript.attr('alt');
      if (typeof noscript.attr('height') !== typeof undefined) {
        img.height = noscript.attr('height');
      }
      if (typeof noscript.attr('width') !== typeof undefined) {
        img.width = noscript.attr('width');
        img.setAttribute('style', "max-width: " + noscript.attr('width') + "px;");
      }
      if (typeof noscript.attr('class') !== typeof undefined) {
        img.setAttribute('class', noscript.attr('class'));
      }
      if (typeof noscript.attr('srcset') !== typeof undefined && noscript.attr('srcset') !== false) {
        img.setAttribute('srcset', noscript.attr('srcset'));
      }
    }
  }

  function initScrollToSection() {
    $(".scroll-to-section").click(function() {
      var $target = $(this).data('target'),
      $animationLength = $(this).data('animation-length');
      $('html, body').animate({
        scrollTop: $("#" + $target).offset().top
      }, $animationLength);
      return false;
    });
  }

  AOS.init({
    offset: 100,
    delay: 50
  });

  window.addEventListener('scroll', function() {
      var elem = document.querySelectorAll('#young-talent, #company-logos, #social-outreach');
      let bounding = [];
      for (var x = 0; x < elem.length; x++) {
        bounding.push(elem[x].getBoundingClientRect());
        if (bounding[x].top - $(window).height() <= $(window).height() / 2) {
          var noScriptTag = elem[x].querySelectorAll('noscript');
          for (var i = 0; i < noScriptTag.length; i++) {
             walshLoad($(noScriptTag[i]))
          }
        }
      }
    });

  initNewMenu();
  initScrollToSection();
  initHomePageVideoButton();
  initHeadRoom();
});
