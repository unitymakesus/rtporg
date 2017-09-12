SircusFeedViewerApp.service(
    'SircusFeedApiService',
    [   '$http',
        '$log',
        'localStorageService',
        'SircusFeedLocalizedDataService',
        'SircusFeedApiRequestService',
        function ($http, $log, localStorageService, dataService, apiRequestService) {
            function setItemState(action, item, persist) {
                item[action] = true;
                if (persist)
                    localStorageService.set(action + '-' + item.id, true);
            }
            function getItemState(action, item) {
                var state = localStorageService.get(action + '-' + item.id);
                item[action] = state;
                return state;
            }
            function unsetItemState(action, item, persist) {
                item[action] = false;
                if (persist)
                    localStorageService.set(action + '-' + item.id, false);
            }
            function like(item) {
                if (getItemState('like', item) === true ) {
                    return false;
                } else {
                    likeItem(item);
                    return true;
                }
            }
            function unlike(item) {
                unlikeItem(item);
                return true;
            }
            function share(item) {
                if (getItemState('share', item)) {
                    return false;
                } else {
                    shareItem(item);
                    return true;
                }
            }

            function open(item) {
                item.text = item.full_text;
                // If opens always trigger an API Update do this
                return openAndSubmit(item);

                // If opens only trigger an API Update the first time
                // uncomment next line, comment previous return statement
                // return openAndSubmitIfVirgin(item);
            }

            function openAndSubmit(item) {
                // If opens always trigger an API Update do this
                openItem(item);
                return true;
            }

            function openAndSubmitIfVirgin(item) {
                // Opens should only trigger an API update the
                // first time
                if (getItemState('open', item)) {
                    return false;
                } else {
                    openItem(item);
                    return true;
                }
            }

            function close(item) {
                item.text = item.mini_text;
                closeItem(item);
                return true;
            }
            function toggle(item) {
                if (item.open == true) {
                    return close(item);
                } else {
                    return open(item);
                }
            }
            function view(item) {
                if (getItemState('viewed', item)) {
                    return false;
                } else {
                    viewItem(item);
                    return true;
                }
            }
            function doAction(action, item) {
                this[action](item);
            }
            function initItem(item) {
                if(item.type != 'banner' ) {
                    getItemState('like', item);
                    getItemState('open', item);
                    getItemState('share', item);
                    getItemState('view', item);
                }
                return item;
            }
            function initItems(items) {
                if (null === items || angular.isUndefined(items) ||
                    null === items.length || angular.isUndefined(items.length)) {
                    return null;
                }

                return items.map(function (item) {
                    item = initItem(item);
                    return item;
                });
            }
            function likeItem(item) {
                item.likes++;
                setItemState('like', item, true);
                apiRequestService.likeItem(item.id);
            }
            function unlikeItem(item) {
                unsetItemState('like', item, true);
                item.likes = Math.max(item.likes - 1, 0);
                apiRequestService.unlikeItem(item.id);
            }
            function shareItem(item) {
                setItemState('share', item, true);
                apiRequestService.shareItem(item.id);
            }
            function openItem(item) {
                setItemState('open', item, true);
                apiRequestService.openItem(item.id);
            }
            function closeItem(item) {
                unsetItemState('open', item, false);
            }
            function viewItem(item) {
                setItemState('viewed', item, true);
            }
            return ({
                like      : like,
                unlike    : unlike,
                open      : open,
                close     : close,
                toggle    : toggle,
                view      : view,
                share     : share,
                initItem  : initItem,
                initItems : initItems,
                doAction  : doAction
            });
        }
    ]
);