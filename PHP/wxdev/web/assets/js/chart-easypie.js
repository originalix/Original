/**
 * @Package: Complete Admin Responsive Theme
 * @Since: Complete Admin 1.0
 * This file is part of Complete Admin Responsive Theme.
 */


jQuery(function($) {

    'use strict';

    var CMPLTADMIN_SETTINGS = window.CMPLTADMIN_SETTINGS || {};

    /*--------------------------------
        Easypie Chart
     --------------------------------*/
    CMPLTADMIN_SETTINGS.chartEasypie = function() {




        if ($.isFunction($.fn.easyPieChart)) {

            $('.easypiechart1').easyPieChart({
                easing: 'easeOutBounce',
                barColor: '#3F51B5',
                trackColor: '#eaeaea',
                scaleColor: '#cccccc',
                lineCap: 'square',
                lineWidth: 10,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });

            $('.easypiechart2').easyPieChart({
                easing: 'easeInBounce',
                barColor: '#673AB7',
                trackColor: '#eaeaea',
                scaleColor: '#ffffff',
                lineCap: 'square',
                lineWidth: 20,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });



            $('.easypiechart3').easyPieChart({
                easing: 'easeInOut',
                barColor: '#E91E63',
                trackColor: '#eaeaea',
                scaleColor: '#ffffff',
                lineCap: 'square',
                lineWidth: 30,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });


            $('.easypiechart4').easyPieChart({
                easing: 'easeOutCirc',
                barColor: '#eaeaea',
                trackColor: '#FFC107',
                scaleColor: '#cccccc',
                lineCap: 'square',
                lineWidth: 40,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });


            $('.easypiechart5').easyPieChart({
                easing: 'easeOutBounce',
                barColor: '#3F51B5',
                trackColor: '#eaeaea',
                scaleColor: '#cccccc',
                lineCap: 'square',
                lineWidth: 2,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });

            $('.easypiechart6').easyPieChart({
                easing: 'easeInBounce',
                barColor: '#673AB7',
                trackColor: '#eaeaea',
                scaleColor: '#ffffff',
                lineCap: 'square',
                lineWidth: 5,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });



            $('.easypiechart7').easyPieChart({
                easing: 'easeInOut',
                barColor: '#E91E63',
                trackColor: '#eaeaea',
                scaleColor: '#ffffff',
                lineCap: 'square',
                lineWidth: 10,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });


            $('.easypiechart8').easyPieChart({
                easing: 'easeOutCirc',
                barColor: '#eaeaea',
                trackColor: '#FFC107',
                scaleColor: '#cccccc',
                lineCap: 'square',
                lineWidth: 15,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });

            $('.easypiechart9').easyPieChart({
                easing: 'easeOutCirc',
                barColor: '#eaeaea',
                trackColor: '#3F51B5',
                scaleColor: '#cccccc',
                lineCap: 'square',
                lineWidth: 10,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });


            $('.easypiechart10').easyPieChart({
                easing: 'easeOutCirc',
                barColor: '#eaeaea',
                trackColor: '#673AB7',
                scaleColor: '#cccccc',
                lineCap: 'square',
                lineWidth: 5,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });

            $('.easypiechart11').easyPieChart({
                easing: 'easeInOut',
                barColor: '#E91E63',
                trackColor: '#eaeaea',
                scaleColor: '#ffffff',
                lineCap: 'square',
                lineWidth: 7,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });


            $('.easypiechart12').easyPieChart({
                easing: 'easeOutCirc',
                barColor: '#eaeaea',
                trackColor: '#FFC107',
                scaleColor: '#cccccc',
                lineCap: 'square',
                lineWidth: 4,
                size: 200,
                animate: 2000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });





        }



    };






    /******************************
     initialize respective scripts 
     *****************************/
    $(document).ready(function() {
        CMPLTADMIN_SETTINGS.chartEasypie();
    });

    $(window).resize(function() {});

    $(window).load(function() {});

});
