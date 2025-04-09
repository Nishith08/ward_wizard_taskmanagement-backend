<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks();

        if ($request->has('status')) {
            $tasks->where('status', $request->status);
        }

        return $tasks->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        $task = $request->user()->tasks()->create($validated);

        // Send email (basic example)
        Mail::raw("New Task Created: {$task->title}", function ($message) use ($request) {
            $message->to($request->user()->email)
                    ->subject("Task Created");
        });

        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        $this->authorizeTask($task);
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'status' => 'in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);
        return $task;
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();
        return response()->json(['message' => 'Deleted']);
    }

    protected function authorizeTask(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
    }
}
