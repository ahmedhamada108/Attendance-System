<?php

namespace App\Http\Controllers\API\Heads;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use App\Models\attendance;
use App\Models\salaries;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SalariesCalculations extends Controller
{
    //
    use ResponseTrait;

    // Get the total salary and with option to generte the report monthly and insert this in the DB

    public function GetTotalSalary(Request $request){
        try{
            if(auth('heads_api')->id() != null){
                $request->validate([
                    'employee_ids' =>'array',
                    'employee_id.*' => 'integer',
                    'discounts' => 'array',
                    'monthly_report' => 'boolean'
                ]);
            // Get an array of employee IDs and discounts from the request
            $employeeIds = $request->input('employee_ids', []);
            $discounts = $request->input('discounts', []);

            // Get the attendances for the selected employees in the current month
            $attendances = Attendance::with('employee')
                ->whereMonth('created_at', date('m'))
                ->get();

            // Process attendance data and apply discounts
            $employeeData = collect($attendances)->mapToGroups(function ($attendance) {
                return [$attendance['employee_id'] => [
                    'employee_id' => $attendance['employee']->id,
                    'employee_name' => $attendance['employee']->name,
                    'working_hours' => $attendance['working_hours'],
                    'over_time_hours' => $attendance['over_time_hours'],
                    'total_day_price' => $attendance['Day_Price'],
                    'over_time_price' => $attendance['over_time_price'],
                ]];
            })->map(function ($employeeAttendances, $employee_id) use ($discounts,$request) {
                $working_hours = $employeeAttendances->sum('working_hours');
                $BasicSalary = $employeeAttendances->sum('total_day_price');
                $over_time_hours = $employeeAttendances->sum('over_time_hours');
                $TotalOverTime = $employeeAttendances->sum('over_time_price');

                // Apply discount for the specific employee only
                $specificEmployeeDiscount = $discounts[$employee_id] ?? 0;
                $TotalSalary = $BasicSalary + $TotalOverTime - $specificEmployeeDiscount;
                if($request->monthly_report == true){
                    
                    $exists = salaries::where('employee_id', $employeeAttendances->first()['employee_id'])
                    ->where([
                        ['TotalWorkingHours', $working_hours],
                        ['BasicSalary', $BasicSalary],
                        ['TotalOverTimeHours', $over_time_hours],
                        ['TotalOverTime', $TotalOverTime],
                        ['TotalSalary', $TotalSalary]
                    ])
                    ->exists();
                    if(!$exists){
                        salaries::create([
                            'employee_id' => $employeeAttendances->first()['employee_id'],
                            'TotalWorkingHours' => $working_hours,
                            'BasicSalary' => $BasicSalary,
                            'TotalOverTimeHours' => $over_time_hours,
                            'TotalOverTime' => $TotalOverTime,
                            'TotalSalary' => $TotalSalary,
                        ]);
                        return 'done';
                    }else{
                        return null;
                    }
                }
                return [
                    'EmployeeName' => $employeeAttendances->first()['employee_name'],
                    'TotalWorkingHours' => $working_hours,
                    'BasicSalary' => $BasicSalary,
                    'TotalOverTimeHours' => $over_time_hours,
                    'TotalOverTime' => $TotalOverTime,
                    'TotalSalary' => $TotalSalary,
                ];
            })->values(); // Add values() to reset the keys and get the array of values.
            if ($employeeData[0]== null && $request->monthly_report ==true) {
                return $this->returnError("E422", "All data has been inserted before.");
            }else if($employeeData[0]== 'done' && $request->monthly_report ==true){
                return $this->returnSuccessMessage("The Salraies data have been inserted.");
            }
            return $this->returnData("Salary Details", $employeeData);
            }else{
                return $this->returnError('E500', 'Please login to your account');
                // check login Employee
            }
        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

}
