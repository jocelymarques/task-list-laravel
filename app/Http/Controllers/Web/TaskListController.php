<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TaskList;
use Illuminate\Http\Request;


class TaskListController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate(['title' => 'required|string|max:255']);
        
        auth()->user()->taskLists()->create($validated);
        
        return back()->with('success', 'Lista criada com sucesso!');
    }

    public function show(TaskList $list)
    {
        return view('lists.show', compact('list'));
    }

    public function update(TaskList $list, Request $request)
    {
        $validated = $request->validate(['title' => 'required|string|max:255']);
        
        $list->update($validated);
        
        return back()->with('success', 'Lista atualizada!');
    }

    public function destroy(TaskList $list)
    {
        $list->delete();
        return back()->with('success', 'Lista excluída!');
    }
}