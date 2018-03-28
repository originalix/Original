/**
 * @Package: Complete Admin Responsive Theme
 * @Since: Complete Admin 1.0
 * This file is part of Complete Admin Responsive Theme.
 */


jQuery(function($) {

    'use strict';

    var CMPLTADMIN_SETTINGS = window.CMPLTADMIN_SETTINGS || {};

    /*--------------------------------
        Morris Chart
     --------------------------------*/
    CMPLTADMIN_SETTINGS.chartMorris = function() {

    if($("#morris_area_graph").length){

        /*Area Graph*/
        // Use Morris.Area instead of Morris.Line
        Morris.Area({
            element: 'morris_area_graph',
            data: [{
                x: '2010 Q4',
                y: 3,
                z: 7
            }, {
                x: '2011 Q1',
                y: 3,
                z: 4
            }, {
                x: '2011 Q2',
                y: null,
                z: 1
            }, {
                x: '2011 Q3',
                y: 2,
                z: 5
            }, {
                x: '2011 Q4',
                y: 8,
                z: 2
            }, {
                x: '2012 Q1',
                y: 4,
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
}

    if($("#morris_bar_graph").length){

        /*Bar Graph*/
        // Use Morris.Bar
        Morris.Bar({
            element: 'morris_bar_graph',
            data: [{
                x: '2011 Q1',
                y: 3,
                z: 2,
                a: 3
            }, {
                x: '2011 Q2',
                y: 2,
                z: null,
                a: 1
            }, {
                x: '2011 Q3',
                y: 0,
                z: 2,
                a: 4
            }, {
                x: '2011 Q4',
                y: 2,
                z: 4,
                a: 3
            }],
            resize: true,
            redraw: true,
            xkey: 'x',
            ykeys: ['y', 'z', 'a'],
            labels: ['Y', 'Z', 'A'],
            barColors: ['#673AB7', '#3F51B5', '#E91E63']
        }).on('click', function(i, row) {
            console.log(i, row);
        });

}
    if($("#morris_line_graph").length){

        /*Line Graph*/
        /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
        var day_data = [{
            "period": "2012-10-01",
            "licensed": 3407,
            "sorned": 660
        }, {
            "period": "2012-09-30",
            "licensed": 3351,
            "sorned": 629
        }, {
            "period": "2012-09-29",
            "licensed": 3269,
            "sorned": 618
        }, {
            "period": "2012-09-20",
            "licensed": 3246,
            "sorned": 661
        }, {
            "period": "2012-09-19",
            "licensed": 3257,
            "sorned": 667
        }, {
            "period": "2012-09-18",
            "licensed": 3248,
            "sorned": 627
        }, {
            "period": "2012-09-17",
            "licensed": 3171,
            "sorned": 660
        }, {
            "period": "2012-09-16",
            "licensed": 3171,
            "sorned": 676
        }, {
            "period": "2012-09-15",
            "licensed": 3201,
            "sorned": 656
        }, {
            "period": "2012-09-10",
            "licensed": 3215,
            "sorned": 622
        }];
        Morris.Line({
            element: 'morris_line_graph',
            data: day_data,
            resize: true,
            xkey: 'period',
            ykeys: ['licensed', 'sorned'],
            labels: ['Licensed', 'SORN'],
            lineColors: ['#673AB7', '#3F51B5'],
            pointFillColors: ['#E91E63']

        });
}

    if($("#morris_donut_graph").length){

        /*Donut Graph*/
        Morris.Donut({
            element: 'morris_donut_graph',
            data: [{
                value: 70,
                label: 'foo'
            }, {
                value: 15,
                label: 'bar'
            }, {
                value: 10,
                label: 'baz'
            }, {
                value: 5,
                label: 'A really really long label'
            }],
            resize: true,
            redraw: true,
            backgroundColor: '#ffffff',
            labelColor: '#999999',
            colors: [
                '#673AB7',
                '#E91E63',
                '#3F51B5',
                '#ffcc00'
            ],
            formatter: function(x) {
                return x + "%"
            }
        });

}
    if($("#morris_negative_graph").length){

        /*Negative Line Graph*/

        var neg_data = [{
            "period": "2011-08-12",
            "a": 100
        }, {
            "period": "2011-03-03",
            "a": 75
        }, {
            "period": "2010-08-08",
            "a": 50
        }, {
            "period": "2010-05-10",
            "a": 25
        }, {
            "period": "2010-03-14",
            "a": 0
        }, {
            "period": "2010-01-10",
            "a": -25
        }, {
            "period": "2009-12-10",
            "a": -50
        }, {
            "period": "2009-10-07",
            "a": -75
        }, {
            "period": "2009-09-25",
            "a": -100
        }];
        Morris.Line({
            element: 'morris_negative_graph',
            data: neg_data,
            resize: true,
            redraw: true,
            xkey: 'period',
            ykeys: ['a'],
            labels: ['Series A'],
            lineColors: ['#673AB7', '#3F51B5'],
            units: '%'
        });

}

    if($("#morris_nogrid_graph").length){

        /*No Grid Line Graph*/
        /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
        var day_data = [{
            "period": "2012-10-01",
            "licensed": 3407,
            "sorned": 660
        }, {
            "period": "2012-09-30",
            "licensed": 3351,
            "sorned": 629
        }, {
            "period": "2012-09-29",
            "licensed": 3269,
            "sorned": 618
        }, {
            "period": "2012-09-20",
            "licensed": 3246,
            "sorned": 661
        }, {
            "period": "2012-09-19",
            "licensed": 3257,
            "sorned": 667
        }, {
            "period": "2012-09-18",
            "licensed": 3248,
            "sorned": 627
        }, {
            "period": "2012-09-17",
            "licensed": 3171,
            "sorned": 660
        }, {
            "period": "2012-09-16",
            "licensed": 3171,
            "sorned": 676
        }, {
            "period": "2012-09-15",
            "licensed": 3201,
            "sorned": 656
        }, {
            "period": "2012-09-10",
            "licensed": 3215,
            "sorned": 622
        }];
        Morris.Line({
            element: 'morris_nogrid_graph',
            grid: false,
            resize: true,
            redraw: true,
            data: day_data,
            xkey: 'period',
            ykeys: ['licensed', 'sorned'],
            labels: ['Licensed', 'SORN'],
            lineColors: ['#673AB7', '#3F51B5']
        });
}
    if($("#morris_noncontinuous_graph").length){


        /*Non Continuous Line Graph*/
        /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
        var day_data = [{
            "period": "2012-10-01",
            "licensed": 3407
        }, {
            "period": "2012-09-30",
            "sorned": 0
        }, {
            "period": "2012-09-29",
            "sorned": 618
        }, {
            "period": "2012-09-20",
            "licensed": 3246,
            "sorned": 661
        }, {
            "period": "2012-09-19",
            "licensed": 3257,
            "sorned": null
        }, {
            "period": "2012-09-18",
            "licensed": 3248,
            "other": 1000
        }, {
            "period": "2012-09-17",
            "sorned": 0
        }, {
            "period": "2012-09-16",
            "sorned": 0
        }, {
            "period": "2012-09-15",
            "licensed": 3201,
            "sorned": 656
        }, {
            "period": "2012-09-10",
            "licensed": 3215
        }];
        Morris.Line({
            element: 'morris_noncontinuous_graph',
            data: day_data,
            resize: true,
            redraw: true,
            xkey: 'period',
            ykeys: ['licensed', 'sorned', 'other'],
            labels: ['Licensed', 'SORN', 'Other'],
            lineColors: ['#673AB7', '#3F51B5'],
            /* custom label formatting with `xLabelFormat` */
            xLabelFormat: function(d) {
                return (d.getMonth() + 1) + '/' + d.getDate() + '/' + d.getFullYear();
            },
            /* setting `xLabels` is recommended when using xLabelFormat */
            xLabels: 'day'
        });

}

    if($("#morris_stackedbar_graph").length){

        /* Stacked Bar Graph*/
        // Use Morris.Bar
        Morris.Bar({
            element: 'morris_stackedbar_graph',
            data: [{
                x: '2011 Q1',
                y: 3,
                z: 2,
                a: 3
            }, {
                x: '2011 Q2',
                y: 2,
                z: null,
                a: 1
            }, {
                x: '2011 Q3',
                y: 0,
                z: 2,
                a: 4
            }, {
                x: '2011 Q4',
                y: 2,
                z: 4,
                a: 3
            }],
            resize: true,
            redraw: true,
            xkey: 'x',
            ykeys: ['y', 'z', 'a'],
            labels: ['Y', 'Z', 'A'],
            barColors: ['#673AB7', '#3F51B5', '#E91E63'],
            stacked: true
        });

    }

    };






    /******************************
     initialize respective scripts 
     *****************************/
    $(document).ready(function() {
        CMPLTADMIN_SETTINGS.chartMorris();
    });

    $(window).resize(function() {});

    $(window).load(function() {});

});
