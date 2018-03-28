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

            $('.db_dynamicbar').sparkline([8.4, 9, 8.8, 8, 9.5, 8.8, 8, 9.5, 9.2, 9.9, 9, 9, 8.4, 9, 8.8, 8, 9.5, 9.2, 9.9, 9, 9,8, 7, 9, 9, 9.5, 8, 9.5, 9.8], {
                type: 'bar',
                barColor: '#3F51B5',
                height: '140',
                barWidth: '10',
                barSpacing: 1,
            });

            $('.db_linesparkline').sparkline([2000, 3454, 5454, 2323, 3432, 2323, 3432, 4656, 2897, 3545, 4232, 5434, 4656, 4656, 2897, 3545, 4232, 5434, 4656, 2323, 3432, 4656, 2897, 3545, 4232, 5434, 4656, 3567, 4878, 3676, 3787], {
                type: 'line',
                width: '100%',
                height: '140',
                lineWidth: 2,
                lineColor: '#3F51B5',
                fillColor: 'rgba(255,255,255,0.2)',
                highlightSpotColor: '#3F51B5',
                highlightLineColor: '#3F51B5',
                spotRadius: 3,
            });


            // Bar + line composite charts
            $('.db_compositebar').sparkline([4, 6, 7, 7, 4, 3, 2, 4, 6, 7, 7, 4, 3, 1, 4, 6, 5, 9], {
                type: 'bar',
                barColor: '#3F51B5',
                height: '140',
                barWidth: '10',
                barSpacing: 1,
            });

            $('.db_compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 8, 4, 7, 9, 9, 8, 8, 4, 2, 5, 6, 7], {
                composite: true,
                fillColor: 'rgba(103,58,183,0)',
                type: 'line',
                width: '100%',
                height: '140',
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
                x: '2010 Q1',
                y: 3000,
                z: 2000,
                a: 2000
            }, {
                x: '2011 Q2',
                y: 2000,
                z: 1000,
                a: 3000
            }, {
                x: '2012 Q3',
                y: 1000,
                z: 3000,
                a: 7000
            }, {
                x: '2012 Q4',
                y: 2000,
                z: 2000,
                a: 5000
            }, {
                x: '2015 Q5',
                y: 4000,
                z: 5000,
                a: 7000
            }, {
                x: '2015 Q6',
                y: 2000,
                z: 4000,
                a: 6000
            }],
            resize: true,
            redraw: true,
            xkey: 'x',
            ykeys: ['y', 'z','a'],
            labels: ['Buyers', 'Projects','Sellers'],
            lineColors: ['#673AB7', '#3F51B5','#E91E63'],
            pointFillColors: ['#E91E63']
        }).on('click', function(i, row) {
            console.log(i, row);
        });



        $('.r1_maingraph .switch .fa').on('click', function() {

            $('.r1_maingraph .switch .fa').removeClass("icon-default").addClass("icon-secondary");

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
        //CMPLTADMIN_SETTINGS.dbEasyPieChart();
        CMPLTADMIN_SETTINGS.dbMorrisChart();
    });

    $(window).resize(function() {
        CMPLTADMIN_SETTINGS.dbSparklineChart();
    });

    $(window).load(function() {});

});
