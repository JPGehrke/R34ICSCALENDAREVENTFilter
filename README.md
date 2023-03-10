# R34ICSCALENDAREVENTFilter
r34ics_display_calendar_exclude_event - custom code
The wordpress plugin ICS_CALENDAR from Room 34 (https://icscalendar.com/) offers several options 
customising the output for the events of the calendar (see https://icscalendar.com/developer/). 
The routing "r34ics_display_calendar_exclude_event" provides the option excluding events from the 
calendar feed URL based on certain criteria. 
The actual procedure uses the available short code option "customoptions" in the ICS Calendar Plugin.
The following logic must be applied:
ICS Calendar definition for customoptions ="key1=value1|key2=value2|.....|key(n)=value(n)"
It is important to separate the pairs by the colon sign "|" !! 
(for details see https://icscalendar.com/developer/#r34ics_display_calendar_exclude_event)
For key(n) please use a valid ICS property (e.g. "summary" or "location") and for corresponding value(n) the desired value
the ICS property. The current code selects all events where the defined ICS properties in the key(n) meet 
the defined values in the corrosponding value(n). 
All other events are excluded and are not published in the calendar!
