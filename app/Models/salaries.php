<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salaries extends Model
{
    use HasFactory;
    protected $table= 'salaries';
    protected $fillable = [
        'id',
        'employee_id',
        'TotalWorkingHours',
        'BasicSalary',
        'TotalOverTimeHours',
        'TotalOverTime',
        'TotalSalary',
        'created_at',
        'updated_at'
    ];

    public function employee(){
        return $this->hasOne(employees::class,'id','employee_id');
    }
}
