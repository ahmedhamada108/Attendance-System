<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class attendance extends Model
{
    protected $table= 'attendance';
    protected $fillable = [
        'id',
        'employee_id',
        'login_date',
        'logout_date',
        'working_hours',
        'created_at',
        'updated_at'
    ];

    public function employee(){
        return $this->hasOne(employees::class,'id','employee_id');
    }


    public static function GetNotLogoutEmplyees(){

        return attendance::with('employee:id,name')->
        select(['id','employee_id','login_date','logout_date','working_hours'])->
        where([
              ['logout_date',null],
              ['login_date','!=',null]
            ])->whereDay('created_at',date('d'))->get();
    }
    public static function GetAttendsToday(){

      return attendance::with('employee:id,name')->
      select(['id','employee_id','login_date','logout_date','working_hours'])->
      where([
        ['login_date','!=',null]
        ])->whereDay('created_at',date('d'))->get();
    }
    public static function GetAbsenceEmplyeesToday(){

        return attendance::with('employee:id,name')->
        select(['id','employee_id','login_date','logout_date','working_hours'])->
        where([
            ['login_date',null]
        ])->whereDay('created_at',date('d'))->get();
    }

    public static function GetAllDaysOfMonthByEmplyee($employee_id,$month){

       return attendance::where([
            ['employee_id',$employee_id]
            ])->whereMonth('created_at',$month)->get();
    }

    public static function GetAttendDaysOfMonthByEmployee($employee_id,$month){

       return attendance::where([
            ['employee_id',$employee_id],
            ['login_date','!=',null],
            ['logout_date','!=',null]
            ])->whereMonth('created_at',$month)->get();
    }

    public static function GetAbsenceDaysOfMonthByEmployee($employee_id,$year,$month){

        return attendance::with('employee:id,name')->
        select(['id','employee_id','login_date','logout_date','working_hours'])->
        where([
            ['employee_id',$employee_id],
            ['login_date',null],
            ['logout_date',null]
            ])->whereYear('created_at',$year)->whereMonth('created_at',$month)->get();
    }

    public static function GetTotalHoursWorkingByMonth($employee_id,$month){
        return $data= attendance::where([
            ['employee_id',$employee_id],
            ['login_date','!=',null],
            ['logout_date','!=',null]
            ])->whereMonth('created_at',$month)->sum('working_hours');
    }

}
