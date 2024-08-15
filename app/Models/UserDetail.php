<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details'; // Specify the table name
    protected $fillable = ['user_id','name', 'email', 'address', 'mobile_no', 'password', 'token']; 

    public $timestamps = false; 

    protected static function boot()
    {
        parent::boot();
    }
}
