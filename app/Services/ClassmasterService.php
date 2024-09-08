<?php

namespace App\Services;

use App\Models\Classmaster;

class ClassmasterService
{
    // Add a new class
    public function createClassmaster($data)
    {
        $classDetails = Classmaster::where('classCode', $data['classCode'])
        ->where('section', $data['section'])
        ->first();
        if ($classDetails) {
            return $classDetails;
        }
        return Classmaster::create($data);
    }

    // Update an existing class
    public function updateClassmaster($classCode, $section, $data)
    {
        // Find the classmaster record based on classCode and section
        $classmaster = Classmaster::where('classCode', $classCode)
        ->where('section', $section)
        ->first();

        // If the record exists, update it
        if ($classmaster) {
            $classmaster->update($data); // Update the matched record with the data array
            return $classmaster;
        }

        // If no matching record found, return null
        return null;
    }

    // List all classes
    public function getAllClasses()
    {
        return Classmaster::all();
    }

    public function deleteClass($classCode, $section ,$status)
    {
        $updatedRows = Classmaster::where('classCode', $classCode)
        ->where('section', $section)
        ->update(['isActive' => $status]);  // Set 'isActive' to 1 (active)

        $statusMessage = ($status == 1) ? 'activated' : 'deactivated';

        // Return the response with a dynamic message
        return response()->json([
            'message' => "Class $statusMessage successfully ",
            'updated_count' => $updatedRows
        ]);
    }
}
