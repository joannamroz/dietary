<?php

namespace App;

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

    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'sex', 'date_of_birth'];

    // protected $guarded = array('id', 'password');

    public function permissions() {

        return $this->hasMany('App\UserPermissions', 'id', 'authorized_user_id');
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
       
    public function is_admin() {

        $role = $this->role;
        if ($role == 'admin') {
          return true;
        }
        return false;
    }

    public function is_user() {

        $role = $this->role;
        if ($role == 'user') {
          return true;
        }
        return false;
    }


    public function can_add_food() {

        $role = $this->role;
        if ($role == 'user') {
          return true;
        }
        return false;
    }    
    public function can_add_brand() {

        $role = $this->role;
        if ($role == 'user') {
          return true;
        }
        return false;
    }   
    /* draws a calendar */
    public static function draw_calendar($month, $year) {

        $now = new \DateTime();

        $thisMonth = $now->format('m');
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
        $running_day = date('w',mktime(0,0,0,$month,1,$year));
        //var_dump($running_day);3 first day of the month
        $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();

        /* row for week one */
        $calendar.= '<tr class="calendar-row">';

        /* print "blank" days until the first of the current week */
        for ($x = 1; $x < $running_day; $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
            $days_in_this_week++;
        endfor;

        /* keep going with days.... */
        for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
            if ($thisDay==$list_day){
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
    public static function getUserBMIrange($bmi) {
        $rangeInArray = array(array(0, 16, 'Staravtion'), array(16, 17, 'Emaciation'), array(17, 18.5, 'Underweight'), array(18.5, 25, 'Healthy'), array(25 ,30, 'Overweight'),array(30, 35, 'First stage of obesity'), array(35, 40, 'Second stage of obesity'),array(40, 100, 'Third stage of obesity'));

        for($i = 0; $i < count($rangeInArray); $i++) {
            $range = $rangeInArray[$i];
                if ( $bmi > $range[0] && $bmi <= $range[1] ){
                    return $range[2];
                }
        }
    }
    public function can_add_meal() {

        $role = $this->role;
        if ($role == 'user') {
          return true;
        }
        return false;
    }  
    public function getUserAge(){
        return $this->date_of_birth->diffInYears(Carbon::now());
    }
}
