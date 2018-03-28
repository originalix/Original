/**
 * @Package: Complete Admin Responsive Theme
 * @Since: Complete Admin 1.0
 * This file is part of Complete Admin Responsive Theme.
 */


jQuery(function($) {

    'use strict';

    var CMPLTADMIN_SETTINGS = window.CMPLTADMIN_SETTINGS || {};

    /*--------------------------------
        Chart Js Chart
     --------------------------------*/
    CMPLTADMIN_SETTINGS.chartJS = function() {




 if($("#bar-chartjs").length){
        /*Bar Chart*/
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100)
        };

        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                fillColor: "rgba(63,81,181,1)",
                strokeColor: "rgba(63,81,181,0.8)",
                highlightFill: "rgba(63,81,181,0.8)",
                highlightStroke: "rgba(63,81,181,1)",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            }, {
                fillColor: "rgba(103,58,183,1.0)",
                strokeColor: "rgba(103,58,183,0.8)",
                highlightFill: "rgba(103,58,183,0.8)",
                highlightStroke: "rgba(103,58,183,1.0)",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            }]

        }

        var ctxb = document.getElementById("bar-chartjs").getContext("2d");
        window.myBar = new Chart(ctxb).Bar(barChartData, {
            responsive: true
        });
    }

        /*Line Chart*/
 if($("#line-chartjs").length){
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100)
        };
        var lineChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "My First dataset",
                fillColor: "rgba(63,81,181,0.5)",
                strokeColor: "rgba(63,81,181,1)",
                pointColor: "rgba(63,81,181,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(63,81,181,1)",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            }, {
                label: "My Second dataset",
                fillColor: "rgba(103,58,183,0.5)",
                strokeColor: "rgba(103,58,183,1.0)",
                pointColor: "rgba(103,58,183,1.0)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(103,58,183,1.0)",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            }]

        }

        var ctx = document.getElementById("line-chartjs").getContext("2d");
        window.myLine = new Chart(ctx).Line(lineChartData, {
            responsive: true
        });

}

 if($("#pie-chartjs").length){
        /*PIE Chart*/


        var pieData = [{
                value: 300,
                color: "#E91E63",
                highlight: "rgba(250,133,100,0.8)",
                label: "Accent"
            }, {
                value: 150,
                color: "rgba(63,81,181,1)",
                highlight: "rgba(63,81,181,0.8)",
                label: "Primary"
            }, {
                value: 50,
                color: "#FFC107",
                highlight: "#FFC870",
                label: "Yellow"
            }, {
                value: 120,
                color: "rgba(103,58,183,1.0)",
                highlight: "rgba(103,58,183,0.8)",
                label: "Purple"
            }

        ];

        var ctx = document.getElementById("pie-chartjs").getContext("2d");
        window.myPie = new Chart(ctx).Pie(pieData);

}

 if($("#donut-chartjs").length){

        /* Donut Chart*/

        var doughnutData = [{
                value: 300,
                color: "#E91E63",
                highlight: "rgba(250,133,100,0.8)",
                label: "Accent"
            }, {
                value: 150,
                color: "rgba(63,81,181,1)",
                highlight: "rgba(63,81,181,0.8)",
                label: "Primary"
            }, {
                value: 50,
                color: "#FFC107",
                highlight: "#FFC870",
                label: "Yellow"
            }, {
                value: 120,
                color: "rgba(103,58,183,1.0)",
                highlight: "rgba(103,58,183,0.8)",
                label: "Purple"
            }

        ];

        var ctxd = document.getElementById("donut-chartjs").getContext("2d");
        window.myDoughnut = new Chart(ctxd).Doughnut(doughnutData, {
            responsive: true
        });
}



 if($("#polar-chartjs").length){
        /*Polar Chart*/

        var polarData = [{
                value: 300,
                color: "#E91E63",
                highlight: "rgba(250,133,100,0.8)",
                label: "Accent"
            }, {
                value: 150,
                color: "rgba(63,81,181,1)",
                highlight: "rgba(63,81,181,0.8)",
                label: "Primary"
            }, {
                value: 50,
                color: "#FFC107",
                highlight: "#FFC870",
                label: "Yellow"
            }, {
                value: 120,
                color: "rgba(103,58,183,1.0)",
                highlight: "rgba(103,58,183,0.8)",
                label: "Purple"
            }

        ];

        var ctxp = document.getElementById("polar-chartjs").getContext("2d");
        window.myPolarArea = new Chart(ctxp).PolarArea(polarData, {
            responsive: true
        });

}




 if($("#radar-chartjs").length){


        /*Radar Chart*/
        var radarChartData = {
            labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
            datasets: [{
                label: "My First dataset",
                fillColor: "rgba(63,81,181,0.4)",
                strokeColor: "rgba(63,81,181,1)",
                pointColor: "rgba(63,81,181,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(63,81,181,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            }, {
                label: "My Second dataset",
                fillColor: "rgba(103,58,183,0.4)",
                strokeColor: "rgba(103,58,183,1.0)",
                pointColor: "rgba(103,58,183,1.0)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(103,58,183,1.0)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }]
        };

        window.myRadar = new Chart(document.getElementById("radar-chartjs").getContext("2d")).Radar(radarChartData, {
            responsive: true
        });
}

    };






    /******************************
     initialize respective scripts 
     *****************************/
    $(document).ready(function() {});

    $(window).resize(function() {});

    $(window).load(function() {
        CMPLTADMIN_SETTINGS.chartJS();
    });

});
