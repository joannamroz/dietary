<?php

namespace App;
use Auth;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Carbon\Carbon;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
  use Authenticatable, CanResetPassword;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  protected $fillable = ['name', 'email', 'password', 'sex', 'date_of_birth'];

  protected $dates = ['created_at', 'updated_at', 'date_of_birth'];


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  

  // protected $guarded = array('id', 'password');

  public function permissions()
  {

    return $this->hasMany('App\UserPermissions', 'id', 'authorized_user_id');
  }

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];
     
  public function is_admin()
  {

    $role = $this->role;
    if ($role == 'admin') {
      return true;
    }
    return false;
  }

  public function is_user()
  {

    $role = $this->role;
    if ($role == 'user') {
      return true;
    }
    return false;
  }

  /* Need to redesign this function and move it to some sort of helper */
  public static function draw_calendar($month, $year) {

    $selectedMonth = Carbon::create($year, $month, 1); /*creating calendar starting from day 1*/
    
    $now = new \DateTime();

    $thisMonth = $now->format('m'); 
    $nameMonth = $now->format('F');
    $thisYear = $now->format('Y');
    $thisDay = null;


    if ($month == $thisMonth && $year == $thisYear) {
        $thisDay = $now->format('d');
    }
    /* draw table */
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar table" data-year="'.$year.'" data-month="'.$month.'">';

    /* table headings */
    $headings = array('Mon.','Tue.','Wed.','Thu.','Fr.','Sat.','Sun.');

    $calendar.= '<tr class="calendar-row"><th class="calendar-day-head">'.implode('</th><th class="calendar-day-head">',$headings).'</td></tr>';

    /* days and weeks vars now ... */
    $running_day = date('w',mktime(0,0,0,$month,1,$year)); /*FIRST falls on what day of week (0-6)*/
     /* 0-tue, 1-wed, 2-thu, 3-Fr, 4-sat, 5-sun, 6-mon*/
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year)); /*how many days in month*/
    $running_day_name = date('l', mktime(0,0,0,$month,'1',$year)); /*FIRST falls on what day of week Full Name*/
  
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar.= '<tr class="calendar-row">';

    /* print "blank" days until the first of the current week */

    //- matt: we want our callendar to start from Monday so we calculate running_day by substracting 7 - (frist day of week in selected month)
    $running_day = 7 - $selectedMonth->dayOfWeek;

    for ($x = 1; $x < $running_day; $x++):
      $calendar.= '<td class="calendar-day-np"> </td>';
      $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for ($list_day = 1; $list_day <= $days_in_month; $list_day++):

      if ($thisDay==$list_day) {
        $calendar.= '<td class="calendar-day today">';
      } else {
        $calendar.= '<td class="calendar-day">';
      }
      /* add in the day number */
      $calendar.= '<div class="day-number">'.$list_day.'</div>';

      /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
      $calendar.= str_repeat('<p> </p>',2);
          
      $calendar.= '</td>';

      if ($running_day == 7):
        $calendar.= '</tr>';

        if (($day_counter+1) != $days_in_month):
          $calendar.= '<tr class="calendar-row">';
        endif;

        $running_day = 0;
        $days_in_this_week = 0;

      endif;

      $days_in_this_week++; $running_day++; $day_counter++;

    endfor;

    /* finish the rest of the days in the week */
    if ($days_in_this_week < 8):
      for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
      endfor;
    endif;

    /* final row */
    $calendar.= '</tr>';

    /* end the table */
    $calendar.= '</table>';
    
    /* all done, return result */
    return $calendar;
  }

  public static function getUserBMIrange($bmi)
  {
    $rangeInArray = array(array(0, 16, 'Staravtion'), array(16, 17, 'Emaciation'), array(17, 18.5, 'Underweight'), array(18.5, 25, 'Healthy'), array(25 ,30, 'Overweight'),array(30, 35, 'First stage of obesity'), array(35, 40, 'Second stage of obesity'),array(40, 100, 'Third stage of obesity'));

    for ($i = 0; $i < count($rangeInArray); $i++) {
      $range = $rangeInArray[$i];
        if ( $bmi > $range[0] && $bmi <= $range[1] ) {
          return $range[2];
        }
    }
  }

  public static function getCurrentMeasurements()
  {
    $sessionId =  Auth::user()->id;
    $currentMeasurements = Measurements::where('user_id', $sessionId)->orderBy('date', 'desc')->select('height', 'weight','body_fat')->get();
    return $currentMeasurements;
   
  }

  // public function can_add_meal()
  // {
  //   $role = $this->role;
  //   if ($role == 'user') {
  //     return true;
  //   }
  //   return false;
  // }  
  public function getUserAge()
  {

    $formattedDateStr = Carbon::createFromFormat("Y-m-d H:i:s", $this->date_of_birth);
    
    return  $formattedDateStr->diffInYears(Carbon::now());
  }
  public static function isLeapYear($year)
  {
      return ($year % 4 == 0 && $year % 100 != 0 || $year % 400 == 0);
  }

  public static function calendar($year, $month)
  {
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar table table-bordered" data-year="'.$year.'" data-month="'.$month.'">';

    $headings = array('Mon.','Tue.','Wed.','Thu.','Fr.','Sat.','Sun.');
    $calendar.= '<tr class="calendar-row">';

    //we draw a row with headings
    for ($i = 0; $i < count($headings); $i++ ) {
      $calendar.= '<th class="calendar-day-head">'.$headings[$i].'</th>';
  
    }
   
    $calendar.= '</tr>';
    $date = Carbon::create($year,$month,1);
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
    $calendar.='<tr class="calendar-row">';
    //first row with empty td
    for ( $i = 1 ; $i <= 7; $i ++) {
      if ($i <= $leadingEmpty) { 
        $calendar.= '<td class="calendar-day-np"></td>'; 
      } else { 

        if ($thisDay == $daysNumber) {
          $calendar.='<td class="calendar-day today"><div class="day-number">'.$daysNumber.'</div></td>';
        } else {
          $calendar.='<td class="calendar-day"><div class="day-number">'.$daysNumber.'</div></td>';
        }
        $daysNumber++;
      }
    }
    $calendar.='</tr>';

  
    $daysInThisWeek = 1;

    //- from currentDay after first row untill daysInMonth ex. 4 to 31
    for ($i = $daysNumber; $i <= $daysInMonth; $i++) {

      $currentDate = Carbon::create($year,$month,$i);

      //- It's Monday! we start new calendar row
      if ($currentDate->dayOfWeek === Carbon::MONDAY) {
        $calendar.='<tr class="calendar-row">';
      }

      if ($currentDate->isToday()) {
        $calendar.='<td class="calendar-day today"><div class="day-number">'.$i.'</div></td>';
      } else  {
        $calendar.='<td class="calendar-day"><div class="day-number">'.$i.'</div></td>';
      }

      //- It's Sunday! we  end calendar row
      if ($currentDate->dayOfWeek === Carbon::SUNDAY) {
        $calendar.='</tr>';
      }      
    }

    $empty_fields = 7-(int)$lastOfMonth;
    for ($i = 0; $i < $empty_fields; $i ++) {
      $calendar.= '<td class="calendar-day-np"></td>'; 
    }


    $calendar.= '</table>';
    return $calendar;
  }
}
