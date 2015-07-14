
<!DOCTYPE html>
<html>
<head>
    <title>FullCalendar by Creative Tim </title>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta name="keywords" content="creative tim, calendar, calendar plugin, twitter bootstrap, bootstrap, jquery plugin, bootstrap plugin, beautiful calendar, minimal calendar, ios7 calendar, slick calendar">
    <meta name="description" content="FullCalendar is a jQuery plugin with a beautiful interface made by Creative Tim. ">

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="FullCalendar by Creative Tim">
    <meta itemprop="description" content="FullCalendar is a jQuery plugin with a beautiful interface made by Creative Tim.">
    <meta itemprop="image" content="http://s3.amazonaws.com/creativetim_bucket/products/11/opt_full_calendar_thumbnail3.jpg">
    
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="FullCalendar by Creative Tim">
    <meta name="twitter:description" content="FullCalendar is a jQuery plugin with a beautiful interface made by Creative Tim.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="http://s3.amazonaws.com/creativetim_bucket/products/11/opt_full_calendar_thumbnail3.jpg">

    <!-- Open Graph data -->
    <meta property="og:title" content="FullCalendar by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://demos.creative-tim.com/fullcalendar" />
    <meta property="og:image" content="http://s3.amazonaws.com/creativetim_bucket/products/11/opt_full_calendar_thumbnail3.jpg" />
    <meta property="og:description" content="FullCalendar is a jQuery plugin with a beautiful interface made by Creative Tim." />
    <meta property="og:site_name" content="Creative Tim" />
    
<link href='css/fullcalendar.css' rel='stylesheet' />
<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='js/jquery-1.10.2.js' type="text/javascript"></script>
<script src='js/jquery-ui.custom.min.js' type="text/javascript"></script>
<script src='js/fullcalendar.js' type="text/javascript"></script>
<script>

    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        
        /*  className colors
        
        className: default(transparent), important(red), chill(pink), success(green), info(blue)
        
        */      
        
          
        /* initialize the external events
        -----------------------------------------------------------------*/
    
        $('#external-events div.external-event').each(function() {
        
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
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
            
        });
    
    
        /* initialize the calendar
        -----------------------------------------------------------------*/
        
        var calendar =  $('#calendar').fullCalendar({
            header: {
                left: 'title',
                center: 'agendaDay,agendaWeek,month',
                right: 'prev,next today'
            },
            editable: true,
            firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
            selectable: true,
            defaultView: 'month',
            
            axisFormat: 'h:mm',
            columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
            },
            allDaySlot: false,
            selectHelper: true,
            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
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
            
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d-3, 16, 0),
                    allDay: false,
                    className: 'info'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d+4, 16, 0),
                    allDay: false,
                    className: 'info'
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    className: 'important'
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false,
                    className: 'important'
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d+1, 19, 0),
                    end: new Date(y, m, d+1, 22, 30),
                    allDay: false,
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/',
                    className: 'success'
                }
            ],          
        });
        
        
    });

</script>
<style>

    body {
        margin-top: 40px;
        text-align: center;
        font-size: 14px;
        font-family: "Helvetica Nueue",Arial,Verdana,sans-serif;
        background-color: #DDDDDD;
        }
        
    #wrap {
        width: 1100px;
        margin: 0 auto;
        }
        
    #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        text-align: left;
        }
        
    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
        }
        
    .external-event { /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 2px 4px;
        background: #3366CC;
        color: #fff;
        font-size: .85em;
        cursor: pointer;
        }
        
    #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
        }
        
    #external-events p input {
        margin: 0;
        vertical-align: middle;
        }

    #calendar {
/*      float: right; */
        margin: 0 auto;
        width: 900px;
        background-color: #FFFFFF;
          border-radius: 6px;
        box-shadow: 0 1px 2px #C3C3C3;
        }

</style>
</head>
<body>
<div id='wrap'>

<div id='calendar'></div>

<div style='clear:both'></div>
</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46172202-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>
