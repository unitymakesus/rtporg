angular.module('rtp').controller('DashCtrl', function($scope, Restangular, alert, $timeout, $rootScope) {
    var messages = [
        "Bleepity Bloop Blorp",
        "Downloading from SkyNet...",
        "Share the looooooaaaaad!",
        "*AOL dial up connection screeching*",
        "One moment while I fetch your data."
    ];
    $scope.loadingMessage = messages[Math.floor(Math.random() * 10000) % messages.length]
    $scope.loadingData = true;
    $scope.data = {};

    var labels = ['Rejected', 'Unapproved', 'Approved', 'Total'];
    var templateTypes = ['Text', 'Hybrid', 'Media', 'Video'];
    var serviceMap = {
        'twitter': {
            name: "Twitter",
            color: {
                fillColor : "#00ACED",
                strokeColor : "f1f1f1"
            }
        },
        'googleplus': {
            name: "Google+",
            color: {
                fillColor : "#DD4B39",
                strokeColor : "f1f1f1"
            }
        },
        'instagram': {
            name: "Instagram",
            color: {
                fillColor : "#517fa4",
                strokeColor : "f1f1f1"
            }
        },
        'youtube': {
            name: "YouTube",
            color: {
                fillColor : "#BB0000",
                strokeColor : "f1f1f1"
            }
        },
        'rss': {
            name: "RSS",
            color: {
                fillColor : "#EF4E22",
                strokeColor : "f1f1f1"
            }
        }
    };
    $scope.serviceMap = serviceMap;


    Restangular.all('dashboard').get('').then(function(response){
        $scope.loadingData = false;
        $scope.data = {
            totals: response.totals,
            services: response.services
        };
        for (var serviceKey in $scope.data.services) {
            $scope.service = serviceKey;
            break;
        }
        $scope.metric = labels[labels.length - 1]
        $rootScope.$broadcast('chart-data-loaded', response);
        $timeout(function() {
            $rootScope.$broadcast('chart-updated', response);
        },100);
        $scope.$watch('metric', function(newMetric, oldMetric, s) {
            if (!s || !s.data || !s.data.services) {
                return;
            }
            $rootScope.$broadcast('chart-updated-metric', s.data);
        }, true);
        $scope.$watch('service', function(newService, oldService, s) {
            if (!s || !s.data || !s.data.services) {
                return;
            }
            $rootScope.$broadcast('chart-updated-service', s.data);
        });

    }, function(response){
        $scope.loadingData = false;
    });
    $scope.dimensions = labels;

    $scope.getTemplateBreakdown = function() {
        var serviceData = $scope.data.services;
        var service = $scope.service;
        if (!serviceMap[service] || !serviceData[service]) {
            return;
        }
        var data = [];
        angular.forEach(templateTypes, function(value, index) {
            data.push(serviceData[service].templates[value.toLowerCase()])
        });
        var dataSet = serviceMap[service].color;
        dataSet.strokeColor = 'rgba(0,0,0,.5)';
        dataSet.pointColor = '#fff';
        dataSet.pointStrokeColor = 'rgba(0,0,0,.8)';
        dataSet.data = data;

        return {
            fn: 'Line',
            data: {
                labels: templateTypes,
                datasets: [dataSet]
            },
            options: {
                bezierCurve: false
            }
        }
    }

    $scope.getServiceBreakdown = function() {
        var serviceData = $scope.data.services;
        var key = $scope.metric.toLowerCase();
        var data = {
            labels : ["Social Media Service"],
            datasets : [
                {
                    fillColor : "#00ACED",
                    strokeColor : "f1f1f1",
                    data : [serviceData.twitter[key]]
                },
                {
                    fillColor : "#DD4B39",
                    strokeColor : "f1f1f1",
                    data : [serviceData.googleplus[key]]
                },
                {
                    fillColor : "#517fa4",
                    strokeColor : "f1f1f1",
                    data : [serviceData.instagram[key]]
                },
                {
                    fillColor : "#BB0000",
                    strokeColor : "f1f1f1",
                    data : [serviceData.youtube[key]]
                },
                {
                    fillColor : "#EF4E22",
                    strokeColor : "f1f1f1",
                    data : [serviceData.rss[key]]
                }
            ]
        };
        return {
            fn: 'Bar',
            data: data,
            options: {}
        }
    }

    $scope.getFeedTotals = function(response, element) {
        var serviceData = [
            {value: response.services.googleplus.total, color: '#DD4B39'},
            {value: response.services.twitter.total, color: '#00ACED'},
            {value: response.services.instagram.total, color: '#517fa4'},
            {value: response.services.rss.total, color: '#EF4E22'},
            {value: response.services.youtube.total, color: '#BB0000'}
        ];
        var polarOptions = {
            segmentStrokeColor: "#f1f1f1",
            segmentStrokeWidth : 1,
            animationEasing : "easeInOutQuad"
        }
        return {
            fn: 'PolarArea',
            data: serviceData,
            options:polarOptions
        }
    }

    $scope.getApproved = function(response, element) {
        var data = [
            // approved
            {value: response.totals.approved, color: '#56af7b'},
            // pending
            {value: response.totals.unapproved, color: '#edc75e'},
            // rejected
            {value: response.totals.rejected, color: '#e25b36'}
        ];
        var doughnutOptions = {
            segmentStrokeColor: "#f1f1f1",
            segmentStrokeWidth : 1,
            animationEasing : "easeInOutQuad"
        }
        return {
            fn: 'Doughnut',
            data: data,
            options:doughnutOptions
        }
    }

}).directive('chart', function() {
    return function(scope, element, attributes) {
        var chartFn = attributes.chart;
        if (!chartFn || !scope[chartFn] || typeof scope[chartFn] != 'function') {
            return;
        }
        var tag = attributes.tag;

        var getSizeMe = function(response) {
            var result = scope[chartFn](response, element);
            if (!result) {
                return;
            }

            var sizeMe = function() {

                var width = element.parent().width();
                element.attr("width",width);
                new Chart((element[0]).getContext("2d"))[result.fn](result.data, result.options);
            }
            return sizeMe;

        }

        scope.$on('chart-data-loaded', function(event, response) {
            var sizeMe = getSizeMe(response);
            if (sizeMe) {
                jQuery(window).resize(function(event){
                    sizeMe();
                });
                sizeMe();
            }

        });
        if (tag) {
            scope.$on('chart-updated-'+tag, function(event, response) {
                var sizeMe = getSizeMe(response);
                if (sizeMe) {sizeMe();}
            });

        }
        scope.$on('chart-updated', function(event, response) {
            var sizeMe = getSizeMe(response);
            if (sizeMe) {sizeMe();}
        });

    }
});