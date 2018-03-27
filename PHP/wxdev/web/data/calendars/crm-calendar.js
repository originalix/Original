
jQuery(function($) {

    'use strict';

    var CMPLTADMIN_SETTINGS = window.CMPLTADMIN_SETTINGS || {};


    /*--------------------------------
         Full Calendar
     --------------------------------*/
    CMPLTADMIN_SETTINGS.dataCalendar = function() {


        if ($.isFunction($.fn.fullCalendar)) {

            /* initialize the external events
                 -----------------------------------------------------------------*/

            $('#external-events .fc-event').each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });

            });


            /* initialize the calendar
             -----------------------------------------------------------------*/

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#crm-calendar-calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }

                },
                events: [{
                    title: 'Counseling',
                    start: new Date(y, m, 1)
                }, {
                    title: 'Consulting',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2)
                }, {
                    id: 999,
                    title: 'Status Check',
                    start: new Date(y, m, d - 3, 16, 0),
                    allDay: false
                }, {
                    id: 999,
                    title: 'New Client',
                    start: new Date(y, m, d + 4, 16, 0),
                    allDay: false
                }, {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false
                }, {
                    title: 'Counseling',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false
                }, {
                    title: 'Conference',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false
                }, {
                    title: 'Staff Meeting',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/'
                }]
            });





            /*Add new event*/
            // Form to add new event

            $("#add_event_form").on('submit', function(ev) {
                ev.preventDefault();

                var $event = $(this).find('.new-event-form'),
                    event_name = $event.val();

                if (event_name.length >= 3) {

                    var newid = "new" + "" + Math.random().toString(36).substring(7);
                    // Create Event Entry
                    $("#external-events").append(
                        '<div id="' + newid + '" class="fc-event bg-accent">' + event_name + '</div>'
                    );


                    var eventObject = {
                        title: $.trim($("#" + newid).text()) // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $("#" + newid).data('eventObject', eventObject);

                    // Reset draggable
                    $("#" + newid).draggable({
                        revert: true,
                        revertDuration: 0,
                        zIndex: 999
                    });

                    // Reset input
                    $event.val('').focus();
                } else {
                    $event.focus();
                }
            });



        }

    };


    /******************************
     initialize respective scripts 
     *****************************/
    $(document).ready(function() {
        CMPLTADMIN_SETTINGS.dataCalendar();
    });

    $(window).resize(function() {
    });

    $(window).load(function() {
    });

});
