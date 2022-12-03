<?php

namespace App\Http\Controllers\API\Employees;

use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\request_leaving;
use Illuminate\Support\Facades\Validator;

class RequestLeavingController extends Controller
{
    use ResponseTrait;
    public function request_leaving(Request $request){
        try{
            if(auth('employees_api')->id()!=null){
                $validator = Validator::make($request->all(), [
                    'leaving_date' => 'required',
                    'reason' => 'required',
                ]);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                }
                request_leaving::create(array_merge(
                    $validator->validated(),
                    ['employee_id'=>auth('employees_api')->id()]
                ));
                return $this->returnSuccessMessage('The Request has been sent.');
            }else{
                return $this->returnError('E500', 'Please login to your account');
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
