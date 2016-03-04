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

    return $this->hasMany('App\UserPermission', 'id', 'authorized_user_id');
  }

   public function tasks()
  {
    return $this->hasMany(Task::class);
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

  public static function getUserBmr() {

    $user = Auth::user();
    $age = $user->getUserAge();  
    $sex = $user->sex;
    $currentMeasurements = User::getCurMeasurements();
    $weight = $currentMeasurements['weight'];
    $height = $currentMeasurements['height'];
    $activity = 1.2; //litlle or no exercises

      if( $sex == 'female') {
         $result = (655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age)) * $activity;
      } else {

          $result = (66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age)) * $activity;
      }
    $bmr =  round($result);
    
    return $bmr;
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

  public static function getCurMeasurements()
  {
    $sessionId =  Auth::user()->id;
    $currentMeasurements = Measurement::where('user_id', $sessionId)->orderBy('date', 'desc')->select('height', 'weight', 'body_fat')->first();
    return $currentMeasurements;
   
  }

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
