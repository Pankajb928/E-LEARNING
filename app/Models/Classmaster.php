<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classmaster extends Model
{
    // Specify the exact table name
    protected $table = 'classmaster';

    // Indicates that the model does not have an auto-incrementing ID
    public $incrementing = false;

    // The primary key is not a single field, it's a composite key (classCode, section)
    protected $primaryKey = null;

    // Laravel expects a string for primary keys that aren't auto-incrementing
    protected $keyType = 'string';

    // Enable timestamps
    public $timestamps = true;

    // Define the fields that are mass assignable
    protected $fillable = [
        'classCode', 'section', 'totalStudents', 'AvaiableStudent', 'ClassTeacher',
        'isActive', 'created_by', 'updated_by', 'ipAddress', 'created_at', 'updated_at'
    ];

    // Override the primary key method for composite keys
    protected function setKeysForSaveQuery($query)
    {
        $query->where('classCode', $this->getAttribute('classCode'))
              ->where('section', $this->getAttribute('section'));

        return $query;
    }
}
