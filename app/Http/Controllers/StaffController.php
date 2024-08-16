<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StaffController extends Controller
{
    public function index(){
        $staffs = Staffs::all();
        return view('staffs.index', ['staffs' => $staffs]);
    }

    public function fetchStaffs(){

       $res = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => 'Bearer '.env('PAYSTACK_SECRET_KEY')
        ])->get('http://localhost:8000/solution');
        // return json_decode($res->getBody()->getContents(), true);

            
            // Decode the JSON response into an associative array
            $employees = $res->json();

            // Check if the response is valid and is an array
            if (is_array($employees)) {
                foreach ($employees as $employeeData) {
                    // Update or create the staff record
                Staffs::updateOrCreate(
                    ['staff_id' => $employeeData['staff_id']], // Condition to find the record
                    [ // Data to update or create
                        'role' => $employeeData['role'],
                        'account_number' => $employeeData['account_number'],
                        'account_name' => $employeeData['account_name'],
                        'bank_name' => $employeeData['bank_name'],
                        'basic_salary' => $employeeData['basic_salary'],
                        'bonus' => $employeeData['bonus'],
                        'gross' => $employeeData['gross'],
                        'status' => $employeeData['status'],
                        'created_at' => $employeeData['created_at'],
                        'updated_at' => $employeeData['updated_at'],
                    ]
                );
            }
            return back()->with('success', 'Staff Fetch Successfully');
        } else {
            return back()->with('error', 'Failed to fetch staff data');
        }
    }
}
