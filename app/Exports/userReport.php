<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\UserDetail;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class userReport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    /**
     * Retrieve the data you want to export
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        // Optimize the query to select only the fields needed
        return UserDetail::query()->select('id', 'user_id', 'name', 'email', 'address', 'mobile_no', 'created_at', 'updated_at');
    }

    /**
     * Define the headings for the Excel sheet
     * 
     * @return array
     */
    public function headings(): array
    {
        return [
            'S.NO',       
            'User-ID',     
            'Username',    
            'Email',       
            'Address',    
            'Mobile No',  
            'Created At',  
            'Updated At', 
        ];
    }

    /**
     * Map the data for each row
     * 
     * @param \App\Models\UserDetail $user
     * @return array
     */
    public function map($user): array
    {
        static $serialNumber = 1;

        return [
            $serialNumber++,       // Incremental serial number
            $user->user_id,   
            $user->name,  
            $user->email,         
            $user->address,     
            $user->mobile_no,        
            $this->formatDate($user->created_at),
            $this->formatDate($user->updated_at), 
        ];
    }

    /**
     * Apply styles to the headings
     * 
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Make the first row (headings) bold
        ];
    }

    /**
     * Format the date or apply a condition to it
     * 
     * @param string $date
     * @return string
     */
    private function formatDate($date)
    {      
        return Carbon::parse($date)->format('d-m-Y');
    }
}
