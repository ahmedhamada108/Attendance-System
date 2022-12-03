<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class heads extends Authenticatable implements JWTSubject
{
    protected $table= 'heads';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];
    public static function MoveToEmployees($id){ 
        
        $heads = heads::where('id', $id)->get();
        $name = $heads[0]->name;
        $email = $heads[0]->email;
        $password = $heads[0]->password;
        $department_id = $heads[0]->department_id;
        
        heads::create([
            'name'=> $name,
            'email'=>$email,
            'password'=>$password,
        ]);
    
        $last_head_id = heads::latest()->first();
        $fetch_dept = departments::find($department_id)->update([
            'head_id'=> $last_head_id->id,
        ]);
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
