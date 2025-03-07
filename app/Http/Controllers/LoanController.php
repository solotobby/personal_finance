<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanSchedule;
use App\Models\Staffs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanController extends Controller
{
    public function index(){
        $staffs = Staffs::all();
        return view('staffs.loans', ['staffs' => $staffs]);
    }

    public function loanList(){
        $loans = Loan::all();
        return view('staffs.loan_list', ['loans' => $loans]);
    }

    public function processLoan(Request $request){
        // return $request;
        $duration = $request->duration;
   
    
    // Start date: First day of the next month
    $startDate = Carbon::now()->addMonthNoOverflow()->endOfMonth();
    
    // End date: Add the duration in months to the start date to get the end date
    $endDate = $startDate->copy()->addMonths($duration - 1);  // Last payment month
    
    $data['user_id'] = auth()->user()->id;
    $data['staff_id'] = $request->staff_id;
    $data['amount'] = $request->amount;
    $data['repayment_amount'] = $request->repayment_amount;
    $data['duration'] = $duration;
    $data['start_date'] = $startDate;
    $data['end_date'] = $endDate;
    $data['status'] = 'ONGOING';

   $loan = Loan::create($data);

   

    // Array to hold the repayment schedule
    $repaymentSchedule = [];

    // Loop through each month and create repayment entries
    
    for ($i = 0; $i < $duration; $i++) {
        $repaymentDate = $startDate->copy()->addMonths($i);  // Repayment date for each month
        
        LoanSchedule::create([
            'loan_id' => $loan->id,
            'month' => $repaymentDate->format('F Y'),  // Month name and year, e.g., "November 2023"
            'currency' => 'NGN',
            'amount_due' => $request->repayment_amount,          // Amount due each month
            'payment_due_date' => $repaymentDate->toDateString(),  // Due date, e.g., "2023-11-01"
            'is_paid' => false
        ]);
    }

    return back()->with('success', 'Loan Processed Successfully');
    
    }

    public function loanSchedule($id){
        $loan = Loan::with('loanSchedule')->find($id);
        // Get the total number of loan schedules
        $totalSchedules = $loan->loanSchedule->count();

        // Get the number of paid loan schedules
        $paidSchedules = $loan->loanSchedule->where('is_paid', 1)->count();

        // Calculate the percentage of paid schedules
        $paidPercentage = ($totalSchedules > 0) ? ($paidSchedules / $totalSchedules) * 100 : 0;
        $finalPercentage = number_format($paidPercentage,0);
        // $loanSchedule = LoanSchedule::with('loan')->where('loan_id', $id)->get();
        return view('staffs.loan_schedule', ['loanSchedule' => $loan, 'percentage' => $finalPercentage]);
        
    }

    public function changeStatus($id){
        $loan = LoanSchedule::find($id);
        if($loan->is_paid == false){
            $loan->is_paid = true;
            $loan->save();
        }
        return back()->with('success', 'Loan Paid Successfully');
        
    }
}
