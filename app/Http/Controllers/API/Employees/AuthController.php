<?php

namespace App\Http\Controllers\API\Employees;

use App\Models\employees;
use App\Models\departments;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ResponseTrait;
    public function Departments(){
        
        $departments = departments::select('id','name')->get();
        return $this->returnData('Departments',$departments,'Success');
    }

    public function Sign_Up(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required| email |unique:employees',
            'password' => 'required|min:6| confirmed',
            'department_id' => 'required',
        ]);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $employee = employees::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return $this->returnSuccessMessage('The Registeraion request has been sent to the admin');
    }

    public function logout(Request $request)
    {

        try {
            $token = $request->bearerToken();
            if ($token) {
                JWTAuth::setToken($token)->invalidate();
                return $this->returnSuccessMessage('Logout successfully');
            } else {
                return $this->returnError('E500', 'Token invalid');
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
    
}
