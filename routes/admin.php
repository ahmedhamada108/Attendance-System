<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HeadsController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\DepartmentsController;

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
Route::group(['middleware' => ['web']], function(Router $router)
{
    Route::get('login',[AuthController::class, 'login_view'])->name('login.view');
    Route::post('login_post', [AuthController::class, 'postLogin'])->name('login.post');
    //  end login routes

    Route::group(['prefix'=>'admin','middleware' => ['check.login']], function()
    {
        Route::get('Dashboard','Login@dashboard_view')->name('admin.dashboard.view');
        
        Route::get('logout',[AuthController::class, 'logout'])->name('logout');
        // end dashboard & logout routes

        Route::resource('departments',DepartmentsController::class)->except('show');
        // end of departments routes

        Route::resource('employees',EmployeesController::class )->except('show');
        // end of employees routes

        Route::resource('heads',HeadsController::class )->except('show');
        // end of heads routes

    });// end admin routes group
});// end localization routes group 
