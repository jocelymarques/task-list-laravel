<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskList;

class Task extends Model
{
    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }
}
