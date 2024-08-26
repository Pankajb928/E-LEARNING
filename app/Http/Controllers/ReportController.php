<?php

namespace App\Http\Controllers;

use App\Exports\userReport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function userReport(Request $request)
    {
        // Get the current timestamp
        $timestamp = date('d-m-y');
        // Generate the filename with the timestamp
        $filename = 'usersreport_' . $timestamp . '.xlsx';
        // Return the Excel download with the timestamped filename
        return Excel::download(new userReport, $filename);
    }
}