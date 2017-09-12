/*
 AngularJS v1.2.16
 (c) 2010-2014 Google, Inc. http://angularjs.org
 License: MIT
*/
(function(p,h,q){'use strict';function E(a){var e=[];s(e,h.noop).chars(a);return e.join("")}function k(a){var e={};a=a.split(",");var d;for(d=0;d<a.length;d++)e[a[d]]=!0;return e}function F(a,e){function d(a,b,d,g){b=h.lowercase(b);if(t[b])for(;f.last()&&u[f.last()];)c("",f.last());v[b]&&f.last()==b&&c("",b);(g=w[b]||!!g)||f.push(b);var l={};d.replace(G,function(a,b,e,c,d){l[b]=r(e||c||d||"")});e.start&&e.start(b,l,g)}function c(a,b){var c=0,d;if(b=h.lowercase(b))for(c=f.length-1;0<=c&&f[c]!=b;c--);
if(0<=c){for(d=f.length-1;d>=c;d--)e.end&&e.end(f[d]);f.length=c}}var b,g,f=[],l=a;for(f.last=function(){return f[f.length-1]};a;){g=!0;if(f.last()&&x[f.last()])a=a.replace(RegExp("(.*)<\\s*\\/\\s*"+f.last()+"[^>]*>","i"),function(b,a){a=a.replace(H,"$1").replace(I,"$1");e.chars&&e.chars(r(a));return""}),c("",f.last());else{if(0===a.indexOf("\x3c!--"))b=a.indexOf("--",4),0<=b&&a.lastIndexOf("--\x3e",b)===b&&(e.comment&&e.comment(a.substring(4,b)),a=a.substring(b+3),g=!1);else if(y.test(a)){if(b=a.match(y))a=
a.replace(b[0],""),g=!1}else if(J.test(a)){if(b=a.match(z))a=a.substring(b[0].length),b[0].replace(z,c),g=!1}else K.test(a)&&(b=a.match(A))&&(a=a.substring(b[0].length),b[0].replace(A,d),g=!1);g&&(b=a.indexOf("<"),g=0>b?a:a.substring(0,b),a=0>b?"":a.substring(b),e.chars&&e.chars(r(g)))}if(a==l)throw L("badparse",a);l=a}c()}function r(a){if(!a)return"";var e=M.exec(a);a=e[1];var d=e[3];if(e=e[2])n.innerHTML=e.replace(/</g,"&lt;"),e="textContent"in n?n.textContent:n.innerText;return a+e+d}function B(a){return a.replace(/&/g,
"&amp;").replace(N,function(a){return"&#"+a.charCodeAt(0)+";"}).replace(/</g,"&lt;").replace(/>/g,"&gt;")}function s(a,e){var d=!1,c=h.bind(a,a.push);return{start:function(a,g,f){a=h.lowercase(a);!d&&x[a]&&(d=a);d||!0!==C[a]||(c("<"),c(a),h.forEach(g,function(d,f){var g=h.lowercase(f),k="img"===a&&"src"===g||"background"===g;!0!==O[g]||!0===D[g]&&!e(d,k)||(c(" "),c(f),c('="'),c(B(d)),c('"'))}),c(f?"/>":">"))},end:function(a){a=h.lowercase(a);d||!0!==C[a]||(c("</"),c(a),c(">"));a==d&&(d=!1)},chars:function(a){d||
c(B(a))}}}var L=h.$$minErr("$sanitize"),A=/^<\s*([\w:-]+)((?:\s+[\w:-]+(?:\s*=\s*(?:(?:"[^"]*")|(?:'[^']*')|[^>\s]+))?)*)\s*(\/?)\s*>/,z=/^<\s*\/\s*([\w:-]+)[^>]*>/,G=/([\w:-]+)(?:\s*=\s*(?:(?:"((?:[^"])*)")|(?:'((?:[^'])*)')|([^>\s]+)))?/g,K=/^</,J=/^<\s*\//,H=/\x3c!--(.*?)--\x3e/g,y=/<!DOCTYPE([^>]*?)>/i,I=/<!\[CDATA\[(.*?)]]\x3e/g,N=/([^\#-~| |!])/g,w=k("area,br,col,hr,img,wbr");p=k("colgroup,dd,dt,li,p,tbody,td,tfoot,th,thead,tr");q=k("rp,rt");var v=h.extend({},q,p),t=h.extend({},p,k("address,article,aside,blockquote,caption,center,del,dir,div,dl,figure,figcaption,footer,h1,h2,h3,h4,h5,h6,header,hgroup,hr,ins,map,menu,nav,ol,pre,script,section,table,ul")),
u=h.extend({},q,k("a,abbr,acronym,b,bdi,bdo,big,br,cite,code,del,dfn,em,font,i,img,ins,kbd,label,map,mark,q,ruby,rp,rt,s,samp,small,span,strike,strong,sub,sup,time,tt,u,var")),x=k("script,style"),C=h.extend({},w,t,u,v),D=k("background,cite,href,longdesc,src,usemap"),O=h.extend({},D,k("abbr,align,alt,axis,bgcolor,border,cellpadding,cellspacing,class,clear,color,cols,colspan,compact,coords,dir,face,headers,height,hreflang,hspace,ismap,lang,language,nohref,nowrap,rel,rev,rows,rowspan,rules,scope,scrolling,shape,size,span,start,summary,target,title,type,valign,value,vspace,width")),
n=document.createElement("pre"),M=/^(\s*)([\s\S]*?)(\s*)$/;h.module("ngSanitize",[]).provider("$sanitize",function(){this.$get=["$$sanitizeUri",function(a){return function(e){var d=[];F(e,s(d,function(c,b){return!/^unsafe/.test(a(c,b))}));return d.join("")}}]});h.module("ngSanitize").filter("linky",["$sanitize",function(a){var e=/((ftp|https?):\/\/|(mailto:)?[A-Za-z0-9._%+-]+@)\S*[^\s.;,(){}<>]/,d=/^mailto:/;return function(c,b){function g(a){a&&m.push(E(a))}function f(a,c){m.push("<a ");h.isDefined(b)&&
(m.push('target="'),m.push(b),m.push('" '));m.push('href="');m.push(a);m.push('">');g(c);m.push("</a>")}if(!c)return c;for(var l,k=c,m=[],n,p;l=k.match(e);)n=l[0],l[2]==l[3]&&(n="mailto:"+n),p=l.index,g(k.substr(0,p)),f(n,l[0].replace(d,"")),k=k.substring(p+l[0].length);g(k);return a(m.join(""))}}])})(window,window.angular);
//# sourceMappingURL=angular-sanitize.min.js.map

/* ng-infinite-scroll - v1.0.0 - 2013-02-23 */
var mod;mod=angular.module("infinite-scroll",[]),mod.directive("infiniteScroll",["$rootScope","$window","$timeout",function(i,n,e){return{link:function(t,l,o){var r,c,f,a;return n=angular.element(n),f=0,null!=o.infiniteScrollDistance&&t.$watch(o.infiniteScrollDistance,function(i){return f=parseInt(i,10)}),a=!0,r=!1,null!=o.infiniteScrollDisabled&&t.$watch(o.infiniteScrollDisabled,function(i){return a=!i,a&&r?(r=!1,c()):void 0}),c=function(){var e,c,u,d;return d=n.height()+n.scrollTop(),e=l.offset().top+l.height(),c=e-d,u=n.height()*f>=c,u&&a?i.$$phase?t.$eval(o.infiniteScroll):t.$apply(o.infiniteScroll):u?r=!0:void 0},n.on("scroll",c),t.$on("$destroy",function(){return n.off("scroll",c)}),e(function(){return o.infiniteScrollImmediateCheck?t.$eval(o.infiniteScrollImmediateCheck)?c():void 0:c()},0)}}}]);
(function() {
/* Start angularLocalStorage */
'use strict';
var angularLocalStorage = angular.module('LocalStorageModule', []);

angularLocalStorage.provider('localStorageService', function() {
  
  // You should set a prefix to avoid overwriting any local storage variables from the rest of your app
  // e.g. localStorageServiceProvider.setPrefix('youAppName');
  // With provider you can use config as this:
  // myApp.config(function (localStorageServiceProvider) {
  //    localStorageServiceProvider.prefix = 'yourAppName';
  // });
  this.prefix = 'ls';

  // You could change web storage type localstorage or sessionStorage
  this.storageType = 'localStorage';

  // Cookie options (usually in case of fallback)
  // expiry = Number of days before cookies expire // 0 = Does not expire
  // path = The web path the cookie represents
  this.cookie = {
    expiry: 30,
    path: '/'
  };

  // Send signals for each of the following actions?
  this.notify = {
    setItem: true,
    removeItem: false
  };

  // Setter for the prefix
  this.setPrefix = function(prefix) {
    this.prefix = prefix;
  };

   // Setter for the storageType
   this.setStorageType = function(storageType) {
       this.storageType = storageType;
   };

  // Setter for cookie config
  this.setStorageCookie = function(exp, path) {
    this.cookie = {
      expiry: exp,
      path: path
    };
  };

  // Setter for cookie domain
  this.setStorageCookieDomain = function(domain) {
    this.cookie.domain = domain;
  };

  // Setter for notification config
  // itemSet & itemRemove should be booleans
  this.setNotify = function(itemSet, itemRemove) {
    this.notify = {
      setItem: itemSet,
      removeItem: itemRemove
    };
  };



  this.$get = ['$rootScope', '$window', '$document', function($rootScope, $window, $document) {

    var prefix = this.prefix;
    var cookie = this.cookie;
    var notify = this.notify;
    var storageType = this.storageType;
    var webStorage;

    // When Angular's $document is not available
    if (!$document) {
      $document = document;
    }

    // If there is a prefix set in the config lets use that with an appended period for readability
    if (prefix.substr(-1) !== '.') {
      prefix = !!prefix ? prefix + '.' : '';
    }
    var deriveQualifiedKey = function(key) {
      return prefix + key;
    }
    // Checks the browser to see if local storage is supported
    var browserSupportsLocalStorage = (function () {
      try {
        var supported = (storageType in $window && $window[storageType] !== null);

        // When Safari (OS X or iOS) is in private browsing mode, it appears as though localStorage
        // is available, but trying to call .setItem throws an exception.
        //
        // "QUOTA_EXCEEDED_ERR: DOM Exception 22: An attempt was made to add something to storage
        // that exceeded the quota."
        var key = deriveQualifiedKey('__' + Math.round(Math.random() * 1e7));
        if (supported) {
          webStorage = $window[storageType];
          webStorage.setItem(key, '');
          webStorage.removeItem(key);
        }

        return supported;
      } catch (e) {
        storageType = 'cookie';
        $rootScope.$broadcast('LocalStorageModule.notification.error', e.message);
        return false;
      }
    }());
    


    // Directly adds a value to local storage
    // If local storage is not available in the browser use cookies
    // Example use: localStorageService.add('library','angular');
    var addToLocalStorage = function (key, value) {

      // If this browser does not support local storage use cookies
      if (!browserSupportsLocalStorage) {
        $rootScope.$broadcast('LocalStorageModule.notification.warning', 'LOCAL_STORAGE_NOT_SUPPORTED');
        if (notify.setItem) {
          $rootScope.$broadcast('LocalStorageModule.notification.setitem', {key: key, newvalue: value, storageType: 'cookie'});
        }
        return addToCookies(key, value);
      }

      // Let's convert undefined values to null to get the value consistent
      if (typeof value === "undefined") {
        value = null;
      }

      try {
        if (angular.isObject(value) || angular.isArray(value)) {
          value = angular.toJson(value);
        }
        if (webStorage) {webStorage.setItem(deriveQualifiedKey(key), value)};
        if (notify.setItem) {
          $rootScope.$broadcast('LocalStorageModule.notification.setitem', {key: key, newvalue: value, storageType: this.storageType});
        }
      } catch (e) {
        $rootScope.$broadcast('LocalStorageModule.notification.error', e.message);
        return addToCookies(key, value);
      }
      return true;
    };

    // Directly get a value from local storage
    // Example use: localStorageService.get('library'); // returns 'angular'
    var getFromLocalStorage = function (key) {

      if (!browserSupportsLocalStorage) {
        $rootScope.$broadcast('LocalStorageModule.notification.warning','LOCAL_STORAGE_NOT_SUPPORTED');
        return getFromCookies(key);
      }

      var item = webStorage ? webStorage.getItem(deriveQualifiedKey(key)) : null;
      // angular.toJson will convert null to 'null', so a proper conversion is needed
      // FIXME not a perfect solution, since a valid 'null' string can't be stored
      if (!item || item === 'null') {
        return null;
      }

      if (item.charAt(0) === "{" || item.charAt(0) === "[") {
        return angular.fromJson(item);
      }

      return item;
    };

    // Remove an item from local storage
    // Example use: localStorageService.remove('library'); // removes the key/value pair of library='angular'
    var removeFromLocalStorage = function (key) {
      if (!browserSupportsLocalStorage) {
        $rootScope.$broadcast('LocalStorageModule.notification.warning', 'LOCAL_STORAGE_NOT_SUPPORTED');
        if (notify.removeItem) {
          $rootScope.$broadcast('LocalStorageModule.notification.removeitem', {key: key, storageType: 'cookie'});
        }
        return removeFromCookies(key);
      }

      try {
        webStorage.removeItem(deriveQualifiedKey(key));
        if (notify.removeItem) {
          $rootScope.$broadcast('LocalStorageModule.notification.removeitem', {key: key, storageType: this.storageType});
        }
      } catch (e) {
        $rootScope.$broadcast('LocalStorageModule.notification.error', e.message);
        return removeFromCookies(key);
      }
      return true;
    };

    // Return array of keys for local storage
    // Example use: var keys = localStorageService.keys()
    var getKeysForLocalStorage = function () {

      if (!browserSupportsLocalStorage) {
        $rootScope.$broadcast('LocalStorageModule.notification.warning', 'LOCAL_STORAGE_NOT_SUPPORTED');
        return false;
      }

      var prefixLength = prefix.length;
      var keys = [];
      for (var key in webStorage) {
        // Only return keys that are for this app
        if (key.substr(0,prefixLength) === prefix) {
          try {
            keys.push(key.substr(prefixLength));
          } catch (e) {
            $rootScope.$broadcast('LocalStorageModule.notification.error', e.Description);
            return [];
          }
        }
      }
      return keys;
    };

    // Remove all data for this app from local storage
    // Also optionally takes a regular expression string and removes the matching key-value pairs
    // Example use: localStorageService.clearAll();
    // Should be used mostly for development purposes
    var clearAllFromLocalStorage = function (regularExpression) {

      regularExpression = regularExpression || "";
      //accounting for the '.' in the prefix when creating a regex
      var tempPrefix = prefix.slice(0, -1);
      var testRegex = new RegExp(tempPrefix + '.' + regularExpression);

      if (!browserSupportsLocalStorage) {
        $rootScope.$broadcast('LocalStorageModule.notification.warning', 'LOCAL_STORAGE_NOT_SUPPORTED');
        return clearAllFromCookies();
      }

      var prefixLength = prefix.length;

      for (var key in webStorage) {
        // Only remove items that are for this app and match the regular expression
        if (testRegex.test(key)) {
          try {
            removeFromLocalStorage(key.substr(prefixLength));
          } catch (e) {
            $rootScope.$broadcast('LocalStorageModule.notification.error',e.message);
            return clearAllFromCookies();
          }
        }
      }
      return true;
    };

    // Checks the browser to see if cookies are supported
    var browserSupportsCookies = function() {
      try {
        return navigator.cookieEnabled ||
          ("cookie" in $document && ($document.cookie.length > 0 ||
          ($document.cookie = "test").indexOf.call($document.cookie, "test") > -1));
      } catch (e) {
          $rootScope.$broadcast('LocalStorageModule.notification.error', e.message);
          return false;
      }
    };

    // Directly adds a value to cookies
    // Typically used as a fallback is local storage is not available in the browser
    // Example use: localStorageService.cookie.add('library','angular');
    var addToCookies = function (key, value) {

      if (typeof value === "undefined") {
        return false;
      }

      if (!browserSupportsCookies()) {
        $rootScope.$broadcast('LocalStorageModule.notification.error', 'COOKIES_NOT_SUPPORTED');
        return false;
      }

      try {
        var expiry = '',
            expiryDate = new Date(),
            cookieDomain = '';

        if (value === null) {
          // Mark that the cookie has expired one day ago
          expiryDate.setTime(expiryDate.getTime() + (-1 * 24 * 60 * 60 * 1000));
          expiry = "; expires=" + expiryDate.toGMTString();
          value = '';
        } else if (cookie.expiry !== 0) {
          expiryDate.setTime(expiryDate.getTime() + (cookie.expiry * 24 * 60 * 60 * 1000));
          expiry = "; expires=" + expiryDate.toGMTString();
        }
        if (!!key) {
          var cookiePath = "; path=" + cookie.path;
          if(cookie.domain){
            cookieDomain = "; domain=" + cookie.domain;
          }
          $document.cookie = deriveQualifiedKey(key) + "=" + encodeURIComponent(value) + expiry + cookiePath + cookieDomain;
        }
      } catch (e) {
        $rootScope.$broadcast('LocalStorageModule.notification.error',e.message);
        return false;
      }
      return true;
    };

    // Directly get a value from a cookie
    // Example use: localStorageService.cookie.get('library'); // returns 'angular'
    var getFromCookies = function (key) {
      if (!browserSupportsCookies()) {
        $rootScope.$broadcast('LocalStorageModule.notification.error', 'COOKIES_NOT_SUPPORTED');
        return false;
      }

      var cookies = $document.cookie && $document.cookie.split(';') || [];
      for(var i=0; i < cookies.length; i++) {
        var thisCookie = cookies[i];
        while (thisCookie.charAt(0) === ' ') {
          thisCookie = thisCookie.substring(1,thisCookie.length);
        }
        if (thisCookie.indexOf(deriveQualifiedKey(key) + '=') === 0) {
          return decodeURIComponent(thisCookie.substring(prefix.length + key.length + 1, thisCookie.length));
        }
      }
      return null;
    };

    var removeFromCookies = function (key) {
      addToCookies(key,null);
    };

    var clearAllFromCookies = function () {
      var thisCookie = null, thisKey = null;
      var prefixLength = prefix.length;
      var cookies = $document.cookie.split(';');
      for(var i = 0; i < cookies.length; i++) {
        thisCookie = cookies[i];
        
        while (thisCookie.charAt(0) === ' ') {
          thisCookie = thisCookie.substring(1, thisCookie.length);
        }

        var key = thisCookie.substring(prefixLength, thisCookie.indexOf('='));
        removeFromCookies(key);
      }
    };

    var getStorageType = function() {
      return storageType;
    };

    var bindToScope = function(scope, key, def) {
      var value = getFromLocalStorage(key);

      if (value === null && angular.isDefined(def)) {
        value = def;
      } else if (angular.isObject(value) && angular.isObject(def)) {
        value = angular.extend(def, value);
      }

      scope[key] = value;

      scope.$watchCollection(key, function(newVal) {
        addToLocalStorage(key, newVal);
      });
    };

    return {
      isSupported: browserSupportsLocalStorage,
      getStorageType: getStorageType,
      set: addToLocalStorage,
      add: addToLocalStorage, //DEPRECATED
      get: getFromLocalStorage,
      keys: getKeysForLocalStorage,
      remove: removeFromLocalStorage,
      clearAll: clearAllFromLocalStorage,
      bind: bindToScope,
      deriveKey: deriveQualifiedKey,
      cookie: {
        set: addToCookies,
        add: addToCookies, //DEPRECATED
        get: getFromCookies,
        remove: removeFromCookies,
        clearAll: clearAllFromCookies
      }
    };
  }];
});
}).call(this);


(function(window, document) {

// Create all modules and define dependencies to make sure they exist
// and are loaded in the correct order to satisfy dependency injection
// before all nested files are concatenated by Grunt

// Config
angular.module('iso.config', [])
    .value('iso.config', {
        debug: true
    });

// Modules
angular.module('iso.directives', ['iso.services']);
angular.module('iso.services', []);
angular.module('iso',
    [
        'iso.config',
        'iso.directives',
        'iso.services'
    ]);


angular.module("iso.controllers", ["iso.config", "iso.services"])
.controller("angularIsotopeController", [
  "iso.config", "iso.topics", "$scope", "$timeout", "optionsStore", function(config, topics, $scope, $timeout, optionsStore) {
    "use strict";
    var buffer, initEventHandler, isoMode, isotopeContainer, methodHandler, onLayoutEvent, optionsHandler, postInitialized, scope;
    onLayoutEvent = "isotope.onLayout";
    postInitialized = false;
    isotopeContainer = null;
    buffer = [];
    scope = "";
    isoMode = "";
    $scope.$on(onLayoutEvent, function(event) {});
    $scope.layoutEventEmit = function($elems, instance) {
      return $timeout(function() {
        return $scope.$apply(function() {
          return $scope.$emit(onLayoutEvent);
        });
      });
    };
    optionsStore.store({
      onLayout: $scope.layoutEventEmit
    });
    initEventHandler = function(fun, evt, hnd) {
      if (evt) {
        return fun.call($scope, evt, hnd);
      }
    };
    $scope.delayInit = function(isoInit) {
      optionsStore.storeInit(isoInit);
    };
    $scope.delayedInit = function() {
      var isoInit = optionsStore.retrieveInit();
      $scope.init(isoInit);
    };

    $scope.$on('iso-init', function() {
      $scope.delayedInit();
    });
    $scope.init = function(isoInit) {
      optionsStore.storeInit(isoInit);
      isotopeContainer = isoInit.element;
      initEventHandler($scope.$on, isoInit.isoOptionsEvent || topics.MSG_OPTIONS, optionsHandler);
      initEventHandler($scope.$on, isoInit.isoMethodEvent || topics.MSG_METHOD, methodHandler);
      $scope.isoMode = isoInit.isoMode || "addItems";
      return $timeout(function() {
        var opts = optionsStore.retrieve();

        if (!(window.jQuery && isotopeContainer.isotope(opts)))
        {
            // create jqLite wrapper
            var instance = new Isotope(isotopeContainer[0], opts);

            isotopeContainer.isotope = function(options, callback) {
                var args = Array.prototype.slice.call( arguments, 1 );
                if ( typeof options === 'string' ) {
                    return(instance[options].apply(instance, args));
                } else {
                    instance.option( options );
                    instance._init( callback );
                }
           }
        }

        postInitialized = true;
      });
    };
    $scope.setIsoElement = function($element) {
      if (postInitialized) {
        return $timeout(function() {
          return isotopeContainer.isotope($scope.isoMode, $element);
        });
      }
    };
    $scope.refreshIso = function() {
      if (postInitialized) {
        return isotopeContainer.isotope();
      }
    };
    $scope.updateOptions = function(option) {
      if (isotopeContainer) {
        isotopeContainer.isotope(option);
      } else {
        optionsStore.store(option);
      }
    };
    $scope.updateMethod = function(name, params, cb) {
      return isotopeContainer.isotope(name, params, cb);
    };
    optionsHandler = function(event, option) {
      return $scope.updateOptions(option);
    };
    methodHandler = function(event, option) {
      var name, params;
      name = option.name;
      params = option.params;
      return $scope.updateMethod(name, params, null);
    };

    $scope.removeAll = function(cb) {
      return isotopeContainer.isotope("remove", isotopeContainer.data("isotope").$allAtoms, cb);
    };
    $scope.refresh = function() {
      return isotopeContainer.isotope();
    };
    $scope.$on(config.refreshEvent, function() {
      return $scope.refreshIso();
    });
    $scope.$on(topics.MSG_REMOVE, function(message, element) {
      return $scope.removeElement(element);
    });
    $scope.$on(topics.MSG_OPTIONS, function(message, options) {
      return optionsHandler(message, options);
    });
    $scope.$on(topics.MSG_METHOD, function(message, opt) {
      return methodHandler(message, opt);
    });
    $scope.removeElement = function(element) {
      return isotopeContainer && isotopeContainer.isotope("remove", element);
    };
  }
])
.controller("isoSortByDataController", [
  "iso.config", "$scope", "optionsStore", function(config, $scope, optionsStore) {
    var getValue, reduce;
    $scope.getHash = function(s) {
      return "opt" + s;
    };
    $scope.storeMethods = function(methods) {
      return optionsStore.store({
        getSortData: methods
      });
    };
    $scope.optSortData = function(index, item) {
      var $item, elementSortData, fun, genSortDataClosure, selector, sortKey, type;
      elementSortData = {};
      $item = angular.element(item);
      selector = $item.attr("ok-sel");
      type = $item.attr("ok-type");
      sortKey = $scope.getHash(selector);
      fun = ($item.attr("opt-convert") ? eval_("[" + $item.attr("opt-convert") + "]")[0] : null);
      genSortDataClosure = function(selector, type, convert) {
        return function($elem) {
          return getValue(selector, $elem, type, convert);
        };
      };
      elementSortData[sortKey] = genSortDataClosure(selector, type, fun);
      return elementSortData;
    };
    $scope.createSortByDataMethods = function(elem) {
      var options, sortDataArray;
      options = $(elem);
      sortDataArray = reduce(options.map($scope.optSortData));
      return sortDataArray;
    };
    reduce = function(list) {
      var reduction;
      reduction = {};
      angular.forEach(list, function(item, index) {
        return angular.extend(reduction, item);
      });
      return reduction;
    };
    getValue = function(selector, $elem, type, evaluate) {
      var getText, item, text, toType, val;
      getText = function($elem, item, selector) {
        var text;
        if (!item.length) {
          return $elem.text();
        }
        text = "";
        switch (selector.charAt(0)) {
          case "#":
            text = item.text();
            break;
          case ".":
            text = item.text();
            break;
          case "[":
            text = item.attr(selector.replace("[", "").replace("]", "").split()[0]);
        }
        return text;
      };
      toType = function(text, type) {
        var numCheck, utility;
        numCheck = function(val) {
          if (isNaN(val)) {
            return Number.POSITIVE_INFINITY;
          } else {
            return val;
          }
        };
        utility = {
          text: function(s) {
            return s.toString();
          },
          integer: function(s) {
            return numCheck(parseInt(s, 10));
          },
          float: function(s) {
            return numCheck(parseFloat(s));
          },
          boolean: function(s) {
            return "true" === s;
          }
        };
        if (utility[type]) {
          return utility[type](text);
        } else {
          return text;
        }
      };
      item = $elem.find(selector);
      text = getText($elem, item, selector);
      val = toType(text, type);
      if (evaluate) {
        return evaluate(val);
      } else {
        return val;
      }
    };
  }
]);
angular.module("iso.directives", ["iso.config", "iso.services", "iso.controllers"]);

angular.module("iso.directives")
.directive("isotopeContainer", ["$injector", "$parse", function($injector, $parse) {
    "use strict";
    var options;
    options = {};
    return {
      controller: "angularIsotopeController",
      link: function(scope, element, attrs) {
        var isoInit, isoOptions, linkOptions;
        linkOptions = [];
        isoOptions = attrs.isoOptions;
        isoInit = {};
        if (isoOptions) {
          linkOptions = $parse(isoOptions)(scope);
          if (angular.isObject(linkOptions)) {
            scope.updateOptions(linkOptions);
          }
        }
        isoInit.element = element;
        isoInit.isoOptionsEvent = attrs.isoOptionsSubscribe;
        isoInit.isoMethodEvent = attrs.isoMethodSubscribe;
        isoInit.isoMode = attrs.isoMode;
        if (attrs.isoUseInitEvent === "true") {
          scope.delayInit(isoInit);
        } else {
          scope.init(isoInit);
        }
        return element;
      }
    };
  }
])
.directive("isotopeItem", [
  "$rootScope", "iso.config", "iso.topics", "$timeout", function($rootScope, config, topics, $timeout) {
    return {
      restrict: "A",
      require: "^isotopeContainer",
      link: function(scope, element, attrs) {

        scope.setIsoElement(element);
        scope.$on('$destroy', function(message) {
          $rootScope.$broadcast(topics.MSG_REMOVE, element);
        });
        if (attrs.ngRepeat && true === scope.$last && "addItems" === scope.isoMode) {
          element.ready(function() {
            return $timeout((function() {
              return scope.refreshIso();
            }), config.refreshDelay || 0);
          });
        }
        if (!attrs.ngRepeat) {
          element.ready(function() {
            return $timeout((function() {
              return scope.refreshIso();
            }), config.refreshDelay || 0);
          });          
        }
        return element;
      }
    };
  }
])
.directive("isoSortbyData", function() {
    return {
      restrict: "A",
      controller: "isoSortByDataController",
      link: function(scope, element, attrs) {
        var methSet, methods, optEvent, optKey, optionSet, options;
        optionSet = angular.element(element);
        optKey = optionSet.attr("ok-key");
        optEvent = "iso-opts";
        options = {};
        methSet = optionSet.find("[ok-sel]");
        methSet.each(function(index) {
          var $this;
          $this = angular.element(this);
          return $this.attr("ok-sortby-key", scope.getHash($this.attr("ok-sel")));
        });
        methods = scope.createSortByDataMethods(methSet);
        return scope.storeMethods(methods);
      }
    };
  }
)
.directive("optKind", ['optionsStore', 'iso.topics', function(optionsStore, topics) {
  return {
    restrict: "A",
    controller: "isoSortByDataController",
    link: function(scope, element, attrs) {
      var createSortByDataMethods, createOptions, doOption, emitOption, optKey, optPublish, methPublish, optionSet, determineAciveClass, activeClass, activeSelector, active;
      optionSet = $(element);
      optPublish = attrs.okPublish || attrs.okOptionsPublish || topics.MSG_OPTIONS;
      methPublish = attrs.okMethodPublish || topics.MSG_METHOD;
      optKey = optionSet.attr("ok-key");

      determineActiveClass = function() {
        activeClass = attrs.okActiveClass;
        if (!activeClass) {
          activeClass = optionSet.find(".selected").length ? "selected" : "active";
        }
        activeSelector = "." + activeClass;
        active = optionSet.find(activeSelector);
      };

      createSortByDataMethods = function(optionSet) {
        var methSet, methods, optKey, options;
        optKey = optionSet.attr("ok-key");
        if (optKey !== "sortBy") {
          return;
        }
        options = {};
        methSet = optionSet.find("[ok-sel]");
        methSet.each(function(index) {
          var $this;
          $this = angular.element(this);
          return $this.attr("ok-sortby-key", scope.getHash($this.attr("ok-sel")));
        });
        methods = scope.createSortByDataMethods(methSet);
        return scope.storeMethods(methods);
      };

      createOptions = function(item) {
        var ascAttr, key, option, virtualSortByKey;
        if (item) {
          option = {};
          virtualSortByKey = item.attr("ok-sortby-key");
          ascAttr = item.attr("opt-ascending");
          key = virtualSortByKey || item.attr("ok-sel");
          if (virtualSortByKey) {
            option.sortAscending = (ascAttr ? ascAttr === "true" : true);
          }
          option[optKey] = key;
          return option;
        }
      };

      emitOption = function(option) {
        optionsStore.store(option);
        return scope.$emit(optPublish, option);
      };

      doOption = function(event) {
        var selItem;
        event.preventDefault();
        selItem = angular.element(event.target);
        if (selItem.hasClass(activeClass)) {
          return false;
        }
        optionSet.find(activeSelector).removeClass(activeClass);
        selItem.addClass(activeClass);
        emitOption(createOptions(selItem));
        return false;
      };

      determineActiveClass();
      
      createSortByDataMethods(optionSet);

      if (active.length) {
        var opts = createOptions(active);
        optionsStore.store(opts);
      }

      return optionSet.on("click", function(event) {
        return doOption(event);
      });
    }
  };
}]);
angular.module("iso.services", ["iso.config"], [
  '$provide', function($provide) {
    return $provide.factory("optionsStore", [
      "iso.config", function(config) {
        "use strict";
        var storedOptions, delayedInit;
        storedOptions = config.defaultOptions || {};
        return {
          store: function(option) {
            angular.extend(storedOptions, option);
            return storedOptions;
          },
          retrieve: function() {
            return storedOptions;
          },
          storeInit: function(init) {
            delayedInit = init;
          },
          retrieveInit: function() {
            return delayedInit;
          }
        };
      }
    ]);
  }
])
.value('iso.topics', {
  MSG_OPTIONS:'iso-option',
  MSG_METHOD:'iso-method',
  MSG_REMOVE:'iso-remove'
});
})(window, document);
/*!
 * Autolinker.js
 * 0.12.2
 *
 * Copyright(c) 2014 Gregory Jacobs <greg@greg-jacobs.com>
 * MIT Licensed. http://www.opensource.org/licenses/mit-license.php
 *
 * https://github.com/gregjacobs/Autolinker.js
 */
!function(a,b){"function"==typeof define&&define.amd?define(b):"undefined"!=typeof exports?module.exports=b():a.Autolinker=b()}(this,function(){var a=function(b){a.Util.assign(this,b)};return a.prototype={constructor:a,urls:!0,email:!0,twitter:!0,newWindow:!0,stripPrefix:!0,className:"",htmlCharacterEntitiesRegex:/(&nbsp;|&#160;|&lt;|&#60;|&gt;|&#62;)/gi,matcherRegex:function(){var a=/(^|[^\w])@(\w{1,15})/,b=/(?:[\-;:&=\+\$,\w\.]+@)/,c=/(?:[A-Za-z]{3,9}:(?:\/\/)?)/,d=/(?:www\.)/,e=/[A-Za-z0-9\.\-]*[A-Za-z0-9\-]/,f=/\.(?:international|construction|contractors|enterprises|photography|productions|foundation|immobilien|industries|management|properties|technology|christmas|community|directory|education|equipment|institute|marketing|solutions|vacations|bargains|boutique|builders|catering|cleaning|clothing|computer|democrat|diamonds|graphics|holdings|lighting|partners|plumbing|supplies|training|ventures|academy|careers|company|cruises|domains|exposed|flights|florist|gallery|guitars|holiday|kitchen|neustar|okinawa|recipes|rentals|reviews|shiksha|singles|support|systems|agency|berlin|camera|center|coffee|condos|dating|estate|events|expert|futbol|kaufen|luxury|maison|monash|museum|nagoya|photos|repair|report|social|supply|tattoo|tienda|travel|viajes|villas|vision|voting|voyage|actor|build|cards|cheap|codes|dance|email|glass|house|mango|ninja|parts|photo|shoes|solar|today|tokyo|tools|watch|works|aero|arpa|asia|best|bike|blue|buzz|camp|club|cool|coop|farm|fish|gift|guru|info|jobs|kiwi|kred|land|limo|link|menu|mobi|moda|name|pics|pink|post|qpon|rich|ruhr|sexy|tips|vote|voto|wang|wien|wiki|zone|bar|bid|biz|cab|cat|ceo|com|edu|gov|int|kim|mil|net|onl|org|pro|pub|red|tel|uno|wed|xxx|xyz|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cw|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sx|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|za|zm|zw)\b/,g=/(?:[\-A-Za-z0-9+&@#\/%?=~_()|!:,.;]*[\-A-Za-z0-9+&@#\/%=~_()|])?/;return new RegExp(["(",a.source,")","|","(",b.source,e.source,f.source,")","|","(","(?:","(?:",c.source,e.source,")","|","(?:","(.?//)?",d.source,e.source,")","|","(?:","(.?//)?",e.source,f.source,")",")",g.source,")"].join(""),"gi")}(),invalidProtocolRelMatchRegex:/^[\w]\/\//,charBeforeProtocolRelMatchRegex:/^(.)?\/\//,link:function(b){var c=this,d=this.getHtmlParser(),e=this.htmlCharacterEntitiesRegex,f=0,g=[];return d.parse(b,{processHtmlNode:function(a,b,c){"a"===b&&(c?f=Math.max(f-1,0):f++),g.push(a)},processTextNode:function(b){if(0===f)for(var d=a.Util.splitAndCapture(b,e),h=0,i=d.length;i>h;h++){var j=d[h],k=c.processTextNode(j);g.push(k)}else g.push(b)}}),g.join("")},getHtmlParser:function(){var b=this.htmlParser;return b||(b=this.htmlParser=new a.HtmlParser),b},getTagBuilder:function(){var b=this.tagBuilder;return b||(b=this.tagBuilder=new a.AnchorTagBuilder({newWindow:this.newWindow,truncate:this.truncate,className:this.className})),b},processTextNode:function(b){var c=this,d=this.charBeforeProtocolRelMatchRegex;return b.replace(this.matcherRegex,function(b,e,f,g,h,i,j,k){var l,m=e,n=f,o=g,p=h,q=i,r=j||k,s="",t="";if(!c.isValidMatch(m,p,q,r))return b;if(c.matchHasUnbalancedClosingParen(b)&&(b=b.substr(0,b.length-1),t=")"),p)l=new a.match.Email({matchedText:b,email:p});else if(m)n&&(s=n,b=b.slice(1)),l=new a.match.Twitter({matchedText:b,twitterHandle:o});else{if(r){var u=r.match(d)[1]||"";u&&(s=u,b=b.slice(1))}l=new a.match.Url({matchedText:b,url:b,protocolRelativeMatch:r,stripPrefix:c.stripPrefix})}var v=c.createMatchReturnVal(l,b);return s+v+t})},isValidMatch:function(a,b,c,d){return a&&!this.twitter||b&&!this.email||c&&!this.urls||c&&-1===c.indexOf(".")||c&&/^[A-Za-z]{3,9}:/.test(c)&&!/:.*?[A-Za-z]/.test(c)||d&&this.invalidProtocolRelMatchRegex.test(d)?!1:!0},matchHasUnbalancedClosingParen:function(a){var b=a.charAt(a.length-1);if(")"===b){var c=a.match(/\(/g),d=a.match(/\)/g),e=c&&c.length||0,f=d&&d.length||0;if(f>e)return!0}return!1},createMatchReturnVal:function(b,c){var d;if(this.replaceFn&&(d=this.replaceFn.call(this,this,b)),"string"==typeof d)return d;if(d===!1)return c;if(d instanceof a.HtmlTag)return d.toString();var e=this.getTagBuilder(),f=e.build(b);return f.toString()}},a.link=function(b,c){var d=new a(c);return d.link(b)},a.match={},a.Util={abstractMethod:function(){throw"abstract"},assign:function(a,b){for(var c in b)b.hasOwnProperty(c)&&(a[c]=b[c]);return a},extend:function(b,c){var d=b.prototype,e=function(){};e.prototype=d;var f;f=c.hasOwnProperty("constructor")?c.constructor:function(){d.constructor.apply(this,arguments)};var g=f.prototype=new e;return g.constructor=f,g.superclass=d,delete c.constructor,a.Util.assign(g,c),f},ellipsis:function(a,b,c){return a.length>b&&(c=null==c?"..":c,a=a.substring(0,b-c.length)+c),a},indexOf:function(a,b){if(Array.prototype.indexOf)return a.indexOf(b);for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return c;return-1},splitAndCapture:function(a,b){if(!b.global)throw new Error("`splitRegex` must have the 'g' flag set");for(var c,d=[],e=0;c=b.exec(a);)d.push(a.substring(e,c.index)),d.push(c[0]),e=c.index+c[0].length;return d.push(a.substring(e)),d}},a.HtmlParser=a.Util.extend(Object,{htmlRegex:function(){var a=/[0-9a-zA-Z:]+/,b=/[^\s\0"'>\/=\x01-\x1F\x7F]+/,c=/(?:".*?"|'.*?'|[^'"=<>`\s]+)/,d=b.source+"(?:\\s*=\\s*"+c.source+")?";return new RegExp(["<(?:!|(/))?","("+a.source+")","(?:","\\s+","(?:",d,"|",c.source+")",")*","\\s*/?",">"].join(""),"g")}(),parse:function(a,b){b=b||{};for(var c,d=b.processHtmlNode||function(){},e=b.processTextNode||function(){},f=this.htmlRegex,g=0;null!==(c=f.exec(a));){var h=c[0],i=c[2],j=!!c[1],k=a.substring(g,c.index);k&&e(k),d(h,i,j),g=c.index+h.length}if(g<a.length){var l=a.substring(g);l&&e(l)}}}),a.HtmlTag=a.Util.extend(Object,{whitespaceRegex:/\s+/,constructor:function(b){a.Util.assign(this,b),this.innerHtml=this.innerHtml||this.innerHTML},setTagName:function(a){return this.tagName=a,this},getTagName:function(){return this.tagName||""},setAttr:function(a,b){var c=this.getAttrs();return c[a]=b,this},getAttr:function(a){return this.getAttrs()[a]},setAttrs:function(b){var c=this.getAttrs();return a.Util.assign(c,b),this},getAttrs:function(){return this.attrs||(this.attrs={})},setClass:function(a){return this.setAttr("class",a)},addClass:function(b){for(var c,d=this.getClass(),e=this.whitespaceRegex,f=a.Util.indexOf,g=d?d.split(e):[],h=b.split(e);c=h.shift();)-1===f(g,c)&&g.push(c);return this.getAttrs()["class"]=g.join(" "),this},removeClass:function(b){for(var c,d=this.getClass(),e=this.whitespaceRegex,f=a.Util.indexOf,g=d?d.split(e):[],h=b.split(e);g.length&&(c=h.shift());){var i=f(g,c);-1!==i&&g.splice(i,1)}return this.getAttrs()["class"]=g.join(" "),this},getClass:function(){return this.getAttrs()["class"]||""},hasClass:function(a){return-1!==(" "+this.getClass()+" ").indexOf(" "+a+" ")},setInnerHtml:function(a){return this.innerHtml=a,this},getInnerHtml:function(){return this.innerHtml||""},toString:function(){var a=this.getTagName(),b=this.buildAttrsStr();return b=b?" "+b:"",["<",a,b,">",this.getInnerHtml(),"</",a,">"].join("")},buildAttrsStr:function(){if(!this.attrs)return"";var a=this.getAttrs(),b=[];for(var c in a)a.hasOwnProperty(c)&&b.push(c+'="'+a[c]+'"');return b.join(" ")}}),a.AnchorTagBuilder=a.Util.extend(Object,{constructor:function(b){a.Util.assign(this,b)},build:function(b){var c=new a.HtmlTag({tagName:"a",attrs:this.createAttrs(b.getType(),b.getAnchorHref()),innerHtml:this.processAnchorText(b.getAnchorText())});return c},createAttrs:function(a,b){var c={href:b},d=this.createCssClass(a);return d&&(c["class"]=d),this.newWindow&&(c.target="_blank"),c},createCssClass:function(a){var b=this.className;return b?b+" "+b+"-"+a:""},processAnchorText:function(a){return a=this.doTruncate(a)},doTruncate:function(b){return a.Util.ellipsis(b,this.truncate||Number.POSITIVE_INFINITY)}}),a.match.Match=a.Util.extend(Object,{constructor:function(b){a.Util.assign(this,b)},getType:a.Util.abstractMethod,getMatchedText:function(){return this.matchedText},getAnchorHref:a.Util.abstractMethod,getAnchorText:a.Util.abstractMethod}),a.match.Email=a.Util.extend(a.match.Match,{getType:function(){return"email"},getEmail:function(){return this.email},getAnchorHref:function(){return"mailto:"+this.email},getAnchorText:function(){return this.email}}),a.match.Twitter=a.Util.extend(a.match.Match,{getType:function(){return"twitter"},getTwitterHandle:function(){return this.twitterHandle},getAnchorHref:function(){return"https://twitter.com/"+this.twitterHandle},getAnchorText:function(){return"@"+this.twitterHandle}}),a.match.Url=a.Util.extend(a.match.Match,{urlPrefixRegex:/^(https?:\/\/)?(www\.)?/i,protocolRelativeRegex:/^\/\//,checkForProtocolRegex:/^[A-Za-z]{3,9}:/,getType:function(){return"url"},getUrl:function(){var a=this.url;return this.protocolRelativeMatch||this.checkForProtocolRegex.test(a)||(a=this.url="http://"+a),a},getAnchorHref:function(){var a=this.getUrl();return a.replace(/&amp;/g,"&")},getAnchorText:function(){var a=this.getUrl();return this.protocolRelativeMatch&&(a=this.stripProtocolRelativePrefix(a)),this.stripPrefix&&(a=this.stripUrlPrefix(a)),a=this.removeTrailingSlash(a)},stripUrlPrefix:function(a){return a.replace(this.urlPrefixRegex,"")},stripProtocolRelativePrefix:function(a){return a.replace(this.protocolRelativeRegex,"")},removeTrailingSlash:function(a){return"/"===a.charAt(a.length-1)&&(a=a.slice(0,-1)),a}}),a});
/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/3/14
 * Time: 4:01 PM
 * To change this template use File | Settings | File Templates.
 */
var SircusFeedViewerApp = angular.module('SircusFeedViewer', ['LocalStorageModule', 'infinite-scroll', 'ngSanitize', 'iso.directives']);

SircusFeedViewerApp.config(['localStorageServiceProvider', function (localStorageServiceProvider) {
    localStorageServiceProvider.setPrefix('sircus-viewer');

    // localStorageServiceProvider.setStorageCookieDomain('rtp.org');
    // localStorageServiceProvider.setStorageType('sessionStorage');
}]);

// set the configuration
SircusFeedViewerApp.run(['$rootScope', 'SircusFeedLocalizedDataService', function ($scope, dataService) {

    var $data = [];

    if (angular.isUndefined(sircus_data) || null === sircus_data )
        $data  = [];
    else
        $data  = sircus_data;

    dataService.init($data);

    $scope.dataService = dataService;


}]);
/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/5/14
 * Time: 1:48 PM
 * To change this template use File | Settings | File Templates.
 */
SircusFeedViewerApp.filter( 'i18n', ['SircusFeedI18nService', function (i18n) {
    return function(input) {
        if (i18n.has(input))
            return i18n.get(input);
        else
            return input;
    };
}]);
/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/5/14
 * Time: 1:48 PM
 * To change this template use File | Settings | File Templates.
 */
SircusFeedViewerApp.filter( 'imageuri', ['SircusFeedUrlService', function (urlService) {
    return function(input) {
        return urlService.getPluginUrl('/images/'+input);
    };
}]);
angular.module('SircusFeedViewer').service('isotopeService', function() {
    return {
        trigger: function(scope) {
            scope.$emit('iso-option', {
                layoutMode: 'masonry',
                itemSelector: 'article.social-tile',
                transitionDuration: 0,
                sortBy: 'original-order'
            });
        }
    }
});

SircusFeedViewerApp.service(
    'SircusFeedApiRequestService',
    [
        '$http',
        '$log',
        'localStorageService',
        'SircusFeedLocalizedDataService',
        'SircusFeedTransformRequestService',
        function ($http, $log, localStorageService, dataService, transformRequestService) {
            function getApiActionUrl(itemId, action) {
                if (angular.isUndefined(itemId) || null === itemId)
                    return false;

                if (angular.isUndefined(action) || null === action)
                    return false;

                return dataService.get('api_url') + '/' + itemId + '/' + action;
            }
            function getApiToken() {
                return dataService.get('api_key');
            }
            function apiItemAction(itemId, action) {
                var actionUrl = getApiActionUrl(itemId, action);

                if (!actionUrl)
                    return false;

                var request = $http({
                    method : 'POST',
                    url    : getApiActionUrl(itemId, action),
                    data   : { api_token : getApiToken() },
                    transformRequest: function(obj) { return transformRequestService.transformRequest(obj); },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                });

                return( request.then(handleSuccess, handleError ));
            }
            function likeItem(itemId) {
                apiItemAction(itemId, 'like');
            }
            function unlikeItem(itemId) {
                apiItemAction(itemId, 'unlike');
            }
            function shareItem(itemId) {
                apiItemAction(itemId, 'share');
            }
            function openItem(itemId) {
                apiItemAction(itemId, 'open');
            }
            function handleError(response) {
                $log.log(response);
            }
            function handleSuccess(response) {
                //$log.log(response.data);
            }
            return ({
                likeItem : likeItem,
                unlikeItem : unlikeItem,
                shareItem : shareItem,
                openItem : openItem
            });
        }
    ]
);
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
SircusFeedViewerApp.service(
    'SircusFeedI18nService',
    [   '$rootScope', '$http', '$log', 'SircusFeedLocalizedDataService',
        function ($scope, $http, $log, $dataService) {
            // This doesn't use Angular's translation service
            // We're letting WordPress handle all the translation
            // This is just a connector for that
            return({
                get : get,
                has : has
            });
            function get(key) {
                $i18n = $dataService.get('i18n');
                return $i18n[key];
            }
            function has(key) {
                var $data = $dataService.get('i18n');

                if (angular.isUndefined($data) || null === $data)
                    return false;

                if (angular.isUndefined($data[key]) || null === $data[key])
                    return true;
                else
                    return false;
            }
        }
    ]
);
SircusFeedViewerApp.service(
    'SircusFeedLocalizedDataService',
    [
        '$http',
        '$log',
        function($http, $log) {
            var $data = [];
            return({
                init : init,
                get : get,
                has : has,
                set : set
            });
            function init(data){
                $data = data;
            }
            function set(key, value){
                $data[key] = value;
            }
            function has(key){
                if (angular.isUndefined($data[key]) || null === $data[key])
                    return true;
                else
                    return false;
            }
            function get(key) {
                return $data[key];
            }
        }
    ]
);
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
SircusFeedViewerApp.service(
    'SircusFeedService',
    [   '$http', '$q', '$log', 'SircusFeedLocalizedDataService',
        function($http, $q, $log, $dataService) {
            /* PRIVATE PARTS */

            var private = [];

            function init() {
                private = [];

                // Internally maintained cursor (for next page of results)
                private.cursor = false;

                // Items Per Page
                private.limit  = 4;

                // Is this service waiting on a current request?
                private.waiting = false;

                // Is this service exhausted / finished?
                private.finished = false;

                // What field / mechanism to order by?
                private.orderby = 'rank';

                // What order? (asc or desc)
                private.order = 'asc';

                private.tag = false;

                private.promise = null;

                private.requests = 0;

                private.type = 'list';

                private.query = '';

                private.page = 1;

                private.total = 0;
            }

            function isFinished() {
                return private.finished;
            }

            function isWaiting() {
                return private.waiting;
            }

            function resetCursor() {
                return false;
            }

            function getLimit() {
                return private.limit;
            }

            function setLimit(num) {
                private.limit = num;
            }

            function getOrderBy() {
                return private.orderby;
            }

            function setOrderBy(obString) {
                private.orderby = obString;
            }

            function getOrder() {
                return private.order;
            }

            function setOrder(oString) {
                private.order = oString;
            }

            function getTag() {
                return private.tag;
            }

            function setTag(oString) {
                private.tag = oString;
            }

            function getCursor() {
                return private.cursor;
            }

            function setCursor(val) {
                private.cursor = val;
            }

            function getTotal() {
                return private.total;
            }

            function getPageCount() {
                return Math.ceil(getTotal() / getLimit());
            }

            function isCursorMatch(newCursor) {
                return newCursor == private.cursor;
            }

            function setPage(page){
                private.page = page;
            }

            function getPage(){
                return private.page;
            }

            function setType(type){
                private.type = type;
            }

            function getType(){
                return private.type;
            }

            function setQuery(query){
                private.query = query;
            }

            function getQuery(){
                return private.query;
            }

            // Response handling
            function handleError(response) {
                private.waiting = false;
                $log.log(response);
                return( $q.reject( "Something went wrong" ) );
            }

            function getItemsFromResponse(response) {
                try {
                    return response.data.data;
                } catch(e) {
                    return {};
                }
            }

            function getCursorFromResponse(response) {
                try {
                    return response.data.meta.cursor;
                } catch(e) {
                    private.finished = true;
                    return false;
                }
            }

            function handlePaginationState(response) {
                var newCursor = getCursorFromResponse(response);
                if(isCursorMatch(newCursor)) {
                    private.finished = true;
                } else {
                    setCursor(newCursor);
                }

                if (response.data.meta.total !== 'undefined' && response.data.meta.total !== null)
                    private.total = response.data.meta.total;
            }

            function handleSuccess(response) {
                $log.log(response.data);
                handlePaginationState(response);
                private.waiting = false;
                return getItemsFromResponse(response);
            }


            function generatePayload() {
                if (getType() == 'search')
                    return generateSearchPayload();

                return generateListPayload();
            }

            function generateListPayload() {
                // Setup payload
                // This is wordpress specific
                // and would need to be replaced if porting to
                // other platforms
                var payload = {
                    action      : 'sircus_action_get',
                    type        : 'list',
                    format      : 'json',
                    limit       : getLimit(),
                    skip_banner : 0
                };

                // Add cursor to payload if set
                var cursor = getCursor();

                if (cursor) {
                    payload.cursor = cursor;
                } else {
                    payload.banner = 1;
                }

                var tag = getTag();

                if (tag) {
                    payload.tag = getTag();
                }

                return payload;
            }

            function generateSearchPayload() {
                // Setup payload
                // This is wordpress specific
                // and would need to be replaced if porting to
                // other platforms
                var payload = {
                    action      : 'sircus_action_get',
                    type        : 'search',
                    format      : 'json',
                    limit       : getLimit(),
                    start       : ((getPage()-1) * getLimit()),
                    query       : getQuery(),
                    skip_banner : 1
                };

                return payload;
            }

            /* PUBLIC PARTS */

            // Trigger the api call & return results
            // Be sure to call hasMoreItems() if using this
            // inside a loop or other situations where
            // getItems may be called repeatedly (i.e. recursive funcs)
            function getItems(options) {

                if (this.isFinished()) {
                    return false;
                }

                if (this.isWaiting()) {
                    return false;
                }

                private.waiting = true;

                var deferredAbort = $q.defer();

                var request = $http({
                    method : 'POST',
                    url    : $dataService.get('ajax_url'),
                    params : generatePayload()
                });

                // Using http://www.bennadel.com/blog/2616-aborting-ajax-requests-using-http-and-angularjs.htm as
                // guidance
                private.promise  =  request.then(handleSuccess, handleError);

                private.promise.abort = function() {
                    deferredAbort.resolve();
                    return [];
                };

                private.promise.finally(
                    function() {
                        promise.abort = angular.noop;
                        deferredAbort = request = promise = null;
                    }
                );


                return private.promise;
            }

            function abort() {
                return (private.promise && private.promise.abort());
            }


            function ready() {
                var deferred = $.Deferred();
                var id = setInterval(function() {
                    private.requests++;
                    //$log.log('FeedService Requests ' + private.requests);
                    if(!private.waiting) {
                        clearInterval(id);
                        deferred.resolve();
                    }
                }, 1000);
                return deferred.promise();
            }

            init();

            // List/return public parts
            return({
                ready        : ready,
                abort        : abort,
                waiting      : private.waiting,
                finished     : private.finished,
                setPage      : setPage,
                getPage      : getPage,
                setType      : setType,
                getType      : getType,
                setQuery     : setQuery,
                getQuery     : getQuery,
                getItems     : getItems,
                getLimit     : getLimit,
                setLimit     : setLimit,
                getOrderBy   : getOrderBy,
                setOrderBy   : setOrderBy,
                getOrder     : getOrder,
                setOrder     : setOrder,
                getTag       : getTag,
                setTag       : setTag,
                getTotal     : getTotal,
                getPageCount : getPageCount,
                isFinished   : isFinished,
                isWaiting    : isWaiting,
                reset        : init,
                init         : init
            });

        }
    ]
);
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
SircusFeedViewerApp.service(
    'SircusFeedTransformRequestService',
    [
        '$log',
        'localStorageService',
        'SircusFeedLocalizedDataService',
        function ($log, localStorageService, dataService) {
            function transformRequest(obj) {
                var str = [];
                for (var key in obj) {
                    if (obj[key] instanceof Array) {
                        for(var idx in obj[key]){
                            var subObj = obj[key][idx];
                            for(var subKey in subObj){
                                str.push(
                                    encodeURIComponent(key) +
                                    "[" +
                                    idx +
                                    "][" +
                                    encodeURIComponent(subKey) +
                                    "]=" +
                                    encodeURIComponent(subObj[subKey])
                                );
                            }
                        }
                    }
                    else {
                        str.push(encodeURIComponent(key) + "=" + encodeURIComponent(obj[key]));
                    }
                }
                return str.join("&");
            }
            return ({
                transformRequest : transformRequest
            });
        }
    ]
);
SircusFeedViewerApp.service(
    'SircusFeedUrlService',
    [
        '$log',
        'SircusFeedLocalizedDataService',
        function ($log, dataService) {
            return({
                getSiteUrl     : getSiteUrl,
                getThemeUrl    : getThemeUrl,
                getPluginUrl   : getPluginUrl,
                getPartialUrl  : getPartialUrl,
                getAjaxUrl     : getAjaxUrl,
                getItemsApiUrl : getItemsApiUrl
            });
            function getItemsApiUrl(asset) {
                return getUrl('api_url', asset);
            }
            function getSiteUrl(asset){
                return getUrl('site_url', asset);
            }
            function getThemeUrl(asset) {
                return getUrl('theme_url', asset);
            }
            function getPluginUrl(asset) {
                return getUrl('plugin_url', asset);
            }
            function getPartialUrl(asset) {
                return getUrl('partials_url', asset);
            }
            function getAjaxUrl(asset) {
                return getUrl('ajax_url', asset);
            }
            function getUrl(key,asset){
                return dataService.get(key) + asset;
            }
        }
    ]
);
angular.module('SircusFeedViewer').filter('stripHtml', function() {
        return function(text) {
            return String(text).replace(/<[^>]+>/gm, '');
        }
    }
);
angular.module('SircusFeedViewer').service('svgCache', function() {
        var SVG_CACHE = {};
        var SVG_CALLBACK = {};
        var SVG_LOCK = {};

        return {
            has: function(src) {
                return !!SVG_CACHE[src];
            },
            setSrc: function(src, data) {
                SVG_CACHE[src] = data;
            },
            getSrc: function(src) {
                return SVG_CACHE[src];
            },
            load: function(src, callback) {
                // if (SVG_CACHE[src]) {
                //     callback(SVG_CACHE[src])
                // } else {
                //     if (SVG_LOCK[src]) {
                //         if (!SVG_CALLBACK[src]) {
                //             SVG_CALLBACK[src] = [];
                //         }
                //         SVG_CALLBACK[src].push(callback);
                //     } else {
                //         SVG_LOCK[src] = true;
                        $.get(src, function(data) {
                            var result = $(data).find('svg');
                            result.removeAttr('xmlns:a');
                            SVG_CACHE[src] = result.clone();
                            SVG_LOCK[src] = false;
                            callback(result.clone());
                            if (SVG_CALLBACK[src]) {
                                for (i in SVG_CALLBACK[src]) {
                                    SVG_CALLBACK[src][i](result.clone());
                                }
                            }
                        })
                //     }
                // }
            }
        };
    }
);
angular.module('SircusFeedViewer').controller('SetCtrl', function($scope) {
    $scope.collapseAll = function() {
        angular.forEach($scope.set.items, function(feedItem, index) {
            feedItem.isExpanded = false;
        });
    }

    $scope.setItemExpanded = function(item) {
        angular.forEach($scope.set.items, function(feedItem, index) {
            if (feedItem.id != item.id) {
                feedItem.open = false;
            }
        });
    }
})
SircusFeedViewerApp.controller(
    'SircusFeedController',
    [   '$scope',
        '$sce',
        '$log',
        '$http',
        'SircusFeedService',
        'SircusFeedUrlService',
        'SircusFeedLocalizedDataService',
        'SircusFeedI18nService',
        'SircusFeedApiService',
        'SircusFeedTransformItemDataService',
        'SircusFeedLocalizedDataService',
        function($scope, $sce, $log, $http,feedService, urlService, dataService,
                 i18n, sircusApi, transformItemDataService, localStorageService) {
            // Set items, this is the social items + banners
            $scope.sets = [];

            // Arguments
            $scope.args = [];

            // Number of items per page of results
            $scope.limit = dataService.get('page_limit');

            // Feed Service handling all your requests to the API
            $scope.feedService = feedService;

            // Should I wait or should I go now?
            $scope.wait = false;


            /*          ITEMS           */

            // Clear out item array
            $scope.resetItems = function() {
                $scope.sets = [];
            }

            /*
             * Insert the items into the social feed
             */
            $scope.insertItems = function(items) {
                var resultSet = {items: []};
                // If there are items...
                // Initialize them
                items = sircusApi.initItems(items);
                // Add each item to the items list
                angular.forEach(items,function(item) {
                    var itemObject = sircusApi.initItem(transformItemDataService.createItem(item,false));
                    if (itemObject) {
                        if (itemObject.type == 'banner') {
                            resultSet.banner = itemObject;
                        } else {
                            resultSet.items.push(itemObject);
                        }
                    }

                });

                $scope.sets.push(resultSet);
            }

            /*
             * Get initial social feed items from new stream
             */
            $scope.renewItems = function() {
                // Reset all the things
                // Loader, tag, limit, feedService, etc
                $scope.feedService.reset();
                $scope.resetItems();

                $scope.feedService.setLimit($scope.limit);
                $scope.feedService.setType('search');
                $scope.feedService.setPage(1);
                $scope.feedService.setQuery('');

                $scope.wait = true;

                $scope.loadItemsFromFeed();
            }


            /*
             * Get social feed items, insert into the social feed
             */
            $scope.getItems = function() {
                $scope.wait = true;
                $scope.feedService.ready().then( function() {
                    if($scope.feedService.isFinished()) {
                        return;
                    }

                    $scope.feedService.setLimit($scope.limit);

                    $scope.loadItemsFromFeed();
                });
            }

            /*          FEED            */

            /*
             * Get items from the feed, update app
             */
            $scope.loadItemsFromFeed = function() {
                // TODO: Can we abort all feedservice promises to
                // ensure this request executes immediately???
                $scope.feedService.getItems().then(
                    function( items ) {
                        $scope.insertItems(items);
                        $scope.wait = false;
                    }
                );
            }

            /*
             * Is
            $scope.feedIsWaiting = function() {
                return $scope.feedService.isWaiting();
            }

            /*
             * Has the feed been exhausted
             */
            $scope.feedIsFinished = function() {
                return $scope.feedService.isFinished();
            }

            /* Based on http://stackoverflow.com/questions/16155542/dynamically-displaying-template-in-ng-repeat-directive-in-angularjs
             * Determine which partial to use for the given item.
             */
            $scope.getItemPartial = function(item) {
                if ( item.type == 'banner' ) {
                    return $scope.constructBannerPartialUrl(item.display_type);
                }

                return $scope.constructItemPartialUrl(item.template, item.featured);
            }


            /*
             * Construct partial URL for social item
             */
            $scope.constructItemPartialUrl = function(type,status) {
                // We can build this out to be more updatable / configurable later if need be
                // i.e. have WP localize template lookup data array
                if (status === 'featured') {
                    //$log.log(urlService.getPartialUrl('/social-tiles/tile-' + type + '-featured.html'));
                    return urlService.getPartialUrl('/social-tiles/tile-' + type + '-featured.html');
                } else {
                    //$log.log(urlService.getPartialUrl('/social-tiles/tile-' + type + '.html'));
                    return urlService.getPartialUrl('/social-tiles/tile-' + type + '.html');
                }
            }

            /*
             * Returns the class for item articles
             */
            $scope.getClass = function(item) {
                // TODO: Refactoring
                // TODO: itemClasses should be array, classes pushed to array
                // TODO: Return array.join(' ')
                // TODO: allow another function argument so that item classes can be passed in / appended
                var itemClasses = ' source-sircus ';

                if (item.type == 'item') {
                    if (item.showOptions) {
                        itemClasses += 'show-options ';
                    }
                    var template = 'type-' + item.template;
                    var featured = item.featured;
                    var service  = 'service-' + item.service;
                    // This is a workaround. Design provides styling for type-hybrid, but not type-video
                    if (item.template == 'video' ) {
                        template = 'type-hybrid type-video';
                    }

                    itemClasses += ' source-sircus social-tile hentry ' + template + ' ' +  featured  + ' ' + service;
                } else {
                    // For now it's safe to assume this is a banner
                    itemClasses += ' featured-banner-item ';
                }

                return itemClasses;
            }

            /*
             * Given HTML from the feed? Render it.
             */
            $scope.renderHtml = function(html_code) {
                try {
                    return $sce.trustAsHtml(html_code);
                } catch (e) {
                    $log.log('scope.renderHtml is unable to parse html code');
                    return '';
                }
            }

            /*
             * Social Item Interaction -- Trigger action
             */
            $scope.triggerAction = function(action,item) {
                sircusApi.doAction(action,item);
            }

            /*
             * Initialize the controller
             */
            $scope.init = function(args) {
                $scope.args = args;

                // TODO: Ugly for now, cleanup later
                // Number of items per page of results
                if (args.limit){
                    $scope.limit = args.limit;
                }

                if (args.page){
                    $scope.page  = args.page;
                }

                if (!args.page) {
                    $scope.query = args.query;
                }

                $scope.renewItems();
            }
        }
    ]
);
SircusFeedViewerApp.controller(
    'SircusFeedListController',
    [   '$scope',
        '$sce',
        '$log',
        '$http',
        'SircusFeedScrollService',
        'SircusFeedService',
        'SircusFeedUrlService',
        'SircusFeedLocalizedDataService',
        'SircusFeedI18nService',
        'SircusFeedApiService',
        'SircusFeedTransformItemDataService',
        'SircusFeedLocalizedDataService',
        '$timeout',
        function($scope, $sce, $log, $http,
                 scrollService, feedService, urlService, dataService,
                 i18n, sircusApi, transformItemDataService, localStorageService, $timeout) {
            // Set items, this is the social items + banners
            $scope.sets = [];
            // assume 3 column layout, unless Responder query fires
            $scope.pageColumnCount = 3;
            Responder.query("only screen and (min-width: 1280px)", function () {
                // CSS is set to do 4 columns
                $scope.pageColumnCount = 4;
            }, true);

            // Number of items per page of results
            $scope.limit = dataService.get('page_limit');

            // Feed Service handling all your requests to the API
            $scope.feedService = feedService;

            // Should I wait or should I go now?
            $scope.wait = false;

            // Scroll state (for infinite scroll)
            $scope.scroll = scrollService;

            // Tag management
            $scope.tags     = dataService.get('tags');
            $scope.tag      = false;

            $scope.op = 'list';

           /*           TAGS            */

            /*
             * Reset tag state
             */
            $scope.resetTags = function() {
                // Tag management
                $scope.tags     = dataService.get('tags');
                $scope.tag      = false;
            }

            $scope.notBanners = function(object) {
                return object.type != 'banner';
            }

            /*
             * Handle tag changes
             */
            $scope.changeTag = function(newTag) {
                // Update the internal tag value
                if($scope.tags.indexOf(newTag) >= 0 && $scope.tag != newTag) {
                    $scope.tag = newTag;
                } else {
                    $scope.tag = false;
                }

                $scope.renewItems();
            }

            /*
             * Compare tag
             */
            $scope.isCurrentTag = function(tag) {
                return tag == $scope.tag;
            }


            /*          ITEMS           */

            // Clear out item array
            $scope.resetItems = function() {
                $scope.sets = [];
            }

            $scope.setShowOptions = function(item) {
                item.showOptions = true;
            }

            /*
             * Insert the items into the social feed
             */
            $scope.insertItems = function(items) {
                var resultSet = {items: []};
                // If there are items...
                // Initialize them
                items = sircusApi.initItems(items);
                // Add each item to the items list
                var setItems = [];
                // go through and figure out each of the items
                angular.forEach(items,function(item) {
                    var itemObject = sircusApi.initItem(transformItemDataService.createItem(item,false));
                    if (itemObject) {
                        setItems.push(itemObject);
                    } else {
                        resultSet.banner = item;
                    }
                });
                // counter to keep track of how many columns have been claimed
                var widthCounter = 0;
                var usedItems = {};

                var getDisplaySize = function(item) {
                    return item.featured == 'featured' && $scope.pageColumnCount > 3 ? 2 : 1;
                }

                var fillInLine = function(j, items) {
                    while (widthCounter % $scope.pageColumnCount != 0) {
                        // load from top
                        j = (j + 1) % items.length;
                        var itemObject = items[j];
                        var itemWidth = getDisplaySize(itemObject);
                        if ((widthCounter % $scope.pageColumnCount) + itemWidth <= $scope.pageColumnCount) {
                            resultSet.items.push(angular.copy(setItems[j]));
                            widthCounter += itemWidth;
                            continue;
                        }
                        if (j > items.length * 2) {
                            break;
                        }
                    }
                }

                var lookaheadIndex = null;
                for (var i in setItems) {
                    var itemObject = setItems[i];
                    var itemWidth = getDisplaySize(itemObject);
                    if ((widthCounter % $scope.pageColumnCount) + itemWidth > $scope.pageColumnCount) {
                        fillInLine(i, setItems);
                    }

                    widthCounter += itemWidth;
                    resultSet.items.push(itemObject);
                    if (i == setItems.length - 1) {
                        fillInLine(i, setItems);
                    }

                }

                $scope.sets.push(resultSet);
            }

            /*
             * Get initial social feed items from new stream
             */
            $scope.renewItems = function() {
                // Reset all the things
                // Loader, tag, limit, feedService, etc
                $scope.scroll.reset();
                $scope.feedService.reset();
                $scope.resetItems();

                $scope.feedService.setTag($scope.tag);
                $scope.feedService.setLimit($scope.limit);

                $scope.wait = true;

                $scope.loadItemsFromFeed();
            }


            /*
             * Get social feed items, insert into the social feed
             */
            $scope.getItems = function() {
                $scope.wait = true;
                $scope.feedService.ready().then( function() {
                    if($scope.feedService.isFinished()) {
                        return;
                    }

                    $scope.feedService.setLimit($scope.limit);

                    $scope.loadItemsFromFeed();
                });
            }



            /*          FEED            */

            /*
             * Get items from the feed, update app
             */
            $scope.loadItemsFromFeed = function() {
                // TODO: Can we abort all feedservice promises to
                // ensure this request executes immediately???
                $scope.feedService.getItems().then(
                    function( items ) {
                        $scope.scroll.incrementPage();
                        $scope.insertItems(items);
                        $scope.wait = false;
                    }
                );
            }

            /*
             * This is used to re-enable infinite load, particularly after
             * it has been disabled from reading the auto-load limit
             */
            $scope.loadMore = function() {
                $scope.scroll.enable();
                $scope.getItems();
            }

            /*
             * Is
            $scope.feedIsWaiting = function() {
                return $scope.feedService.isWaiting();
            }

            /*
             * Has the feed been exhausted
             */
            $scope.feedIsFinished = function() {
                return $scope.feedService.isFinished();
            }


            /*          BANNERS         */

            /*
             * Returns the image class i.e class="getBannerImageClass()"
             *
             */
            $scope.getBannerImageClass = function(banner) {
                if(banner.thumb_url)
                    return '';
                else
                    return 'placeholder';
            }

            /*
             * Returns the banner image markup
             */
            $scope.getBannerImageStyle = function(banner) {
                if(banner.thumb_url)
                    return 'background-image: url(' + banner.thumb_url + ')';
                else
                    return 'background-image: url(' + banner.theme_dir + '/img/icons/i_about-us.svg'  + ')';
            }

            /*
             * Construct partial URL for banner
             */
            $scope.constructBannerPartialUrl = function(type) {
                return urlService.getPartialUrl('/banners/banner-' + type + '.html');
            }

            /* Based on http://stackoverflow.com/questions/16155542/dynamically-displaying-template-in-ng-repeat-directive-in-angularjs
             * Determine which partial to use for the given item.
             */
            $scope.getItemPartial = function(item) {
                if ( item.type == 'banner' ) {
                    return $scope.constructBannerPartialUrl(item.display_type);
                }

                return $scope.constructItemPartialUrl(item.template, item.featured);
            }


            /*
             * Construct partial URL for social item
             */
            $scope.constructItemPartialUrl = function(type,status,service) {
                // We can build this out to be more updatable / configurable later if need be
                // i.e. have WP localize template lookup data array
                // #34118 - Make youtube (video) 2x1 (featured) size always
                if (status === 'featured') {
                    //$log.log(urlService.getPartialUrl('/social-tiles/tile-' + type + '-featured.html'));
                    return urlService.getPartialUrl('/social-tiles/tile-' + type + '-featured.html');
                } else {
                    //$log.log(urlService.getPartialUrl('/social-tiles/tile-' + type + '.html'));
                    return urlService.getPartialUrl('/social-tiles/tile-' + type + '.html');
                }
            }

            /*
             * Returns the class for item articles
             */
            $scope.getClass = function(item) {
                // TODO: Refactoring
                // TODO: itemClasses should be array, classes pushed to array
                // TODO: Return array.join(' ')
                // TODO: allow another function argument so that item classes can be passed in / appended
                var itemClasses = ' source-sircus ';

                if (item.type == 'item') {
                    if (item.showOptions) {
                        itemClasses += 'show-options ';
                    }
                    var template = 'type-' + item.template;
                    var featured = item.featured;
                    var service  = 'service-' + item.service;

                    // This is a workaround. Design provides styling for type-hybrid, but not type-video
                    if (item.template == 'video' ) {
                        template = 'type-hybrid type-video';
                    }

                    itemClasses += ' source-sircus social-tile hentry ' + template + ' ' +  featured  + ' ' + service;
                } else {
                    // For now it's safe to assume this is a banner
                    itemClasses += ' featured-banner-item ';
                }

                return itemClasses;
            }

            /*
             * Given HTML from the feed? Render it.
             */
            $scope.renderHtml = function(html_code) {
                try {
                    return $sce.trustAsHtml(html_code);
                } catch (e) {
                    return html_code;
                }
            }

            /*
             * Social Item Interaction -- Trigger action
             */
            $scope.triggerAction = function(action,item) {
                sircusApi.doAction(action,item);
            }

            /*
             * Initialize the controller
             */
            $scope.init = function(args) {
                $scope.args = args;
                $scope.renewItems();
            }
        }
    ]
)
angular.module('SircusFeedViewer').filter('limitTile', function() {
    return function(html, limit) {
        console.log('limit tile', html);
        if (html.length < limit) {
            return html;
        }
        var nextSpace = (''+html).substring(limit).indexOf(' ');
        return html.substring(0,limit + nextSpace);
    }
});
SircusFeedViewerApp.controller(
    'SircusFeedSearchController',
    [   '$scope',
        '$sce',
        '$log',
        '$http',
        'SircusFeedService',
        'SircusFeedUrlService',
        'SircusFeedLocalizedDataService',
        'SircusFeedI18nService',
        'SircusFeedApiService',
        'SircusFeedTransformItemDataService',
        'SircusFeedLocalizedDataService',
        function($scope, $sce, $log, $http,feedService, urlService, dataService,
                 i18n, sircusApi, transformItemDataService, localStorageService) {
            // Set items, this is the social items + banners
            $scope.items = [];

            // Arguments
            $scope.args = [];

            // Number of items per page of results
            $scope.limit = dataService.get('page_limit');

            // Feed Service handling all your requests to the API
            $scope.feedService = feedService;

            $scope.urlService = urlService;

            $scope.dataService = dataService;


            // Should I wait or should I go now?
            $scope.wait = false;

            $scope.op = 'search';

            /*          ITEMS           */

            // Clear out item array
            $scope.resetItems = function() {
                $scope.items = [];
            }

            $scope.hasNoItems = function() {
                return $scope.items.length < 1 && $scope.wait == false;
            }

            $scope.getPagesArray = function() {
                var pages = [];
                for(var i = 1; i <= $scope.feedService.getPageCount(); i++) {
                    pages.push(i);
                }
                return pages;
            }

            $scope.getPaginationUrl = function(page) {
                // TODO: Refactor so that query params are not hard coded ... they are subject to change
                var url =
                    dataService.get('site_url') +
                    '?' + dataService.get('search_query_var') + '=' + $scope.query +
                    '&' + dataService.get('domain_query_var') + '=social' +
                    '&' + dataService.get('domain_page_query_var') + '=' + page;
                return url;
            }

            /*
             * Insert the items into the social feed
             */
            $scope.insertItems = function(items) {
                // If there are items...
                // Initialize them
                items = sircusApi.initItems(items);
                // Add each item to the items list
                angular.forEach(items,function(item) {
                    var itemObject = sircusApi.initItem(transformItemDataService.createItem(item,false));
                    if (itemObject)
                        $scope.items.push(itemObject);
                });
            }

            /*
             * Get initial social feed items from new stream
             */
            $scope.renewItems = function() {
                // Reset all the things
                // Loader, tag, limit, feedService, etc
                $scope.feedService.reset();
                $scope.resetItems();

                $scope.feedService.setLimit($scope.limit);
                $scope.feedService.setType('search');
                $scope.feedService.setPage($scope.page);
                $scope.feedService.setQuery($scope.query);

                $scope.wait = true;

                $scope.loadItemsFromFeed();
            }


            /*
             * Get social feed items, insert into the social feed
             */
            $scope.getItems = function() {
                $scope.wait = true;
                $scope.feedService.ready().then( function() {
                    if($scope.feedService.isFinished()) {
                        return;
                    }

                    $scope.feedService.setLimit($scope.limit);

                    $scope.loadItemsFromFeed();
                });
            }

            /*          FEED            */

            /*
             * Get items from the feed, update app
             */
            $scope.loadItemsFromFeed = function() {
                // TODO: Can we abort all feedservice promises to
                // ensure this request executes immediately???
                $scope.feedService.getItems().then(
                    function( items ) {
                        $scope.insertItems(items);
                        $scope.wait = false;
                    }
                );
            }

            /*
             * Is
             $scope.feedIsWaiting = function() {
             return $scope.feedService.isWaiting();
             }

             /*
             * Has the feed been exhausted
             */
            $scope.feedIsFinished = function() {
                return $scope.feedService.isFinished();
            }

            /* Based on http://stackoverflow.com/questions/16155542/dynamically-displaying-template-in-ng-repeat-directive-in-angularjs
             * Determine which partial to use for the given item.
             */
            $scope.getItemPartial = function(item) {
                if ( item.type == 'banner' ) {
                    return $scope.constructBannerPartialUrl(item.display_type);
                }

                return $scope.constructItemPartialUrl(item.template, item.featured);
            }


            /*
             * Construct partial URL for social item
             */
            $scope.constructItemPartialUrl = function(type,status) {
                // We can build this out to be more updatable / configurable later if need be
                // i.e. have WP localize template lookup data array
                if (status === 'featured') {
                    //$log.log(urlService.getPartialUrl('/social-tiles/tile-' + type + '-featured.html'));
                    return urlService.getPartialUrl('/social-tiles/tile-' + type + '-featured.html');
                } else {
                    //$log.log(urlService.getPartialUrl('/social-tiles/tile-' + type + '.html'));
                    return urlService.getPartialUrl('/social-tiles/tile-' + type + '.html');
                }
            }

            $scope.getPaginationPartial = function() {
                return urlService.getPartialUrl('/pagination/links.html');
            }

            /*
             * Returns the class for item articles
             */
            $scope.getClass = function(item) {
                // TODO: Refactoring
                // TODO: itemClasses should be array, classes pushed to array
                // TODO: Return array.join(' ')
                // TODO: allow another function argument so that item classes can be passed in / appended
                var itemClasses = ' source-sircus ';

                if (item.type == 'item') {
                    var template = 'type-' + item.template;
                    var featured = item.featured;
                    var service  = 'service-' + item.service;
                    // This is a workaround. Design provides styling for type-hybrid, but not type-video
                    if (item.template == 'video' ) {
                        template = 'type-hybrid type-video';
                    }

                    itemClasses += ' source-sircus social-tile hentry ' + template + ' ' +  featured  + ' ' + service;
                } else {
                    // For now it's safe to assume this is a banner
                    itemClasses += ' featured-banner-item ';
                }

                return itemClasses;
            }

            /*
             * Given HTML from the feed? Render it.
             */
            $scope.renderHtml = function(html_code) {
                try {
                    return $sce.trustAsHtml(html_code);
                } catch (e) {
                    $log.log('renderHtml is unable to parse html code');
                    return html_code;
                }
            }

            /*
             * Social Item Interaction -- Trigger action
             */
            $scope.triggerAction = function(action,item) {
                sircusApi.doAction(action,item);
            }

            /*
             * Initialize the controller
             */
            $scope.init = function(args) {
                $scope.args = args;

                // TODO: Ugly for now, cleanup later
                // Number of items per page of results
                if (angular.isObject(args) && args.limit > 0) {
                    $scope.limit = args.limit;
                } else {
                    $scope.limit = dataService.get('limit');
                }

                if (angular.isObject(args) && args.page > 0) {
                    $scope.page  = args.page;
                } else {
                    $scope.page = dataService.get('page');
                }

                if (angular.isObject(args) && args.query) {
                    $scope.query = args.query;
                } else {
                    $scope.query = dataService.get('query');
                }

                $scope.renewItems();
            }
        }
    ]
);
angular.module('SircusFeedViewer').directive('randomTweetColors', function() {})
/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/26/14
 * Time: 3:37 PM
 * To change this template use File | Settings | File Templates.
 */
SircusFeedViewerApp.directive('itemBackground', ['$log', function ($log) {
    var tweetColors = ["#194685", "#799ED2", "#C7202C", "#5C8A3D", "#2EBAA5", "#038798", "#EF4E22"];

    return function (scope, element, attrs) {

        if (scope.item) {
            var backgroundUrl = false;

            if (scope.item.type == 'item') {
                if (scope.item.template == 'video' ) {
                    backgroundUrl = scope.item.media.thumbnail;
                } else {
                    backgroundUrl = scope.item.media;
                }
                if (scope.item.template == 'text') {
                    element.css('background-color', tweetColors[~~(Math.random() * tweetColors.length)])
                }
            }

            if (backgroundUrl) {
                element.css({
                    'background-image': 'url(' + backgroundUrl +')',
                    'background-size' : 'cover'
                });
            }
        }
    };
}]);
/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/26/14
 * Time: 3:37 PM
 * To change this template use File | Settings | File Templates.
 */
SircusFeedViewerApp.directive("postRender", ['$log', '$timeout', 'isotopeService', function($log, $timeout, isotopeService) {


    return {
        restrict : 'A',
        link: function(scope, element, attrs) {
            scope.item.open = false;
            if (scope.$last) {
                var imgLoad = imagesLoaded(element.parent());
                imgLoad.on('always', function(instance) {
                    $timeout(function() {
                        SocialFeedLib.init(element.parent(), function(initAspect) {
                            $timeout(function() {
                                isotopeService.trigger(scope);
                            },0);
                        });
                        // hide spinner!
                        $('.preloader').fadeOut();
                    }, 500)

                });
            }
        }
    };
}]);
/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/26/14
 * Time: 3:37 PM
 * To change this template use File | Settings | File Templates.
 */
SircusFeedViewerApp.directive('whenScrolled', ['$log', function($log) {
    return {
        link:function (scope, element, attrs) {
            // Added this to prevent errors if scroll is undefined
            if(scope.scroll == null || scope.scroll === undefined)
                return;
            // Had to hard code this in because the div.st-content element is not in scope
            // TODO: Refactor this to make it injectable & testable
            var $win = jQuery('div.st-content');

            scope.scroll.reset();
            scope.scroll.setTop($win.scrollTop());

            // Is scroll the best event to bind with?
            $win.scroll(function () {
                // There's no point in loading more if loading is already in progress
                if(scope.wait)
                    return;

                // Do not load if autoloading is disabled
                if(!scope.scroll.isEnabled())
                    return;

                // Feed exhausted? Stop trying so hard.
                if(scope.feedService.isFinished())
                    return;

                // Get properties of the last item in the grid
                var grid = jQuery('section.social-grid');
                var griditems = jQuery('section.social-grid article');
                var lastitem = griditems.last();
                var itemheight = lastitem.height();
                var itempos = lastitem.position();

                // No item position avalaiable, abort
                if (itempos == null || itempos === undefined) {
                    return;
                }

                // Get the top coordinate for the last item in the list
                var itemtop = itempos.top;

                // Resets croll heigh if item height has changed (means there's been some reconjiggering)
                if(scope.scroll.getHeight() > itemheight) {
                    scope.scroll.setTop($win.scrollTop());
                }

                // Scrolling up? No need to get more items
                if(scope.scroll.getTop() > $win.scrollTop()) {
                    return;
                }

                // Set state for next scroll
                scope.scroll.setHeight(itemheight);
                scope.scroll.setTop($win.scrollTop());

                // Test if appropirate to load more, and if so, load more
                if ((scope.scroll.getTop() + $win.height())  > (itemtop - (2 * itemheight))) {
                    scope.getItems();
                }
            });
        }
    };
}]);
angular.module('SircusFeedViewer').directive('svg', function(svgCache) {
    return {
        template: function(tElement, tAttrs) {
            return '<img src="'+tAttrs.svg+'" />';
        },
        link: function(scope, iElement, iAttrs) {
            var classOnReplace = iAttrs.class ? iAttrs.class : '';
            var swapOut = function(src) {
                if (src) {
                    var onData = function(svg) {
                        try {
                            svg.attr('class', classOnReplace+' '+(iAttrs.svgClass ? iAttrs.svgClass : 'svg'));
                            if (iAttrs.setFill) {
                                svg.children('path').each(function(i, e) {
                                    jQuery(e).attr('fill', iAttrs.setFill);
                                });
                            }
                            iElement.children().remove();
                            iElement.append(svg);
                        } catch (e) {
                            console.error(e);
                        }
                    }
                    svgCache.load(src, onData);
                }
            }
            if (iAttrs.static) {
                swapOut(iAttrs.static);
                return;
            }
            if (iAttrs.evaluated) {
                swapOut(scope.$eval(iAttrs.evaluated));
                return;
            }

            scope.$watch(iAttrs.svg, function(newValue, oldValue) {
                swapOut(newValue);
            }, true);
            swapOut(scope.$eval(iAttrs.svg));
        }
    };
});
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