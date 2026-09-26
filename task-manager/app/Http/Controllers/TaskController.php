<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('due_date', 'asc')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        Task::create($validated);

        return new RedirectResponse('/tasks');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return new RedirectResponse('/tasks');
    }

    public function updateStatus(Task $task)
    {
        $task->update([
            'status' => $task->status === 'Pending'
                ? 'Completed'
                : 'Pending',
        ]);

        return new RedirectResponse('/tasks');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return new RedirectResponse('/tasks');
    }
}