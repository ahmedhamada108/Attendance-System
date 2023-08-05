<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class request_leaving extends Model
{
    use HasFactory;
    protected $table= 'request_leaving';
    protected $fillable = [
        'id',
        'employee_id',
        'reason',
        'status',
        'leaving_date',
        'created_at',
        'updated_at'
    ];

    public function employee(){
        return $this->hasOne(employees::class,'id','employee_id');
    }

    public static function GetRequests(){

        $request = request_leaving::with('employee:id,name')->whereHas('employee', function ($employee) {
            $employee->with('department')->whereHas('department',function($departments) {
                $departments->where('head_id',auth('heads_api')->id());
            } );
        })->get();
        $request = $request->map(function ($item) {
         if($item->status==0){
             // Rejected
             $request=[
                 'id'=> $item->id,
                 'employee_name' => $item->employee->name,
                 'leaving_date' => $item->leaving_date,
                'reason'=> $item->reason,
                'status'=> 'Pending'
             ];
         }else if($item->status==1){
             // Accept
             $request=[
                'id'=> $item->id,
                'employee_name' => $item->employee->name,
                'leaving_date' => $item->leaving_date,
               'reason'=> $item->reason,
               'status'=> 'Rejected'
            ];
         }else{
            $request=[
                'id'=> $item->id,
                'employee_name' => $item->employee->name,
                'leaving_date' => $item->leaving_date,
               'reason'=> $item->reason,
               'status'=> 'Accept'
            ];
         }
            return $request;
        });
      return  $request;
    }
    
}
