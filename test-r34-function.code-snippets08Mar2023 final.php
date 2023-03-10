<?php

function calendar_exclude_event_callback($exclude, $event, $args) {
 // make your code do something with the arguments and return something
 /* This version of the procedure is able to replace https://icalfilter.com as an external filter 
 *  selecting events from an ics calendar file. This procedure may be put to work  if required. 
 *  The procedure allows to select events based on the definition in the short code option "customoptions" 
 *  in the ICS Calendar Plugin from Room 34. 
 *  The following logic must be applied:
 *  ICS Calendar definition for customoptions ="key1=value1|key2=value2|.....|key(n)=value(n)"
 *  It is important to separate the pairs by the colon sign "|" !! 
 *  (for details see https://icscalendar.com/developer/#r34ics_display_calendar_exclude_event
 *  For the key(n) please use a valid ICS property (e.g. "summary") and for corresponding value(n) the desired value
 *  the ICS property. The procedure selects all events where the ICS properties defined in the key(n) meet 
 *  the defined values in the corrosponding value(n). 
 *  All other events are excluded and are not published in the calendar!
*/
//===============================================================
// return false;   //if return is false nothing is excluded
// return true;	//if return is true events are excluded
//===============================================================

	$argsres = @$args;
	foreach ($argsres as $arr_res) {			// loops through the array args provided from ICS_Calendar
	if (is_array($arr_res) && $arr_res[0]<> "" ) {   	// checks whether $arr_ress is an array and the first element of the $arr_res is NOT empty
		$val_cnt = count($arr_res);
		$val_str = $arr_res[0];
		$index = 0;
		foreach ($arr_res as $val){  			// loops through inner array $arr_res and reads the content to $val)
			$index++;
			$val_len = strlen($val);	
				if (strlen($val)>0) {
					$val_sepstr = strpos($val, "=");		//determines the position of the "=" in the string
					$val_r34val = substr($val, $val_sepstr +1); 	//shows the string without the "=" sign
					$val_r34key = substr($val,0,$val_sepstr);
					$res_str = stristr(@$event->$val_r34key,$val_r34val);
 					if ($res_str == true) {
						return false;}  	//event is included
					}

				}	
			if ($res_str == false) {return true;} 		//event is excluded
			}
		}

	}

// now hook the callback function to the 'example_filter'
add_filter( 'r34ics_display_calendar_exclude_event', 'calendar_exclude_event_callback', 10, 3 );
