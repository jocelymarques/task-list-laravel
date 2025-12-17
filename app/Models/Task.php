<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskList;

class Task extends Model
{
    protected $fillable = [
        'title',
        'completed',
        'task_list_id',
    ];

    
    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }
}
