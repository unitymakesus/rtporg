/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 7/3/14
 * Time: 3:34 PM
 * To change this template use File | Settings | File Templates.
 */
var AbtRtpBannerLib = (function ($) {
    var vars = {
        button  : null,
        message : null,
        elem    : null
    }

    function postFeaturedBannerUpdate(id) {
        vars.button.attr('disabled', 'disabled');
        var payload = {
            action  : 'sircus_action_get',
            type    : 'banner',
            post_id : id
        };

        $.ajax({
            type    : "POST",
            url     : ajaxurl,
            data    : payload,
            success : $.proxy(function(data,stuff,things) { setFeatured(); }, this)
        });
    }

    function setFeatured() {
        vars.button.hide();
        vars.message.show();
    }

    function setNotFeatured() {
        vars.button.show();
        vars.message.hide();
    }

   function init(elem, banner) {
        vars.elem    = elem;
        vars.button  = elem.children('button');
        vars.message = elem.children('p');

        vars.button.html(banner.labels.button);
        vars.message.html(banner.labels.message);

        if (banner.current == banner.featured) {
            setFeatured();
        } else {
            setNotFeatured();
            vars.button.click($.proxy(function(e){
                e.preventDefault();
                postFeaturedBannerUpdate(banner.current);
            }, this));
        }
    }
    return {
        init                     : init,
        setNotFeatured           : setNotFeatured,
        setFeatured              : setFeatured,
        postFeaturedBannerUpdate :  postFeaturedBannerUpdate
    };
})(jQuery);


(function($){
    $(document).ready(function () {
        if (banner) {
            var bannerElement = $('#set-featured-banner');
            AbtRtpBannerLib.init(bannerElement, banner);
        }
    });
})(jQuery);