<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PayslipMail;
use App\Models\Payslip;
use Carbon\Carbon;

class PaySlipController extends Controller
{

    public function generatePayslip($staff_id)
    {

        $staff = Staffs::where('staff_id', $staff_id)->first();
        $business = $staff->business;

        $total_salary = $staff->basic_salary + $staff->bonus;

        $data = [
            'staff' => $staff,
            'business_name' => $business ? $business->business_name : 'N/A',
            'total_salary' => $total_salary,
            'date' => now()->format('d M Y'),
        ];
        // return response()->json($data);

        // Load the view and pass the data to generate the payslip PDF
        $pdf = Pdf::loadView('staffs.payslip', $data);

        // Generate PDF file path
        $pdf_file_path = storage_path('app/payslips/payslip_' . $staff->staff_id . '.pdf');

        // Save the PDF to the file system
        $pdf->save($pdf_file_path);

        // Send the payslip via email
        Mail::to($staff->email)->send(new PayslipMail($staff, $pdf_file_path));

        // Return the generated PDF for download
        return $pdf->download('Payslip for ' . $staff->name . ' (' . $staff->staff_id . ').pdf');
    }

    public function downloadSinglePayslip($payslip_id)
    {
        // Fetch payslip details
        $payslip = Payslip::find($payslip_id);

        if (!$payslip) {
            return redirect()->back()->with('error', 'Payslip not found.');
        }

        $staff = $payslip->staff;
        $business = $staff->business;

        // Data for the PDF
        $data = [
            'staff' => $staff,
            'payslip' => $payslip,
            'business_name' => $business ? $business->business_name : 'N/A',
        ];

        // Generate the PDF from the Blade template
        $pdf = Pdf::loadView('staffs.single_payslip', $data);

        // Define the PDF file path
        $pdf_file_path = storage_path('app/payslips/payslip_' . $payslip->id . '.pdf');

        // Save the PDF file
        $pdf->save($pdf_file_path);

        // Send the payslip via email
        // Mail::to($staff->email)->send(new PayslipMail($staff, $pdf_file_path));

        $month = Carbon::parse($payslip->date)->format('F Y');
        // Return the payslip as a downloadable PDF
        return response()->download($pdf_file_path, $month . ' Payslip for ' . $staff->name . '.pdf');
    }
}
