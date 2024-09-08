<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ClassmasterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassmasterController extends Controller
{
    protected $classmasterService;

    // Inject the service into the controller
    public function __construct(ClassmasterService $classmasterService)
    {
        $this->classmasterService = $classmasterService;
    }

    // Store (Add) new class
    public function createClass(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'classCode' => 'required|string|max:100',
            'section' => 'required|string|max:100',
            'totalStudents' => 'required|integer',
            'AvaiableStudent' => 'required|integer|lte:totalStudents', // Available should not exceed total
            'ClassTeacher' => 'required|string|max:191',
            'isActive' => 'boolean',
            'created_by' => 'nullable|string|max:191',
            'ipAddress' => 'nullable|ip',
        ]);

        // Check validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Insert the new class record using service
        $classmaster = $this->classmasterService->createClassmaster([
            'classCode' => $request->classCode,
            'section' => $request->section,
            'totalStudents' => $request->totalStudents,
            'AvaiableStudent' => $request->AvaiableStudent,
            'ClassTeacher' => $request->ClassTeacher,
            'isActive' => $request->isActive ?? 1,
            'created_by' => $request->created_by,
            'ipAddress' => $request->ip(),
        ]);

        return response()->json($classmaster, 201);
    }

    // Update class
    public function updateClass(Request $request, $classCode, $section)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'totalStudents' => 'required|integer',
            'AvaiableStudent' => 'required|integer|lte:totalStudents',
            'ClassTeacher' => 'required|string|max:191',
            'isActive' => 'boolean',
            'updated_by' => 'nullable|string|max:191',
            'ipAddress' => 'nullable|ip',
        ]);

        // Check validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update the class record using service
        $classmaster = $this->classmasterService->updateClassmaster($classCode, $section, [
            'totalStudents' => $request->totalStudents,
            'AvaiableStudent' => $request->AvaiableStudent,
            'ClassTeacher' => $request->ClassTeacher,
            'isActive' => $request->isActive ?? 1,
            'updated_by' => $request->updated_by,
            'ipAddress' => $request->ip(),
        ]);

        if ($classmaster) {
            return response()->json($classmaster, 200);
        } else {
            return response()->json(['message' => 'Class not found'], 404);
        }
    }

    // List all classes
    public function listClass()
    {
        $classes = $this->classmasterService->getAllClasses();
        return response()->json($classes);
    }

    //delete Class by status
    public function deleteClass(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'classCode' => 'required|exists:classmaster,classCode',
            'section' => 'required|exists:classmaster,section',
        ]);

        // Check validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update the class record using service
        $classmaster = $this->classmasterService->deleteClass($request->classCode, $request->section,$request->status);
        if ($classmaster) {
            return $classmaster;
        } else {
            return response()->json(['message' => 'Class not found'], 404);
        }
    }
}
