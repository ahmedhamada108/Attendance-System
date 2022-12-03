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

    public static function GetRequestsByEmployee($id){

        $request = request_leaving::with('employee:id,name')->where('employee_id',$id)->get();
        $id= $request[0]->id;
        $employee_name= $request[0]->employee->name;
        $leaving_date = $request[0]->leaving_date;
        $reason = $request[0]->reason;
        $status = $request[0]->status;

        if($status==0){
            // Rejected
            $request=[
                'id'=> $id,
                'employee_name'=> $employee_name,
                'leaving_date' => $leaving_date,
                'reason'=> $reason,
                'status'=> 'Rejected'
            ];
        }else if($status==1){
            // Accept
            $request=[
                'id'=> $id,
                'employee_name'=> $employee_name,
                'leaving_date' => $leaving_date,
                'reason'=> $reason,
                'status'=> 'Accept'
            ];
        }else{
            $request=[
                'id'=> $id,
                'employee_name'=> $employee_name,
                'leaving_date' => $leaving_date,
                'reason'=> $reason,
                'status'=> 'Pending'
            ];
        }
      return  $request;
    }
    
}
