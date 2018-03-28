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

            $('.db_dynamicbar').sparkline([8.4, 9, 8.4, 9, 8.8, 8, 9.5, 9.2, 9.9, 9, 9,8, 7, 9, 9, 9.5, 8, 9.5, 9.8], {
                type: 'bar',
                barColor: '#3F51B5',
                height: '80',
                barWidth: '8',
                barSpacing: 3,
            });

            $('.db_linesparkline').sparkline([2000, 4656, 2897, 3545, 4232, 5434, 4656, 2323, 3432, 4656, 2897, 3545, 4232, 5434, 4656, 3567, 4878, 3676, 3787], {
                type: 'line',
                width: '100%',
                height: '80',
                lineWidth: 2,
                lineColor: '#673AB7',
                fillColor: 'rgba(255,255,255,0.8)',
                highlightSpotColor: '#673AB7',
                highlightLineColor: '#673AB7',
                spotRadius: 3,
            });

            $('.db_linesparkline2').sparkline([3545, 4232, 5434, 4656, 4656, 2323, 3432, 4656, 2897, 3545, 4232, 5434, 4656, 3567, 4878, 3676, 3787], {
                type: 'line',
                width: '100%',
                height: '80',
                lineWidth: 2,
                lineColor: '#673AB7',
                fillColor: 'rgba(255,255,255,0.8)',
                highlightSpotColor: '#673AB7',
                highlightLineColor: '#673AB7',
                spotRadius: 3,
            });


            // Bar + line composite charts
            $('.db_compositebar').sparkline([4, 6,  4, 6, 7, 7, 4, 3, 2, 4, 6, 7,7, 4, 3, 1, 4, 6, 5, 9], {
                type: 'bar',
                barColor: '#3F51B5',
                height: '80',
                barWidth: '8',
                barSpacing: 3,
            });

            $('.db_compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 8, 4, 7, 9, 4, 6, 7, 7, 4, 3, 2, 4, 6, 7, 9, 8, 8, 4, 2, 5, 6, 7], {
                composite: true,
                fillColor: 'rgba(103,58,183,0)',
                type: 'line',
                width: '100%',
                height: '80',
                lineWidth: 2,
                lineColor: '#3F51B5',
                highlightSpotColor: '#E91E63',
                highlightLineColor: '#673AB7',
                spotRadius: 3,
            });



        }

    };







    /*--------------------------------
        Morris 
     --------------------------------*/
    CMPLTADMIN_SETTINGS.dbMorrisChart = function() {


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



    };



    /******************************
     initialize respective scripts 
     *****************************/
    $(document).ready(function() {
        CMPLTADMIN_SETTINGS.dbSparklineChart();
        CMPLTADMIN_SETTINGS.dbMorrisChart();
    });

    $(window).resize(function() {
        CMPLTADMIN_SETTINGS.dbSparklineChart();
    });

    $(window).load(function() {});

});
