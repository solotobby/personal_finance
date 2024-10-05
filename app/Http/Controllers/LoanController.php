<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(){
        $staffs = Staffs::all();
        return view('staffs.loans', ['staffs' => $staffs]);
    }

    public function processLoan(Request $request){
        return $request;
    }
}
