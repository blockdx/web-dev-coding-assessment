<?php
//Can append ?year=XXXX to end of URL to change year (ex ?year=2012)
    function draw_calendar($year)
    {
        $calendar.= '<!DOCTYPE html>
                <html>
                <head>
                <meta charset="UTF-8">
                <title>Calendar</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <style>
                    #today {
                        background-color: lightgreen;
                    }
                    .day-number {
                        text-align: center;
                    }
                    .calendar-week {
                        width: 14%;
                        text-align: center;
                    }
                    .container {
                        text-align: center;
                    }
                    .col-centered{
                        float: none;
                        margin: 0 auto;
                    }
                </style>
                </head>
                <body>';
        date_default_timezone_set("America/New_York");
        $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        for ($month = 1; $month <= 12; $month++)
        {
            //create header
            $header = '<h2>'.$months[$month-1].' '.$year.'</h2>';
            $calendar.= '<div class="row"><div class="container col-xs-6 col-centered"> <table class="table table-bordered">';
            
        	// write calendar table headings 
        	$headings = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        	$calendar.= $header.'<tr><td class="calendar-week">'.implode('</td><td class="calendar-week">',$headings).'</td></tr>';
         
        	$starting_day = date('w', mktime(0, 0, 0, $month, 1, $year)); //the starting day of the week
        	$days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        	$days_this_week = 1;
        	$day_counter = 0;
        	$end_of_month = 0;
         
        	// row for week one 
        	$calendar.= '<tr>';
        	
        	// display blank days until starting day of the current week
        	for($day = 0; $day < $starting_day; $day++):
        		$calendar.= '<td> </td>';
        		$days_this_week++; //add blank day to days
        	endfor;
         
        	// write days
        	for ($day = 1; $day <= $days_in_month; $day++):
        		if ($day != date('d') && $month != date('n'))
        		{
        			$current_day = ''; //add blank td per day (that isnt today)
        		}
        		$calendar.= '<td class="calendar-day'.$current_day.'">';
        		
        			// Add in the day number
                    if ($day == date('d') && $month == date('n') && $year == date('Y')) //this day = today
        			{
        				$showtoday = '<div id="today"> <strong>'.$day.'</strong></div>'; //add today (special styling)
        			}else {
        			    $showtoday = $day;
        			}
        			$calendar.= '<div class="day-number">'.$showtoday.'</div>'; //commit the date number to the td
         
        		// end of first week
        		$calendar.= '</td>';
        		if($starting_day == 6):
        			$calendar.= '</tr>'; // if end of week, end row
        			if (($day_counter+1) != $days_in_month) //if today is not end of month, start new row
        			{
        				$calendar.= '<tr>';
        			} else 
        			{
        			    $end_of_month = 1; // is end of month, so no need for new row
        			}
        			$starting_day = -1; // if end of week, mark as sunday-1 so when incrementing below, it goes to 0 (sunday)
        			$days_this_week = 0; //reset days this week
        		endif;
        		$days_this_week++;
        		$starting_day++;
        		$day_counter++;
        	endfor;
         
        	// Finish the rest of blank days in the week
        	if(($days_this_week < 8) && ($end_of_month == 0)): //last row of calendar, if end of month already has happened (ie on the last day of the previous week), do not add new cells
        		for($x = 1; $x <= (8 - $days_this_week); $x++):
        			$calendar.= '<td> </td>';
        		endfor;
        	endif;
         
        	// final row
        	$calendar.= '</tr>';
    
        	// end table tags
        	$calendar.= '</table> </div> </div>';
        }
        // end tags and return
        $calendar.= '</body>
                     </html>';
        return $calendar;
    }
    
    $do_year = 2017; //default to 2017
    if (!empty($_GET['year'])) { //if param in url, use it over default 2017
        $do_year = $_GET['year'];
    }
    
    echo draw_calendar($do_year);
?>

