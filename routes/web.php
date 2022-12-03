<?php

use Carbon\Carbon;
use App\Models\heads;
use App\Models\employees;
use App\Models\attendance;
use App\Models\departments;
use App\Models\request_leaving;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

        // return $data= attendance::where([
        // ['employee_id',7],
        // ['login_date','!=',null],
        // ['logout_date','!=',null]

        // ])->whereMonth('created_at',date('m'))->get(['login_date','logout_date','working_hours']);
        // $login_date= $data[0]->login_date;
        // $logout_date= $data[0]->logout_date;
        // Carbon::parse($login_date)->diffInRealHours(Carbon::parse($logout_date)); 
    return view('welcome');
    // employees::select('id')->get()->each(function($q){
    //     attendance::create([
    //         'employee_id'=>$q->id,
    //         'reason'=>null
    //     ]);
    // });
    // return date('Y-m-d H:i:s.u');
});
