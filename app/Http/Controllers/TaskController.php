<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Staff;
use App\Models\Staffs;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $businessId = auth()->user()->business_id;

        $tasks = Task::where('business_id', $businessId)
            ->with(['staff', 'user']) // Load related staff and user
            ->get();

        $total_tasks = $tasks->count();
        $completed_tasks = $tasks->where('status', 'completed')->count();
        $pending_tasks = $tasks->where('status', 'pending')->count();

        return view('tasks.index', compact('tasks', 'total_tasks', 'completed_tasks', 'pending_tasks'));
    }


    public function create()
    {
        $staffs = Staffs::where('business_id', auth()->user()->business_id)->get();
        return view('tasks.create', compact('staffs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staffs,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date'
        ]);

        Task::create([
            'business_id' => auth()->user()->business_id,
            'staff_id' => $request->staff_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        $task->update(['status' => $request->status]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
}
