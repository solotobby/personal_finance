<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PaySlipController extends Controller
{
    public function generatePayslip($staff_id)
{
    // Fetch staff data by ID
    $staff = Staffs::where('staff_id', $staff_id)->first();

    // Fetch the business associated with the staff
    $business = $staff->business;

    // Calculate the total salary
    $total_salary = $staff->basic_salary + $staff->bonus;

    // Prepare data for the PDF view
    $data = [
        'staff' => $staff,
        'business_name' => $business ? $business->business_name : 'N/A',  // Add business name, default to 'N/A' if no business found
        'total_salary' => $total_salary,
        'date' => now()->format('d M Y'),
    ];

    // Load the view and pass the data to generate the payslip PDF
    $pdf = Pdf::loadView('staffs.payslip', $data);

    // Return the generated PDF for download
    return $pdf->download('Payslip for '.$staff->name.' ('.$staff->staff_id.').pdf');
}

}
