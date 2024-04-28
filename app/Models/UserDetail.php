<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details'; // Specify the table name
    protected $fillable = ['name', 'email', 'address', 'mobile_no', 'password']; // Specify the fillable columns

    public $timestamps = false; // Set timestamps to false to disable default behavior

    // Override the boot method to set the creation and update timestamps in epoch format
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = time(); // Set creation timestamp to current epoch time
        });

        static::updating(function ($model) {
            $model->updated_at = time(); // Set update timestamp to current epoch time
        });
    }
}
