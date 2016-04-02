<?php 

namespace App\Helpers;

use Carbon\Carbon;


/**
 * Simple Helper Class for drawing Calendar
 */
class CalendarHelper
{
    public static function drawCalendar($year, $month) {


        $date = Carbon::create($year,$month,1);


        $calendar2 = '<div class="datepicker-embed">
                        <div class="datepicker datepicker-inline">
                            <div class="datepicker-days" style="display: block;">';

        $calendar2 .= '<table class="calendar table-condensed" data-year="'.$year.'" data-month="'.$month.'">
          <thead>
            <tr><th colspan="7" class="datepicker-title" style="display: none;"></th></tr>
            <tr>
              <th class="prev monthChange" style="visibility: visible;">«</th>
              <th colspan="5" class="datepicker-switch">'.  $date->format('F'). ' '. $date->format('Y')  .'</th>
              <th class="next monthChange" style="visibility: visible;">»</th>
            </tr>
            <tr>
              <th class="dow">Mo</th>
              <th class="dow">Tu</th>
              <th class="dow">We</th>
              <th class="dow">Th</th>
              <th class="dow">Fr</th>
              <th class="dow">Sa</th>
              <th class="dow">Su</th>
            </tr>
          </thead> ';


        $calendar = '<table cellpadding="0" cellspacing="0" class="calendar table table-bordered" data-year="'.$year.'" data-month="'.$month.'">';

        $headings = array('Mon.','Tue.','Wed.','Thu.','Fr.','Sat.','Sun.');
        $calendar.= '<tr class="calendar-row">';

        //we draw a row with headings
        for ($i = 0; $i < count($headings); $i++ ) {
          $calendar.= '<th class="">'.$headings[$i].'</th>';
        }
       
        $calendar.= '</tr>';
        
        $thisMonth = $date->month;                
        $thisYear = $date->year;                 
        $daysInMonth = $date->daysInMonth;    
        $now = Carbon::now();

        $thisDay = null;
       
        if ($month == $thisMonth && $year == $thisYear) {
            $thisDay = $now->day;
        }

        // $daysInYear = isLeapYear($year) ? 366 : 365;
        $firstOfMonth = $date->firstOfMonth(); //first day of month 2015 11 01
        $numericFirstDayOfMonth = $firstOfMonth->dayOfWeek; // falls on what day of week (0-6) -> in November it's sunday so int(0)   // 0-sun, 1-mon, 2-tue, 3-wed, 4-thu, 5-fr, 6-sat
       
        $leadingEmpty = 0; // sum of empty td , if it's 0 it's monday so we don't need empty spaces
        $lastOfMonth = $date->lastOfMonth()->dayOfWeek;
        
        if ($numericFirstDayOfMonth != 1) { //if it's not 1 - it's not a monday!
          if ($numericFirstDayOfMonth == 0) { //if 0 it's - it's sunday 
            $leadingEmpty = 6; //so we need 6 empty spaces
          } else {
            $leadingEmpty = $numericFirstDayOfMonth-1; //if its e.g. Thursday (4) we need 3 empty spaces before 
          }
        }

        $daysNumber = 1; //var which help to iterate days in month from 1 to $daysInMonth
        $calendar2.='<tr class="calendar-row">';
        //first row with empty td
        for ( $i = 1 ; $i <= 7; $i ++) {
          if ($i <= $leadingEmpty) { 
            $calendar2.= '<td class=""></td>'; 
          } else { 

            if ($thisDay == $daysNumber) {
              $calendar2.='<td class="day active">'.$daysNumber.'</td>';
            } else {
              $calendar2.='<td class="day">'.$daysNumber.'</div></td>';
            }
            $daysNumber++;
          }
        }
        $calendar2.='</tr>';

      
        $daysInThisWeek = 1;

        //- from currentDay after first row untill daysInMonth ex. 4 to 31
        for ($i = $daysNumber; $i <= $daysInMonth; $i++) {

          $currentDate = Carbon::create($year,$month,$i);

          //- It's Monday! we start new calendar row
          if ($currentDate->dayOfWeek === Carbon::MONDAY) {
            $calendar2.='<tr class="calendar-row">';
          }

          if ($currentDate->isToday()) {
            $calendar2.='<td class="day">'.$i.'</td>';
          } else  {
            $calendar2.='<td class="day">'.$i.'</td>';
          }

          //- It's Sunday! we  end calendar row
          if ($currentDate->dayOfWeek === Carbon::SUNDAY) {
            $calendar2.='</tr>';
          }      
        }

        $empty_fields = 7-(int)$lastOfMonth;
        for ($i = 0; $i < $empty_fields; $i ++) {
          $calendar2.= '<td class=""></td>'; 
        }


        $calendar2 .= '</table>';
        $calendar2 .= '</div></div></div>';



        return $calendar2;
      }
}