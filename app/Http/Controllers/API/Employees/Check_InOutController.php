<?php

namespace App\Http\Controllers\API\Employees;

use Carbon\Carbon;
use App\Models\employees;
use App\Models\attendance;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Http\Controllers\Controller;

class Check_InOutController extends Controller
{
    use ResponseTrait;
    public function Check_In(){
        try{
            if(auth('employees_api')->id() != null){
                $EmployeeDay = attendance::where([
                        ['employee_id',auth('employees_api')->id()],
                        ['login_date',null]
                    ])->whereDay('created_at',date('d'));
                if($EmployeeDay->get()->isEmpty()){
                    return $this->returnError('E02','It is not allowed to Check-In twice in the same day');
                }else{
                    $EmployeeDay->update([
                        'login_date'=> date('Y-m-d H:i:s.u'),
                    ]);

                    return $this->returnSuccessMessage('Check-In Successfully','S000');
                }    
            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login Employee
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function Check_Out(){
        try{
            if(auth('employees_api')->id() != null){
                $EmployeeDay = attendance::where([
                        ['employee_id',auth('employees_api')->id()],
                        ['login_date','!=',null],
                        ['logout_date',null]
                    ])->whereDay('created_at',date('d'));
                    
                if($EmployeeDay->get()->isEmpty()){
                    return $this->returnError('E02','You must Check-In firstly or It is not allowed to Check-out twice in the same day');
                
                }else{
                    $login_date = $EmployeeDay->first()->login_date;
                    $logout_date = $EmployeeDay->first()->logout_date;
                    $TotalHours = Carbon::parse($login_date)->diffInRealHours(Carbon::parse($logout_date));
                    $Basic_hours = employees::with('department:id,working_hours')->first()->department->working_hours;
                    $over_time_hours = $TotalHours - $Basic_hours;
                    $hour_price = employees::find(auth('employees_api')->id())->first('hour_price')->hour_price;
                    $EmployeeDay->update([
                        'logout_date'=> date('Y-m-d H:i:s.u'),
                        'working_hours'=> $TotalHours,
                        'over_time_hours' => ($over_time_hours < 0) ? 0 : $over_time_hours,
                        'over_time_price' => ($over_time_hours < 0) ? 0 : $over_time_hours * 2 * $hour_price,
                        'Day_Price' => ($over_time_hours < 0) ? $TotalHours * $hour_price : $over_time_hours * 2 * $hour_price
                    ]);
                    return $this->returnSuccessMessage('Check-Out Successfully','S000');
                    // return $hour_price;
                }    
            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login Employee
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
