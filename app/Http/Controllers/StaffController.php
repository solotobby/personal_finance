<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Department;
use App\Models\Qualification;
use App\Models\Role;
use App\Models\Staffs;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        //$business = $user->businesses->first();

        // Fetch staffs based on the business_id
        $staffs = Staffs::where('business_id', $user->business_id)->get();

        return view('staffs.index', ['staffs' => $staffs]);
    }


    public function createStaff()
    {
        $user = auth()->user();
        //  $business = $user->businesses->first();
        $data['qualifications'] = Qualification::where(
            'business_id',
            $user->business_id
        )->get();
        $data['roles'] = Role::where(
            'business_id',
            $user->business_id
        )->get();
        $data['departments'] = Department::where(
            'business_id',
            $user->business_id
        )->get();

        return view('staffs.create_staff', $data);
    }

    public function addStaff(Request $request)
    {

        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string',
            'sex' => 'required|string',
            'date_of_birth' => 'required|date',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'qualification' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
            'bank_name' => 'required|string',
            'basic_salary' => 'required|numeric',
            'bonus' => 'required|numeric',
            'role' => 'required|string',
            'employment_date' => 'required|date',
            'department' => 'required|string',
        ]);

        $user = Auth::user();
        //$business = $user->businesses->first();

        // Save the staff data to the database
        $staff = new Staffs();
        $staff->business_id = $user->business_id;
        $staff->created_by = $user->id;
        $staff->name = $validated['name'];
        $staff->sex = $validated['sex'];
        $staff->date_of_birth = $validated['date_of_birth'];
        $staff->email = $validated['email'];
        $staff->phone = $validated['phone'];
        $staff->address = $validated['address'];
        $staff->qualification = $validated['qualification'];
        $staff->account_number = $validated['account_number'];
        $staff->account_name = $validated['account_name'];
        $staff->bank_name = $validated['bank_name'];
        $staff->basic_salary = $validated['basic_salary'];
        $staff->bonus = $validated['bonus'];
        $staff->role = $validated['role'];
        $staff->employment_date = $validated['employment_date'];
        $staff->salary = $validated['basic_salary'] + $validated['bonus'];
        $staff->department = $validated['department'];


        if ($staff->save()) {
            return redirect()->route('staff.index');
        } else {
            return redirect()->back()->with('error', 'Unable to create new staff');
        }
    }


    public function MakePayment(Request $request){
        
    }
    public function showSingleStaff($staff_id)
    {
        $user = Auth::user();
        $data['staff'] = $staff = Staffs::where(
            'staff_id',
            $staff_id
        )->where(
            'business_id',
            $user->business_id
        )->first();

        if (!$staff) {
            return redirect()->route('staff.index')->with('error', 'Staff not found');
        }

        $data['user'] = User::find($staff->created_by);

        if ($data['user'] == null) {

            $data['user'] = User::find($staff->business_id);
            //return $data;
        }
        return view('staffs.staff_details', $data);
    }

    public function fetchStaffs()
    {

        $res = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => 'Bearer '.env('PAYSTACK_SECRET_KEY')
        ])->get('https://freebyz.com/solution');
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
