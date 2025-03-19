<?php

namespace App\Http\Controllers;

use App\Mail\TaskAssigned;
use App\Models\Task;
use App\Models\Staffs;
use App\Notifications\TaskNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index()
    {
        $businessId = auth()->user()->business_id;

        $tasks = Task::where('business_id', $businessId)
            ->with(['staff', 'user'])
            ->orderByDesc('created_at')
            ->get();

        $total_tasks = $tasks->count();
        $completed_tasks = $tasks->where('status', 'completed')->count();
        $pending_tasks = $tasks->whereIn('status', ['pending', 'in_progress'])->count();

        // return $completed_tasks;
        return view('tasks.index', compact('tasks', 'total_tasks', 'completed_tasks', 'pending_tasks'));
    }


    public function create()
    {
        $businessId = auth()->user()->business_id;
        $staffs = Staffs::where('business_id', $businessId)->get();

        return view('tasks.create', compact('staffs'));
    }

    public function show($id)
    {
        $task = Task::where('task_id', $id)->with(['staff', 'user'])->firstOrFail();
        return view('tasks.task-details', compact('task'));
    }

    public function edit($id)
    {
        $businessId = auth()->user()->business_id;
        $task = Task::where('task_id', $id)->with('staff')->firstOrFail();
        $staffMembers = Staffs::where('business_id', $businessId)->get();
        return view('tasks.edit', compact('task', 'staffMembers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'staff_id' => 'required|exists:staffs,id',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date|after:today',
        ]);

        $task = Task::create([
            'business_id' => auth()->user()->business_id,
            'title' => $request->title,
            'description' => $request->description,
            'staff_id' => $request->staff_id,
            'priority' => $request->priority,
            'status' => 'pending',
            'due_date' => $request->due_date,
            'created_by' => auth()->id(),
        ]);

        $task->staff->notify(new TaskNotification($task, 'assigned'));
        Mail::to($task->staff->email)->send(new TaskAssigned($task));
        return redirect()->route('tasks')->with('success', 'Task updated successfully.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        $task = Task::where('task_id', $id)->first();

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

       // $staff = Staffs::where('id', $task->staff_id)->first();
        $task->staff->notify(new TaskNotification($task, 'status_updated'));
        return redirect()->route('tasks')->with('success', 'Task updated successfully.');
    }

    public function priority(Request $request, $id)
    {
        $request->validate([
            'priority' => 'required|string|in:low,medium,high'
        ]);

        $task = Task::where('task_id', $id)->first();

        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }

        $task->update(['priority' => $request->priority]);
        $task->staff->notify(new TaskNotification($task, 'priority_updated'));
        return redirect()->route('tasks')->with('success', 'Task updated successfully.');
    }
    public function close(Request $request, $id)
    {
        $task = Task::where('task_id', $id)->first();

        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }

        $task->update([
            'status' => 'completed',
            'completion_date' => now()
        ]);

        return redirect()->route('tasks')->with('success', 'Task updated successfully.');
    }
}
