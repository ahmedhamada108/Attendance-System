<?php

namespace App\Http\Controllers\API\Heads;

use App\Models\employees;
use App\Models\attendance;
use Illuminate\Http\Request;
use App\Models\request_leaving;
use App\Http\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TrackEmployeesController extends Controller
{
    use ResponseTrait;
    public function ListEmployees(){
        try{
            if(auth('heads_api')->id() != null){
                $employees= employees::ListEmployees();
                return $this->returnData('Employees',$employees);
            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login Employee
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function ListAttendsToday(){
        try{
            if(auth('heads_api')->id() != null){
                $employees = attendance::GetAttendsToday();
                return $this->returnData('Attendance Today',$employees,'Success');
            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login Employee
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function ListAbsenceEmplyeesToday(){
        try{
            if(auth('heads_api')->id() != null){
                $employees = attendance::GetAbsenceEmplyeesToday();
                return $this->returnData('Absence Today',$employees,'Success');
            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login Employee
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function ListLoginEmployeesNow(){
        $employees = attendance::GetNotLogoutEmplyees();
        return $this->returnData('Attendance Now',$employees,'Success');
    }

    public function ListAbsenceDaysByMonth(Request $request){
        try{
            if(auth('heads_api')->id() != null){
                $validator = Validator::make($request->all(), [
                    'employee_id' => 'required',
                    'month' => 'required',
                    'year' => 'required',
                    'count'=>'required| boolean'
                ]);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                }
                if($request->count==true){
                    $employees = attendance::GetAbsenceDaysOfMonthByEmployee($request->employee_id,$request->year,$request->month)
                    ->count();
                    return $this->returnData('The Number of Days',$employees);
        
                }else{
                    $employees = attendance::GetAbsenceDaysOfMonthByEmployee($request->employee_id,$request->year,$request->month);
                    return $this->returnData('The Days',$employees);
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
