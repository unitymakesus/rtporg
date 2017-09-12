/**
 * Created by brians on 3/12/15.
 *
 * This is a simple wrapper object for the calandar library we're
 * using on the events pages. This should help isolate the functionality
 * from other Javascript components and minimize potential routes of
 * scope collision between the calendar and social tiles.
 *
 */
var AbtEventsCalendar =
    (function ($) {
        "use strict";
        var defaultOptions =
            {
                'calendarElem' : $('#calendar'),
                'monthElem'    : $('#custom-month'),
                'yearElem'     : $('#custom-year'),
                'ctrlNextElem' : $('#custom-next'),
                'ctrlPrevElem' : $('#custom-prev'),
                'ctrlCurrElem' : $('#custom-current')
            };
        return {
            init : function (data, opts) {
                // Merge defaults
                opts = $.extend(defaultOptions, opts);

                // Setup calendar
                var cal =
                        $('#calendar').calendario({
                            onDayClick : function($el, $contentEl, dateProperties) {},
                            caldata : data,
                            startIn : 0
                        }),
                    $month = opts.monthElem.html(cal.getMonthName()),
                    $year  = opts.yearElem.html(cal.getYear());

                function updateMonthYear() {
                    $month.html(cal.getMonthName());
                    $year.html(cal.getYear());
                };

                opts.ctrlNextElem.on('click', function () {
                    cal.gotoNextMonth(updateMonthYear);
                });

                opts.ctrlPrevElem.on('click', function () {
                    cal.gotoPreviousMonth(updateMonthYear);
                });

                opts.ctrlCurrElem.on('click', function () {
                    cal.gotoNow(updateMonthYear);
                });
            }
        };
    })(jQuery);
/*
 * Use:     AbtEventsCalendar.init({ // json calendar data}, { // options });
 *
 * var  data    = {'11-23-2015' : <a href="/event/">Event</a>, ...},
 *      options = {'calendarElem' : $('#calendar'), ...};
 *
 * AbtEventsCalendar.init(data,options);
 *
 */