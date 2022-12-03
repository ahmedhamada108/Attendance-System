<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use ResponseTrait;
    public function Login(Request $request)
    {
        ## validation ##
        try {
                $rules = [
                    'email' => "required",
                    'password' => "required"
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                } // return validation messages

                /// login code wise For Employee
                $credentials = $request->only(['email', 'password']);
                if(auth('employees_api')->attempt($credentials)){
                    $token = auth('employees_api')->attempt($credentials);
                    if (!$token) {
                        return $this->returnError('E1001', 'Error in the Password or Email');
                    } else {
                        //return token 
                        $employee = auth('employees_api')->user();
                        $employee->Token = $token;
                        if ($employee->status == 0) {
                            JWTAuth::setToken($token)->invalidate();
                            return $this->returnError('E2422', 'Your request still pending.');
                            // return request pending message 
                        } else {
                            $employee = [
                                'id' =>  $employee->id,
                                'name' => $employee->name,
                                'email' => $employee->email,
                                'role'=> 'employee',
                                'token' => $employee->Token
                            ];
                            // filter the response 
                            return $this->returnData('Employee', $employee, 'login success');
                        }
                    }
                    
                    // code login wise for the Heads
                }else if(auth('heads_api')->attempt($credentials)){
                    $token = auth('heads_api')->attempt($credentials);
                        //return token 
                        $heads = auth('heads_api')->user();
                        $heads->Token = $token;
                            $head = [
                                'id' =>  $heads->id,
                                'name' => $heads->name,
                                'email' => $heads->email,
                                'role'=> 'head',
                                'token' => $heads->Token
                            ];
                            // filter the response 
                            return $this->returnData('Head', $head, 'login success');
                      
                }else{
                    return $this->returnError('E1001', 'Error in the Password or Email'); 
                }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}
