<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskList;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::whereHas('taskList', function ($query) {
            $query->where('user_id', auth()->id());
        })->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'task_list_id' => 'required|exists:task_lists,id',
            'title' => 'required|string|max:255',
        ]);

        $list = TaskList::where('id', $data['task_list_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $task = $list->tasks()->create([
            'title' => $data['title'],
        ]);

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorizeTask($task);
        return $task;
    }

    private function authorizeTask(Task $task)
    {
        abort_if($task->taskList->user_id !== auth()->id(), 403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $data = $request->validate([
            // 'title' => 'required|string|max:255',
            'completed' => 'boolean',
        ]);

        $task->update($data);

        return $task;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();

        return response()->noContent();
    }

}
