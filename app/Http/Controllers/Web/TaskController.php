<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Não autenticado'], 401);
            }
            return redirect()->route('login');
        }
        $request->validate([
            'title' => 'required',
            'task_list_id' => 'required|exists:task_lists,id',
        ]);

        $list = TaskList::where('id', $request->task_list_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $list->tasks()->create([
            'title' => $request->title,
            'completed' => false,
        ]);

        return back();
    }

    public function update(Task $task, Request $request)
    {
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Não autenticado'], 401);
            }
            return redirect()->route('login');
        }
        abort_if($task->taskList->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'completed' => 'sometimes|boolean',
        ]);

        $task->update($validated);

        return back();
    }

    public function destroy(Task $task, Request $request)
    {
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Não autenticado'], 401);
            }
            return redirect()->route('login');
        }
        abort_if($task->taskList->user_id !== auth()->id(), 403);
        $task->delete();
        return back();
    }
}

