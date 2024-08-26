<?php

namespace App\Http\Controllers;

use App\Models\SalaryAdvance;
use App\Models\Staffs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryAdvanceController extends Controller
{
    public function salaryAdvance(){
        $staffs = Staffs::all();
        return view('staffs.salary_advance', ['staffs' => $staffs]);
    }

    public function processSalaryAdvance(Request $request){

        $staff = Staffs::where('id', $request->staff_id)->first();
        //get 30% of salary
         $percentAmount = 0.3 * $staff->basic_salary;

         $currentMonth = Carbon::now()->format('M,Y');
        
         if($request->amount > $percentAmount){
            return back()->with('error', 'Amount too high');
         }

         $salaryAdvance = SalaryAdvance::where(['staff_id'=> $request->staff_id, 'current_month' => $currentMonth, 'is_paid'=>false])->sum('amount');
         $remBalance = $percentAmount - $salaryAdvance;

      
         if($remBalance == 0){
            return back()->with('error', 'You can no longer take salary advance this month');
         }

       
        $nextMonth = Carbon::now()->addMonth('+1')->format('M,Y');


         SalaryAdvance::create(['staff_id' => $staff->id, 'amount' => $request->amount, 'current_month' => $currentMonth, 'next_payment_date' => $nextMonth]);

         return back()->with('success', 'Salary Advance Processed');


    }
}
