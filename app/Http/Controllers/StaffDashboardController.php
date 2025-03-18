<?php

namespace App\Http\Controllers;

use App\Models\Payslip;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    /**
     * Show the staff dashboard.
     */
    public function index()
    {
        $staff = auth()->guard('staffs')->user();

        // Ensure the staff is authenticated
        if (!$staff) {
            return redirect()->route('staff.login')->with('error', 'Unauthorized access.');
        }

        // Calculate total salary paid out
        $total_paid = Payslip::where('staff_id', $staff->staff_id)->sum('amount');

        // Fetch all payslips for the staff
        $payslips = Payslip::where('staff_id', $staff->staff_id)->orderBy('created_at', 'desc')->get();

        return view('staff.dashboard', [
            'staff' => $staff,
            'total_paid' => $total_paid,
            'payslips' => $payslips,
        ]);

    }

    public function downloadPayslip($payslip_id)
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
