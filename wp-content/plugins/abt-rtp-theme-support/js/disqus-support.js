/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 7/7/14
 * Time: 3:31 PM
 * To change this template use File | Settings | File Templates.
 */
var DisqusLib = (function($, args) {

    var selectors = {
        embed : '#disqus_thread',
        tiles : '.social-tile.post',
        likes : '.likes'
    }

    var options = {
        apikey    : 'x4yGxe2tyDjtLRnaAF0zDnlUMrjvpmMQ6fn820URcfNHpoVVQDPqCYmFrQxkSRA6',
        shortname : 'rtporg',
        endpoints : {
            list : 'https://disqus.com/api/3.0/threads/set.jsonp'
        }
    }

    var i18n = {
        'Comment'  : 'Comment',
        'Comments' : 'Comments'
    };

    // jQuery DOM objects
    var elements = {};

    /*
     * Setup items/elements
     */
    function initElements() {
        $.each(selectors, $.proxy( function(key, value) {
            elements[key] = $(value);
        }, elements));
    }

    function setI18n(i18nValues) {
        i18n = i18nValues;
    }

    function getI18nOf(key) {
        if (i18n[key])
            return i18n[key];
        else
            return key;
    }

    /* Setup disqus comments
     ------------------------------------------------------------------------ */
    function initComments() {
        if (elements.embed.length > 0) {
            addScripts();
        }
    }

    function addCommentCounts() {
        init();

        if (elements.tiles.length > 0) {
            queryApi();
        }
    }

    function init() {

        initElements();

        if (elements.embed.length > 0) {
            addScripts();
        }

        if (args.i18n)
            setI18n(args.i18n);
    }

    function addScripts() {
        var dsq  = document.createElement('script');
        dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src  = getSource();
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    }

    function getSource() {
        return '//' + options.shortname + '.disqus.com/embed.js';
    }

    function queryApi() {
        var urlArray = [];

        if (elements.tiles.length > 0) {
            elements.likes.each(function () {
                var url = $(this).attr('data-disqus-url');
                urlArray.push('link:' + url);
                $(this).siblings().hide();
            });

            $.ajax({
                type     : 'GET',
                url      : options.endpoints.list,
                data     : { api_key: options.apikey, forum : options.shortname, thread : urlArray },
                cache    : false,
                dataType : 'jsonp',
                success  : $.proxy(function (result) {
                    // Set them all to 0
                    elements.likes.html(constructCommentMarkup(0));

                    // Update counts as appropriate
                    for (var i in result.response) {
                        var count = result.response[i].posts;
                        $('div[data-disqus-url="' + result.response[i].link + '"]').html(constructCommentMarkup(count));
                    }
                }, this)
            });
        }
    }

    function constructCommentMarkup(count) {
        if (count == 1) {
            return '<h4>' + count + ' ' + getI18nOf('Comment') + ' </h4>'
        }

        if (!count) {
            count = 0;
        }

        return '<h4>' + count + ' ' + getI18nOf('Comments') + ' </h4>';
    }

    return {
        addCommentCounts : addCommentCounts
    };
})(jQuery, disqus_data);