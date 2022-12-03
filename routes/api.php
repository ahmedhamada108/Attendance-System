<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\Employees\AuthController;
use App\Http\Controllers\API\Heads\TrackEmployeesController;
use App\Http\Controllers\API\Employees\Check_InOutController;
use App\Http\Controllers\API\Heads\EmployeesActionsController;
use App\Http\Controllers\API\Employees\RequestLeavingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'employee','namespace'=>'API/Employee'], function(Router $router)
{
    Route::post("Login",[LoginController::class, 'Login']);
    
    Route::get("GetDepartments",[AuthController::class, 'Departments']);
    Route::post("Sign_Up",[AuthController::class, 'Sign_Up']);
    Route::post("Logout",[AuthController::class, 'Logout']);

    Route::get("Check_In",[Check_InOutController::class, 'Check_In']);
    Route::get("Check_Out",[Check_InOutController::class, 'Check_Out']);
    Route::post("RequestLeaving",[RequestLeavingController::class, 'request_leaving']);

    Route::get("ListEmployees",[TrackEmployeesController::class, 'ListEmployees']);
    Route::get("ListRequests",[TrackEmployeesController::class, 'ListRequests']);
    Route::get("ListAttendsToday",[TrackEmployeesController::class, 'ListAttendsToday']);
    Route::get("ListLoginEmployeesNow",[TrackEmployeesController::class, 'ListLoginEmployeesNow']);
    Route::post("ListAbsenceDaysByMonth",[TrackEmployeesController::class, 'ListAbsenceDaysByMonth']);



});

Route::group(['prefix'=>'head','namespace'=>'API/Heads'], function(Router $router)
{
    Route::get("ListEmployees",[TrackEmployeesController::class, 'ListEmployees']);
    Route::get("ListRequests",[TrackEmployeesController::class, 'ListRequests']);
    Route::get("ListAttendsToday",[TrackEmployeesController::class, 'ListAttendsToday']);
    Route::get("ListLoginEmployeesNow",[TrackEmployeesController::class, 'ListLoginEmployeesNow']);
    Route::post("ListAbsenceDaysByMonth",[TrackEmployeesController::class, 'ListAbsenceDaysByMonth']);

    Route::get("JoinRequest",[EmployeesActionsController::class, 'ListJoinRequest']);
    Route::post("UpdateStatusRequest",[EmployeesActionsController::class, 'UpdateStatusRequest']);

    Route::get("ListLeavingRequest",[EmployeesActionsController::class, 'ListLeavingRequest']);
    Route::post("UpdateLeavingStatusRequest",[EmployeesActionsController::class, 'UpdateLeavingStatusRequest']);



});