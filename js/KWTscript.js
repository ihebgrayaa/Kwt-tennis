document.addEventListener('DOMContentLoaded', function () {
    (function (jQuery) {
        // initalise the dialog
        jQuery('#eventModal').dialog({
            title: 'Event',
            dialogClass: 'wp-dialog',
            autoOpen: false,
            draggable: false,
            width: 'auto',
            modal: true,
            resizable: false,
            closeOnEscape: true,
            position: {
                my: "center",
                at: "center",
                of: window
            },
            open: function () {
                // close dialog by clicking the overlay behind it
                jQuery('.ui-widget-overlay').bind('click', function () {
                    jQuery('#eventModal').dialog('close');
                })
            },
            create: function () {
                // style fix for WordPress admin
                jQuery('.ui-dialog-titlebar-close').addClass('ui-button');
            },
        });
    })(jQuery);

    var calendarEl = document.getElementById('calendar');

    jQuery.ajax({

        type: "get",

        dataType: "json",

        url: KWT_ajax.ajax_url,

        data: { action: "programs_ajax" },

        success: function (events) {
            if (events != null) {
                var eventsArray = [];
                jQuery.map(events, function (event) {
                    eventsArray.push({
                        daysOfWeek: event.day,
                        title: event.title,
                        startTime: event.start_time,
                        endTime: event.end_time,
                        startRecur: event.date_start,
                        endRecur: event.date_end,
                        color: event.color,
                        place_number: event.place_number,
                        coach: event.coach,
                        groups: event.groups,
                        levels: event.levels,
                        start_time: event.start_time,
                        end_time: event.end_time
                    })
                });
                var today = new Date();
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {

                        left: 'prev,next today',

                        center: 'title',

                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'

                    },
                    initialView: 'timeGridWeek',

                    initialDate: today,

                    navLinks: true, // can click day/week names to navigate views

                    businessHours: true, // display business hours

                    editable: false,

                    selectable: true,

                    events: eventsArray,

                    eventClick: function (info) {
                        var data = info.event.extendedProps;
                        jQuery('#eventModal h3').html(info.event.title);
                        jQuery('#placeNumber').html(data.place_number);
                        jQuery('#coachName').html(data.coach);
                        jQuery('#groupName').html(data.groups[0].name);
                        jQuery('#levelsName').html(data.levels[0].name);
                        jQuery('#time').html(data.start_time + ' -> ' + data.end_time);
                        jQuery('.ui-dialog-titlebar').css('background', info.event._def.ui.backgroundColor);
                        jQuery('#eventModal').dialog('open');
                    }

                });

                calendar.render();
            } else {
                console.log('no data');
            }

        }

    });
});







