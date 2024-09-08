<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details'; // Specify the table name
    protected $fillable = ['user_id','name', 'classCode', 'email','role_id', 'address', 'mobile_no', 'password', 'token' , 'status']; 

    public $timestamps = false; 

    protected static function boot()
    {
        parent::boot();
    }
}
