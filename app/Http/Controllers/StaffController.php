<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Department;
use App\Models\Qualification;
use App\Models\Role;
use App\Models\Staffs;
use App\Models\Payslip;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class StaffController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Fetch all staff for the business
        $staffs = Staffs::where('business_id', $user->business_id)->get();

        // Count total staff
        $total_staff = $staffs->count();

        // Calculate total salary paid out
        $total_paid = Payslip::whereHas('staff', function ($query) use ($user) {
            $query->where('business_id', $user->business_id);
        })->sum('amount');

        return view('staffs.index', compact('staffs', 'total_staff', 'total_paid'));
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


    public function MakePayment(Request $request)
    {
        // Validate request data
        $request->validate([
            'date' => 'required|date_format:Y-m',
            'amount' => 'required|numeric|min:1',
            'name' => 'required|string|max:255',
            'staff_id' => 'required|string|max:50',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|digits_between:10,15',
            'account_name' => 'required|string|max:255',
            'payer_name' => 'required|string|max:255',
            'narration' => 'required|string|max:255',
        ]);

        try {

            // Find Staff
            $staff = Staffs::where('staff_id', $request->staff_id)->first();
            //   return $request->amount;
            //  Save initial record in the database (status: Pending)
            $payslip = Payslip::create([
                'date' => $request->date,
                'amount' => $staff->salary,
                'basic_salary' => $staff->basic_salary,
                'bonus' => $staff->bonus,
                'staff_id' => $request->staff_id,
                'name' => $request->name,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'account_name' => $request->account_name,
                'payer_name' => $request->payer_name,
                'narration' => $request->narration,
                'status' => 'Pending',
                'transaction_id' => Str::uuid(),
            ]);

            // Process Payment with Third-Party
            //$paymentResponse = $this->processPayment($payslip);


            $paymentResponse = true;
            //  Update payment status based on response
            if ($paymentResponse) {
                $payslip->update([
                    'status' => 'Paid',
                ]);
                return redirect()->back()->with('success', 'Payment successful and Payslip updated.');
            } else {
                $payslip->update([
                    'status' => 'Failed',
                ]);
                return redirect()->back()->with('error', 'Payment failed: ');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function updateStaff($staff_id)
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

        $data['staff'] = Staffs::where('staff_id', $staff_id)->firstOrFail();
        return view('staffs.update_staff', $data);
    }

    public function updateStaffDetail(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'sex' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'qualification' => 'required|string',
            'account_number' => 'nullable|string|max:20',
            'account_name' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'basic_salary' => 'nullable|numeric',
            'bonus' => 'nullable|numeric',
            'role' => 'required|string',
            'employment_date' => 'required|date',
            'department' => 'required|string',
        ]);

        try {
            $staff = Staffs::findOrFail($id);
            $staff->update($request->all());
            return redirect()->back()->with('success', 'Staff information updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
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

        // Fetch Payslip(s) for the Staff
        $data['payslips'] = Payslip::where('staff_id', $staff_id)
            ->orderBy('date', 'desc')
            ->get();
        return view('staffs.staff_details', $data);
    }

    public function fetchStaffs()
    {

        $res = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            // 'Authorization' => 'Bearer '.env('PAYSTACK_SECRET_KEY')
        ])->get('https://freebyz.com/solution');

        $employees = $res->json();

        if (is_array($employees)) {
            foreach ($employees as $employeeData) {
                // Update or create the staff record
                Staffs::updateOrCreate(
                    ['staff_id' => $employeeData['staff_id']], // Condition to find the record
                    [
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

    private function processPayment($payslip)
    {
        try {
            $response = Http::post('https://api.paystack.co/transaction/initialize', [
                'amount' => $payslip->amount,
                'account_number' => $payslip->account_number,
                'bank_name' => $payslip->bank_name,
                'narration' => $payslip->narration,
                'transaction_id' => $payslip->transaction_id,
            ]);

            $result = $response->json();

            // Check if payment was successful
            if ($result['status'] == 'success') {
                return [
                    'success' => true,
                    'message' => 'Payment processed successfully',
                ];
            } else {
                return [
                    'success' => false,
                    'message' => $result['message'] ?? 'Payment failed',
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'API request failed: ' . $e->getMessage(),
            ];
        }
    }
}
