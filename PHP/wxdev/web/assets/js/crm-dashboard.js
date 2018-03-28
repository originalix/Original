/**
 * @Package: Complete Admin Responsive Theme
 * @Since: Complete Admin 1.0
 * This file is part of Complete Admin Responsive Theme.
 */


jQuery(function($) {

    'use strict';

    var CMPLTADMIN_SETTINGS = window.CMPLTADMIN_SETTINGS || {};

    /*--------------------------------
        Sparkline Chart
     --------------------------------*/
    CMPLTADMIN_SETTINGS.dbSparklineChart = function() {

        if ($.isFunction($.fn.sparkline)) {

            $('.db_dynamicbar').sparkline([8.4, 9, 8.8, 8, 9.5, 9.2, 9.9, 9, 9, 8, 7, 9, 9, 9.5, 8, 9.5, 9.8], {
                type: 'bar',
                barColor: '#f5f5f5',
                height: '40',
                barWidth: '10',
                barSpacing: 1,
            });

            $('.db_linesparkline').sparkline([2000, 3454, 5454, 2323, 3432, 4656, 2897, 3545, 4232, 5434, 4656, 3567, 4878, 3676, 3787], {
                type: 'line',
                width: '100%',
                height: '40',
                lineWidth: 2,
                lineColor: '#f5f5f5',
                fillColor: 'rgba(255,255,255,0.2)',
                highlightSpotColor: '#ffffff',
                highlightLineColor: '#ffffff',
                spotRadius: 3,
            });


            // Bar + line composite charts
            $('.db_compositebar').sparkline([4, 6, 7, 7, 4, 3, 2, 4, 6, 7, 7, 4, 3, 1, 4, 6, 5, 9], {
                type: 'bar',
                barColor: '#f5f5f5',
                height: '40',
                barWidth: '10',
                barSpacing: 1,
            });

            $('.db_compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 8, 4, 7, 9, 9, 8, 8, 4, 2, 5, 6, 7], {
                composite: true,
                fillColor: 'rgba(103,58,183,0)',
                type: 'line',
                width: '100%',
                height: '40',
                lineWidth: 2,
                lineColor: '#673AB7',
                highlightSpotColor: '#E91E63',
                highlightLineColor: '#673AB7',
                spotRadius: 3,
            });



        }

    };




    /*--------------------------------
        Easy PIE
     --------------------------------*/
    CMPLTADMIN_SETTINGS.dbEasyPieChart = function() {

        if ($.isFunction($.fn.easyPieChart)) {

            $('.db_easypiechart1').easyPieChart({
                barColor: '#673AB7',
                trackColor: '#f5f5f5',
                scaleColor: '#f5f5f5',
                lineCap: 'square',
                lineWidth: 6,
                size: 120,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }

    };




    /*--------------------------------
        Morris 
     --------------------------------*/
    CMPLTADMIN_SETTINGS.dbMorrisChart = function() {


        /*Area Graph*/
        // Use Morris.Area instead of Morris.Line
        Morris.Area({
            element: 'db_morris_area_graph',
            data: [{
                x: '2009 Q1',
                y: 3,
                z: 2
            }, {
                x: '2010 Q2',
                y: 2,
                z: 1
            }, {
                x: '2011 Q3',
                y: 1,
                z: 2
            }, {
                x: '2011 Q4',
                y: 2,
                z: 2
            }, {
                x: '2012 Q5',
                y: 4,
                z: 2
            }, {
                x: '2012 Q6',
                y: 2,
                z: 4
            }],
            resize: true,
            redraw: true,
            xkey: 'x',
            ykeys: ['y', 'z'],
            labels: ['Y', 'Z'],
            lineColors: ['#673AB7', '#3F51B5'],
            pointFillColors: ['#E91E63']
        }).on('click', function(i, row) {
            console.log(i, row);
        });


        /*Line Graph*/
        /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
        var day_data = [{
            "period": "2012-10-01",
            "pageviews": 3407,
            "unique": 660
        }, {
            "period": "2012-09-30",
            "pageviews": 3351,
            "unique": 629
        }, {
            "period": "2012-09-29",
            "pageviews": 3269,
            "unique": 618
        }, {
            "period": "2012-09-20",
            "pageviews": 3246,
            "unique": 661
        }, {
            "period": "2012-09-19",
            "pageviews": 3257,
            "unique": 667
        }, {
            "period": "2012-09-18",
            "pageviews": 3248,
            "unique": 627
        }, {
            "period": "2012-09-17",
            "pageviews": 3171,
            "unique": 660
        }, {
            "period": "2012-09-16",
            "pageviews": 3171,
            "unique": 676
        }, {
            "period": "2012-09-15",
            "pageviews": 3201,
            "unique": 656
        }, {
            "period": "2012-09-10",
            "pageviews": 3215,
            "unique": 622
        }];
        Morris.Line({
            element: 'db_morris_line_graph',
            data: day_data,
            resize: true,
            redraw: true,
            xkey: 'period',
            ykeys: ['pageviews', 'unique'],
            labels: ['Page Views', 'Unique Visitors'],
            lineColors: ['#673AB7', '#3F51B5'],
            pointFillColors: ['#E91E63']
        });

        /*Bar Graph*/
        // Use Morris.Bar
        Morris.Bar({
            element: 'db_morris_bar_graph',
            data: [{
                x: '2011 Q1',
                y: 3,
                z: 2
            }, {
                x: '2011 Q2',
                y: 2,
                z: 1
            }, {
                x: '2011 Q3',
                y: 1,
                z: 2
            }, {
                x: '2011 Q4',
                y: 2,
                z: 2
            }, {
                x: '2011 Q5',
                y: 4,
                z: 2
            }, {
                x: '2011 Q6',
                y: 2,
                z: 4
            }],
            resize: true,
            redraw: true,
            xkey: 'x',
            ykeys: ['y', 'z'],
            labels: ['Y', 'Z'],
            barColors: ['#673AB7', '#3F51B5']
        }).on('click', function(i, row) {
            console.log(i, row);
        });

        $('.r1_maingraph .switch .fa').on('click', function() {

            $('.r1_maingraph .switch .fa').removeClass("icon-default").addClass("icon-secondary");

            if ($(this).hasClass("fa-bar-chart")) {
                $(this).toggleClass("icon-secondary icon-default");
                $("#db_morris_line_graph").hide();
                $("#db_morris_area_graph").hide();
                $("#db_morris_bar_graph").show();
            }

            if ($(this).hasClass("fa-line-chart")) {
                $(this).toggleClass("icon-secondary icon-default");
                $("#db_morris_line_graph").show();
                $("#db_morris_area_graph").hide();
                $("#db_morris_bar_graph").hide();
            }

            if ($(this).hasClass("fa-area-chart")) {
                $(this).toggleClass("icon-secondary icon-default");
                $("#db_morris_line_graph").hide();
                $("#db_morris_area_graph").show();
                $("#db_morris_bar_graph").hide();
            }

        });


    };



    /******************************
     initialize respective scripts 
     *****************************/
    $(document).ready(function() {
        CMPLTADMIN_SETTINGS.dbSparklineChart();
        CMPLTADMIN_SETTINGS.dbEasyPieChart();
        CMPLTADMIN_SETTINGS.dbMorrisChart();
    });

    $(window).resize(function() {
        CMPLTADMIN_SETTINGS.dbSparklineChart();
    });

    $(window).load(function() {});

});
