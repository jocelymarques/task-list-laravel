<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskList;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return auth()
            ->user()
            ->taskLists()
            ->latest()
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $list = auth()->user()->taskLists()->create($validated);

        return response()->json($list, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskList $list)
    {
        $this->authorizeList($list);

        return $list;
    }


    private function authorizeList(TaskList $list)
    {
        abort_if($list->user_id !== auth()->id(), 403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskList $list)
    {
        $this->authorizeList($list);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $list->update($validated);

        return $list;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskList $list)
    {
        $this->authorizeList($list);

        $list->delete();

        return response()->noContent();
    }
}
