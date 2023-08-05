<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departments extends Model
{
    protected $table= 'departments';
    protected $fillable = [
        'id',
        'name',
        'head_id',
        'working_hours',
        'created_at',
        'updated_at'
    ];

    public function head(){
        return $this->hasOne(heads::class,'id','head_id');
    }
}
