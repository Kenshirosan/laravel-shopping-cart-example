<template>
    <div>
        <div class="col mt-5">
            <div id="calendar"></div>
        </div>
        <div style="overflow:hidden;">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                        <div class="datetimepicker"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    require('fullcalendar')
    export default {
        $('#calendar').fullCalendar({});
    }
</script>

<script>
    $(function () {
    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
        ele.each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            }
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject)

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex        : 1070,
              revert        : true, // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
            })

        })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/

    //Date for the calendar events
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
        header    : {
            left  : 'prev,next today',
            center: 'title',
            right : 'month,agendaWeek,agendaDay'
      },
        buttonText: {
            today: 'today',
            month: 'month',
            week : 'week',
            day  : 'day'
        },

        // update events on click
        eventClick: function(event, element) {
            // Trying to get sweetalert to update events
            // swal({
            //     text: 'Pick a new date and/or time.',
            //     content: 'div',
            //     className: 'datetimepicker',
            //     button: {
            //         text: "Go!",
            //         closeModal: false,
            //   },
            // })

            // $('.datetimepicker').datetimepicker({
            //     inline: true,
            //     sideBySide: true
            // });
            // var date = $(".datetimepicker").data("DateTimePicker").date();
            // $(".datetimepicker").on('click', function(){
            //     console.log($(this).html());
            // });
            event.title = prompt(event.title +' change the title?');
            if(event.title == 'delete') {
                return axios.delete('/things-to-do/'+event.id, event).then(flash('Event successfully deleted'))
            } else {
                event.start = prompt('new date ? eg 2017-11-11 14:00:00');
                event = {
                    id: event.id,
                    title: event.title,
                    start: event.start,
                    allDay: false,
                    backgroundColor: event.color,
                }
                axios.patch('/things-to-do/'+event.id, event).then(flash('Event successfully modified'))
            }
        },

      //fetch events
      events: function(start, end, timezone, callback) {
        $.ajax({
            url: '/calendar',
            dataType: 'json',
            // display on calendar
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
    droppable : true, // this allows things to be dropped onto the calendar !!!
    drop      : function ( date, allDay) { // this function is called when something is dropped
        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')
        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)
        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = false
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')
        // persist event
        axios.post('/things-to-do', copiedEventObject).then(flash('event successfully added'))

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked? the remove element
        if ($('#drop-remove').is(':checked')) {
          $(this).remove()
        }
    }
})

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
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
        'border-color'    : currColor,
        'color'           : '#fff'
        }).addClass('external-event')
        event.html(val)
        $('#external-events').prepend(event)

        //Add draggable funtionality
        init_events(event)

        //Remove event from text input
        $('#new-event').val('')
    })
})
</script>