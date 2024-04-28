<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details'; // Specify the table name
    protected $fillable = ['name', 'email', 'address', 'mobile_no', 'password']; 

    public $timestamps = false; 

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = time();
        });

        static::updating(function ($model) {
            $model->updated_at = time(); 
        });
    }
}
