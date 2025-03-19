<?php

namespace App\Http\Controllers;

use App\Models\Payslip;
use App\Models\Task;
use App\Notifications\TaskNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'isFirstLogin' => $staff->first_login
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


    public function staffProfile()
    {
        $staff = auth()->guard('staffs')->user();

        $business = $staff->business;
        return view('staff.staff-profile', compact('staff',     'business'));
    }

    public function resetPassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'new_password' => 'required|string|confirmed',
        ]);

        $staff = auth()->guard('staffs')->user();

        $staff->password = Hash::make($request->new_password);
        $staff->first_login = false;
        $staff->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Password reset successfully.');
    }

    public function viewTask()
    {
        $staff = auth()->guard('staffs')->user();

        $tasks = Task::where('staff_id', $staff->id)
            ->with(['user'])
            ->orderByDesc('created_at')
            ->get();

        $total_tasks = $tasks->count();
        $completed_tasks = $tasks->where('status', 'completed')->count();
        $pending_tasks = $tasks->whereIn('status', ['pending', 'in_progress'])->count();

        // return $completed_tasks;
        return view('staff.task', compact('tasks', 'total_tasks', 'completed_tasks', 'pending_tasks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        $staff = auth()->guard('staffs')->user();
        $task = Task::where('task_id', $id)->where('staff_id', $staff->id)->first();

        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }

        if ($request->status === 'completed') {
            $task->update([
                'status' => $request->status,
                'completion_date' => now()
            ]);
        } else {
            $task->update(['status' => $request->status]);
        }
        $task->user->notify(new TaskNotification($task, 'status_updated'));
        return redirect()->route('staff.tasks')->with('success', 'Task updated successfully.');
    }
    public function markAsRead()
    {
        auth()->guard('staffs')->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }
}
