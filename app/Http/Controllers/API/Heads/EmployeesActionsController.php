<?php

namespace App\Http\Controllers\API\Heads;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\departments;
use App\Models\employees;
use App\Models\request_leaving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesActionsController extends Controller
{
    use ResponseTrait;
    public function ListJoinRequest(){
        try{
            if(auth('heads_api')->id() != null){

                $department_id= departments::where('head_id',auth('heads_api')->id())->first()->id;

                $employees = employees::ListEmployeesByDepartment($department_id)->
                where('status',0)->get();
                return $this->returnData('Join Requests',$employees);;
            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login Employee
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function UpdateJoiningStatusRequest(Request $request){
        try{
            if(auth('heads_api')->id() != null){
                $validator = Validator::make($request->all(), [
                    'employee_id' => 'required',
                    'status' => 'required',
                ]);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                }
                $JoinRequests= employees::where('id',$request->employee_id);

                if($request->status =="1"){
                    $JoinRequests->update([
                        'status'=> 1,
                    ]);
                    return $this->returnSuccessMessage("The Joining Request has been Accepted");

                }else if($request->status == "0"){
                    $JoinRequests->update([
                        'status'=> 0,
                    ]);
                    return $this->returnSuccessMessage("The Joining Request has been Rejected");
                }
            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login Employee
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function ListLeavingRequest(){
        try{
            if(auth('heads_api')->id() != null){
                $requests=  request_leaving::with('employee:id,name')->
                select(['id','employee_id','leaving_date','reason','status'])->
                get();
                return $this->returnData('Requests Leaving',$requests,'Success');
            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login Head
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function UpdateLeavingStatusRequest(Request $request){
        try{
            if(auth('heads_api')->id() != null){
                $validator = Validator::make($request->all(), [
                    'request_id' => 'required',
                    'status' => 'required',
                ]);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                }
                $LeavingRequests= request_leaving::where('id',$request->request_id);

                if($request->status =="1"){
                    $LeavingRequests->update([
                        'status'=> 1,
                    ]);
                    return $this->returnSuccessMessage("The Leaving Request has been Accepted");

                }else if($request->status == "0"){
                    $LeavingRequests->update([
                        'status'=> 0,
                    ]);
                    return $this->returnSuccessMessage("The Leaving Request has been Rejected");
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
