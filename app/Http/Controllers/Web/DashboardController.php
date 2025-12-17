<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskList;


class DashboardController extends Controller
{
    public function index()
    {
        $lists = auth()->user()->taskLists()->get();
        return view('dashboard', compact('lists'));
    }
}