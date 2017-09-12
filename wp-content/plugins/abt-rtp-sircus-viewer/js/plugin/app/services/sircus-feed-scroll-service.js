SircusFeedViewerApp.service(
    'SircusFeedScrollService',
    [
        '$log',
        '$location',
        '$anchorScroll',
        function ($log, $location, $anchorScroll) {
            // Load state
            var scroll   = {page:0, limit: 5, enabled: true, top: 0, height: 0, topHash: ''};

            function reset() {
                // Load state
                scroll = {page:0, limit: 5, enabled: true, top: 0, height: 0, topHash: ''};

                $location.hash(scroll.topHash);
                $anchorScroll();
            }

            /*
             *
             *      LOADER STATE FUNCTIONS
             *
             */
            function toggle() {
                if (isEnabled() == true) {
                    disable();
                } else {
                    enable();
                }
            }

            function setTop(top){
                scroll.top = top;
            }

            function getTop(){
                return scroll.top;
            }

            function setTopHash(topHash){
                scroll.topHash = topHash;
            }

            function getTopHash(){
                return scroll.topHash;
            }

            function setHeight(height){
                scroll.height = height;
            }

            function getHeight(){
                return scroll.height;
            }

            function enable(){
                scroll.enabled = true;
            }

            function disable() {
                scroll.enabled = false;
            }

            function isEnabled() {
                return scroll.enabled;
            }

            function setLimit(limit) {
                scroll.limit = limit;
            }

            function getLimit() {
                return scroll.limit;
            }

            function incrementPage() {
                scroll.page++;
                if ((scroll.page % getLimit()) == 0) {
                    disable();
                }
            }

            function loadMore() {

            }

            function getPage() {
                return scroll.page;
            }

           function resetPage() {
                scroll.page = 0;
            }


            // List/return public parts
            return({
                resetPage: resetPage,
                getPage: getPage,
                incrementPage: incrementPage,
                getLimit: getLimit,
                setLimit: setLimit,
                isEnabled: isEnabled,
                disable: disable,
                enable: enable,
                toggle: toggle,
                reset: reset,
                setTop: setTop,
                getTop: getTop,
                setHeight: setHeight,
                getHeight: getHeight,
                getTopHash: getTopHash,
                setTopHash: setTopHash,
            });
        }
    ]
);