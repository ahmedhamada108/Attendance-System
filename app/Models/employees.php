<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class employees extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table= 'employees';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'department_id',
        'status',
        'created_at',
        'updated_at'
    ];
    protected $appends = ['role'];
    protected $hidden = ['created_at','updated_at']; 
    public function getRoleAttribute()
    {
        $Role= 'emplyee';
        return $Role;
    }
    public static function ListEmployees(){
        $employees= employees::with('department:id,name as dept_name')->
        select(['id','name','email','department_id','status'])->get();
        return $employees;
    }
    public static function ListEmployeesByDepartment($department_id){
        $employees = employees::where('department_id',$department_id)->select(['id','name','email','department_id','status']);
        return $employees;
    }
    public function department(){
        return $this->belongsTo(departments::class,'department_id','id');
    }
    public static function MoveToHeads($id){ 

            $employees = employees::where('id', $id)->get();
            $name = $employees[0]->name;
            $email = $employees[0]->email;
            $password = $employees[0]->password;
            $department_id = $employees[0]->department_id;
            
            heads::create([
                'name'=> $name,
                'email'=>$email,
                'password'=>$password,
            ]);
        
            $last_head_id = heads::latest()->first();
            $fetch_dept = departments::find($department_id)->update([
                'head_id'=> $last_head_id->id,
            ]);
            employees::destroy($id);
    }

    
     // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


}
