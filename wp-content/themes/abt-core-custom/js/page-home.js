(function ($) {

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

    // Lazy load images a la David Walsh
    // https://davidwalsh.name/lazyload-image-fade
    function autoLazyLoad() {
      [].forEach.call(document.querySelectorAll('noscript'), function(noscript) {
        if (noscript.hasAttribute('data-src')) {
          var img = new Image();
          img.setAttribute('data-src', '');
          noscript.parentNode.insertBefore(img, noscript);
          img.onload = function() {
            img.removeAttribute('data-src');
            img.className = "loaded";
          };
          img.src = noscript.getAttribute('data-src');
        }
      });
    }

    function initHeroVideo() {
      var data_img = $('#bg-video-wrapper').data('poster');
      var data_webm = $('#bg-video-wrapper').data('webm');
      var data_mp4 = $('#bg-video-wrapper').data('mp4');
      var data_ogg = $('#bg-video-wrapper').data('ogg');

      vid_el = '<video class="bg-video" id="bg-video" playsinline mute loop preload="auto" poster="'+data_img+'">';
      vid_el += '<source src="'+data_webm+'" type="video/webm">';
      vid_el += '<source src="'+data_mp4+'" type="video/mp4">';
      vid_el += '<source src="'+data_ogg+'" type="video/ogg">';
      vid_el += '</video>';

      var vid_d = $.Deferred();
      vid_d.resolve( $('#bg-video-wrapper').html(vid_el) );
      $.when(vid_d).done(function() {
        $('#bg-video').on('loadeddata', function() {
          if($('#bg-video')[0].readyState >= 2) {
            $('#bg-video')[0].play();
          }
        });
      });
    }

    // set up controller to reuse
    var controller = new ScrollMagic.Controller();

    // top band header section
    function loadFadeInLeft() {
        $loadFadeInLeftEl = $('.load-fade-in-left');
        if ($loadFadeInLeftEl.length) {
            var loadFadeInLeftTween = new TweenMax.fromTo($loadFadeInLeftEl, .75, {autoAlpha: 0, x:"-100px"}, {x: "0px", autoAlpha: 1, ease: Power2.easeOut, delay: .5, className: "+=loaded"});
        }
    }

    // Fade In Left
    function fadeInLeft() {
        $fadeInLeftEl = $('.fade-in-left');
        if ($fadeInLeftEl.length) {
            $fadeInLeftEl.each(function(){
                var currentTarget = this;
                var tween = new TweenMax.fromTo(currentTarget, .75, {autoAlpha: 0, x:"100px"}, {x: "0px", autoAlpha: 1, ease: Power2.easeOut, className: "+=loaded"});
                var scene = new ScrollMagic.Scene({triggerElement: currentTarget})
                .setTween(tween)
                .reverse(false)
                controller.addScene([scene]);
            });
        }
    }

    // Fade In Right
    function fadeInRight() {
        $fadeInRightEl = $('.fade-in-right');
        if ($fadeInRightEl.length) {
            $fadeInRightEl.each(function(){
                var currentTarget = this;
                var tween = new TweenMax.fromTo(currentTarget, .75, {autoAlpha: 0, x:"-100px"}, {x: "0px", autoAlpha: 1, ease: Power2.easeOut, className: "+=loaded"});
                var scene = new ScrollMagic.Scene({triggerElement: currentTarget})
                .setTween(tween)
                .reverse(false)
                controller.addScene([
                scene
                ]);
            });
        }
    }

    // Fade In Up
    function fadeInUp() {
        $fadeInUpEl = $('.fade-in-up');
        if ($fadeInUpEl.length) {
            $fadeInUpEl.each(function(){
                var currentTarget = this;
                var tween = new TweenMax.fromTo(currentTarget, .75, {autoAlpha: 0, y:"100px"}, {y: "0px", autoAlpha: 1, ease: Power2.easeOut, className: "+=loaded"});
                var scene = new ScrollMagic.Scene({triggerElement: currentTarget})
                .setTween(tween)
                .reverse(false)
                controller.addScene([
                scene
                ]);
            });
        }
    }


    function fadeInUpTriggerNext(target, trigger2, target2, delayTime) {
        $fadeInUpEl = $(target);
        if ($fadeInUpEl.length) {
            $fadeInUpEl.each(function(){
                var currentTarget = this;
                var tween = new TweenMax.fromTo(currentTarget, .75, {autoAlpha: 0, y:"100px"}, {y: "0px", autoAlpha: 1, ease: Power2.easeOut, onComplete: fadeInRightStaggered(trigger2, target2, 0, delayTime), className: "+=loaded"});
                var scene = new ScrollMagic.Scene({triggerElement: currentTarget})
                .setTween(tween)
                .reverse(false)
                controller.addScene([
                scene
                ]);
            });
        }
    }

    // Fade In Down *too jumpy when set up in foreach loop
    function fadeInDown(triggerEl, targetEl) {
        if (triggerEl.length) {
            var fadeInDown = TweenMax.fromTo(targetEl, .75, {autoAlpha: 0, y:"-400px"}, {y: "0px", autoAlpha: 1, ease: Power2.easeOut, className: "+=loaded"});
            var fadeInDownScene = new ScrollMagic.Scene({triggerElement: triggerEl})
            .setTween(fadeInDown)
            .reverse(false)
            .addTo(controller);
        }
    }

    // Fade In Up (staggered)
    function fadeInUpStaggered(triggerEl, targetEl, offsetVal) {
        if (triggerEl.length) {
            var fadeInUpStaggered = TweenMax.staggerFromTo(targetEl, .5, {autoAlpha: 0, y:"100px"}, {y: "0px", autoAlpha: 1, ease: Power2.easeOut, className: "+=loaded"}, 0.15);
            var fadeInUpStaggeredScene = new ScrollMagic.Scene({
              triggerElement: triggerEl,
              //triggerHook: "onEnter",
              //duration: "80%"
              offset: offsetVal
            })
            .setTween(fadeInUpStaggered)
            .reverse(false)
            .addTo(controller);
        }
    }

       // Fade In Right (staggered)
    function fadeInRightStaggered(triggerEl, targetEl, offsetVal, delayStart) {
        if (triggerEl.length) {
            var fadeInRightStaggered = TweenMax.staggerFromTo(targetEl, .5, {autoAlpha: 0, x:"-100px"}, {x: "0px", autoAlpha: 1, ease: Power2.easeOut, delay: delayStart, className: "+=loaded"}, 0.15);
            var fadeInRightStaggeredScene = new ScrollMagic.Scene({
              triggerElement: triggerEl,
              //triggerHook: "onEnter",
              //duration: "80%"
              offset: offsetVal
            })
            .setTween(fadeInRightStaggered)
            .reverse(false)
            .addTo(controller);
        }
    }

    // Slide In Down
    function slideInDown(triggerEl, targetEl) {
        if (triggerEl.length) {
            var slideInDownTween = TweenMax.fromTo(targetEl, .75, {autoAlpha: 0, y:"-200px"}, {y: "0px", autoAlpha: 1, ease: Power2.easeOut, delay: .5, className: "+=loaded"});
            var slideInDownScene = new ScrollMagic.Scene({triggerElement: triggerEl})
            .setTween(slideInDownTween)
            .reverse(false)
            .addTo(controller);
        }
    }

    // Slide In Up
    function slideInUp(triggerEl, targetEl) {
        if (triggerEl.length) {
            var slideInUpTween = TweenMax.fromTo(targetEl, .75, {autoAlpha: 0, y:"200px"}, {y: "0px", autoAlpha: 1, ease: Power2.easeOut, delay: .5, className: "+=loaded"});
            var slideInUpScene = new ScrollMagic.Scene({triggerElement: triggerEl})
            .setTween(slideInUpTween)
            .reverse(false)
            .addTo(controller);
        }
    }

    // Slide In Right
    function slideInRight(triggerEl, targetEl) {
        if (triggerEl.length) {
            var slideInRightTween = TweenMax.fromTo(targetEl, .75, {autoAlpha: 0, x:"200px"}, {x: "0px", autoAlpha: 1, ease: Power2.easeOut, delay: .5, className: "+=loaded"});
            var slideInRightScene = new ScrollMagic.Scene({triggerElement: triggerEl})
            .setTween(slideInRightTween)
            .reverse(false)
            .addTo(controller);
        }
    }

    // Slide In Left
    function slideInLeft(triggerEl, targetEl) {
        if (triggerEl.length) {
            var slideInLeftTween = TweenMax.fromTo(targetEl, .75, {autoAlpha: 0, x:"-200px"}, {x: "0px", autoAlpha: 1, ease: Power2.easeOut, delay: .5, className: "+=loaded"});
            var slideInLeftScene = new ScrollMagic.Scene({triggerElement: triggerEl})
            .setTween(slideInLeftTween)
            .reverse(false)
            .addTo(controller);
        }
    }

    function fadeIn(triggerEl, targetEl, offsetVal) {
        if (triggerEl.length) {
            var fadeInTween = TweenMax.fromTo(targetEl, .75, {autoAlpha: 0}, {autoAlpha: 1, ease: Power2.easeOut, className: "+=loaded"});
            var fadeInScene = new ScrollMagic.Scene({triggerElement: triggerEl, triggerHook: "onLeave", offset: offsetVal})
            .setTween(fadeInTween)
            .reverse(false)
            .addTo(controller);
        }
    }

    function initHomePageVideoButton() {$('.popup-youtube').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });}

    // Slide In Down
    function slideBackground(triggerEl, targetEl) {
        if (triggerEl.length) {
            var tween = TweenMax.fromTo(targetEl, 1, {backgroundPositionY:"50%"}, {backgroundPositionY: "0%"});
            var scene = new ScrollMagic.Scene({triggerElement: triggerEl, triggerHook: "onEnter", duration: '250%'})
            .setTween(tween)
            .addTo(controller);
        }
    }

    function staggerFromToAnim(target, duration, fromX, toX, fromY, toY, fromAlpha, toAlpha, triggerElementId, triggerHookType, delayTime, staggerTime, sceneDuration) {
      var tween = TweenMax.staggerFromTo(target, duration, {autoAlpha: fromAlpha, x: fromX, y:fromY}, {x: toX, y: toY, autoAlpha: toAlpha, ease: Power2.easeOut, delay: delayTime}, staggerTime);
      var scene = new ScrollMagic.Scene({
        triggerElement: triggerElementId,
        triggerHook: triggerHookType,
        duration: sceneDuration
      })
      .setTween(tween)
      .reverse(false)
      .addTo(controller);
    }

    function staggerFrom(target) {
        TweenMax.staggerFrom(target, .5, {x: '-=100px', opacity:0, ease: Power2.easeOut}, 0.15);
    }

    // var slideRight_1 = TweenMax.fromTo(".slide-right-1", 1, {x:"-1000px"}, {x: "0px", ease: Power2.easeOut});
    // var slideRightScene_1 = new ScrollMagic.Scene({triggerElement: "#slide-in-1", triggerHook: "onEnter",  duration: "100%"})
    // .setTween(slideRight_1)
    // .addTo(controller);

    // var slideLeft_1 = TweenMax.fromTo(".slide-left-1", 1, {x:"1000px"}, {x: "0px", ease: Power2.easeOut});
    // var slideLeftScene_1 = new ScrollMagic.Scene({triggerElement: "#slide-in-1", triggerHook: "onEnter",  duration: "100%"})
    // .setTween(slideLeft_1)
    // .addTo(controller);

    // var slideUp_1 = TweenMax.fromTo(".slide-up-1", 1, {y:"800px"}, {y: "0px", ease: Power2.easeOut});
    // var slideUpScene_1 = new ScrollMagic.Scene({triggerElement: "#slide-in-1", triggerHook: "onEnter",  duration: "100%"})
    // .setTween(slideUp_1)
    // .addTo(controller);

    $(document).ready(function () {
        initNewMenu();
        initScrollToSection();
        initHeroVideo();
        initHomePageVideoButton();
        autoLazyLoad();

        //hero video
        //$('.hero-video').outerHeight($(window).height());
        //
        Responder.query("only screen and (min-width: 960px)", function () {

            initHeadRoom();

        }, false);

        Responder.query("only screen and (min-width: 960px)", function () {
            initHeadRoom();

            fadeInLeft();
            loadFadeInLeft();
            fadeInRight();
            fadeInUp();

            fadeInUpStaggered('#innovation-band', '#innovation-band .fade-in-up-staggered', 0);

            // Triangle of Young Talent
            fadeInRightStaggered('#young-talent', '#young-talent .fade-in-right-staggered', 0, .25);

            // A Long Tradition of Invention - brain info graphics
            slideInDown('#infographic-brain', '#infographic-brain .slide-in-down');
            slideInUp('#infographic-brain', '#infographic-brain .slide-in-up');
            slideInRight('#infographic-brain', '#infographic-brain .slide-in-right');
            slideInLeft('#infographic-brain', '#infographic-brain .slide-in-left');

            // A Culture of Diverse Expertise - header & company logos
            fadeInUpStaggered('#company-logos', '#company-logos .fade-in-up-staggered', 0);

            // Quote
            // fadeInUpStaggered('#quote-band', '#quote-band .fade-in-up-staggered', 0);

            // Make Your Mark on RTP
            fadeInUpStaggered('#make-your-mark', '#make-your-mark .fade-in-up-staggered', 0);

            // Upcoming Events - gets call at end of fadeInUpTriggerUpcomingEvents()
            fadeInUpTriggerNext('#header-upcoming-events', '#upcoming-events', '#upcoming-events .fade-in-right-staggered', .35);

            // Social Blocks
            fadeInUpStaggered('#social-outreach', '#social-outreach .fade-in-up-staggered', 0);

            // Quote Parallax
            //parallaxAnim('#quote-band__parallax', '#quote-band', '200%', '80%');
            // slideBackground('#quote-band', '#quote-band');
        }, true);

    });

})(jQuery);
