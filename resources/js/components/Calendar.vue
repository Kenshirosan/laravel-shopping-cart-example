<template>
    <div>
        <div class="col mt-5">
            <div id="calendar"></div>
        </div>
    </div>
</template>

<script>
    import fullcalendar from "fullcalendar";

    export default {
        $('#calendar').fullCalendar({});
    }
</script>

<script>

// import swal from 'sweetalert';

$(function () {
    /* initialize the external events
     --------------------------------------------*/
    function init_events(ele) {
        ele.each(function () {
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
            // use the element's text as the event title
            title: $.trim($(this).text())
            }
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject)
                    // make the event draggable using jQuery UI
                $(this).draggable({
                zIndex        : 1070,
                // will cause the event to go back to its original position after the drag
                revert        : true,
                revertDuration: 500
            })
        })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/

    //Date for the calendar events
    var date = new Date()
    var d = date.getDate(),
    m = date.getMonth(),
    y = date.getFullYear()
    $('#calendar').fullCalendar({
        header    : {
            left  : 'prev, next, today',
            center: 'title',
            right : 'month, agendaWeek, agendaDay'
        },
        buttonText: {
            today: 'today',
            month: 'month',
            week : 'week',
            day  : 'day'
        },
    // update or delete events on click, will implement a proper delete button sometimes...
        eventClick: function(event, element) {
            swal({
                text: 'Pick a new date and/or time.',
                    content: 'div',
                    className: 'datetimepicker',
                    button: {
                    text: "Update",
                            closeModal: true,
                    }
            })

            $('.datetimepicker').datetimepicker({
                inline: true,
                    sideBySide: true
                });

                $(".datetimepicker").on('click', function() {
                    let date = $(this).data("DateTimePicker").date();

                    if (date < new Date()) {
                        adminflash("Invalid date", 'error')
                        date = event.start;
                    }

                    date = moment(date).format("YYYY-MM-DD HH:mm:ss");
                    event = {
                        id: event.id,
                        title: event.title,
                        start: date,
                        allDay: false,
                        backgroundColor: event.color,
                    }
                    axios.patch('/things-to-do/' + event.id, event)
                        .then(adminflash("Event successfully modified"))
                        .then(
                            setTimeout(function() {
                                location.reload();
                            }, 1000)
                        ).catch(e => console.log(e))
                });
        },
//!!!!!!!!!!!!!!!! fetch events and display on calendar!!!!!!!!!!!!!!!!!!!!!!!!!!//
        events: function(start, end, timezone, callback) {
            $.get({
                url: '/calendar',
                dataType: 'json',
                success: function(doc) {
                    var events = [];
                    $(doc).each(function() {
                        events.push({
                            id: $(this).attr('id'),
                            title: $(this).attr('title'),
                            start: $(this).attr('start'),
                            end: $(this).attr('end'),
                            color: $(this).attr('color'),
                            url: $(this).attr('url')
                        });
                    });

                    callback(events);
                }
            });
        },
        editable  : true,
        selectable: true,
        droppable : true, // this allows things to be dropped onto the calendar
        drop      : function (date, allDay) { // this function is called when something is dropped
            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject')
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject)
                // assign it the date that was reported
            copiedEventObject.start = date
            copiedEventObject.allDay = false
            copiedEventObject.color = $(this).css('background-color')
            copiedEventObject.borderColor = $(this).css('border-color')
                // persist event
            axios.post('/things-to-do', copiedEventObject)
                .then(flash("event successfully added"))
                .then(
                    setTimeout(function() {
                    location.reload();
                    }, 3000)
                )

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                // is the "remove after drop" checkbox checked? then remove element
            if ($('#drop-remove').is(':checked')) {
                $(this).remove()
            }
        }
    })

            /* Create events to be dropped */
            //Blue by default
    var currColor = '#3c8dbc'
            //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
        e.preventDefault()
        //Save color
        currColor = $(this).css('color')
        //Add color effect to button
        $('#add-new-event').css({ 'background-color': currColor, 'border-color': 'white' })
    })

    $('#add-new-event').click(function (e) {
        e.preventDefault()
        //Get value and make sure it is not null
        var val = $('#new-event').val()

        if (val.length == 0) {
            return
        }

    //Create events
        var event = $('<div />')
        event.css({
            'background-color': currColor,
            'border-color'    : 'rgb(0, 0, 0)',
            'color'           : '#fff'
        }).addClass('external-event')

        event.html(val)

        $('#external-events').prepend(event)
        //Add draggable funtionality
        init_events(event)

        //Remove event from text input
        $('#new-event').val('')
    });
});
</script>