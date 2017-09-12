SircusFeedViewerApp.service(
    'SircusFeedTransformItemDataService',
    [ '$log',
        function ($log) {
            var regex = /(<([^>]+)>)/ig
            var tileTextLimit = function(html, limit) {
                if (html.length < limit) {
                    // no need to truncate
                    return html;
                }
                var choppedText = html.substring(0, limit);
                // get the next space after the limit
                var nextSpace = html.substring(limit).indexOf(' ');
                if (nextSpace >= 0) {
                    // if there is a space somewhere beyond the limit
                    return html.substring(0,limit + nextSpace);
                } else if ((lastSpace = choppedText.lastIndexOf(' ')) >= 0) {
                    // find the last space before the 120 character limit and return that
                    return choppedText.substring(0, lastSpace);
                }
                return choppedText;
            };
            function createSocialItem(sircusItemData, miniTextLength) {
                // This is a bit of a bandage to bridge the gap between
                // webservice api data format(s) and the more simplistic
                // item data model we want for the partials
                // Create object
                var itemObject = {};

                if (miniTextLength == null || miniTextLength < 1) {
                    miniTextLength = 70;
                }

                // Assign data members
                itemObject.id        = sircusItemData.id;

                if (sircusItemData.fields.item_text) {
                    // set src = http://www.youtube.com/embed/VIDEO_ID
                    var html_code = sircusItemData.fields.item_text;
                    var formatted = html_code
                        .replace('youtube.com/v/', 'youtube.com/embed/')
                        .replace(/(youtube.com.*?\?)(.*)/, '$1showinfo=0&playsinline=1&$2')
                        .replace('<iframe', '<iframe width="560" height="315"');
                    itemObject.full_text = Autolinker.link(formatted, {newWindow: true});
                    var rawText = String(sircusItemData.fields.item_text).replace(regex, '').trim();
                    var miniText = tileTextLimit(rawText, 120);
                    var truncated = miniText.length < rawText.length;
                    miniText = Autolinker.link(miniText, {newWindow: true});
                    if (truncated) {
                        miniText += '&hellip;';
                    }
                    itemObject.mini_text = miniText;
                    itemObject.text      = itemObject.mini_text;
                }

                itemObject.source    = sircusItemData.fields.link;
                itemObject.likes     = Math.max(sircusItemData.fields.like_count, 0);
                itemObject.tags      = sircusItemData.fields.item_tags;
                itemObject.template  = sircusItemData.fields.item_template;
                itemObject.service   = sircusItemData.fields.service;
                itemObject.type      = sircusItemData.fields.type;

                // For now this is using a try/catch to determine if the media
                // field is parsable JSON data or not
                try{
                    itemObject.media = angular.fromJson(sircusItemData.fields.item_media);
                } catch(e) {
                    itemObject.media = sircusItemData.fields.item_media;
                }

                // Handle more complex data transformations

                // Convert author
                if (sircusItemData.fields.item_author != 0) {
                    itemObject.author = angular.fromJson(sircusItemData.fields.item_author);
                } else {
                    itemObject.author = { 'name':'', 'id':'', 'image' : ''};
                }

                // Convert featured
                if (sircusItemData.fields.featured == 1) {
                    // Set featured to text
                    itemObject.featured = 'featured';
                } else {
                    itemObject.featured = 'standard';
                }

                // #34118 - Make youtube (video) 2x1 (featured) size always
                if (sircusItemData.fields.service == 'youtube') {
                    // Set featured to text
                    itemObject.featured = 'featured';
                }

                // #34117 - Make tweets (text-only) 1x1 (standard) size always
                if (sircusItemData.fields.service == 'twitter' && sircusItemData.fields.item_template == 'text') {
                    // Set featured to text
                    itemObject.featured = 'standard';
                }

                // Convert timestamp
                if (sircusItemData.fields.created_ts != 0) {
                    // Gotta multiply those Unix timestamps
                    itemObject.timestamp = sircusItemData.fields.created_ts * 1000;
                } else {
                    itemObject.timestamp = 0;
                }

                // Return item
                return itemObject;
            }
            function createBannerItem(sircusItemData) {
                sircusItemData.type = 'banner';
                return sircusItemData;
            }
            function createItem(sircusItemData,includeBanners) {
                if(sircusItemData.type == 'banner') {
                    if (includeBanners) {
                        return createBannerItem(sircusItemData);
                    } else {
                        return false;
                    }
                }

                return createSocialItem(sircusItemData);
            }
            return ({
                createItem : createItem
            });
        }
    ]
);